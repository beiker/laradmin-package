<?php

/*
|--------------------------------------------------------------------------
| Laradmin Routes
|--------------------------------------------------------------------------
|
| Aqui es donde tu puedes registrar todos tus routes para Laradmin.
| Solamente agrega los URIs como en cualquier otra aplicacion. Ten en cuenta
| que toda URI llevará el prefijo "admin/" y si estas usando "lang" entonces
| el prefijo seria "admin/en" o "admin/es" o alguno otro que tu hallas agregado
| en el archivo de configuracion "lang", pero no te preocupes eso ya lo
| maneja Laradmin automaticante. Asi que por ejemplo
| si quieres tener las ruta "admin/examples" se  podria hacer asi:
|
*/
return array(

  'routes' => function ()
  {
    // admin/examples
    // Route::get('examples', function()
    // {
    //   $title = 'Basic Example';
    //   return View::make('admin.examples.basic')->with(compact('title'));
    // });

    // o con un controller, para esto tendrias que crear el controller en el
    // directorio de siempre: app/controllers/

    // admin/examples
    // Route::controller('examples', 'ExamplesController');

    // Todo depende de ti :)
  }

);