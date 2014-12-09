<?php 

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