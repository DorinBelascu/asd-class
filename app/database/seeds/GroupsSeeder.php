<?php

class GroupsSeeder extends Seeder 
{

	public function run()
	{
		$now = Carbon\Carbon::now()->format('Y-m-d H:i:s');
		// Groups::get()->delete();
		DB::table('groups')->delete();
		Groups::insert(['id' => 1, 'name' => 'admin','created_at' => $now,]);
		Groups::insert(['id' => 2, 'name' => 'diriginte', 'created_at' => $now]);
		Groups::insert(['id' => 3, 'name' => 'elev', 'created_at' => $now]);
		Groups::insert(['id' => 4, 'name' => 'profesor', 'created_at' => $now]);
	}

}

// composer dump-autoload ---> in cazul in care nu gaseste o anumita clasa in cmd