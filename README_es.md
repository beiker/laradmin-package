LARADMIN
================


##Instalación


Agregar a tu composer.json 


	"require": {
      "laravel/framework": "4.0.*",
      "beiker/laradmin": "master"
	}
	
Despues ejecuta en la Terminal:

`composer.phar update`

Una vez que termina de descargar y actualizar los archivos, el siguiente paso es agregar el service provider, esto se 
hace en el archivo `app/config/app.php` en el array `providers` al final coloca:

`'Beiker\Laradmin\LaradminServiceProvider'`

###Facade
En el mismo archivo donde agregaste el service provider, en el array `aliases` al final agrega:
`'Laradmin' => 'Beiker\Laradmin\Facades\Laradmin',`


##Publicando Assets, Archivos de Configuracion, Idiomas.

Una vez realizado lo anterior, para poder publicar los assets(css, js, imagenes etc), los archivos de configuracion
(config, lang, routes) y los archivos de idiomas, Laradmin cuenta con un comando para realizar todo esto de un solo golpe, solo ejecuta en la Terminal 
el comando: `php artisan laradmin:install`

###Opciones del Commando laradmin:install

`php artisan laradmin:install --database`: Con la opcion `--database` se crearan las tablas necesarias para el funcionamiento
de Laradmin y tambien ejecutara los seeders para insertar los privilegios principales y un usuario administrador por default. 
<b>NOTA: Antes de ejectuar el comando con esta opcion tienes que especificar la base de datos a utilizar en el archivo `app/config/database.php` </b>

`php artisan laradmin:install --envi`: La opcion `--envi` sirve para en caso de que estes usando algun ambiente.
Ejemplo: `php artisan laradmin:install --database --envi="dev"`

## Instalando Ejemplos

Los ejemplos contienen codigo de como puedes utilizar Laradmin desde tus controller, los routes, extender la vista master de Laradmin,
como enviar mensajes a las vistas, etc etc.

Para instalar los ejemplos simplemente ejecuta el comando: `php artisan laradmin:install --examples`

Esto creara los siguientes archivos:

Controller: `app/controllers/admin/ExamplesController.php`<br />
Views: `app/views/admin/examples/basic.blade.php` y `app/views/admin/examples/advanced.blade.php`

Para poder acceder a los ejemplos mediante el navegador antes tienes que descomentar las siguientes lineas del 
archivo `app/config/packages/beiker/laradmin/routes.php`


```
Route::get('examples', function()
{
  $title = 'Basic Example';
  return View::make('admin.examples.basic')->with(compact('title'));
});
```


o si quieres acceder mediante el controller entonces descomenta la linea:

```Route::controller('examples', 'ExamplesController');```

Si al intentar acceder a los ejemplos te sale el error `ExamplesController Not Found` entonces ejecutar en la Terminal:

`composer.phar dumpautoload -o`
