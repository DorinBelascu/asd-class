<?php

class CatalogNoteController extends BaseController {

	public function index($denumirea, $id)
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
	 	$note = Note::orderBy('data','desc')->get();
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
			'semestrul' => 'required',
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
			$nota->semestru = $data['semestrul'];		
			if ($data['starea'] == 'publica') 
			{
				$nota->publica_sau_nu = '1';
			}
			else
			{
				$nota->publica_sau_nu = '0';	
			}
			$nota->save();
			return Redirect::route('catalog-note', ['id' => $id, 'denumirea' => $denumirea])->with('result-success', 'Nota a fost adaugata');
		}
		return Redirect::route('catalog-note', ['id' => $id, 'denumirea' => $denumirea])->withInput()->witherrors($validator)->with('result-fail', 'Va rog introduceti o nota intre 1 si 10');
	}

	public function delete()
	{
		$data = Input::all();
		$nota = Note::where('id', $data['id'])->get()->first();
		$nota->delete();	
		return Redirect::route('catalog-note', ['id' => $data['id_elev'], 'denumirea' => $data['denumirea']])->with('result-success', 'Stergerea s-a efectuat cu succes!');
	}

	public function edit()
	{
		$data = Input::all();
		$materie = Materii::find($data['id_materie']);
		if (! $materie)
		{
			return Redirect::route('materii-catalog');	
		}
		$elev = Elevi::find($data['id_elev']);
		if(! $elev)
		{
			return Redirect::route('materii-catalog');
		}
		$rules = array(
			'nota-edit' => 'required|min:1|max:10|integer',
			'data-edit' => 'required',
			'starea-edit' => 'required',
			'semestru-edit' => 'required',
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Ati uitat sa introduceti ceva',
			'min' => 'Introduceti o nota mai mare decat 1 si mai mica decat 10',
			'max' => 'Introduceti o nota mai mare decat 1 si mai mica decat 10',
			'integer' => 'Va rog introduceti un numar intreg',
		));

		if ($validator->passes()) 
		{
			$nota = Note::find($data['id']);
			$nota->valoare = $data['nota-edit'];
			$nota->materie_id = $materie->id;
			$nota->elev_id = $data['id_elev'];
			$nota->semestru = $data['semestrul'];
			$nota->data = $data['data-edit'];			
			if ($data['starea-edit'] == 'publica') 
			{
				$nota->publica_sau_nu = '1';
			}
			else
			{
				$nota->publica_sau_nu = '0';	
			}
			$nota->save();
			return Redirect::route('catalog-note', ['id' => $data['id_elev'], 'denumirea' => $data['denumirea']])->with('result-success','Nota a fost modificata');
		}
		return Redirect::route('catalog-note', ['id' => $data['elev_id'], 'denumirea' => $data['denumirea']])->withInput()->witherrors($validator)->with('result-fail', 'Va rog introduceti o nota intre 1 si 10');
	}
}