<?php

Route::get('catalog', array(
	'as'   => 'catalog',
	'uses' => 'CatalogController@index'
));

Route::get('catalog/materii/{id}', array(
	'as'   => 'materii-catalog',
	'uses' => 'MateriiCatalogController@index'
));

Route::get('catalog/vezi-note-elev/{denumirea}/note/{id}', array(
	'as'   => 'catalog-note',
	'uses' => 'CatalogNoteController@index'
));

Route::get('catalog/vezi-absente-elev/{denumirea}/absente/{id}', array(
	'as'   => 'catalog-absente',
	'uses' => 'CatalogAbsenteController@index'
));

Route::post('catalog/adauga-nota/{denumirea}/{id}', array(
	'as'   => 'add-new-nota',
	'uses' => 'CatalogNoteController@showAddForm'
));

Route::post('catalog/sterge-nota/', array(
	'as'   => 'delete-nota',
	'uses' => 'CatalogNoteController@delete'
));

Route::post('catalog/editeaza-nota/{denumirea}/{id}', array(
	'as'   => 'edit-nota',
	'uses' => 'CatalogNoteController@edit',
));