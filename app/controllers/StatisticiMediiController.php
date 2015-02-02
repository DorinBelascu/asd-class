<?php

	class StatisticiMediiController extends BaseController {

		public function index()
		{
        $note = Note::all();
        $elevi = Elevi::all();
        $medii = array();
        foreach ($elevi as $i => $elev) 
        {
        	$aux = $elev->id;
        	$v = array();
        	$v['NumePrenume'] = $elev->nume . ' ' . $elev->prenume; $v['k1'] = 0; $v['s1'] = 0; $v['k2'] = 0; $v['s2'] = 0; $v['teza1'] = '0'; $v['teza2'] = '0'; $v['medie1'] = 0; $v['medie2'] = 0; $v['medietot'] =0;
        	$medii[$aux]=$v;
        }
        foreach ($note as $i => $nota) {
        	if ( $nota->semestru==1 )
        	{
        		if ($nota->teza==1) {
        			$medii[$nota->elev_id]['teza1'] = $nota->valoare;
        		}
        		else
        		{
	        		$medii[$nota->elev_id]['k1'] += 1;
	        		$medii[$nota->elev_id]['s1'] += $nota->valoare;
        		}
        	}
        	if ( $nota->semestru==2 )
        	{
        		if ($nota->teza==1) {
        			$medii[$nota->elev_id]['teza2'] = $nota->valoare;
        		}
        		else
        		{
	        		$medii[$nota->elev_id]['k2'] += 1;
	        		$medii[$nota->elev_id]['s2'] += $nota->valoare;
        		}
        	}
        }
        foreach ($medii as $i => $medie) 
        {
        	if ($medii[$i]['k1']) 
        	{
	        	if ($medii[$i]['teza1']) 
	        	{
	        		$medii[$i]['medie1'] = round(($medie['s1']/$medie['k1']*3+$medie['teza1'])/4,2);
	        	}
	        	else
	        	{
	        		$medii[$i]['medie1'] = round($medie['s1']/$medie['k1'],2);
	        	}        	
        	}
        	if ($medie['k2'])
        	{
        		if ($medii[$i]['teza2'])
        		{
        			$medii[$i]['medie2'] = round(($medie['s2']/$medie['k2']*3+$medie['teza2'])/4,2);
        		}
        		else
        		{
        			$medii[$i]['medie2'] = round($medie['s2']/$medie['k2'],2);
        		}
        	}
        	if(($medii[$i]['medie2']) || ($medii[$i]['medie2'])) 
        	{
        		$medii[$i]['medietot'] = round(($medii[$i]['medie1'] + $medii[$i]['medie2'])/2,2);
        	}
        	else
        	{
        		$medii[$i]['medietot'] = round($medii[$i]['medie1'] + $medii[$i]['medie2'],2);		
        	}
        }

		return View::make('statistici/statistici-medii')->with('medii',$medii);
		}
	}