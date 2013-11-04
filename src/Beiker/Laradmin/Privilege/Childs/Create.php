<?php namespace Beiker\Laradmin\Privileges\Childs;

use Beiker\Laradmin\Privilege\Contracts\ExtraChild;

class Create implements ExtraChild{

  public function getData($parentLang, $parentName, $parentUrl)
  {
    return [
      'name'         => 'Create',
      'show_menu'    => 1,
      'url_action'   => "{$parentUrl}/create",
      'url_icon'     => 'plus',
      'target_blank' => '',
      'lang'         => 'menu.'.strtolower($parentLang).'.create',
      'use_lang'     => true,
      'created_at'   => new \Datetime(),
    ];
  }

}
