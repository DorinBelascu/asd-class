<?php

class CatalogController extends BaseController 
{
	public function index()
	{
		$elevi = Elevi::orderBy('nume')->get();
		return View::make('catalog/catalog')->with('elevi', $elevi);
	}
}