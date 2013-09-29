<?php

use Illuminate\Database\Migrations\Migration;

class CreatePrivacyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('privacy', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->timestamps();

			$table->engine = 'InnoDB';
			$table->foreign('user_id')
	            ->references('id')->on('users')
	            ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('privacy');
	}

}
