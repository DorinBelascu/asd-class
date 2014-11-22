<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPhotoToElevi extends Migration {

	public function up()
	{
		Schema::table('elevi', function($t)
		{
    		$t->text('photo');
		});
	}

	public function down()
	{
		Schema::table('elevi', function($t)
		{
    		$t->dropColumn('photo');
		});
	}

}
