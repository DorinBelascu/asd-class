<?php

class MateriiCatalogController extends BaseController 
{

	public function index($id)
	{
		$elev = Elevi::find($id);
		$note = Note::where('elev_id', '=', $id)->get();
		$k1 = 0; $k2 = 0; $s1 = 0; $s2 = 0; $teza1 = 0; $teza2 = 0;
		foreach ($note as $i => $nota) {
			if($nota->semestru==1)
			{
				if ($nota->teza) 
				{
					$teza1 = $nota->valoare;
				}
				else
				{
					$s1 += $nota->valoare;
					$k1 += 1;	
				}
			}
			else
			{
				if ($nota->teza) 
				{
					$teza2 = $nota->valoare;
				}
				$s2 += $nota->valoare;
				$k2 += 1;
			}
		}
		$media1 = 'Elevul nu are note la aceasta materie'; 
		$media2 = 'Elevul nu are note la aceasta materie';
		if($k1)
		{
			if ($teza1) 
			{
				$media1 = round(($s1/$k1*3+$teza1)/4,2);
			}
			else
			{
				$media1 = round($s1/$k1,2);
			}
		}
		if($k2)
		{
			if ($teza2) 
			{
				$media2 = round(($s2/$k2*3+$teza2)/4,2);
			}
			else
			{
				$media2 = round($s2/$k2,2);
			}
		}

    	if(($media1<>'Elevul nu are note la aceasta materie') || ($media2<>'Elevul nu are note la aceasta materie')) 
    	{
    		$mediatot = round(($media1+$media2)/2,2);
    	}
    	else
    	{
    		$mediatot = $media1+$media2;	
    	}

		if(! $elev)
		{
			return Redirect::route('catalog');
		}
	 	$materii = Materii::orderBy('denumirea')->get();
	 	return View::make('materii-catalog')->with([
	 		'materii' => $materii, 
	 		'id'      => $id,
	 		'media1'  => $media1,
	 		'media2'  => $media2,
	 		'mediatot'=> $mediatot
	 	]);
	}
}