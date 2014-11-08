<?php

class ProfesorMateriiController extends BaseController {

	public function index($id)
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

	public function showAddForm()
	{
		return __METHOD__;
	}

}