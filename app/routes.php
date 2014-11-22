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
/*---------------------------------------------------------*/
Route::get('forgot-password', array(
	'as'   => 'show-forgot-password-form',
	'uses' => 'ForgotPasswordController@ShowStartForm'
));

Route::post('forgot-password-process', array(
	'as'   => 'show-forgot-password-form-post',
	'uses' => 'ForgotPasswordController@StartFormProcess'
));

Route::get('reset-forgotten-password/{id}/{code}', array(
	'as'   => 'show-set-password-form',
	'uses' => 'ForgotPasswordController@ShowChangePasswordForm'
));
// Route::get('forgot-password/{id}/{code}', array(
// 	'as'  =>'forgot-password',
// 	'uses'=>'ForgotPasswordController@index'
// ));

// Route::get('reset-password/', array(
// 	'as'  =>'reset-password',
// 	'uses'=>'ForgotPasswordController@reset'
// ));

Route::post('reset-password-processing', array(
	'as'  =>'reset-password-post',
	'uses'=>'ForgotPasswordController@change'
));
/*---------------------------------------------------------*/

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

Route::post('profile-password-update',array(
	'as'  =>'password-update',
	'uses'=>'ProfileController@passwordUpdate',
));

Route::get('materii', array(
	'as'   => 'materii',
	'uses' => 'MateriiController@index'

));

Route::post('materii/add', array(
	'as'   => 'add-new-materie',
	'uses' => 'MateriiController@showAddForm'
));

Route::post('materii/edit/', array(
	'as'   => 'edit-materie',
	'uses' => 'MateriiController@edit',
));

Route::post('materii/delete', array(
	'as'   => 'delete-materie',
	'uses' => 'MateriiController@delete',
));

Route::get('elevi', array(
	'as'   => 'elevi',
	'uses' => 'EleviController@index'
));

Route::post('elevi/add', array(
	'as'   => 'add-new-elev',
	'uses' => 'EleviController@showAddForm'
));

Route::post('elevi/edit', array(
	'as'   => 'edit-elev',
	'uses' => 'EleviController@edit',
));

Route::post('elevi/delete', array(
	'as'   => 'delete-elev',
	'uses' => 'EleviController@delete',
));

Route::get('profesori', array(
	'as'   => 'profesori',
	'uses' => 'ProfesoriController@index'
));

Route::post('profesori/add', array(
	'as'   => 'add-new-profesor',
	'uses' => 'ProfesoriController@showAddForm'
));

Route::post('profesori/edit', array(
	'as'   => 'edit-profesor',
	'uses' => 'ProfesoriController@edit'
));

Route::post('profesori/delete', array(
	'as'   => 'delete-profesor',
	'uses' => 'ProfesoriController@delete'
));

Route::get('profesor/{id}/materii', array(
	'as'   => 'profesor_materii',
	'uses' => 'ProfesorMateriiController@index1'
));

Route::get('materie/{id}/profesori', array(
	'as'   => 'materie_profesori',
	'uses' => 'ProfesorMateriiController@index2'
));

Route::post('profesor/materii/add', array(
	'as'   => 'profesor_materii_add',
	'uses' => 'ProfesorMateriiController@showAddForm'
));

Route::post('profesor/materii/delete', array(
	'as'   => 'profesor_materii_delete',
	'uses' => 'ProfesorMateriiController@delete'
));

Route::get('elevi-photo/{id}', array(
	'as'   => 'elevi_photo',
	'uses' => 'EleviPhotoController@index'
));

Route::post('save-elev-photo-upload/{id}', array(
	'as'   => 'save-elev-photo-upload',
	'uses' => 'EleviPhotoController@upload'
));