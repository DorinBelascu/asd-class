<?php

Route::get('/', array(
	'as'   => 'home',
	'uses' => 'HomeController@index'
));

include 'routes/commons/users.php';
include 'routes/materii/materii.php';
include 'routes/elevi/elevi.php';
include 'routes/profesori/profesori.php';
include 'routes/profesori-materii/profesori-materii.php';
include 'routes/materii-profesori/materii-profesori.php';
include 'routes/elevi/elevi-photo.php';
include 'routes/commons/catalog.php';
include 'routes/statistici/statistici.php';

Route::post('schimba-stare-absenta', array(
	'as' => 'schimba-stare-absenta',
	'uses' => 'CatalogAbsenteController@schimbaPublic'
));

Route::post('schimba-stare-nota', array(
	'as' => 'schimba-stare-nota',
	'uses' => 'CatalogNoteController@schimbaPublic'
));