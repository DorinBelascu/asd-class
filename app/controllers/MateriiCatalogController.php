<?php

class MateriiCatalogController extends BaseController 
{
        protected function show_media($id, $elev)
        {
            $role = User::find(Sentry::getUser()->id)->groupName();
            switch($role)
            {
                case 'admin' : 
                case 'diriginte' : 
                case 'profesor' :
                    return true;
                case 'elev' : 
                    return Sentry::getUser()->id == $elev->user_id;

            }  
        }
	public function index($id)
	{
		$elev = Elevi::find($id);
        $show_media = $this->show_media($id, $elev);
		$note = Note::where('elev_id', '=', $id)->get();
		$materii = Materii::orderBy('denumirea')->get();
		$medii = array();
		foreach ($materii as $i => $materie) 
		{	 
			$v = array();
			$v['denumirea'] = $materie->denumirea; $v['k1'] = 0; $v['s1'] = 0; $v['k2'] = 0; $v['s2'] = 0; $v['teza1'] = 0; $v['teza2'] = 0; $v['medie1'] = 'Elevul nu are note in acest semestru'; $v['medie2'] = 'Elevul nu are note in acest semestru'; $v['medietot'] =0;
			$medii[$materie->id] = $v;
		}

                foreach ($note as $i => $nota) {
                	if ( $nota->semestru==1 )
                	{
                		if ($nota->teza==1) {
                			$medii[$nota->materie_id]['teza1'] = $nota->valoare;
                		}
                		else
                		{
        	        		$medii[$nota->materie_id]['k1'] += 1;
        	        		$medii[$nota->materie_id]['s1'] += $nota->valoare;
                		}
                	}
                	if ( $nota->semestru==2 )
                	{
                		if ($nota->teza==1) {
                			$medii[$nota->materie_id]['teza2'] = $nota->valoare;
                		}
                		else
                		{
        	        		$medii[$nota->materie_id]['k2'] += 1;
        	        		$medii[$nota->materie_id]['s2'] += $nota->valoare;
                		}
                	}
                }

                foreach ($medii as $i => $medie) 
                {
                	if ($medii[$i]['k1']) 
                	{
        	        	if ($medii[$i]['teza1']) 
        	        	{
        	        		$medii[$i]['medie1'] = round(($medie['s1']/$medie['k1']*3+$medie['teza1'])/4);
        	        	}
        	        	else
        	        	{
        	        		$medii[$i]['medie1'] = round($medie['s1']/$medie['k1']);
        	        	}        	
                	}
                	if ($medie['k2'])
                	{
                		if ($medii[$i]['teza2'])
                		{
                			$medii[$i]['medie2'] = round(($medie['s2']/$medie['k2']*3+$medie['teza2'])/4);
                		}
                		else
                		{
                			$medii[$i]['medie2'] = round($medie['s2']/$medie['k2']);
                		}
                	}
                	if(($medii[$i]['medie2'] != 'Elevul nu are note in acest semestru') || ($medii[$i]['medie2'] != 'Elevul nu are note in acest semestru')) 
                	{
                		$medii[$i]['medietot'] = round(($medii[$i]['medie1'] + $medii[$i]['medie2'])/2);
                	}
                	else
                	{
                		$medii[$i]['medietot'] = round($medii[$i]['medie1'] + $medii[$i]['medie2']);		
                	}
                }
                 


	 	return View::make('catalog/materii-catalog')->with([
	 		'materii'   => $materii, 
	 		'id'        => $id,
	 		'medii'     => $medii,
            'nume_elev' => $elev->nume . ' ' . $elev->prenume,
            'show_media' => $show_media,
	 	]);
	}
}