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
		echo '<pre>';
		var_dump($id);
		var_dump(Input::file('photo-elev'));
		dd('----');
	}
}