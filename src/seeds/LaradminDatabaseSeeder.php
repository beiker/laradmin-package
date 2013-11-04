<?php

use Illuminate\Database\Seeder;

class LaradminDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\Eloquent::unguard();

		$this->call('LaradminUsersTableSeeder');
    $this->call('LaradminPrivilegesTableSeeder');
    $this->call('LaradminPrivilegeUserTableSeeder');
	}

}