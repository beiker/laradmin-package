<?php

/*
 |------------------------------------------------------------------------
 | Laradmin Filters
 |------------------------------------------------------------------------
 */

 /*
  | Este filtro valida que el usuario este autenticado en la app, si no lo
  | esta redirecciona al login del panel.
  |
  | Si el usuario esta logueado entonces verifica que cuente con la autorizacion
  | o permisos para acceder a la url.
  |
  | Si no cuenta con los permisos para acceder entonces redirecciona al home
  | del panel mostrando un mensaje.
  */
 Route::filter('authadmin', function()
 {
   if ( ! Auth::check())
   {
     return Redirect::route('admin.show.login');
   }
   else
   {
     if ( ! Request::ajax())
     {
       $langs = Config::get('laradmin::lang.valid_langs');

       $seg   = in_array(Request::segment(2), $langs) ? 3 : 2;

       $urlPriv = Request::segment($seg) .
         ( ! is_null(Request::segment($seg + 1)) ?
           (Request::segment($seg + 1) !== 'index' ? '/'.Request::segment($seg + 1) : '') : '');

       if ($urlPriv !== 'home' && $urlPriv !== 'home/index')
       {
         $userHasPriv = App::make('Beiker\Laradmin\User\UserHasPrivilege');

         $userHasPriv->setUrlOrId($urlPriv);
         $userHasPriv->setUserId(Auth::user()->id);

         if ( ! $userHasPriv->has())
         {
           $noty = Util::noty('No tiene autorizada la pagina u operación!');

           return Redirect::route('admin.dashboard')
             ->with(compact('noty'));
         }
       }
     }
   }
 });


 /*
  | Filtro Csrf.
  */
 Route::filter('csrfadmin', function()
{
  if (Request::getMethod() === 'POST' && ! Request::ajax())
  {
    if (Session::token() != Input::get('_token'))
    {
      throw new Illuminate\Session\TokenMismatchException;
    }
  }
});