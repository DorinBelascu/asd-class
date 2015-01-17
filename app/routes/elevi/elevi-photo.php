<?php

Route::get('elevi-photo/{id}', array(
	'as'   => 'elevi_photo',
	'uses' => 'EleviPhotoController@index'
));

Route::post('save-elev-photo-upload/{id}', array(
	'as'   => 'save-elev-photo-upload',
	'uses' => 'EleviPhotoController@upload'
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