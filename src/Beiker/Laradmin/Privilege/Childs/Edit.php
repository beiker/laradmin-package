<?php namespace Beiker\Laradmin\Privileges\Childs;

use Beiker\Laradmin\Privilege\Contracts\ExtraChild;

class Edit implements ExtraChild{

  public function getData($parentLang, $parentName, $parentUrl)
  {
    return [
      'name'         => 'Edit',
      'show_menu'    => 0,
      'url_action'   => "{$parentUrl}/edit",
      'url_icon'     => 'pencil',
      'target_blank' => '',
      'lang'         => 'menu.'.strtolower($parentLang).'.edit',
      'use_lang'     => true,
      'created_at'   => new \Datetime(),
    ];
  }

}
