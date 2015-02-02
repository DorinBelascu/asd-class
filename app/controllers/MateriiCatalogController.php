<?php

class MateriiCatalogController extends BaseController 
{

	public function index($id)
	{
		$elev = Elevi::find($id);
		$note = Note::where('elev_id', '=', $id)->get();
		$materii = Materii::all();
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
        	if(($medii[$i]['medie2']<>'Elevul nu are note in acest semestru') || ($medii[$i]['medie2']<>'Elevul nu are note in acest semestru')) 
        	{
        		$medii[$i]['medietot'] = round(($medii[$i]['medie1'] + $medii[$i]['medie2'])/2,2);
        	}
        	else
        	{
        		$medii[$i]['medietot'] = round($medii[$i]['medie1'] + $medii[$i]['medie2'],2);		
        	}
        }






		// foreach ($note as $i => $nota) {
		// 	if($nota->semestru==1)
		// 	{
		// 		if ($nota->teza) 
		// 		{
		// 			$teza1 = $nota->valoare;
		// 		}
		// 		else
		// 		{
		// 			$s1 += $nota->valoare;
		// 			$k1 += 1;	
		// 		}
		// 	}
		// 	else
		// 	{
		// 		if ($nota->teza) 
		// 		{
		// 			$teza2 = $nota->valoare;
		// 		}
		// 		$s2 += $nota->valoare;
		// 		$k2 += 1;
		// 	}
		// }
		// $media1 = 'Elevul nu are note la aceasta materie'; 
		// $media2 = 'Elevul nu are note la aceasta materie';
		// if($k1)
		// {
		// 	if ($teza1) 
		// 	{
		// 		$media1 = round(($s1/$k1*3+$teza1)/4,2);
		// 	}
		// 	else
		// 	{
		// 		$media1 = round($s1/$k1,2);
		// 	}
		// }
		// if($k2)
		// {
		// 	if ($teza2) 
		// 	{
		// 		$media2 = round(($s2/$k2*3+$teza2)/4,2);
		// 	}
		// 	else
		// 	{
		// 		$media2 = round($s2/$k2,2);
		// 	}
		// }

  //   	if(($media1<>'Elevul nu are note la aceasta materie') || ($media2<>'Elevul nu are note la aceasta materie')) 
  //   	{
  //   		$mediatot = round(($media1+$media2)/2,2);
  //   	}
  //   	else
  //   	{
  //   		$mediatot = $media1+$media2;	
  //   	}

		// if(! $elev)
		// {
		// 	return Redirect::route('catalog');
		// }
	 // 	$materii = Materii::orderBy('denumirea')->get();
	 	return View::make('materii-catalog')->with([
	 		'materii'  => $materii, 
	 		'id'       => $id,
	 		'medii'   => $medii,
	 	]);
	}
}