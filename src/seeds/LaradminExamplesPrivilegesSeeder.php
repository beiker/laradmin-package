<?php

use Illuminate\Database\Seeder;
use Beiker\Laradmin\Models\User;
use Beiker\Laradmin\Models\Privilege;

class LaradminExamplesPrivilegesSeeder extends Seeder {

  public function run()
  {
    /*
     |---------------------------------------------------------------------
     |  Examples Privileges
     |---------------------------------------------------------------------
     */

    $parent = Privilege::create(array(
      'name'         => 'Examples',
      'parent_id'    => 0,
      'show_menu'    => 1,
      'url_action'   => 'examples',
      'url_icon'     => 'magic',
      'target_blank' => 0,
      'lang'         => '',
      'use_lang'     => false,
    ));

    $exa1 = Privilege::create(array(
      'name'         => 'Advanced',
      'parent_id'    => $parent->id,
      'show_menu'    => 1,
      'url_action'   => 'examples/advanced',
      'url_icon'     => 'trophy',
      'target_blank' => 0,
      'lang'         => '',
      'use_lang'     => false,
    ));

    $exa2 = Privilege::create(array(
      'name'         => 'Example Message 1',
      'parent_id'    => $parent->id,
      'show_menu'    => 0,
      'url_action'   => 'examples/message1',
      'url_icon'     => 'bell',
      'target_blank' => 0,
      'lang'         => '',
      'use_lang'     => false,
    ));

    $exa3 = Privilege::create(array(
      'name'         => 'Example Message 2',
      'parent_id'    => $parent->id,
      'show_menu'    => 0,
      'url_action'   => 'examples/message2',
      'url_icon'     => 'bell',
      'target_blank' => 0,
      'lang'         => '',
      'use_lang'     => false,
    ));

    // Asigna los provilegios de los ejemplos al usuario admin.
    $user = User::find('1');
    $user->privileges()->attach($parent->id);
    $user->privileges()->attach($exa1->id);
    $user->privileges()->attach($exa2->id);
    $user->privileges()->attach($exa3->id);
  }
}