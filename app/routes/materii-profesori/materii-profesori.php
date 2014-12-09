<?php

Route::get('materie/{id}/profesori', array(
	'as'   => 'materie_profesori',
	'uses' => 'ProfesorMateriiController@index2'
));

Route::post('materie/profesori/add', array(
	'as'   => 'materie_profesori_add',
	'uses' => 'ProfesorMateriiController@showAddForm2'
));
Route::post('materie/profesori/delete', array(
	'as'   => 'materie_profesori_delete',
	'uses' => 'ProfesorMateriiController@delete2'
));
