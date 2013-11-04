<?php

use Beiker\Laradmin\Models\User;

class LaradminPrivilegeUserTableSeeder extends Seeder {

  public function run()
  {
    $user = User::find('1');

    $user->privileges()->sync(array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18));
  }

}