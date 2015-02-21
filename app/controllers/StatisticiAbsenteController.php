<?php

class StatisticiAbsenteController extends BaseController
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
		$sort = 'data';
		$dir = 'desc';
		if($v = Input::get('sort'))
		{
			if( in_array($v, ['elev', 'materie', 'data','stare','semestru']) )
			{
				$dir = $this->direction($currentOrder);
				switch($v)
				{
					case 'elev' :
						$sort = 'elev_id';
						break;
					case 'materie' :
						$sort = 'materie_id';
						break;
					case 'semestru' :
						$sort = 'semestru';
						break;
					case 'stare' :
						$sort = 'stare';
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
		$sort = $this->getSort();
		
		$absente = DB::table('absente')
			->leftjoin('elevi', 'absente.elev_id', '=', 'elevi.id')
			->leftjoin('materii', 'absente.materie_id', '=', 'materii.id')
			->select('absente.data', 'elevi.nume', 'elevi.prenume', 'materii.denumirea', 'absente.stare', 'absente.semestru')
			->orderBy($sort['field'], $sort['dir'])
			->paginate(15);

		$current_page = Input::get('page');
		if($current_page > $absente->getLastPage())
		{
			return Redirect::to(URL::to('statistici-absente') . '?page=' . $absente->getLastPage());
		}
		return View::make('statistici/statistici-absente')->with('absente',$absente);
	}
}