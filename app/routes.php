<?php

include 'routes/commons/users.php';




Route::get('profile', array(
	'as'  =>'user-profile',
	'uses'=>'ProfileController@index'
));

Route::post('profile-update', array(
	'as'  =>'profile-update',
	'uses'=>'ProfileController@update'
));

Route::post('profile-password-update',array(
	'as'  =>'password-update',
	'uses'=>'ProfileController@passwordUpdate',
));

Route::get('materii', array(
	'as'   => 'materii',
	'uses' => 'MateriiController@index'

));

Route::post('materii/add', array(
	'as'   => 'add-new-materie',
	'uses' => 'MateriiController@showAddForm'
));

Route::post('materii/edit/', array(
	'as'   => 'edit-materie',
	'uses' => 'MateriiController@edit',
));

Route::post('materii/delete', array(
	'as'   => 'delete-materie',
	'uses' => 'MateriiController@delete',
));

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





Route::get('elevi-photo/{id}', array(
	'as'   => 'elevi_photo',
	'uses' => 'EleviPhotoController@index'
));

Route::post('save-elev-photo-upload/{id}', array(
	'as'   => 'save-elev-photo-upload',
	'uses' => 'EleviPhotoController@upload'
));

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


Route::get('test-image', function()
{
	$path  = Config::get('images.storage');
	$sizes = Config::get('images.sizes');
	
	$img = Image::make(storage_path() . '/photos/test.jpg');
	$min = min( $img->width(), $img->height() );
	$img->crop($min, $min)->save( $path . '/test-square.jpg');
	echo '<pre>';
	// var_dump();

    // $img = Image::make(storage_path().'/photos/test.jpg')->resize(300, 200);

    // $img->save(storage_path().'/photos/altceva.jpg');

    // return $img->response('jpg');
    foreach ($sizes as $key => $value) 
    {
    	$img = Image::make(storage_path() . '/photos/test-square.jpg');
    	var_dump( $value );
    	$img->resize($value, $value , 
    		function ($constraint)
    		{
        		$constraint->aspectRatio();
        		$constraint->upsize();
    		}
    	)
    	// ->crop($value, $value)
    	->save($path . '/test-' . $key .'.jpg');
    }
});