<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToElevi extends Migration {

	public function up()
	{
		Schema::table('elevi', function($t)
		{
    		$t->integer('user_id')->unsigned()->nullable()->default(NULL);
    		$t->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('elevi', function($t)
		{
    		$t->dropColumn('user_id');
		});
	}

}
