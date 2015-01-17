<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotoToMaterii extends Migration {

	public function up()
	{
		Schema::table('materii', function($t)
		{
    		$t->text('photo');
		});
	}

	public function down()
	{
		Schema::table('materii', function($t)
		{
    		$t->dropColumn('photo');
		});
	}

}
