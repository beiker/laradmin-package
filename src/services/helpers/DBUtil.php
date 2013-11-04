<?php
/**
 * @package helpers
 * @author beiker
 **/
class DBUtil {

  /**
   * Registra una acción tipo POST, UPDATE, DELETE especificando
   * el usuario(id), url(full), http verb, query y el timestamps de
   * cuando se realizo dicha acción.
   *
   * @return boid
   */
  public static function logAction()
  {
    // Obtiene el QueryLog de DB y saca el ultimo con end().
    $log       = DB::getQueryLog();
    $lastQuery = end($log);

    // Obtiene el total de bindings existentes.
    $countBindigs = count($lastQuery['bindings']);

    // Si $countBindings es mayor a 0 significa fue un query insert, update, delete.
    if ($countBindigs > 0)
    {
      $pattern = array_fill(0, $countBindigs, "/\?/");

      // Reformatea los valores de $lastQuery['bindings'].
      array_walk($lastQuery['bindings'], function (&$item, $key)
      {
        if ($item instanceof DateTime) $item = "'".$item->format('Y-m-d H:i:s')."'";
        else $item = "'".$item."'";
      });

      // Reconstruye el query remplazando los valores correspondientes.
      $queryLog = preg_replace($pattern, $lastQuery['bindings'], $lastQuery['query'], 1);
    }
    else $queryLog = $lastQuery['query'];

    // Inserta el ultimo log que se ejecuto.
    DB::table('usuarios_logs')->insert(array(
      'usuario_id' => Session::get('id'),
      'url_accion' => str_replace(URL::to('/').'/', '', Request::url()),
      'http_verb'  => Request::getMethod(),
      'query'      => $queryLog,
      'created_at' => new DateTime
    ));
  }

}