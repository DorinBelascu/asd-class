<?php

class Materii extends Eloquent
{

	protected $table = 'materii';

    public function note()
    {
        return $this->hasMany('Note', 'materie_id');
    }


	public function Profesorimaterii()
    {
        return $this->hasMany('ProfesorMaterii', 'materie_id');
    }
	
	public static function Profesori($materie)
    {
    	return 
    		DB::table('profesori_materii')
    		->join('profesori', 'profesori_materii.profesor_id', '=', 'profesor.id')
    		->where('materie_id', $materie->id)->orderby('profesor.nume')->get();
    }

    public static function ProfesoriDisponibili($materie)
    {
    	$rows = DB::select('
    		select
				id, nume, prenume 
			from profesori
			where id not in 
			(
				select
					profesori_materii.profesor_id
				from profesori_materii
				where profesori_materii.materie_id = ' . $materie->id . '
			)
    	    order by nume
    	');
    	$lista = [];
    	foreach($rows as $i => $record)
    	{
    		$lista[$record->id] = $record->nume . ' ' . $record->prenume;
    	}
    	return $lista;
    }

}
