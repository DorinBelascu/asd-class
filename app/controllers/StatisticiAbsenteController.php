<?php

class StatisticiAbsenteController extends BaseController
{

	protected function getSort()
	{
		$sort = 'data';
		$dir = 'desc';
		if($v = Input::get('sort'))
		{
			if( in_array($v, ['elev', 'materie', 'data']) )
			{
				switch($v)
				{
					case 'elev' :
						$sort = 'elev_id';
						$dir = 'asc';
						break;
					case 'materie' :
						$sort = 'materie_id';
						$dir = 'asc';
						break;
				}
			}
		}
		return ['field' => $sort, 'dir' => $dir];
	}


	public function index()
	{

		$sort = $this->getSort();
		
		$absente = Absente::orderBy($sort['field'], $sort['dir'])->paginate(15);

		$current_page = Input::get('page');
		if($current_page > $absente->getLastPage())
		{
			return Redirect::to(URL::to('statistici-absente') . '?page=' . $absente->getLastPage());
		}
		return View::make('statistici/statistici-absente')->with('absente',$absente);
	}
}