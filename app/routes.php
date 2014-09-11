<?php

Route::get('/', array(
	'as'   => 'home',
	'uses' => 'HomeController@index'
));

Route::get('register', array(
	'as'   => 'register',
	'uses' => 'RegisterController@index'
));

Route::post('register-processing', array(
	'as'  => 'register-post',
	'uses'=> 'RegisterController@create'
));

Route::get('login',array(
	'as'  =>'login',
	'uses'=>'LoginController@index',
));

Route::post('login-processing',array(
	'as'  =>'login-post',
	'uses'=>'LoginController@check',
));

Route::get('activate-account/{id}/{code}', array(
	'as'  =>'activate-account',
	'uses'=>'ActivateController@index'
));

Route::get('logout', array(
	'as'  => 'logout',
	'uses'=> 'LogoutController@index'
));
