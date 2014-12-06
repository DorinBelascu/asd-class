<?php

class CatalogNoteController extends BaseController {

	public function index($denumirea, $id)
	{
		$materie = Materii::where('denumirea','=', $denumirea)->get()->first();
		if (! $materie)
		{
			return Redirect::route('materii-catalog');	
		}
		$elev = Elevi::find($id);
		if(! $elev)
		{
			return Redirect::route('materii-catalog');
		}
	 	$note = Note::orderBy('data')->get();
	 	return View::make('catalog-note')->with([
	 		'note' => $note, 
	 		'elev' => $elev,
	 		'materie' => $denumirea 
	 	]);
	}

}