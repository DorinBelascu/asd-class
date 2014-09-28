<?php

use Illuminate\Database\Migrations\Migration;

class ExtendAsdclass extends Migration 
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('elevi', function($table)
		{	
			$table->increments('id');
			$table->string('nume');
			$table->string('prenume');
			$table->date('data nasterii');	
			$table->string('genul');
			$table->timestamps();
		});

		Schema::create('materii', function($table)
		{
			$table->increments('id');
			$table->string('denumirea');
			$table->timestamps();
		});

		Schema::create('profesori', function($table)
		{
			$table->increments('id');
			$table->string('nume');
			$table->string('prenume');
			$table->date('data nasterii');
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
		Schema::drop('elevi');
		Schema::drop('materii');
		Schema::drop('profesori');
	}

}
