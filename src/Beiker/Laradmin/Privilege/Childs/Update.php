<?php namespace Beiker\Laradmin\Privileges\Childs;

use Beiker\Laradmin\Privilege\Contracts\ExtraChild;

class Update implements ExtraChild{

  public function getData($parentLang, $parentName, $parentUrl)
  {
    return [
      'name'         => 'Update',
      'show_menu'    => 0,
      'url_action'   => "{$parentUrl}/update",
      'url_icon'     => '',
      'target_blank' => '',
      'lang'         => 'menu.'.strtolower($parentLang).'.update',
      'use_lang'     => true,
      'created_at'   => new \Datetime(),
    ];
  }

}
