<?php

Route::get('/', array(
	'as'   => 'home',
	'uses' => 'HomeController@index'
));

Route::get('register', array(
	'as'   => 'register',
	'uses' => 'RegisterController@index'
));