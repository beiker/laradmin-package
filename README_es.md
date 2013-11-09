LARADMIN
================


- [Instalacion](#instalación)
- [Facade](#facade)
- [Base de Datos](#base-de-datos-migraciones-y-seeds)
- [Publicando Assets, Archivos de Configuracion, Idiomas](#publicando-assets-archivos-de-configuracion-idiomas)
- [Opciones del Comando laradmin:install](#opciones-del-comando-laradmininstall)
- [--database](#--database)
- [--envi](#--envi)
- [Instalando Ejemplos](#instalando-ejemplos)
- [USO](#uso)
- [Routes](#routes)
- [Configuracion](#configuraci%C3%B3n)
- [config.php](#configphp)
- [lang.php](#langphp)
- [assets.php](#assetsphp)
- [Privilegios](#privilegios)
- [Usuarios](#usuarios)
- [Features](#features)


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
configuracion del ambiente si es que estas usando uno.

Cabe recalcar que Laradmin cuenta con un comando que crea las migraciones y los seeds de los privilegios automaticamente,
si te interesa hacerlo mediante el comando entonces da click [AQUI](#--database).

Si deseas crear manualmente las migraciones entonces ejecuta en la Terminal el comando: 
`php artisan migrate --package=beiker/laradmin`


Y para ejecutar los seeds de los privilegios principales y del usuario admin por default de Laradmin entonces ejecuta:
`php artisan db:seed --class=LaradminDatabaseSeeder`


##Publicando Assets, Archivos de Configuracion, Idiomas.

Para poder publicar los assets(css, js, imagenes etc), los archivos de configuracion
(config, lang, assets) y los archivos de idiomas, Laradmin cuenta con un comando para realizar todo esto de un solo golpe, solo ejecuta en la Terminal 
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
Ten en cuenta que a los routes que agregues llevaran el prefijo `admin/{lang}` asi que por ejemplo para el route `report`
la url seria: `localhost/admin/report` o si esta algun lang seleccionado seria `localhost/admin/es/report`

En el caso de usar controllers restful/resources todo seria igual, tendrias que crear el archivo en `app/controllers` y declarar tus metodos
en él.

###Configuración

Laradmin cuenta por ahora con unicamente tres archivos de configuracion muy basicos los cuales se encuentran en
`app/config/packages/beiker/laradmin/`. A continuación explicare los archivos de configuración.

######config.php

En este archivo se le pueden especificar cuatro opciones de configuracion: <br /> 

- `name` Esta opcion es el text que aparecera en el navbar header o la barra superior del template.
- `avatarpath` Esta opcion indica la ruta donde se almacenaran las imagenes que se suben al crear un nuevo usuario.
<b>Nota: En dado caso que al querer crear un nuevo usuario con una imagen desde el formulario te marque error de permisos/escritura,
dale permisos de escritura a la carpeta que especificaste en esta opcion.</b>
- `error404` Especifica la vista que mostrará para el error 404 pagina no encontrada.
- `errormodel` Esta otra indica la vista que se mostrará para el error `Model not found`, lanzado por los metodos
`findOrFail` etc.
- `dashboard` Esta opcion indica la vista que sera utilizada para el contenido del dashboard.
- `dashboardComposerClass` Esta opcion es necesaria en caso que requieras pasarle datos a la vista especificada en la opcion `dashboard`. Aqui
debes especificar el nombre de la clase composer que servira para construir la vista.
Para mas info acerca de las vistas composer [AQUI](http://laravel.com/docs/responses#view-composers)

######lang.php

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

######assets.php

Este archivo de configuracion almacena los paths de los css y js que son usados por default en Laradmin, aquí es donde
puedes agregar styles y scripts que quieres que sean cargados en todos los routes de Laradmin. Te recomiendo que no 
quites los css y js que vienen por default ya que pueden afectar el comportamiento del javascript o el estilo de los
componentes html.


### Privilegios

La idea de implementar los privilegios en Laradmin y no mediante roles, grupos etc, es hacerlo un poco mas simple. Cada 
privilegio es una accion como por ejemplo mostrar el listado de usuarios, eliminar algun recurso, desactivar, 
ver un reporte etc, y a esos privilegios unicamente podran acceder aquellos usuarios que tengan ese  privilegio asignado.

En la seccion de Privilegios podras encontrar un listado de los privilegios existentes asi como las opciones de editar,
eliminar, desactivar, activar.

Para crear un privilegio esto se hace mediante el formulario de crear privilegio que puede ser accedido mediante el menu (Privilegios > Nuevo).

A continuacion explicare los campos del formulario para crear un privilegio:

######Nombre
El campo `nombre` es requerido. Este es el nombre a desplegar en el menu o en algun boton de privilegio (explicado mas adelante).

######Url accion
El campo `url accion` es requerido. En este campo debes colocar el route al que accedera.

######Icon
El campo `icon` no es obligatorio. Los iconos que puedes usar se encuentra en [FontAwesome](http://fortawesome.github.io/Font-Awesome/icons/), 
unicamente debes de colocar el texto despues de `fa-` por ejemplo si el icono es `fa-comments` entonces debes poner `comments`.
FontAwesome cuenta con otras clases que pueden ser utiles como `fa-fw` o las clases zoom `fa-2x`, si quieres usar alguna clase extra
entonces colocalas despues del nombre del icon por ejemplo: `comments fa-2x fa-fw`

######Mostrar en menu
El campo `mostrar en menu` sirve para aquellos privilegios que quieres que se vean en el menu izquierdo. Por lo regular los
privilegios que son mostrados en el menu son aquellos que muestran listados, formularios de creacion, reportes etc. Sientete
libre de marcar esta opcion para los privilegios que tu quieras.

######Target blank
El campo `target blank` creo que es muy obvia esta opcion, lo que hace es abrir los privilegios en otra pestaña del navegador.

######Lang file
El campo `lang file` es util por si estas usando diferentes idiomas en Laradmin, el formato de este campo es `archivo.opcion`.El
archivo debe existir en la ruta `app/lang/{lang}/laradmin/`. Por ejemplo si colocaste `miarchivo.reporte` y estas usando los lang
`en` y `es` entonces debes crear el archivo `miarchivo.php` dentro de `app/lang/en/laradmin/` y `app/lang/es/laradmin/`.
Para mas info acerca de localization en Laravel da click [AQUI](http://laravel.com/docs/localization#language-files)

> Si quiere que laradmin tome en cuenta tus langs entonces en el archivo de configuracion `app/config/packages/beiker/laradmin/lang`
la opcion `default` ponla como `false`

######Usar lang por default
El campo `usar lang por default` indica si el nombre a mostrar en el privilegio es el que esta ligado al campo `lang file`. Si esta
opcion no es marcada entonces el nombre a mostrar del privilegio sera el campo `nombre`.

######Privilegios
El campo `privilegios` es el arbol de privilegios que existen en Laradmin, aqui tienes que seleccionar a que rama
de los privilegios pertenece el privilegio que estas agregando.


### Usuarios

Esta seccion al igual que la de privilegios tiene un listado de los usuarios existentes los cuales podras editar, 
eliminar, desactivar, activar y agregar.

Agregar un nuevo usuario.

El formulario para agregar un nuevo usuario es muy simple, requiere de datos que no son tan necesarios de explicar, el que
si es necesario explicar es el campo `Privilegios`. Este campo muestra el arbol de los privilegios existentes en Laradmin,
todos esos privilegios son los que ya vienen por default en Laradmin y tambien deberan aparecer aquellos que tu agregues.

Es de suma importancia asignar los privilegios necesarios al usuario, asignarle privilegios que el usuario no requiere o que
no debe tener acceso puede ser se de mucho riesgo. Solamente asegurate de asignarle los privilegios que ese usuario necesita para
ello solamente tienes que marcarlos, si te equivocaste al momento de agregar el usuario, no te preocupes puedes modificarlo,
solo ve al listado de usuario da click en el boton editar y modificalo.


###Credenciales por Default

Al momento de ejecutar los seeds para crear los privilegios por default de Laradmin tambien se crea un usuario administrador
por default, el usuario y pass para que puedas acceder son los siguientes:

`Usuario: admin`
`Password: 123456`

###Features

- [Bootstrap 3](http://getbootstrap.com/)
- [Font Awesome](http://fortawesome.github.io/Font-Awesome/)
- [Jquery](http://jquery.com/)
- [Uniform](http://uniformjs.com/)
- [Noty](http://needim.github.io/noty/)

