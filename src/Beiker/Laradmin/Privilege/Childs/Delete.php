<?php namespace Beiker\Laradmin\Privileges\Childs;

use Beiker\Laradmin\Privilege\Contracts\ExtraChild;

class Delete implements ExtraChild{

  public function getData($parentLang, $parentName, $parentUrl)
  {
    return [
      'name'         => 'Delete',
      'show_menu'    => 0,
      'url_action'   => "{$parentUrl}/delete",
      'url_icon'     => 'trash',
      'target_blank' => '',
      'lang'         => 'menu.'.strtolower($parentLang).'.delete',
      'use_lang'     => true,
      'created_at'   => new \Datetime(),
    ];
  }

}
