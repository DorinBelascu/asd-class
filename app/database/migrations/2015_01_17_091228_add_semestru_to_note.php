<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSemestruToNote extends Migration {

	public function up()
	{
		Schema::table('note', function($t)
		{
    		$t->integer('semestru');
		});
	}

	public function down()
	{
		Schema::table('note', function($t)
		{
    		$t->dropColumn('semestru');
		});
	}

}
