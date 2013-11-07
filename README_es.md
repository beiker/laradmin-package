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


### Base de Datos (Migraciones y Seeds)

Laradmin necesita de cuatro tablas para su funcionamiento las cuales son:

- users
- privileges
- privilege_user
- users_logs

Las estructuras de estas tablas se encuentras en migraciones dentro del paquete de Laradmin. Antes de ejecutar las migraciones
tienes que especificar la base de datos a usar en la app, esto se hace en el archivo `app/config/database.php` o en la 
configuracion del ambiente si es que estas usando alguna.

Cabe recalcar que Laradmin cuenta con un comando que crea las migraciones y los seeds de los privilegios, si te interesa
hacerlo mediante el comando entonces da click [AQUI](#--database).

Si deseas crear manualmente las migraciones entonces ejecuta en la Terminal el comando: 
`php artisan migrate -package=beiker/laradmin`


Y para ejecutar los seeds de los privilegios principales y del usuario admin por default de Laradmin entonces ejecuta:
`php artisan db:seed --class=LaradminDatabaseSeeder`


##Publicando Assets, Archivos de Configuracion, Idiomas.

Una vez realizado lo anterior, para poder publicar los assets(css, js, imagenes etc), los archivos de configuracion
(config, lang) y los archivos de idiomas, Laradmin cuenta con un comando para realizar todo esto de un solo golpe, solo ejecuta en la Terminal 
el comando: `php artisan laradmin:install`

###Opciones del Comando laradmin:install


######--database
`php artisan laradmin:install --database`: Con la opcion `--database` se crearan las tablas necesarias para el funcionamiento
de Laradmin y tambien ejecutara los seeders para insertar los privilegios principales y un usuario administrador por default. 
> <b>NOTA: Antes de ejectuar el comando con esta opcion tienes que especificar la base de datos a utilizar en el archivo `app/config/database.php` </b>

#####--envi
`php artisan laradmin:install --envi`: La opcion `--envi` sirve para en caso de que estes usando algun ambiente.
Ejemplo: `php artisan laradmin:install --database --envi="dev"`

## Instalando Ejemplos

Los ejemplos contienen codigo de como puedes utilizar Laradmin desde tus controller, los routes, extender la vista master de Laradmin,
como enviar mensajes a las vistas, etc etc.

Para instalar los ejemplos simplemente ejecuta el comando: `php artisan laradmin:install --examples`

Esto creara los siguientes archivos:

Controller: `app/controllers/admin/ExamplesController.php`<br />
Views: `app/views/admin/examples/basic.blade.php` y `app/views/admin/examples/advanced.blade.php`

Para poder acceder a los ejemplos mediante el navegador tienes que descomentar las siguientes lineas del 
archivo `app/routes.php`


```
Route::get('examples', function()
{
  $title = 'Basic Example';
  return View::make('admin.examples.basic')->with(compact('title'));
});
```


o si quieres acceder a los ejemplos mediante el controller entonces descomenta la linea:

```Route::controller('examples', 'ExamplesController');```

Si al intentar acceder a los ejemplos te sale el error `ExamplesController Not Found` entonces ejecuta en la Terminal:

`composer.phar dumpautoload -o`

##USO


###Routes

Los routes al igual que en otra aplicacion en Laravel son colocados dentro del archivo `app/routes.php`, pero para que sean
tomados en cuenta dentro de los routes de Laradmin tienes que utilizar el metodo `Laradmin::routes()` y pasarle un closure 
con los routes que desees. Ejemplo


```
// file app/routes.php

<?php

Laradmin::routes(function() 
{
  // admin/report o admin/{lang}/report
  Route::get('report', function() 
  {
    return 'Hi Report !!!';
  });
  
  Route::controller('stuff', 'StuffController');
});

```
Ten en cuenta que a los routes que agregues se le añadira el prefijo `admin/{lang}` asi que por ejemplo para el route `report`
la url seria: `tuproyecto.com/admin/report` o si esta algun lang seleccionado seria `tuproyecto.com/admin/es/report`

En el caso de usar controllers restful/resources todo seria igual, tendrias que crear el archivo en `app/controllers` y declarar tus metodos
en él.

###Configuración

Laradmin cuenta por ahora con unicamente dos archivos de configuracion muy basicas los cuales se encuentran en
`app/config/packages/beiker/laradmin/`. A continuación explicare ambos archivos.

######Archivo config.php

En este archivo se le pueden especificar cuatro opciones de configuracion: <br /> 

- `name` Esta opcion es el text que aparecera en el navbar header o la barra superior del template.
- `avatarpath` Esta opcion indica la ruta donde se almacenaran las imagenes que se suben al crear un nuevo usuario.
- `error404` Especifica la vista que mostrará para el error 404 pagina no encontrada.
- `errormodel` Esta otra indica la vista que se mostrará para el error `Model not found`, lanzado por los metodos
`findOrFail` etc.

######Archivo lang.php

Este archivo esta relacionado con los idiomas a implementar en Laradmin, por default viene con Ingles y Español
pero se pueden agregar más o quitar, los archivos lang de Laradmin se encuentran en el directorio `app/lang/{en|es}/laradmin/`
los cuales son creados al momento de ejecutar el commando `php artisan laradmin:install`, dentro de este directorio
se encuentran dos archivos: 

- `menu.php` el cual contiene las traducciones para los privilegios.
- `messages.php` el cual tiene las traduccion de textos en general de Laradmin.

Sientete libre para agregar/quitar/cambiar las traducciones de ambos archivos. En cuanto a las opciones de configuracion
del archivo `lang.php` son las siguientes:

- `default` Esta opcion le indica a Laradmin si tomara los archivos de traduccion que vienen en el paquete o los que estan
en el directorio `app/lang`<br>
      
      `true`: Tomara en cuenta las traducciones dentro del Paquete.<br>
      `false`: Tomara en cuenta las traducciones en `app/lang`.<br>

- `valid_langs` Este array contiene los idiomas que seran usados en Laradmin. Aqui es donde tienes que poner los idiomas a
usar, ten en cuenta que si agregas nuevos idiomas tienes que agregar sus archivos en `app/lang`. La primera posición del array es la que 
se cargará por default así que si el array es: ```['es', 'en']``` entonces el español sera cargado por default cuando
en la url no se especifique un idioma.

### Agregar Privilegios


### Agregar Usuarios



