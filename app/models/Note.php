<?php

class Note extends Eloquent
{

    protected $table = 'note';

    public function Elev()
    {
        return $this->belongsTo('Elevi', 'elev_id');
    }

    public function Materie()
    {
        return $this->belongsTo('Materii', 'materie_id');
    }
}