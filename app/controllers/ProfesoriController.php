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
		$data = Input::all();
		$rules = array(
			'nume'=> 'required',
			'prenume'=> 'required',
			'data_nasterii'=> 'required|before:1990-01-01|after:1915-01-01|date',	
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Introdu :attribute',
			'before' => 'Introdu o data anterioara datei 01.01.1990',
			'after' => 'Introdu o data mai mare decat 01.01.1915'
		));
		if ($validator->passes()) 
		{
			$profesor = new Profesori;
			$profesor->nume = $data['nume'];
			$profesor->prenume = $data['prenume'];
			$profesor->{"data nasterii"} = $data['data_nasterii'];
			$profesor->save();
			return Redirect::route('profesori')->with('result','Profesorul a fost adaugat');
		}
		return Redirect::route('profesori')->withInput()->witherrors($validator)->with('result', 'Atentie! Ai gresit la adaugarea profesorului!');
		
	}

	public function edit()
	{
		$data = Input::all();
		$nume_nou = Input::get('nume-edit');
		$prenume_nou = Input::get('prenume-edit');
		$data_nou = Input::get('data_nasterii-edit');
		$rules = array(
			'nume-edit'=> 'required',
			'prenume-edit'=> 'required',
			'data_nasterii-edit'=> 'required|before:1990-01-01|after:1915-01-01|date',	
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Introdu :attribute',
			'before' => 'Introdu o data anterioara datei 01.01.1990',
			'after' => 'Introdu o data mai mare decat 01.01.1915'
		));
		if ($validator->passes()) 
		{
			$profesor = Profesori::findOrFail(Input::get('id'));
			if ((($profesor->nume) <> $nume_nou) || (($profesor->prenume) <> $prenume_nou) || (($profesor->{"data nasterii"}) <> $data_nou))
			{
				$profesor->nume = Input::get('nume');
				$profesor->prenume = Input::get('prenume');
				$profesor->{"data nasterii"} = Input::get('data_nasterii');
				$profesor->save();
				return Redirect::back()->with('result', 'Editarea s-a efectuat cu succes!');
			}
			return Redirect::back()->with('result', 'Nu s-a efectuat nici o editare!');
		}
		return Redirect::back()->withInput()->witherrors($validator)->with('result', 'Atentie! Ai gresit la editarea profesorului!');
	}

	public function delete()
	{
		$profesor = Profesori::findOrFail(Input::get('id'));
		$profesor->delete();	
		return Redirect::route('profesori')->with('result', 'Stergerea s-a efectuat cu succes!');
	}

}
