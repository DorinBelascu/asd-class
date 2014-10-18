<?php

class ProfesoriController extends BaseController {

	public function index()
	{
		$profesori = Profesori::orderBy('nume')->paginate(5);
		$current_page = Input::get('page');
		if($current_page > $profesori->getLastPage())
		{
			return Redirect::to(URL::to('profesori') . '?page=' . $profesori->getLastPage());
		}
		return View::make('profesori')->with('profesori', $profesori);
	}

	public function showAddForm()
	{
		return __METHOD__;
	}

}
