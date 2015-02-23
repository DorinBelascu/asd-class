<?php

class LogoutController extends BaseController
{
	public function index()
	{
		Sentry::logout();
		Session::flush();
		return Redirect::route('home')->with('result', 'Pa!');
	}
}