<?php

class StatisticiNoteController extends BaseController
{
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

		$dir = 'desc';
		$sort = 'data';
		if($v = Input::get('sort'))
		{
			if( in_array($v, ['elev', 'materie', 'data']) )
			{
				$dir = $this->direction($currentOrder);
				switch($v)
				{
					case 'elev' :
						$sort = 'elevi.nume';
						break;
					case 'materie' :
						$sort = 'materii.denumirea';
						break;
					case 'data' :
						$sort = 'note.data';
						break;
				}
			}
		}

		Session::put('order-by', $result = ['field' => $sort, 'dir' => $dir]);
		return $result;
	}


	public function index()
	{

		$sort = $this->getSort();
		$note = DB::table('note')
            ->leftjoin('elevi', 'note.elev_id', '=', 'elevi.id')
            ->leftjoin('materii', 'note.materie_id', '=', 'materii.id')
            ->select('note.data', 'elevi.nume', 'elevi.prenume', 'materii.denumirea', 'note.valoare', 'note.semestru')
            ->orderBy($sort['field'], $sort['dir'])
            ->paginate(15);

        // echo '<pre>';
        // dd($note);

		$current_page = Input::get('page');
		if($current_page > $note->getLastPage())
		{
			return Redirect::to(URL::to('statistici-note') . '?page=' . $note->getLastPage());
		}
		return View::make('statistici/statistici-note')->with('note',$note);
	}
}