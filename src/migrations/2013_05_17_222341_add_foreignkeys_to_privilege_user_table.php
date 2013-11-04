<?php

use Illuminate\Database\Migrations\Migration;

class AddForeignkeysToPrivilegeUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('privilege_user', function($table){

      $table->primary(array('user_id', 'privilege_id'));

      $table->foreign('user_id')
        ->references('id')->on('users')
        ->onDelete('cascade')->onUpdate('cascade');

      $table->foreign('privilege_id')
        ->references('id')->on('privileges')
        ->onDelete('cascade')->onUpdate('cascade');

    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('privilege_user', function($table){

      $table->dropForeign('privilege_user_user_id_foreign');
      $table->dropForeign('privilege_user_privilege_id_foreign');

      $table->dropPrimary('PRIMARY');
      $table->dropIndex('privilege_user_privilege_id_foreign');

    });
	}

}