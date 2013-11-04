<?php namespace Beiker\Laradmin\Privileges\Childs;

use Beiker\Laradmin\Privilege\Contracts\ExtraChild;

class Restore implements ExtraChild{

  public function getData($parentLang, $parentName, $parentUrl)
  {
    return [
      'name'         => 'Restore',
      'show_menu'    => 0,
      'url_action'   => "{$parentUrl}/restore",
      'url_icon'     => 'refresh',
      'target_blank' => '',
      'lang'         => 'menu.'.strtolower($parentLang).'.restore',
      'use_lang'     => true,
      'created_at'   => new \Datetime(),
    ];
  }

}
