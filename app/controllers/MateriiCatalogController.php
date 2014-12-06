<?php

class MateriiCatalogController extends BaseController {

	public function index($id)
	{
		$elev = Elevi::find($id);
		if(! $elev)
		{
			return Redirect::route('catalog');
		}
	 	$materii = Materii::orderBy('denumirea')->get();
	 	return View::make('materii-catalog')->with([
	 		'materii' => $materii, 
	 		'id' => $id
	 	]);
	}
}