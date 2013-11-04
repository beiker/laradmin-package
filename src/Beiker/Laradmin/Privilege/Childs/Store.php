<?php namespace Beiker\Laradmin\Privileges\Childs;

use Beiker\Laradmin\Privilege\Contracts\ExtraChild;

class Store implements ExtraChild{

  public function getData($parentLang, $parentName, $parentUrl)
  {
    return [
      'name'         => 'Save',
      'show_menu'    => 0,
      'url_action'   => "{$parentUrl}/store",
      'url_icon'     => '',
      'target_blank' => '',
      'lang'         => 'menu.'.strtolower($parentLang).'.store',
      'use_lang'     => true,
      'created_at'   => new \Datetime(),
    ];
  }

}
