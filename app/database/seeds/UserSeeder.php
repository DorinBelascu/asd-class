<?php

class UserSeeder extends Seeder 
{

	public function run()
	{
		$now = Carbon\Carbon::now()->format('Y-m-d H:i:s');
		DB::table('users')->delete();
		DB::table('users_groups')->delete();
		// Admini
		$adminGroup = Sentry::findGroupById(1);
	    $user = Sentry::createUser(array(
	    	'id'         => 1,
	        'email'      => 'Andra_Andrus12@yahoo.com',
	        'password'   => 'asd',
	        'activated'  => true,
	        'first_name' => 'Andra',
	        'last_name'  => 'Andrus',
	        'user_type'  => 'admin',
	    ));	    
	    $user->addGroup($adminGroup);

	    $user = Sentry::createUser(array(
	    	'id'         => 2,
	        'email'      => 'Maftei_Stefan_Radu@yahoo.com',
	        'password'   => 'asd',
	        'activated'  => true,
	        'first_name' => 'Stefan',
	        'last_name'  => 'Maftei',
	       	'user_type'  => 'admin',
	    ));	    
	    $user->addGroup($adminGroup);

	    $user = Sentry::createUser(array(
	    	'id'         => 3,
	        'email'      => 'Dorin.Belascu@yahoo.com',
	        'password'   => 'asd',
	        'activated'  => true,
	        'first_name' => 'Dorin',
	        'last_name'  => 'Belascu',
	        'user_type'  => 'admin',	      
	    ));	    
	    $user->addGroup($adminGroup);	


	    // Diriginte
	    $diriginteGroup = Sentry::findGroupById(2);
	    $user = Sentry::createUser(array(
	    	'id'         => 4,
	        'email'      => 'tarta_moga_v@yahoo.com',
	        'password'   => 'vindows',
	        'activated'  => true,
	        'first_name' => 'Viorel',
	        'last_name'  => 'Tarta',
	        'user_type'  => 'diriginte',	        
	    ));	    
	    $user->addGroup($diriginteGroup);   


	    // Elevi
	    $elevGroup = Sentry::findGroupById(3);
	   	$user = Sentry::createUser(array(
	    	'id'         => 5,
	        'email'      => 'Babos@yahoo.com',
	        'password'   => 'Babos',
	        'activated'  => true,
	        'first_name' => 'Teodora',
	        'last_name'  => 'Babos',
	    ));	    
	    $user->addGroup($elevGroup);

	   	$user = Sentry::createUser(array(
	    	'id'         => 6,
	        'email'      => 'Baciu@yahoo.com',
	        'password'   => 'Baciu',
	        'activated'  => true,
	        'first_name' => 'Florin',
	        'last_name'  => 'Baciu',
	    ));	
		$user->addGroup($elevGroup);

		// Profesori
	    $profesorGroup = Sentry::findGroupById(4);
		$user = Sentry::createUser(array(
	    	'id'         => 7,
	        'email'      => 'Lupsor@yahoo.com',
	        'password'   => 'Lupsor',
	        'activated'  => true,
	        'first_name' => 'Maria',
	        'last_name'  => 'Lupsor',
	    ));	
		$user->addGroup($profesorGroup);

		$user = Sentry::createUser(array(
	    	'id'         => 8,
	        'email'      => 'Betcher@yahoo.com',
	        'password'   => 'Betcher',
	        'activated'  => true,
	        'first_name' => 'Elizabeta',
	        'last_name'  => 'Betcher',
	    ));	
		$user->addGroup($profesorGroup);
	}

}