<?php

class EleviController extends BaseController {

	public function index()
	{
		$elevi = Elevi::orderBy('nume')->paginate(5);
		$current_page = Input::get('page');
		if($current_page > $elevi->getLastPage())
		{
			return Redirect::to(URL::to('elevi') . '?page=' . $elevi->getLastPage());
		}
		return View::make('elevi')->with('elevi', $elevi);
	}

	public function showAddForm()
	{
		return __METHOD__;
	}

}