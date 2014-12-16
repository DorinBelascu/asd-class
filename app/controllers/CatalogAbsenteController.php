<?php

class CatalogAbsenteController extends BaseController {

	public function index($denumirea, $id)
	{
		$adaugare = Session::get('adaugare');
		if ($adaugare) 
		{
			$denumirea = Session::get( 'denumirea' );
    		$id = Session::get( 'id' );
		}

		$materie = Materii::where('denumirea', $denumirea)->get()->first();
		if (! $materie)
		{
			return Redirect::route('materii-catalog');	
		}
		$elev = Elevi::find($id);
		if(! $elev)
		{
			return Redirect::route('materii-catalog');
		}
	 	$absente = Absente::orderBy('data')->get();
	 	return View::make('catalog-absente')->with([
	 		'absente' => $absente, 
	 		'elev' => $elev,
	 		'materie' => $materie, 
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
			'data' => 'required',
			'publica_sau_nu' => 'required',	
			'motivata_sau_nemotivata' => 'required',
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Ati uitat sa introduceti ceva',
		));
		if ($validator->passes()) 
		{
			$absenta = new Absente;
			$absenta->materie_id = $materie->id;
			$absenta->elev_id = $id;
			$absenta->data = $data['data'];			
			if ($data['publica_sau_nu'] == 'publica') 
			{
				$absenta->publica_sau_nu = '1';
			}
			else
			{
				$absenta->publica_sau_nu = '0';	
			}

			if ($data['motivata_sau_nemotivata'] == 'motivata') 
			{
				$absenta->stare = '1';
			}
			else
			{
				$absenta->stare = '0';	
			}
			$absenta->save();
			return Redirect::route('catalog-absente')->with('result-success','Absenta a fost adaugata cu succes')->with('denumirea', $denumirea)->with('id', $id)->with('adaugare', 'Adaugare');;
		}
		return Redirect::route('catalog-absente')->withInput()->witherrors($validator)->with('result-fail', 'Ati uitat sa introduceti data')->with('denumirea', $denumirea)->with('id', $id)->with('adaugare', 'Adaugare');
	}
}