<?php

class EleviPhotoController extends BaseController
{
	public function index($id)
	{
		$elev = Elevi::find($id);
		if(! $elev)
		{
			return Redirect::route('elevi');
		}
		return View::make('elevi/elevi-photo')->with('elev', $elev);
	}

	public function upload($id)
	{
		if( ! ($elev = Elevi::find($id) ))
		{
			return Redirect::route('elevi');
		}

		$input = ['file' => $uploadedFile = Input::file('photo-elev') ];
    	$rules = ['file' => 'image|max:3000'];
    	$messages = ['file.image' => 'Fisierul trebuie sa fie o imagine valida', 'file.max' => 'Fisierul nu trebuie sa depaseasca 3MB'];

		$validator = Validator::make($input, $rules, $messages);
		if ($validator->fails())
		{
			return Redirect::route('elevi_photo', ['id' => $id])->withErrors($validator);
		}

		$destinationPath = $path =  app_path() . '/../public/images/photos/elevi/';

		$elev->photo = $filename = ('photo_' . $id . '(-).' . $uploadedFile->getClientOriginalExtension());
		$elev->save();

		$uploadedFile->move($destinationPath, $filename  );


		
		$baseName = 'photo_' . $id;
		$photoFileName = str_replace('\\', '/', $destinationPath . $filename);
		$extention ='.' . $uploadedFile->getClientOriginalExtension();
		$sizes = Config::get('images.sizes');

		$img = Image::make($photoFileName);
		$min = min( $img->width(), $img->height() );
		$img->crop($min, $min)->save( $path . '/' . $baseName . '-square.' . $uploadedFile->getClientOriginalExtension());
		// echo '<pre>';
		// // var_dump();

	    foreach ($sizes as $key => $value) 
	    {
	    	$img = Image::make($path . '/' . $baseName . '-square.' . $uploadedFile->getClientOriginalExtension());
	    	$img->resize($value, $value , 
	    		function ($constraint)
	    		{
	        		$constraint->aspectRatio();
	        		$constraint->upsize();
	    		}
	    	)
	    	// ->crop($value, $value)
	    	->save($path . '/' . $baseName . $key . $extention);
	    }

	return Redirect::route('elevi_photo', ['id' => $id])->with('result-success','Poza a fost adaugata cu succes');
	}
}