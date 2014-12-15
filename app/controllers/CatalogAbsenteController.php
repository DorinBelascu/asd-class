<?php

class CatalogAbsenteController extends BaseController {

	public function index($denumirea, $id)
	{
		$materie = Materii::where('denumirea', $denumirea)->get()->first();
		if (! $materie)
		{
			return Redirect::route('materii-catalog');	
		}
		$elev = Elevi::find($id);
		if(! $elev)
		{
			return Redirect::route('materii-catalog');
		}
	 	$absente = Absente::orderBy('data')->get();
	 	return View::make('catalog-absente')->with([
	 		'absente' => $absente, 
	 		'elev' => $elev,
	 		'materie' => $materie, 
	 	]);
	}

}