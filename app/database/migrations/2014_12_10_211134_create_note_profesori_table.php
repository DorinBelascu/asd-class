<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteProfesoriTable extends Migration {

	public function up()
	{
		Schema::create('note_profesori', function($table)
		{
			$table->increments('id');
			$table->float('valoare');
			$table->integer('profesor_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('note_profesori');
	}

}
