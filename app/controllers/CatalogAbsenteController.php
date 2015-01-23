<?php

class CatalogAbsenteController extends BaseController {

	public function index($denumirea, $id_elev, $id_materie)
	{
		$materie = Materii::find($id_materie);
		$elev     = Elevi::find($id_elev);
		if( ! $materie || ! $elev)
		{
			return Redirect::route('materii-catalog', ['id' => $id_elev]);
		}
	 	return View::make('catalog-absente')->with([
	 		'absente' => Absente::orderBy('data','desc')->where('elev_id', '=', $id_elev)->where('materie_id', '=', $id_materie)->get(), 
	 		'elev' => $elev,
	 		'materie' => $materie
	 	]);
	}

	public function insert($id_elev, $id_materia)
	{
		$materie = Materii::find($id_materia);
		$elev     = Elevi::find($id_elev);
		if( ! $materie || ! $elev)
		{
			return Redirect::route('catalog-absente', ['id_elev' => $id_elev, 'id_materia' => $id_materia, 'denumirea' => $materie->denumirea]);
		}
		$data = Input::all();
		$rules = array(
			'data' => 'required',
			'publica_sau_nu' => 'required|in:publica,privata',	
			'motivata_sau_nemotivata' => 'required',
			'semestrul' => 'required',
		);
		$validator = Validator::make($data, $rules, array(
			'data.required' => 'Ati uitat sa introduceti data',
			'publica_sau_nu.required' => 'Ati uitat sa introduceti daca e publica sau nu',
			'motivata_sau_nemotivata.required' => 'Ati uitat sa introduceti daca e motivata sau nemotivata',
			'semestrul.required' => 'Ati uitat sa introduceti semestrul',

		));
		if ($validator->passes()) 
		{
			$absenta = new Absente;
			$absenta->materie_id = $id_materia;
			$absenta->elev_id = $id_elev;
			$absenta->semestru = $data['semestrul'];
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
			return Redirect::route('catalog-absente', ['id_elev' => $id_elev, 'id_materia' => $id_materia, 'denumirea' => $materie->denumirea])->with('result-success', 'Nota a fost adaugata');
		}
		return Redirect::route('catalog-absente', ['id_elev' => $id_elev, 'id_materia' => $id_materia, 'denumirea' => $materie->denumirea])->withInput()->witherrors($validator)->with('result-fail', 'Va rog corectati datele');
	}

	public function delete($id)
	{
		$absenta = Absente::find($id);
		if( $absenta )
		{
			$id_elev = $absenta->elev_id;
			$id_materie = $absenta->materie_id;
			$materie = Materii::find($absenta->materie_id);
			$absenta->delete();
			return Redirect::route('catalog-absente', ['id_elev' => $id_elev , 'id_materia' => $id_materie, 'denumirea' => $materie->denumirea])->with('result-success', 'Stergerea s-a efectuat cu succes!');
		}
		return Redirect::back();
	}

	public function update($id)
	{
		$absenta = Absente::find($id);
		if( ! $absenta )
		{
			return Redirect::back();
		}

		$id_elev = $absenta->elev_id;
		$id_materie = $absenta->materie_id;
		$materie = Materii::find($absenta->materie_id);
		$data = Input::all();
		$rules = array(
			'data' => 'required',
			'publica_sau_nu' => 'required|in:publica,privata',	
			'motivata_sau_nemotivata' => 'required|in:motivata,nemotivata',
			'semestru-edit' => 'required|in:Semestrul 1,Semestrul 2',
		);
		$validator = Validator::make($data, $rules, array(
			'data.required' => 'Ati uitat sa introduceti data',
			'publica_sau_nu.required' => 'Ati uitat sa introduceti daca e publica sau nu',
			'motivata_sau_nemotivata.required' => 'Ati uitat sa introduceti daca e motivata sau nemotivata',
			'semestru-edit' => 'Ati uitat sa introduceti semestrul',
		));

		if ($validator->passes()) 
		{
			$absenta->materie_id = $id_materie;
			$absenta->elev_id = $id_elev;
			$absenta->semestru = $data['semestru-edit'];
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
			return Redirect::route('catalog-absente', ['id_elev' => $id_elev , 'id_materia' => $id_materie, 'denumirea' => $materie->denumirea])->with('result-success', 'Nota a fost modificata');
		}
		return Redirect::route('catalog-absente', ['id_elev' => $id_elev , 'id_materia' => $id_materie, 'denumirea' => $materie->denumirea])->with('result-fail', 'Va rog corectati datele');
	}
}