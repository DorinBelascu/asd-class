<?php

Route::get('statistici/note', array(
	'as'   => 'statistici-note',
	'uses' => 'StatisticiNoteController@index'
));