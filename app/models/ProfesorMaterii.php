<?php

class ProfesorMaterii extends Eloquent
{

	protected $table = 'profesori_materii';


	public function Profesor()
    {
        return $this->belongsTo('Profesori', 'profesor_id');
    }

    public function Materie()
    {
        return $this->belongsTo('Materii', 'materie_id');
    }
}
