<?php

class Materii extends Eloquent
{

	protected $table = 'materii';


	public function Profesorimaterii()
    {
        return $this->hasMany('ProfesorMaterii', 'materie_id');
    }
	

}
