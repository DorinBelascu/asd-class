<?php

class Profesori extends Eloquent
{

	protected $table = 'profesori';

	public function Profesorimaterii()
    {
        return $this->hasMany('ProfesorMaterii', 'profesor_id');
    }

    
}
