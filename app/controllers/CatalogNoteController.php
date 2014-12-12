<?php

class CatalogNoteController extends BaseController {

	public function index($denumirea, $id)
	{
		$adaugare = Session::get('adaugare');
		if ($adaugare) 
		{
			$denumirea = Session::get( 'denumirea' );
    		$id = Session::get( 'id' );
		}

		$materie = Materii::where('denumirea','=', $denumirea)->get()->first();
		if (! $materie)
		{
			return Redirect::route('materii-catalog');	
		}
		$elev = Elevi::find($id);
		if(! $elev)
		{
			return Redirect::route('materii-catalog');
		}
	 	$note = Note::orderBy('data')->get();
	 	return View::make('catalog-note')->with([
	 		'note' => $note, 
	 		'elev' => $elev,
	 		'materie' => $materie
	 	]);
	}

	public function showAddForm($denumirea, $id)
	{
		$materie = Materii::where('denumirea','=', $denumirea)->get()->first();
		if (! $materie)
		{
			return Redirect::route('materii-catalog');	
		}
		$elev = Elevi::find($id);
		if(! $elev)
		{
			return Redirect::route('materii-catalog');
		}
		$data = Input::all();
		$rules = array(
			'nota' => 'required|min:1|max:10|integer',
			'data' => 'required',
			'starea' => 'required',	
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Ati uitat sa introduceti ceva',
			'min' => 'Introduceti o nota mai mare decat 1 si mai mica decat 10',
			'max' => 'Introduceti o nota mai mare decat 1 si mai mica decat 10',
			'integer' => 'Va rog introduceti un numar intreg',
		));
		if ($validator->passes()) 
		{
			$nota = new Note;
			$nota->valoare = $data['nota'];
			$nota->materie_id = $materie->id;
			$nota->elev_id = $id;
			$nota->data = $data['data'];			
			if ($data['starea'] == 'publica') 
			{
				$nota->publica_sau_nu = '1';
			}
			else
			{
				$nota->publica_sau_nu = '0';	
			}
			$nota->save();
			return Redirect::route('catalog-note')->with('result-success','Nota a fost adaugata')->with('denumirea', $denumirea)->with('id', $id)->with('adaugare', 'Adaugare');;
		}
		return Redirect::route('catalog-note')->withInput()->witherrors($validator)->with('result-fail', 'Va rog introduceti o nota intre 1 si 10')->with('denumirea', $denumirea)->with('id', $id)->with('adaugare', 'Adaugare');
	}

	public function delete()
	{
		$data = Input::all();
		$nota = Note::where('id', $data['id'])->get()->first();
		$nota->delete();	
		return Redirect::route('catalog-note')->with('result-success', 'Stergerea s-a efectuat cu succes!')->with('denumirea', $data['denumirea'])->with('id', $data['id_elev'])->with('adaugare', 'Adaugare');
	}

}