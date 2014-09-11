<?php

class LogoutController extends BaseController
{
	public function index()
	{
		Sentry::logout();
		return Redirect::route('home')->with('result', 'Bye!');
	}
}