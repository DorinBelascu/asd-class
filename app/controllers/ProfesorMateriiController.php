<?php

class ProfesorMateriiController extends BaseController 
{

	public function index1($id)
	{
		$profesor = Profesori::find($id);
		if(! $profesor)
		{
			return Redirect::route('profesori');
		}
	    return View::make('profesori/materii/index')->with([
	    	'profesor' => $profesor,
	    	'materii'  => $materii = Profesori::Materii($profesor),
	    	'lista'    => Profesori::MateriiDisponibile($profesor)
	    ]);
	}

	public function index2($id)
	{
		
		$materie = Materii::find($id);
		if(! $materie)
		{
			return Redirect::route('materii');
		}
	    return View::make('materii/profesori/index')->with([
	    	'materie'   => $materie,
	    	'profesori' => ProfesorMaterii::with('Profesor')->where('materie_id', $id)->get(),
	    	'lista'     => Materii::ProfesoriDisponibili($materie),
	    ]);
	}

	public function showAddForm()
	{
		$data = Input::all();
		$id_profesor = (int)$data['id'];
		$id_materie = (int)($data['lista_materii']);
		$pm = new ProfesorMaterii;
		$pm->profesor_id = $id_profesor;
		$pm->materie_id = $id_materie;
		$pm->save();
		return Redirect::route('profesor_materii', array('id' => $id_profesor))->with('result-success', 'Materia a fost adaugata profesorului!');
	}

	public function delete()
	{
		$profesor = Profesori::findOrFail(Input::get('id'));
		$pm = ProfesorMaterii::findOrFail(Input::get('pm_id'));
		$pm->delete();	
		return Redirect::route('profesor_materii', array('id' => $profesor->id))->with('result-success', 'Stergerea s-a efectuat cu succes!');
	}

	public function showAddForm2()
	{
		$data = Input::all();
		$id_profesor = (int)$data['lista_profesori'];
		$id_materie = (int)($data['id']);
		$pm = new ProfesorMaterii;
		$pm->profesor_id = $id_profesor;
		$pm->materie_id = $id_materie;
		$pm->save();
		return Redirect::route('materie_profesori', array('id' => $id_materie))->with('result-success', 'Profesorul a fost adaugat materiei!');
	}

	public function delete2()
	{
		$materie = Materii::findOrFail(Input::get('id'));
		$pm = ProfesorMaterii::findOrFail(Input::get('pm_id'));
		$pm->delete();	
		return Redirect::route('materie_profesori', array('id' => $materie->id))->with('result-success', 'Stergerea s-a efectuat cu succes!');
	}
}