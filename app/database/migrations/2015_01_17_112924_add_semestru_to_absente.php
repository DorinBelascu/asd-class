<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSemestruToAbsente extends Migration {

	public function up()
	{
		Schema::table('absente', function($t)
		{
    		$t->integer('semestru');
		});
	}

	public function down()
	{
		Schema::table('absente', function($t)
		{
    		$t->dropColumn('semestru');
		});
	}

}
