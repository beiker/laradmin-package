<?php

/**
 * Clase con funciones helpers que se llaman staticamente.
 *
 * @package helpers
 * @author beiker
 **/
class Util {

  /**
   * Construye array para el noty.
   *
   * @param  string $message
   * @param  string $ico
   * @return array
   */
  public static function noty($message='Error', $ico='error')
  {
    return array('message' => $message, 'ico' => $ico);
  }

  /**
   * Construye una lista <li> con mensajes para el alert.
   *
   * @param  string $message
   * @param  string $ico
   * @return array
   */
  public static function liAlert($message = array(), $header = '')
  {
    array_walk($message, function(&$item, $key) {
      $item = "<li>{$item}</li>";
    });
    return implode('', $message);
  }

  /**
   * Construye el breadcrumb.
   *
   * @param  string $title
   * @return string
   */
  public static function breadcrumb($title=null)
  {
    // array(2) { [0]=> string(5) "panel" [1]=> string(11) "privilegios" }
    $segments = Request::segments();

    // Extrae la posicion 0 del array
    $first = array_shift($segments);

    $breadcrumb = array();

    array_push($breadcrumb, '<div><ol class="breadcrumb">');

    array_push($breadcrumb,
      '<li>
        <a href="' . URL::route('admin.dashboard') . '"><i class="fa fa-home"></i> '.trans(Conf::langPath().'messages.admin-bread-init').'</a>
        <span class="divider"><i class="icon-angle-right"></i></span>
      </li>');

    // Extrae la ultima posicion del array
    $last = array_pop($segments);

    if ($last === 'index')
    {
      $last = array_pop($segments);
    }

    $exclude = array_merge(array('edit', 'show'), \Config::get('laradmin::lang.valid_langs'));

    // Recorre los segmentos restantes
    foreach($segments as $segment)
    {
      if ( ! in_array($segment, $exclude))
      {
        array_push($breadcrumb, '
          <li>
            <a href="' . URL::to(Util::getUrlLang('admin/'.$segment)) . '">' . ucfirst($segment) . '</a>
            <span class="divider"><i class="icon-angle-right"></i></span>
          </li>');
      }
    }

    array_push($breadcrumb,
      '<li class="active">' . ($title ? $title : ucfirst($last)). '</li>');

    array_push($breadcrumb, '</ol></div>');

    return implode('', $breadcrumb);
  }

  /**
   * Contruye un alert bootstrap.
   *
   * @param  array  $config
   * @return string
   */
  public static function alert($config = array())
  {
    if (Session::has('alertbs'))
    {
      $config = array_merge(array(
        'type'   => 'alert-danger', // success | info | warning | danger
        'effect' => 'fade in',
      ), (array)$config);

      $message = (Session::has('alertbs'))
        ?
          (Session::has('errors'))
            ?
              implode('', $config['errors']->all('<li>:message</li>'))
            :
              Session::get('alertbs')['message']
        :
          '';

      return
        '<div class="alert '.$config['type'].' '.$config['effect'].'" id="alertbs" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <ul style="list-style-type: none; text-align:left; margin: 0; padding: 0;">'
            .$message.'
          </ul>
        </div>';
    }

  }

  /**
   * Genera la url con el lang especificado.
   *
   * Ejemplo: admin/es/home
   *
   * @param  string $url
   * @return string
   */
  public static function getUrlLang($url = 'admin/login')
  {
    $languages = Config::get('laradmin::lang.valid_langs');

    $locale = Request::segment(2);

    if(in_array($locale, $languages))
    {
      $explodeUrl = explode('/', $url);
      array_splice($explodeUrl, 1, 0, $locale);
      return implode('/', $explodeUrl);
    }
    else
    {
      return $url;
    }
  }

  /**
   * A la url actual le agrega el lenguage especificado.
   *
   * Ej: Si esta en la url admin/users/ y se le pasa en $lang = es
   * entonces generaria la url admin/es/users/
   *
   * @param  string $lang
   * @return string
   */
  public static function setUrlLang($lang)
  {
    $languages = Config::get('laradmin::lang.valid_langs');

    $locale = Request::segment(2);

    // Si en la url actual ya hay un lang entonces entra y verifica si el lang
    // que ya esta en la url actual es igual al que se le paso a la funcion.
    // Si no son iguales entonces lo cambia por el nuevo.
    if(in_array($locale, $languages))
    {
      if ($lang !== $locale)
      {
        $explodePath = explode('/', Request::path());
        $explodePath[1] = $lang;

        return implode('/', $explodePath);
      }

      return Request::path();
    }

    // Si no hay ninung lang en la url actual entonces lo que hace
    // es tomar la url actual y meterle el lang especificado.
    else
    {
      $explodePath = explode('/', Request::path());

      array_splice($explodePath, 1, 0, $lang);

      return implode('/', $explodePath);
    }
  }

  /**
   * Obtiene el lang actual.
   *
   * @return string
   */
  public static function getActualLang()
  {
    $languages = Config::get('laradmin::lang.valid_langs');

    $locale = Request::segment(2);

    if (in_array($locale, $languages))
    {
      return $locale;
    }

    return $languages[0];
  }
}