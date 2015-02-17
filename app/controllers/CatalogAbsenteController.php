<?php

class CatalogAbsenteController extends BaseController {

	protected function user_este_elev($elev)
	{
		if ((Sentry::getUser()->id == $elev->user_id) ) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function index($denumirea, $id_elev, $id_materie)
	{
		$materie = Materii::find($id_materie);
		$elev     = Elevi::find($id_elev);
		if( ! $materie || ! $elev)
		{
			return Redirect::route('materii-catalog', ['id' => $id_elev]);
		}
		$sem = 0;
		if($v = Input::get('semestrul'))
		{
			if( in_array($v, ['1', '2']) )
			{
				switch($v)
				{
					case '1' :
						$sem = 1;
						break;
					case '2' :
						$sem = 2;
						break;
				}
			}
		}
		$user_este_elev = $this->user_este_elev($elev);
		if((!$user_este_elev) && (User::Group() == 'elev'))
		{
			$absente = Absente::orderBy('data','desc')->where('elev_id', '=', $id_elev)->where('materie_id', '=', $id_materie)->where('publica_sau_nu', '=' , 1)->get();
		}
		else
		{
			$absente = Absente::orderBy('data','desc')->where('elev_id', '=', $id_elev)->where('materie_id', '=', $id_materie)->get();
		}
	 	return View::make('catalog/catalog-absente')->with([
	 		'absente' => $absente,
	 		'elev' => $elev,
	 		'materie' => $materie,
	 		'sem' => $sem,
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
			$absenta->publica_sau_nu = 0;
			$absenta->save();
			return Redirect::route('catalog-absente', ['id_elev' => $id_elev, 'id_materia' => $id_materia, 'denumirea' => $materie->denumirea])->with('result-success', 'Absenta a fost adaugata');
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
			'data-edit' => 'required',
		);
		$validator = Validator::make($data, $rules, array(
			'data-edit.required' => 'Ati uitat sa introduceti data',
		));
		if ($validator->passes()) 
		{
			$absenta->materie_id = $id_materie;
			$absenta->elev_id = $id_elev;
			$absenta->data = $data['data-edit'];
			$aux1 = Input::get('motivata_sau_nemotivata');
			$aux2= Input::get('publica_sau_nu');
			$aux3 = Input::get('semestrul');
			$absenta->stare = $aux1;
			$absenta->publica_sau_nu = $aux2;
			$absenta->semestru = $aux3;
			$absenta->save();
			return Redirect::route('catalog-absente', ['id_elev' => $id_elev , 'id_materia' => $id_materie, 'denumirea' => $materie->denumirea])->with('result-success', 'Absenta a fost modificata');
		}
		return Redirect::route('catalog-absente', ['id_elev' => $id_elev , 'id_materia' => $id_materie, 'denumirea' => $materie->denumirea])->with('result-fail', 'Va rog corectati datele');
	}
}