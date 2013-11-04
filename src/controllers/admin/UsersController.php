<?php namespace Beiker\Laradmin\Controllers;

use Beiker\Laradmin\Storage\User\UserRepositoryInterface;
use Beiker\Laradmin\Privilege\TreePrivilegesBuilder;
use Beiker\Laradmin\Privilege\LinkPrivilegeGenerator;
use Illuminate\Routing\Controllers\Controller;

class UsersController extends Controller {

  /**
   * Construct.
   *
   * @param Beiker\Laradmin\Storage\User\UserRepositoryInterface $user
   * @param Beiker\Laradmin\Privilege\TreePrivilegesBuilder      $treePrivileges
   */
  public function __construct(UserRepositoryInterface $user,
                              TreePrivilegesBuilder $treePrivileges,
                              LinkPrivilegeGenerator $linkGenerator)
  {
    $this->user = $user;
    $this->treePrivileges = $treePrivileges;
    $this->linkGenerator = $linkGenerator;
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getIndex()
  {
    $scripts = array(
      \Laradmin::jsDir().'admin/msgbox.js',
    );

    $pagination = $this->user->filterList(40);

    $users = $pagination['items'];

    $linkGenerator = $this->linkGenerator;

    $title = trans(\Conf::langPath().'messages.users');

    \Laradmin::scripts($scripts);

    return \View::make('laradmin::admin.users.index')
      ->with(compact('title', 'crumbTitle', 'users', 'linkGenerator'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function getCreate()
  {
    $styles = array(
      \Laradmin::libsDir().'jquery-treeview/css/jquery.treeview.css',
    );

    $scripts = array(
      \Laradmin::libsDir().'jquery-treeview/scripts/jquery.treeview.js',
    );

    $title      = trans(\Conf::langPath().'messages.admin-users-create-title');
    $crumbTitle = trans(\Conf::langPath().'messages.add');

    $linkGenerator  = $this->linkGenerator;
    $treePrivileges = $this->treePrivileges;

    \Laradmin::styles($styles);
    \Laradmin::scripts($scripts);

    return \View::make('laradmin::admin.users.create')
      ->with(compact('title', 'crumbTitle', 'linkGenerator', 'treePrivileges'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function postStore()
  {
    $validation = new \Validators\Admin\UsersCreate;

    if ($validation->passes())
    {
      $this->user->create(\Input::all());

      $noty = \Util::noty(trans(\Conf::langPath().'messages.admin-users-create-success'), 'success');

      return \Redirect::route('users.create')
        ->with(compact('noty'));
    }

    return \Redirect::route('users.create')
      ->withErrors($validation->errors)
      ->withInput();
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function getEdit($id = 0)
  {
    $styles = array(
      \Laradmin::libsDir().'jquery-treeview/css/jquery.treeview.css',
    );

    $scripts = array(
      \Laradmin::libsDir().'jquery-treeview/scripts/jquery.treeview.js',
    );

    $title      = trans(\Conf::langPath().'messages.admin-users-edit-title');
    $crumbTitle = trans(\Conf::langPath().'messages.edit');

    $linkGenerator  = $this->linkGenerator;
    $user = $this->user->findOrFail($id, 'withTrashed');

    $treePrivileges = $this->treePrivileges;

    \Laradmin::styles($styles);
    \Laradmin::scripts($scripts);

    return \View::make('laradmin::admin.users.edit')
      ->with(compact('title', 'crumbTitle', 'user', 'linkGenerator', 'treePrivileges'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function putUpdate($id)
  {
    $validation = new \Validators\Admin\UsersEdit($id);

    if ($validation->passes())
    {
      $this->user->update($id, \Input::all());

      $noty = \Util::noty(trans(\Conf::langPath().'messages.admin-users-update-success'), 'success');

      return \Redirect::route('users.edit', array($id))
        ->with(compact('noty'));
    }

    return \Redirect::route('users.edit', array($id))
      ->withErrors($validation->errors)
      ->withInput();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function getDelete($id)
  {
    if (! is_null($user = $this->user->findOrFail($id, 'withTrashed')))
    {
      $notyMsg = trans(\Conf::langPath().'messages.admin-user-delete-success');
      $notyIco = 'success';

      $user->forceDelete();
    }

    $noty = \Util::noty($notyMsg, $notyIco);

    return \Redirect::route('users.index')
      ->with(compact('noty'));
  }

  /**
   * Deactiva the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function getSoftdelete($id)
  {
    if (! is_null($user = $this->user->findOrFail($id, 'withTrashed')))
    {
      $notyMsg = trans(\Conf::langPath().'messages.admin-user-softdelete-success');
      $notyIco = 'success';

      $user->delete();
    }

    $noty = \Util::noty($notyMsg, $notyIco);

    return \Redirect::route('users.index')
      ->with(compact('noty'));
  }

  /**
   * Restore the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function getRestore($id)
  {
    if (! is_null($user = $this->user->findOrFail($id, 'withTrashed')))
    {
      $notyMsg = trans(\Conf::langPath().'messages.admin-user-restore-success');
      $notyIco = 'success';

      $user->restore();
    }

    $noty = \Util::noty($notyMsg, $notyIco);

    return \Redirect::route('users.index')
      ->with(compact('noty'));
  }

}