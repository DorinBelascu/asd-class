<?php

class StatisticiNoteController extends BaseController
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
		
		$note = Note::orderBy($sort['field'], $sort['dir'])->paginate(15);

		$current_page = Input::get('page');
		if($current_page > $note->getLastPage())
		{
			return Redirect::to(URL::to('statistici-note') . '?page=' . $note->getLastPage());
		}
		return View::make('statistici/statistici-note')->with('note',$note);
	}
}