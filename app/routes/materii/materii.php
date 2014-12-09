<?php 

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
