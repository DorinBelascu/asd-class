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

		Schema::create('profesori_materii', function($table)
		{
			$table->increments('id');
			$table->integer('profesor_id');
			$table->integer('materie_id');
			$table->timestamps();
		});

		Schema::create('note', function($table)
		{
			$table->increments('id');
			$table->float('valoare');
			$table->integer('materie_id');
			$table->integer('elev_id');
			$table->date('data');
			$table->boolean('publica_sau_nu');
			$table->timestamps();
		});

		Schema::create('absente', function($table)
		{
			$table->increments('id');
			$table->date('data');
			$table->string('materie_id');
			$table->string('nume_elev');
			$table->boolean('stare');
			$table->boolean('publica_sau_nu');
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
		Schema::drop('profesori_materii');
		Schema::drop('note');
		Schema::drop('absente');
	}

}
