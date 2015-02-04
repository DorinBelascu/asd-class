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
	public function upload_materii($id)
	{
		if( ! ($materie = Materii::find($id) ))
		{
			return Redirect::route('materii');
		}

		$input = ['file' => $uploadedFile = Input::file('photo-materie') ];
    	$rules = ['file' => 'image|max:3000'];
    	$messages = ['file.image' => 'Fisierul trebuie sa fie o imagine valida', 'file.max' => 'Fisierul nu trebuie sa depaseasca 3MB'];

		$validator = Validator::make($input, $rules, $messages);
		if ($validator->fails())
		{
			return Redirect::route('materie_profesori', ['id' => $id])->withErrors($validator);
		}

		$destinationPath = $path =  app_path() . '/../public/images/photos/materii/';

		$materie->photo = $filename = ('photo_' . $id . '(-).' . $uploadedFile->getClientOriginalExtension());
		$materie->save();
		
		$uploadedFile->move($destinationPath, $filename  );	
		$baseName = 'photo_' . $id;
		$photoFileName = str_replace('\\', '/', $destinationPath . $filename);
		$extention ='.' . $uploadedFile->getClientOriginalExtension();
		$sizes = ['icon'   => 64,];
		$img = Image::make($photoFileName);
		$min = min( $img->width(), $img->height() );
		$img->crop($min, $min)->save( $path . '/' . $baseName . '-square.' . $uploadedFile->getClientOriginalExtension());
	    foreach ($sizes as $key => $value) 
	    {
	    	$img = Image::make($path . '/' . $baseName . '-square.' . $uploadedFile->getClientOriginalExtension());
	    	$img->resize($value, $value , 
	    		function ($constraint)
	    		{
	        		$constraint->aspectRatio();
	        		$constraint->upsize();
	    		}
	    	)
	    	// ->crop($value, $value)
	    	->save($path . '/' . $baseName . $key . $extention);
	    }

	return Redirect::route('materie_profesori', ['id' => $id])->with('result-success','Poza a fost adaugata cu succes');
	}
	public function upload_profesori($id)
	{
		if( ! ($profesor = Profesori::find($id) ))
		{
			return Redirect::route('profesori');
		}

		$input = ['file' => $uploadedFile = Input::file('photo-profesor') ];
    	$rules = ['file' => 'image|max:3000'];
    	$messages = ['file.image' => 'Fisierul trebuie sa fie o imagine valida', 'file.max' => 'Fisierul nu trebuie sa depaseasca 3MB'];

		$validator = Validator::make($input, $rules, $messages);
		if ($validator->fails())
		{
			return Redirect::route('profesor_materii', ['id' => $id])->withErrors($validator);
		}

		$destinationPath = $path =  app_path() . '/../public/images/photos/profesori/';

		$profesor->photo = $filename = ('photo_' . $id . '(-).' . $uploadedFile->getClientOriginalExtension());
		$profesor->save();
		
		$uploadedFile->move($destinationPath, $filename  );	
		$baseName = 'photo_' . $id;
		$photoFileName = str_replace('\\', '/', $destinationPath . $filename);
		$extention ='.' . $uploadedFile->getClientOriginalExtension();
		$sizes = ['medium'   => 240,];
		$img = Image::make($photoFileName);
		$min = min( $img->width(), $img->height() );
		$img->crop($min, $min)->save( $path . '/' . $baseName . '-square.' . $uploadedFile->getClientOriginalExtension());
	    foreach ($sizes as $key => $value) 
	    {
	    	$img = Image::make($path . '/' . $baseName . '-square.' . $uploadedFile->getClientOriginalExtension());
	    	$img->resize($value, $value , 
	    		function ($constraint)
	    		{
	        		$constraint->aspectRatio();
	        		$constraint->upsize();
	    		}
	    	)
	    	// ->crop($value, $value)
	    	->save($path . '/' . $baseName . $key . $extention);
	    }

	return Redirect::route('profesor_materii', ['id' => $id])->with('result-success','Poza a fost adaugata cu succes');
	}
}