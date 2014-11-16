<?php

use Illuminate\Database\Migrations\Migration;

class ExtendAsdclass extends Migration 
{

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

	public function down()
	{
		Schema::drop('absente');
		Schema::drop('note');
		Schema::drop('elevi');
	}

}
