<?php

use Illuminate\Database\Migrations\Migration;

class AddForeignkeysToUsersLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users_logs', function($table) {

      $table->foreign('user_id')
        ->references('id')->on('users');

    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::table('users_logs', function($table){

      $table->dropForeign('users_logs_user_id_foreign');

    });
	}

}