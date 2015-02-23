<?php

class MateriiController extends BaseController {

	public function index()
	{
		$materii = Materii::orderBy('denumirea')->paginate(5);
		// dd($materii[0]->Profesorimaterii->count());
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
			'add_materie' => 'required|unique:materii,denumirea',
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Introdu denumirea materiei', 
			'unique' => 'Exista deja aceasta materie' 
		));
		if ($validator->passes()) 
		{
			$materie = new Materii;
			$materie->denumirea = $data['add_materie'];
			$materie->save();
			return Redirect::route('materii')->with('result-success', 'Materia a fost adaugata cu succes');
		}
		return Redirect::route('materii')->withinput()->witherrors($validator)->with('result-fail', 'da');
	}

	public function edit()
	{
		$data = Input::all();
		$rules = array(
			'edit-materie' => 'required|unique:materii,denumirea',
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Va rog introduceti ceva...',
			'unique'   => 'Denumirea introdusa exista deja la alta materie',
		));
		if ($validator->passes())
		{
			$materie = Materii::findOrFail(Input::get('id'));
			$materie->denumirea = $data['edit-materie']; 
			$materie->save();
			return Redirect::back()->with('result-success', 'Editarea s-a efectuat cu succes!');
		}
		else
		{
			return Redirect::back()->withInput()->witherrors($validator)->with('result-fail', 'Ceva nu a mers bine!');
		}
	}
	public function delete()
	{
		$materie = Materii::findOrFail(Input::get('id'));

		$materie->delete();	
		return Redirect::route('materii')->with('result-success', 'Stergerea s-a efectuat cu succes!');
	}
}
