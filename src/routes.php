<?php
Route::get('/', function()
{
  return 'Hola';
});
/*
|--------------------------------------------------------------------------
| Laradmin Application Routes
|--------------------------------------------------------------------------
*/
$languages = Config::get('laradmin::lang.valid_langs');

$locale = Request::segment(2);

if(in_array($locale, $languages))
{
  App::setLocale($locale);
}
else
{
  if (count($languages) > 0)
  {
    App::setLocale($languages[0]);
  }

  $locale = '';
}

Route::group(array('prefix' => "admin/{$locale}"), function() use ($locale)
{

  /*
   |------------------------------------------------------------------------
   | Login & Logout Panel.
   |------------------------------------------------------------------------
   */
  Route::controller('login', 'Beiker\Laradmin\Controllers\AdminLoginController', array(
    'getIndex' => 'admin.show.login',
    'postAuth' => 'admin.create.login',
  ));

  Route::get('logout', function()
  {
    Auth::logout();
    Session::forget('id');
    Session::forget('name');
    Session::forget('user');
    Session::forget('email');
    Session::forget('tipo');

    return Redirect::route('admin.show.login');
  });

  /*
   |-----------------------------------------------------------------------
   | Route group que contiene los routes del panel de admin.
   | Se necesita estar autenticado para poder entrar el group
   | de lo contrario redireccionara al login del panel.
   |-----------------------------------------------------------------------
   */
  Route::group(array('before' => 'authadmin|csrfadmin', 'prefix' => ""), function()
  {
    // admin/home
    Route::controller('home', 'Beiker\Laradmin\Controllers\AdminDashboardController', array(
      'getIndex' => 'admin.dashboard',
    ));

    // admin/privileges
    Route::controller('privileges', 'Beiker\Laradmin\Controllers\PrivilegesController', array(
      'getIndex'      => 'privileges.index',
      'getCreate'     => 'privileges.create',
      'postStore'     => 'privileges.store',
      'getEdit'       => 'privileges.edit',
      'putUpdate'     => 'privileges.update',
      'getDelete'     => 'privileges.delete',
      'getSoftdelete' => 'privileges.softdelete',
      'getRestore'    => 'privileges.restore',
    ));

    // admin/users
    Route::controller('users', 'Beiker\Laradmin\Controllers\UsersController', array(
      'getIndex'  => 'users.index',
      'getCreate' => 'users.create',
      'postStore' => 'users.store',
      'getEdit'   => 'users.edit',
      'putUpdate' => 'users.update',
      'getDelete' => 'users.delete',
    ));

    call_user_func(Laradmin::getRoutes());
  });
});