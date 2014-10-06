<?php

class MateriiController extends BaseController {

	public function index()
	{
		$materii = Materii::orderBy('denumirea')->paginate(5);
		$current_page = Input::get('page');
		if($current_page > $materii->getLastPage())
		{
			return Redirect::to(URL::to('materii') . '?page=' . $materii->getLastPage());
		}
		return View::make('materii')->with('materii', $materii);
	}

	public function showAddForm()
	{
		return __METHOD__;
	}

}
