<?php

use Illuminate\Database\Migrations\Migration;

class CreateNewsletterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletter', function($table)
		{
			$table->increments('id');
			$table->string('email');
			$table->boolean('cofounder')->nullable();
			$table->boolean('founder')->nullable();
			$table->boolean('investor')->nullable();
			$table->timestamps();

			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('newsletter');
	}

}