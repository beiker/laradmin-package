<?php namespace Beiker\Laradmin\View;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ViewServiceProvider extends ServiceProvider {

  public function register()
  {
  }

  public function boot()
  {
    // View composer menu.
    \View::composer('laradmin::admin.master', function($view)
    {
      if (\Auth::check())
      {
        $menu = \App::make('Beiker\Laradmin\Privilege\MenuConstructor');

        $view->nest('menu', 'laradmin::admin.general.menu', compact('menu'));
      }
      else
      {
        $view->with('menu', '');
      }
    });

    // Modelo no encontrado.
    $this->app->error(function(ModelNotFoundException $e)
    {
      return \Response::view(\Conf::errorModelView(), array(), 404);
    });

    // Error 404 pagina no encontrada.
    $this->app->missing(function($exception)
    {
      return \Response::view(\Conf::error404View(), array(), 404);
    });
  }

}