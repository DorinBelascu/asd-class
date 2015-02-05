<?php
Route::group(array('before' => 'isLogged'),function(){


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

});