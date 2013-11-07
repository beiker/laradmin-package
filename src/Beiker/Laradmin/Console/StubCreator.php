<?php namespace Beiker\Laradmin\Console;

use Illuminate\Filesystem\Filesystem;

class StubCreator {

  /**
   * Constructor.
   *
   * @param Illuminate\Filesystem\Filesystem $filesys
   */
  function __construct(Filesystem $filesys)
  {
    $this->filesys = $filesys;
  }

  /**
   * Copea los archivos lang en los directorios:
   *
   *   ingles => app/lang/en | app/lang/en/laradmin
   *  español => app/lang/es | app/lang/es/laradmin
   *
   * @param  string $pathDest
   * @return void
   */
  public function lang($pathDest)
  {
    // Verifica si no existe el dir laradmin/ en la carpeta en/
    if ( ! $this->filesys->isDirectory("{$pathDest}/en/laradmin"))
    {
      // Crea el directorio laradmin y tambien aquellos directorios padres
      // que no existan.
      $this->filesys->makeDirectory("{$pathDest}/en/laradmin", 0777, true);

      // Copea los archivos menu.php y messages.php dentro de app/lang/en/laradmin
      $this->filesys->copy(__DIR__.'/../../../lang/en/menu.php', "{$pathDest}/en/laradmin/menu.php");
      $this->filesys->copy(__DIR__.'/../../../lang/en/messages.php', "{$pathDest}/en/laradmin/messages.php");

      // Copea los archivos pagination.php, reminders.php y validation.php dentro
      // de app/lang/en/
      $this->filesys->copy(__DIR__.'/../../../lang/en/pagination.php', "{$pathDest}/en/pagination.php");
      $this->filesys->copy(__DIR__.'/../../../lang/en/reminders.php', "{$pathDest}/en/reminders.php");
      $this->filesys->copy(__DIR__.'/../../../lang/en/validation.php', "{$pathDest}/en/validation.php");

    }

    // Verifica si no existe el dir laradmin/ en la carpeta es/
    if ( ! $this->filesys->isDirectory("{$pathDest}/es/laradmin"))
    {
      // Crea el directorio laradmin y tambien aquellos directorios padres
      // que no existan.
      $this->filesys->makeDirectory("{$pathDest}/es/laradmin", 0777, true);

      // Copea los archivos menu.php y messages.php dentro de app/lang/es/laradmin
      $this->filesys->copy(__DIR__.'/../../../lang/es/menu.php', "{$pathDest}/es/laradmin/menu.php");
      $this->filesys->copy(__DIR__.'/../../../lang/es/messages.php', "{$pathDest}/es/laradmin/messages.php");

      // Copea los archivos pagination.php, reminders.php y validation.php dentro
      // de app/lang/es/
      $this->filesys->copy(__DIR__.'/../../../lang/es/pagination.php', "{$pathDest}/es/pagination.php");
      $this->filesys->copy(__DIR__.'/../../../lang/es/reminders.php', "{$pathDest}/es/reminders.php");
      $this->filesys->copy(__DIR__.'/../../../lang/es/validation.php', "{$pathDest}/es/validation.php");
    }
  }

  /**
   * Crea los ejemplos.
   *
   * @param  string $pathDest
   * @return void
   */
  public function examples($pathDest)
  {
    if ( ! $this->filesys->isDirectory("{$pathDest}/controllers/admin/"))
    {
      $this->filesys->makeDirectory("{$pathDest}/controllers/admin", 0777, false);

      if ($this->filesys->isDirectory("{$pathDest}/controllers/admin/"))
      {
        $this->filesys->copy(__DIR__.'/Stubs/ExamplesController.php', "{$pathDest}/controllers/admin/ExamplesController.php");
      }
    }

    if ( ! $this->filesys->isDirectory("{$pathDest}/views/admin/examples"))
    {
      $this->filesys->makeDirectory("{$pathDest}/views/admin/examples", 0777, true);

      if ($this->filesys->isDirectory("{$pathDest}/views/admin/examples"))
      {
        $this->filesys->copy(__DIR__.'/Stubs/basic.blade.php', "{$pathDest}/views/admin/examples/basic.blade.php");
        $this->filesys->copy(__DIR__.'/Stubs/advanced.blade.php', "{$pathDest}/views/admin/examples/advanced.blade.php");
      }
    }
  }

}
