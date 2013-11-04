<?php

/**
 * Clase personalizada para paginar.
 *
 * @package helpers
 * @author beiker
 **/
class Pagination {

  /**
   * Construye la Paginacion para mostrarla en el HTML.
   *
   * @param  array $paginator
   * @return string
   */
  public static function make($paginator, $classes='')
  {
    $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);

    $html = '';

    if ($paginator->getLastPage() > 1)
    {
      $html .= '<ul class="pagination ' . $classes . '">';
      $html .= $presenter->render();
      $html .= '</ul></div>';
    }

    return $html;
  }

  /**
   * Retorna un array con resultados de la paginacion.
   *
   * @param  array $query [Query Resulset]
   * @param  int $per_page [Items a pagins]
   * @return array
   */
  public static function setup($query, $per_page)
  {
    $paginator = $query->paginate($per_page);

    return array(
      'items'        => $paginator,
      'total'        => $paginator->getTotal(),
      'per_page'     => $paginator->getPerPage(),
      'current_page' => $paginator->getCurrentPage(),
      'last_page'    => $paginator->getLastPage(),
      'result_set'   => $query
    );
  }

}