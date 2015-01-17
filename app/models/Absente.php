<?php

class Absente extends Eloquent
{

    protected $table = 'absente';

    public function Elev()
    {
        return $this->belongsTo('Elevi', 'elev_id');
    }

    public function Materie()
    {
        return $this->belongsTo('Materii', 'materie_id');
    }
}