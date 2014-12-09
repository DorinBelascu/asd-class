<?php

Route::get('profesor/{id}/materii', array(
	'as'   => 'profesor_materii',
	'uses' => 'ProfesorMateriiController@index1'
));

Route::post('profesor/materii/add', array(
	'as'   => 'profesor_materii_add',
	'uses' => 'ProfesorMateriiController@showAddForm'
));

Route::post('profesor/materii/delete', array(
	'as'   => 'profesor_materii_delete',
	'uses' => 'ProfesorMateriiController@delete'
));