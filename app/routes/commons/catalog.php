<?php
Route::group(array('before' => 'isLogged'),function(){
/**
vad toti elevii
**/
Route::get('catalog', array(
	'as'   => 'catalog',
	'uses' => 'CatalogController@index'
));

/**
Sunt pe elevul id si vad toate materiile
**/
Route::get('catalog/materii/{id}', array(
	'as'   => 'materii-catalog',
	'uses' => 'MateriiCatalogController@index'
));

/**
Vreau sa vad notele elevului id_elev la materia id_materie
**/
Route::get('catalog/vezi-note-elev-la-materia-{denumirea}/{id_elev}-{id_materie}', array(
	'as'   => 'catalog-note',
	'uses' => 'CatalogNoteController@index'
));


/**
Adauga o inregistrare noua in tabele NOTE (elev_id, materie_id)
**/
Route::post('catalog/adauga-nota/{id_elev}/{id_materia}', array(
	'as'   => 'add-new-nota',
	'uses' => 'CatalogNoteController@insert'
));


/**
Sterge inregistrarea id din tabela NOTE
**/
Route::post('catalog/sterge-nota/{id}', array(
	'as'   => 'delete-nota',
	'uses' => 'CatalogNoteController@delete'
));


/**
Modifica inregistrarea id din tabela NOTE
**/
Route::post('catalog/editeaza-nota/{id}', array(
	'as'   => 'edit-nota',
	'uses' => 'CatalogNoteController@update',
));

Route::get('catalog/vezi-absente-elev-la-materia-{denumirea}/{id_elev}-{id_materie}', array(
	'as'   => 'catalog-absente',
	'uses' => 'CatalogAbsenteController@index'
));

Route::post('catalog/adauga-absenta/{id_elev}/{id_materia}', array(
	'as'   => 'add-new-absenta',
	'uses' => 'CatalogAbsenteController@insert',
));

Route::post('catalog/sterge-absenta/{id}', array(
	'as'   => 'delete-absenta',
	'uses' => 'CatalogAbsenteController@delete'
));

Route::post('catalog/editeaza-absenta/{id}', array(
	'as'   => 'edit-absenta',
	'uses' => 'CatalogAbsenteController@update',
));

Route::post('catalog/adauga-teza/{id_elev}/{id_materia}', array(
	'as'   => 'add-new-teza',
	'uses' => 'CatalogNoteController@insertTeza'
));
});