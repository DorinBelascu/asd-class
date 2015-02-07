<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToProfesori extends Migration {

	public function up()
	{
		Schema::table('profesori', function($t)
		{
    		$t->integer('user_id')->unsigned()->nullable()->default(NULL);
    		$t->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('profesori', function($t)
		{
    		$t->dropColumn('user_id');
		});
	}

}
