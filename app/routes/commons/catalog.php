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