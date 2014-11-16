<?php

class Profesori extends Eloquent
{

	protected $table = 'profesori';

	public function Profesorimaterii()
    {
        return $this->hasMany('ProfesorMaterii', 'profesor_id');
    }

    /*
    Vreau Materiile unui profesor ordonate alfabetic. Care? $profesor


    " -> "      functia se apeleaza $x->func() si este nestatica
    " :: "      functia se apeleaza Clasa::func() si este statica
    */

    public static function Materii($profesor)
    {
    	return 
    		DB::table('profesori_materii')
    		->join('materii', 'profesori_materii.materie_id', '=', 'materii.id')
    		->where('profesor_id', $profesor->id)->orderby('materii.denumirea')->get();
    }

    public static function MateriiDisponibile($profesor)
    {
    	$rows = DB::select('
    		select
				id, denumirea
			from materii
			where id not in 
			(
				select
					profesori_materii.materie_id
				from profesori_materii
				where profesori_materii.profesor_id = ' . $profesor->id . '
			)
    	    order by denumirea
    	');
    	$lista = [];
    	foreach($rows as $i => $record)
    	{
    		$lista[$record->id] = $record->denumirea;
    	}
    	return $lista;
    }
    
}
