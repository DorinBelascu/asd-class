<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotoToProfesori extends Migration {

	public function up()
	{
		Schema::table('profesori', function($t)
		{
    		$t->text('photo');
		});
	}

	public function down()
	{
		Schema::table('profesori', function($t)
		{
    		$t->dropColumn('photo');
		});
	}

}
