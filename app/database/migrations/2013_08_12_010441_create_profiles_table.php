<?php

use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('gender', 1)->nullable();
			$table->string('city')->nullable();
			$table->string('state', 4)->nullable();
			$table->datetime('birthday')->nullable();
			$table->text('about')->nullable();
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
		Schema::drop('profiles');
	}
}
