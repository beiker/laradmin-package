<?php

return array(

  // Titulo principal a mostrar en el header del panel.
  'name' => 'LARADMIN',

  // Ruta donde se guardara el avatar.
  'avatarpath' => 'packages/beiker/laradmin/assets/images/admin/upload/users/',

  // Ruta de la vista para el error "404 Pagina no encontrada".
  // Especificar otra ruta si se desea cambiar. Ejemplo: si se colocara
  // la ruta "errors.404" entonces el archivo deberia existir
  // en app/views/errors/404.blade.php
  'error404' => 'laradmin::errors.404',

  // Ruta de la vista para el error de los modelos no encontrado lanzaado por la
  // excepcion "ModelNotFoundException".
  // Especificar otra ruta si se desea cambiar Ejemplo: si se colocara
  // la ruta "errors.modelNotFound" entonces el archivo deberia existir
  // en app/views/errors/modelNotFound.blade.php
  'errormodel' => 'laradmin::errors.404',

  // Esta opcion indica la vista que sera utilizada para el contenido del
  // dashboard.
  'dashboard' => 'laradmin::admin.general.dashboard',

  // La siguiente opcion es necesaria cuando a la vista del dashboard requieres
  // pasarles variables desde php. Para eso necesitas crear una clase que funcionara
  // como la clase composer de la vista. Creala donde mas te plasca y no olvides
  // cargarla desde el composer.json o de alguna otra parte.
  // Posibles valores: false || ComposerClass
  'dashboardComposerClass' => 'Beiker\Laradmin\View\Composers\DashboardComposer',
);