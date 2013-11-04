<?php namespace Beiker\Laradmin\Privileges\Childs;

use Beiker\Laradmin\Privilege\Contracts\ExtraChild;

class Show implements ExtraChild{

  public function getData($parentLang, $parentName, $parentUrl)
  {
    return [
      'name'         => 'Show',
      'show_menu'    => 0,
      'url_action'   => "{$parentUrl}/show",
      'url_icon'     => 'eye-open',
      'target_blank' => '',
      'lang'         => 'menu.'.strtolower($parentLang).'.show',
      'use_lang'     => true,
      'created_at'   => new \Datetime(),
    ];
  }

}
