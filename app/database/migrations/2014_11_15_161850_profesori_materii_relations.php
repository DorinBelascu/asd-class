<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfesoriMateriiRelations extends Migration 
{

	public function up()
	{

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

		Schema::create('profesori_materii', function($t)
		{
			$t->increments('id');
			$t->integer('profesor_id')->unsigned();
			$t->integer('materie_id')->unsigned();
			$t->timestamps();

			$t->foreign('materie_id')->references('id')->on('materii')->onDelete('restrict')->onUpdate('cascade');
			$t->foreign('profesor_id')->references('id')->on('profesori')->onDelete('restrict')->onUpdate('cascade');

		});
	}


	public function down()
	{
		Schema::drop('profesori_materii');
		Schema::drop('materii');
		Schema::drop('profesori');
	}

}
