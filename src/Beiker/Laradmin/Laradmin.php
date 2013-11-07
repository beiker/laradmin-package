<?php namespace Beiker\Laradmin;

class Laradmin {

  /**
   * Almacena los css que el usuario quiera cargar.
   *
   * @var array
   */
  protected $styles = array();

  /**
   * Almacena los scripts que el usuario quiera cargar.
   *
   * @var array
   */
  protected $scripts = array();

  protected $routes;

  /**
   * Asgina los css.
   *
   * @param  array  $css
   * @return void
   */
  public function styles(array $css = array())
  {
    $this->styles = $css;
  }

  /**
   * Asigna los scripts.
   *
   * @param  array  $js
   * @return void
   */
  public function scripts(array $js = array())
  {
    $this->scripts = $js;
  }

  /**
   * Regresa todos los css usados en laradmin.
   *
   * @return array
   */
  public function getStyles()
  {
    return array_merge([
      'packages/beiker/laradmin/assets/libs/bootstrap/css/bootstrap.min.css',
      'packages/beiker/laradmin/assets/libs/bootstrap/css/bootstrap-theme.min.css',
      'packages/beiker/laradmin/assets/libs/font-awesome/css/font-awesome.min.css',
      'packages/beiker/laradmin/assets/libs/jquery-ui/css/jquery-ui-1.9.2.custom.min.css',
      'packages/beiker/laradmin/assets/libs/jquery-noty/css/jquery.noty.css',
      'packages/beiker/laradmin/assets/libs/jquery-uniform/css/uniform.default.min.css',
      'packages/beiker/laradmin/assets/css/admin/laradmin.css',
      'packages/beiker/laradmin/assets/css/admin/menu.css',
    ], $this->styles);
  }

  /**
   * Regresa todos los scripts usados en laradmin.
   *
   * @return array
   */
  public function getScripts()
  {
    return array_merge([
      'packages/beiker/laradmin/assets/libs/jquery/jquery-2.0.0.min.js',
      'packages/beiker/laradmin/assets/libs/jquery-ui/scripts/jquery-ui-1.9.2.custom.min.js',
      'packages/beiker/laradmin/assets/libs/bootstrap/scripts/bootstrap.min.js',
      'packages/beiker/laradmin/assets/libs/jquery-noty/scripts/jquery.noty.js',
      'packages/beiker/laradmin/assets/libs/jquery-uniform/scripts/jquery.uniform.min.js',
      'packages/beiker/laradmin/assets/scripts/admin/laradmin.js',
      'packages/beiker/laradmin/assets/scripts/admin/menu.js',
    ], $this->scripts);
  }

  /**
   * Directorio para los css.
   *
   * @return string
   */
  public function cssDir()
  {
    return 'packages/beiker/laradmin/assets/css/';
  }

  /**
   * Directorio para los js.
   *
   * @return string
   */
  public function jsDir()
  {
    return 'packages/beiker/laradmin/assets/scripts/';
  }

  /**
   * Directorio para las librerias.
   *
   * @return string
   */
  public function libsDir()
  {
    return 'packages/beiker/laradmin/assets/libs/';
  }

  /**
   * Inicializa el paginador.
   *
   * @param  Illuminate\Database\Eloquent\Builder $query
   * @param  integer $perPage
   * @return
   */
  public function paginate($query, $perPage)
  {
    return \Pagination::setup($query, $perPage);
  }

  /**
   * Renderiza la paginacion.
   *
   * @param  Illuminate\Pagination\Paginator $paginator
   * @param  string $classes
   * @return string
   */
  public function renderPag($paginator, $classes = '')
  {
    return \Pagination::make($paginator, $classes);
  }

  /**
   * Llama el metodo estatico noty de la clase Util para generar la estructura
   * de una alerta.
   *
   * @param  string $message
   * @param  string $type
   * @return string
   */
  public function alert($message, $type = 'error')
  {
    return \Util::noty($message, $type);
  }

  /**
   * Llama el metodo estatico de la clase Util para genera el HTML
   * de la alerta de bootstrap.
   *
   * @param  array  $config
   * @return string
   */
  public function showAlert($config = array())
  {
    return \Util::alert($config);
  }

  /**
   * Asigna/Inicializa los routes del usuario y de laradmin.
   *
   * @param  Closure $fn
   * @return void
   */
  public function routes(\Closure $fn)
  {
    $this->routes = $fn;

    include __DIR__.'/../../routes.php';
  }

  /**
   * Obtiene los routes del usuario.
   *
   * @return Closure
   */
  public function getRoutes()
  {
    return $this->routes;
  }

}
