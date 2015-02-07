<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserTypeToUsers extends Migration {

	public function up()
	{
		Schema::table('users', function($t)
		{
    		$t->string('user_type',16)->nullable()->default(NULL);
		});
	}

	public function down()
	{
		Schema::table('users', function($t)
		{
    		$t->dropColumn('user_type');
		});
	}

}
