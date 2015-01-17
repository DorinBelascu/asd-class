<?php

class Elevi extends Eloquent
{
	protected $table = 'elevi';

	public function note()
    {
		return $this->hasMany('Note', 'elev_id');
	}
}