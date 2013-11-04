<?php

use Illuminate\Database\Seeder;

class LaradminDatabaseExamplesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\Eloquent::unguard();

		$this->call('LaradminExamplesPrivilegesSeeder');
	}

}