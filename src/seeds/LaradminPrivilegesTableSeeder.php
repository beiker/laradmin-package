<?php

use Illuminate\Database\Seeder;
use Beiker\Laradmin\Models\Privilege;

class LaradminPrivilegesTableSeeder extends Seeder {

  public function run()
  {
    DB::table('privileges')->delete();

    /*
     |---------------------------------------------------------------------
     |  Privileges
     |---------------------------------------------------------------------
     */
    Privilege::create(array(
      'name'         => 'Privileges',
      'parent_id'    => 0,
      'show_menu'    => 1,
      'url_action'   => 'privileges',
      'url_icon'     => 'lock',
      'target_blank' => 0,
      'lang'         => 'menu.privileges.index',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Add',
      'parent_id'    => 1,
      'show_menu'    => 1,
      'url_action'   => 'privileges/create',
      'url_icon'     => 'plus',
      'target_blank' => 0,
      'lang'         => 'menu.privileges.create',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Save',
      'parent_id'    => 1,
      'show_menu'    => 0,
      'url_action'   => 'privileges/store',
      'url_icon'     => '',
      'target_blank' => 0,
      'lang'         => 'menu.privileges.store',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Edit',
      'parent_id'    => 1,
      'show_menu'    => 0,
      'url_action'   => 'privileges/edit',
      'url_icon'     => 'pencil',
      'target_blank' => 0,
      'lang'         => 'menu.privileges.edit',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Update',
      'parent_id'    => 1,
      'show_menu'    => 0,
      'url_action'   => 'privileges/update',
      'url_icon'     => '',
      'target_blank' => 0,
      'lang'         => 'menu.privileges.update',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Show',
      'parent_id'    => 1,
      'show_menu'    => 0,
      'url_action'   => 'privileges/show',
      'url_icon'     => 'eye',
      'target_blank' => 0,
      'lang'         => 'menu.privileges.show',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Delete',
      'parent_id'    => 1,
      'show_menu'    => 0,
      'url_action'   => 'privileges/delete',
      'url_icon'     => 'trash-o',
      'target_blank' => 0,
      'lang'         => 'menu.privileges.delete',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Deactivate',
      'parent_id'    => 1,
      'show_menu'    => 0,
      'url_action'   => 'privileges/softdelete',
      'url_icon'     => 'ban',
      'target_blank' => 0,
      'lang'         => 'menu.privileges.softdelete',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Activate',
      'parent_id'    => 1,
      'show_menu'    => 0,
      'url_action'   => 'privileges/restore',
      'url_icon'     => 'refresh',
      'target_blank' => 0,
      'lang'         => 'menu.privileges.restore',
      'use_lang'     => true,
    ));


    /*
     |---------------------------------------------------------------------
     |  Users
     |---------------------------------------------------------------------
     */

    Privilege::create(array(
      'name'         => 'Users',
      'parent_id'    => 0,
      'show_menu'    => 1,
      'url_action'   => 'users',
      'url_icon'     => 'user',
      'target_blank' => 0,
      'lang'         => 'menu.users.index',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Add',
      'parent_id'    => 10,
      'show_menu'    => 1,
      'url_action'   => 'users/create',
      'url_icon'     => 'plus',
      'target_blank' => 0,
      'lang'         => 'menu.users.create',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Save',
      'parent_id'    => 10,
      'show_menu'    => 0,
      'url_action'   => 'users/store',
      'url_icon'     => '',
      'target_blank' => 0,
      'lang'         => 'menu.users.store',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Edit',
      'parent_id'    => 10,
      'show_menu'    => 0,
      'url_action'   => 'users/edit',
      'url_icon'     => 'pencil',
      'target_blank' => 0,
      'lang'         => 'menu.users.edit',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Update',
      'parent_id'    => 10,
      'show_menu'    => 0,
      'url_action'   => 'users/update',
      'url_icon'     => '',
      'target_blank' => 0,
      'lang'         => 'menu.users.update',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Show',
      'parent_id'    => 10,
      'show_menu'    => 0,
      'url_action'   => 'users/show',
      'url_icon'     => 'eye',
      'target_blank' => 0,
      'lang'         => 'menu.users.show',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Delete',
      'parent_id'    => 10,
      'show_menu'    => 0,
      'url_action'   => 'users/delete',
      'url_icon'     => 'trash-o',
      'target_blank' => 0,
      'lang'         => 'menu.users.delete',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Deactivate',
      'parent_id'    => 10,
      'show_menu'    => 0,
      'url_action'   => 'users/softdelete',
      'url_icon'     => 'ban',
      'target_blank' => 0,
      'lang'         => 'menu.users.softdelete',
      'use_lang'     => true,
    ));

    Privilege::create(array(
      'name'         => 'Activate',
      'parent_id'    => 10,
      'show_menu'    => 0,
      'url_action'   => 'users/restore',
      'url_icon'     => 'refresh',
      'target_blank' => 0,
      'lang'         => 'menu.users.restore',
      'use_lang'     => true,
    ));
  }

}