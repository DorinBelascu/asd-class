<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTezaToNote extends Migration {

	public function up()
	{
		Schema::table('note', function($t)
		{
    		$t->boolean('teza');
		});
	}

	public function down()
	{
		Schema::table('note', function($t)
		{
    		$t->dropColumn('teza');
		});
	}

}
