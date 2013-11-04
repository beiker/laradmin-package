<?php

use Illuminate\Database\Seeder;
use Beiker\Laradmin\Models\User;

class LaradminUsersTableSeeder extends Seeder {

  public function run()
  {
    User::create(array(

      'name'     => 'admin',
      'user'    => 'admin',
      'password'   => '123456',
      'email'      => 'oscar.alcantars@gmail.com',
      'type'       => 'admin',
      'created_at' => new DateTime,

    ));
  }

}