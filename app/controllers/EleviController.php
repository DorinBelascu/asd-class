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

		$data = Input::all();
		$rules = array(
			'nume'=> 'required',
			'prenume'=> 'required',
			'data_nasterii'=> 'required|before:2000-01-01|after:1915-01-01|date',	
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Introdu :attribute',
			'before' => 'Introdu o data anterioara datei 01.01.2000',
			'after' => 'Introdu o data mai mare decat 01.01.1915'
		));
		if ($validator->passes()) 
		{
			$elev = new Elevi;
			$elev->nume = $data['nume'];
			$elev->prenume = $data['prenume'];
			$elev->{"data nasterii"} = $data['data_nasterii'];
			$elev->genul = $data['genul'];
			$elev->photo = 'default.png';
			$elev->user_id = $data['user_id'];
			$elev->save();
			$user = Sentry::findUserById($data['user_id']);
			$user->user_type = 'elev';
			$user->save();
			return Redirect::route('elevi')->with('result-success','Elevul a fost adaugat');
		}
		return Redirect::route('elevi')->withInput()->witherrors($validator)->with('result-success', 'Atentie! Ai gresit la adaugarea elevului!');
	}

	public function edit()
	{
		$data = Input::all();
		$rules = array(
			'nume-edit'          => 'required',
			'prenume-edit'       => 'required',
			'data_nasterii-edit' => 'required|before:2000-01-01|after:1915-01-01|date',	
		);
		$gen = array( '1' => 'masculin', '2' => 'feminin');
		$validator = Validator::make($data, $rules, array(
			'required' => 'Baga ba :attribute',
			'before'   => 'Introdu o data anterioara datei 01.01.2000',
			'after'    => 'Introdu o data mai mare decat 01.01.1915'
		));
		if ($validator->passes()) 
		{
			$elev = Elevi::findOrFail(Input::get('id'));
			$elev->nume = Input::get('nume-edit');
			$elev->prenume = Input::get('prenume-edit');
			$elev->{"data nasterii"} = Input::get('data_nasterii-edit');
			$aux = Input::get('genul');
			$elev->genul = $gen[$aux];
			$elev->save();
			return Redirect::back()->with('result-success', 'Editarea s-a efectuat cu succes!');
		}
		return Redirect::back()->withInput()->witherrors($validator)->with('result-fail', 'Atentie! Ai gresit la editarea elevului!');
	}

	public function delete()
	{
		$elev =	Elevi::findOrFail(Input::get('id'));
		$elev->delete();	
		return Redirect::route('elevi')->with('result-success', 'Stergerea s-a efectuat cu succes!');
	}

}