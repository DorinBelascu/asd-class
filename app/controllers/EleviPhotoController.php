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
    	$rules = ['file' => 'image'];
    	$messages = ['file.image' => 'Fisierul trebuie sa fie o imagine valida'];

		$validator = Validator::make($input, $rules, $messages);
		if ($validator->fails())
		{
			return Redirect::route('elevi_photo', ['id' => $id])->withErrors($validator);
		}

		$destinationPath =  app_path() . '/../public/images/photos/elevi/';
		$elev->photo = $filename = ('photo_' . $id . '.' . $uploadedFile->getClientOriginalExtension());
		$elev->save();

		$uploadedFile->move($destinationPath, $filename  );

		return Redirect::route('elevi_photo', ['id' => $id])->with('result-success','Poza a fost adaugata cu succes');
	}
}