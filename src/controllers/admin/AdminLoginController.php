<?php namespace Beiker\Laradmin\Controllers;

use Beiker\Laradmin\Auth\Auth;
use Illuminate\Routing\Controllers\Controller;

class AdminLoginController extends Controller {

  public function __construct(Auth $auth)
  {
    // Filter validate if Auth existe.
    $this->beforeFilter(function()
    {
      if (\Auth::check()) return \Redirect::to(\Util::getUrlLang('admin/home'));
    });

    // Filter csrf protection.
    $this->beforeFilter('csrfadmin', array('on'=>'post'));

    $this->auth = $auth;
  }

  /**
   * Show login form.
   *
   * Get admin/login
   *
   * @return void
   */
  public function getIndex()
  {
    $title = trans(\Conf::langPath().'messages.admin-auth-header-title');

    return \View::make('laradmin::admin.general.login')
      ->with(compact('title'));
  }

  /**
   * POST /admin/auth
   *
   * @return
   */
  public function postAuth()
  {
    $validation = new \Validators\Admin\Auth;

    if ($validation->passes())
    {
      // Llama auth() para crear autenticacion.
      $auth = $this->auth->authenticate(\Input::all());

      // If Auth passes.
      if ($auth['passes'])
      {
        // Si la autenticacion pasa redirecciona al home.
        return \Redirect::intended(\Util::getUrlLang('admin/home'));
      }

      //Auth fails.
      else
      {
        // noty array.
        // $noty = Util::noty($auth['message']);
        $alertbs = \Util::noty($auth['message']);

        // redirect to login.
        return \Redirect::route('admin.show.login')
          ->with(compact('alertbs'));
      }
    }

    $alertbs = true;

    // if validation fails then back to login.
    return \Redirect::back()
      ->withErrors($validation->errors)->with(compact('alertbs'));
  }

}
