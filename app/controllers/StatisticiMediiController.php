<?php

	class StatisticiMediiController extends BaseController {

    protected function cmp($a, $b) 
    {
        $result = $this->getSort();
        if ($a[$result['field']] == $b[$result['field']]) 
        {
            return 0;
        }
        return ($a[$result['field']] < $b[$result['field']]) ? -1 : 1;
    }
    protected function direction($currentOrder)
    {
        switch($currentOrder['dir'])
        {
            case 'asc' : 
                $dir = 'desc';
                break;
            case 'desc' : 
                $dir = 'asc';
                break;
        }
        return $dir;
    }

    protected function getSort()
    {

        $currentOrder = Session::get('order-by');

        /**
        $currentOrder['field'] = coloana ultimei sortari
        $currentOrder['dir'] = directia ultimei sortari
        Input::get('sort') = pe ce coloana a apasat omul acuma (elev, materia, data)
        --------
        Ne trebuie
        $sort = coloana din tabela
        $dir = noua directie de sortare
        **/

        $dir = 'asc';
        $sort = 'NumePrenume';
        if($v = Input::get('sort'))
        {
            if( in_array($v, ['Numeprenume', 'medie1', 'medie2', 'medietot']) )
            {
                $dir = $this->direction($currentOrder);
                switch($v)
                {
                    case 'NumePrenume' :
                        $sort = 'NumePrenume';
                        break;
                    case 'medie1' :
                        $sort = 'medie1';
                        break;
                    case 'medie2' :
                        $sort = 'medie2';
                        break;
                    case 'medietot' :
                        $sort = 'medietot';
                        break;
                }
            }
        }

        Session::put('order-by', $result = ['field' => $sort, 'dir' => $dir]);
        return $result;
    }

    public function index()
    {
        if( ! User::CanChange() )
        {
            return Redirect::route('home');
        }
        $note = Note::all();
        $elevi = Elevi::all();
        $medii = array();
        foreach ($elevi as $i => $elev) 
        {
        	$aux = $elev->id;
        	$v = array();
        	$v['NumePrenume'] = $elev->nume . ' ' . $elev->prenume; 
                $v['k1'] = 0; 
                $v['s1'] = 0;
                $v['k2'] = 0;
                $v['s2'] = 0;
                $v['teza1'] = '0';
                $v['teza2'] = '0';
                $v['medie1'] = 'Nu sunt note';
                $v['medie2'] = 'Nu sunt note';
                $v['medietot'] ='Nu sunt note';
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
	        		$medii[$i]['medie1'] = number_format(($medie['s1']/$medie['k1']*3+$medie['teza1'])/4,2,'.','');
	        	}
	        	else
	        	{
	        		$medii[$i]['medie1'] = number_format($medie['s1']/$medie['k1'],2,'.','');
	        	}        	
        	}
        	if ($medie['k2'])
        	{
        		if ($medii[$i]['teza2'])
        		{
        			$medii[$i]['medie2'] = number_format(($medie['s2']/$medie['k2']*3+$medie['teza2'])/4,2,'.','');
        		}
        		else
        		{
        			$medii[$i]['medie2'] = number_format($medie['s2']/$medie['k2'],2,'.','');
        		}
        	}
        	if(($medii[$i]['medie1'] !== 'Nu sunt note') && ($medii[$i]['medie2'] !== 'Nu sunt note')) 
        	{
        		$medii[$i]['medietot'] = number_format(($medii[$i]['medie1'] + $medii[$i]['medie2'])/2,2,'.','');
        	}
        	else
        	{
        		$medii[$i]['medietot'] = $medii[$i]['medie1'] + $medii[$i]['medie2'];		
        	}
        }
        usort($medii, array($this, 'cmp'));
    	return View::make('statistici/statistici-medii')->with('medii',$medii);
	}
}