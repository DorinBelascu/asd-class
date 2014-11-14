<?php

class ProfesorMateriiController extends BaseController {

	public function index1($id)
	{
		$profesor = Profesori::find($id);
		if(! $profesor)
		{
			return Redirect::route('profesori');
		}
	    return View::make('profesori/materii/index')->with([
	    	'profesor' => $profesor,
	    	'materii' => ProfesorMaterii::with('Materie')->where('profesor_id', $id)->get(),
	    ]);
	}

	public function index2($id)
	{
		$materie = Materii::find($id);
		if(! $materie)
		{
			return Redirect::route('materii');
		}
	    return View::make('materii/profesori/index')->with([
	    	'materie' => $materie,
	    	'profesori' => ProfesorMaterii::with('Profesor')->where('materie_id', $id)->get(),
	    ]);
	}

}