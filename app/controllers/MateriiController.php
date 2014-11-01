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
		$data = Input::all();
		$rules = array(
			'add_materie'=> 'required|unique:materii,denumirea',
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Baga ba materia', 
			'unique' => 'Exista deja materia:attribute',
		));
		if ($validator->passes()) 
		{
			$materie = new Materii;
			$materie->denumirea = $data['add_materie'];
			$materie->save();
			return Redirect::route('materii')->with('result', 'Materia a fost adaugata cu succes');
		}
		return Redirect::route('materii')->withinput()->witherrors($validator);
	}

}
