<?php

class ProfesorMateriiController extends BaseController {

	public function index($id)
	{
		$profesor = Profesori::find($id);
		if(!$profesor)
		{
			return Redirect::route('profesori');
		}
		return 'Trebuie sa vad lista materiilor profesorului ' . $id;
	}

	public function showAddForm()
	{
		return __METHOD__;
	}

}