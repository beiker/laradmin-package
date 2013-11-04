<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivilegesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('privileges', function(Blueprint $table)
		{
			$table->increments('id');
      $table->string('name', 100);
      $table->integer('parent_id')->unsigned();
      $table->smallInteger('show_menu')->default(1);
      $table->string('url_action', 100);
      $table->string('url_icon', 100);
      $table->smallInteger('target_blank')->default(0);
      $table->string('lang', 100)->nullable();
      $table->boolean('use_lang')->default(false);
			$table->timestamps();
      $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('privileges');
	}

}
