<?php

Route::get('statistici/note', array(
	'as'   => 'statistici-note',
	'uses' => 'StatisticiNoteController@index'
));

Route::get('statistici/absente', array(
	'as'   => 'statistici-absente',
	'uses' => 'StatisticiAbsenteController@index'
));