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

Route::get('forgot-password/{id}/{code}', array(
	'as'  =>'forgot-password',
	'uses'=>'ForgotPasswordController@index'
));

Route::get('reset-password/', array(
	'as'  =>'reset-password',
	'uses'=>'ForgotPasswordController@reset'
));

Route::post('reset-password-processing', array(
	'as'  =>'reset-password-post',
	'uses'=>'ForgotPasswordController@change'
));

Route::get('logout', array(
	'as'  => 'logout',
	'uses'=> 'LogoutController@index'
));

Route::get('profile', array(
	'as'  =>'user-profile',
	'uses'=>'ProfileController@index'
));

Route::post('profile-update', array(
	'as'  =>'profile-update',
	'uses'=>'ProfileController@update'
));

Route::post('password-update',array(
	'as'  =>'password-update',
	'uses'=>'ProfileController@passwordUpdate',
));