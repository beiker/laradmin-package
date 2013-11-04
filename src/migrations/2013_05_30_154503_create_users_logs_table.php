<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_logs', function(Blueprint $table)
		{
      $table->increments('id');
			$table->integer('user_id')->unsigned();
      $table->string('url_action', 100);
      $table->enum('http_verb', array('GET', 'POST', 'PUT', 'PATCH', 'DELETE'));
      $table->text('query');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_logs');
	}

}
