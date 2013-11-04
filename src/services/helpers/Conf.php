<?php

/**
 * Clase para obtener los valores y parametros en base a los archivos de
 * configuracion.
 *
 * @package helpers
 * @author beiker
 **/
class Conf
{

  /**
   *
   *
   * @return string
   */
  public static function mainTitle()
  {
    return Config::get('laradmin::config.name', 'Laradmin');
  }

  /**
   * Determina de donde leera los archivos lang si de los por default del
   * paquete o de los publicados en app/lang/en/laradmin
   *
   * @return string
   */
  public static function langPath()
  {
    return Config::get('laradmin::lang.default') ? 'laradmin::' : 'laradmin/';
  }

  /**
   * Determina la ruta donde se hara el upload del avatar del usuario.
   *
   * @return string
   */
  public static function uploadPath()
  {
    $path = Config::get('laradmin::config.avatarpath');

    if ($path !== '' || ! is_null($path))
    {
      return $path;
    }
    else
    {
      return base_path().'/public/packages/beiker/laradmin/assets/images/admin/upload/users/';
    }
  }

  /**
   * Determina la ruta de la vista a usar para el error 404.
   *
   * @return string
   */
  public static function error404View()
  {
    $view = 'laradmin::errors.404';

    if (Config::has('laradmin::config.error404'))
    {
      if (Config::get('laradmin::config.error404') !== '')
      {
        $view = Config::get('laradmin::config.error404');
      }
    }

    return $view;
  }

  /**
   * Determina la ruta de la vista a usar para el error ModelNotFoundException
   * que es lanzado cuando un model no existe en la bdd.
   *
   * @return string
   */
  public static function errorModelView()
  {
    $view = 'laradmin::errors.404';

    if (Config::has('laradmin::config.errormodel'))
    {
      if (Config::get('laradmin::config.errormodel') !== '')
      {
        $view = Config::get('laradmin::config.errormodel');
      }
    }

    return $view;
  }

}