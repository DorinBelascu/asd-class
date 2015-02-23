<?php

class CatalogNoteController extends BaseController {

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
			$note = Note::orderBy('data','desc')->where('elev_id', '=', $id_elev)->where('materie_id', '=', $id_materie)->where('publica_sau_nu', '=' , 1)->get();
		}
		else
		{
			$note = Note::orderBy('data','desc')->where('elev_id', '=', $id_elev)->where('materie_id', '=', $id_materie)->get();
		}
	 	return View::make('catalog/catalog-note')->with([
	 		'note' => $note, 
	 		'elev' => $elev,
	 		'materie' => $materie,
	 		'sem' => $sem,
	 		'user_este_elev' => $user_este_elev,
	 	]);
	}

	public function insert($id_elev, $id_materia)
	{
		$materie = Materii::find($id_materia);
		$elev     = Elevi::find($id_elev);
		if( ! $materie || ! $elev)
		{
			return Redirect::route('catalog-note', ['id_elev' => $id_elev, 'id_materia' => $id_materia, 'denumirea' => $materie->denumirea]);
		}
		$data = Input::all();
		$rules = array(
			'nota'      => 'required|min:1|max:10|integer',
			'data'      => 'required',	
			'semestrul' => 'required|in:1,2',
		);
		$validator = Validator::make($data, $rules, array(
			'nota.required' => 'Ati uitat sa introduceti ceva',
			'nota.min' => 'Introduceti o nota mai mare decat 1 si mai mica decat 10',
			'nota.max' => 'Introduceti o nota mai mare decat 1 si mai mica decat 10',
			'nota.integer' => 'Va rog introduceti un numar intreg',
		));
		if ($validator->passes()) 
		{
			$nota = new Note;
			$nota->valoare        = $data['nota'];
			$nota->materie_id     = $materie->id;
			$nota->elev_id        = $elev->id;
			$nota->data           = $data['data'];	
			$nota->semestru       = $data['semestrul'];	
			$nota->publica_sau_nu = 0;
			$nota->teza 		  = 0;
			$nota->save();
			return Redirect::route('catalog-note', ['id_elev' => $id_elev, 'id_materia' => $id_materia, 'denumirea' => $materie->denumirea])->with('result-success', 'Nota a fost adaugata');
		}
		return Redirect::route('catalog-note', ['id_elev' => $id_elev, 'id_materia' => $id_materia, 'denumirea' => $materie->denumirea])->withInput()->witherrors($validator)->with('result-fail', 'Va rog corectati datele');
	}

	public function delete($id)
	{
		$nota = Note::find($id);
		if( $nota )
		{
			$id_elev = $nota->elev_id;
			$id_materie = $nota->materie_id;
			$materie = Materii::find($nota->materie_id);
			$nota->delete();
			return Redirect::route('catalog-note', ['id_elev' => $id_elev , 'id_materia' => $id_materie, 'denumirea' => $materie->denumirea])->with('result-success', 'Stergerea s-a efectuat cu succes!');
		}
		return Redirect::back();
	}

	public function update($id)
	{
		$nota = Note::find($id);
		if( ! $nota )
		{
			return Redirect::back();
		}
		$id_elev = $nota->elev_id;
		$id_materie = $nota->materie_id;
		$materie = Materii::find($nota->materie_id);
		$data = Input::all();
		$rules = array(
			'nota-edit'      => 'required|min:1|max:10|integer',
			'data-edit'      => 'required',
			'starea-edit'    => 'required|in:publica,privata',	
			'semestru-edit'  => 'required|in:1,2',
			'teza-edit'      => 'required',
		);
		$validator = Validator::make($data, $rules, array(
			'nota-edit.required' => 'Ati uitat sa introduceti ceva',
			'nota-edit.min' => 'Introduceti o nota mai mare decat 1 si mai mica decat 10',
			'nota-edit.max' => 'Introduceti o nota mai mare decat 1 si mai mica decat 10',
			'nota-edit.integer' => 'Va rog introduceti un numar intreg',
		));

		if ($validator->passes()) 
		{
			$nota->valoare        = $data['nota-edit'];
			$nota->data           = $data['data-edit'];	
			$nota->semestru       = $data['semestru-edit'];	
			$nota->publica_sau_nu = $data['starea-edit'] == 'publica' ? 1 : 0;
			$nota->teza 		  = $data['teza-edit'];
			$nota->save();
			return Redirect::route('catalog-note', ['id_elev' => $id_elev , 'id_materia' => $id_materie, 'denumirea' => $materie->denumirea])->with('result-success', 'Nota a fost modificata');
		}
		return Redirect::route('catalog-note', ['id_elev' => $id_elev , 'id_materia' => $id_materie, 'denumirea' => $materie->denumirea])->with('result-success', 'Va rog corectati datele');
	}

	public function insertTeza($id_elev, $id_materia)
	{
		$materie = Materii::find($id_materia);
		$elev     = Elevi::find($id_elev);
		if( ! $materie || ! $elev)
		{
			return Redirect::route('catalog-note', ['id_elev' => $id_elev, 'id_materia' => $id_materia, 'denumirea' => $materie->denumirea]);
		}
		$data = Input::all();
		$rules = array(
			'nota-teza'      => 'required|min:1|max:10|integer',
			'data-teza'      => 'required',
			'starea-teza'    => 'required|in:publica,privata',	
			'semestrul-teza' => 'required|in:1,2',
		);
		$validator = Validator::make($data, $rules, array(
			'nota.required' => 'Ati uitat sa introduceti ceva',
			'nota.min' => 'Introduceti o nota mai mare decat 1 si mai mica decat 10',
			'nota.max' => 'Introduceti o nota mai mare decat 1 si mai mica decat 10',
			'nota.integer' => 'Va rog introduceti un numar intreg',
		));
		if ($validator->passes()) 
		{
			$nota = new Note;
			$nota->valoare        = $data['nota-teza'];
			$nota->materie_id     = $materie->id;
			$nota->elev_id        = $elev->id;
			$nota->data           = $data['data-teza'];	
			$nota->semestru       = $data['semestrul-teza'];	
			$nota->publica_sau_nu = $data['starea-teza'] == 'publica' ? 1 : 0;
			$nota->teza           = 1;
			$nota->save();
			return Redirect::route('catalog-note', ['id_elev' => $id_elev, 'id_materia' => $id_materia, 'denumirea' => $materie->denumirea])->with('result-success', 'Teza a fost adaugata');
		}
		return Redirect::route('catalog-note', ['id_elev' => $id_elev, 'id_materia' => $id_materia, 'denumirea' => $materie->denumirea])->withInput()->witherrors($validator)->with('result-fail', 'Va rog corectati datele');
	}

	function schimbaPublic()
	{
		$id = Input::get('id'); // id-ul inregistrarii ce trebuie schimbate
		$stare = Input::get('stare'); // starea curenta ==> trebuie schimbata

		$record = Note::find($id);
		$record->publica_sau_nu = 1 - $stare;
		$record->save();

		return HTML::image('images/status/' . $record->publica_sau_nu . '.png','', ['style'=>'width:24px', 'title' => $record->publica_sau_nu ? 'publica' : 'privata', 'class' => 'stare_nota', 'data-id' => $record->id, 'data-stare' => $record->publica_sau_nu] );
	}
}