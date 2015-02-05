<?php

class DatabaseSeeder extends Seeder 
{

	public function run()
	{
		Eloquent::unguard();
		$this->call('GroupsSeeder');
		$this->call('UserSeeder');	
	}

}