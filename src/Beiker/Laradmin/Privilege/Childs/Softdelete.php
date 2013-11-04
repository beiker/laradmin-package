<?php namespace Beiker\Laradmin\Privileges\Childs;

use Beiker\Laradmin\Privilege\Contracts\ExtraChild;

class Softdelete implements ExtraChild{

  public function getData($parentLang, $parentName, $parentUrl)
  {
    return [
      'name'         => 'Softdelete',
      'show_menu'    => 0,
      'url_action'   => "{$parentUrl}/softdelete",
      'url_icon'     => 'ban-circle',
      'target_blank' => '',
      'lang'         => 'menu.'.strtolower($parentLang).'.softdelete',
      'use_lang'     => true,
      'created_at'   => new \Datetime(),
    ];
  }

}
