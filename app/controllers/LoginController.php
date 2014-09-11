<?php

class LoginController extends BaseController
{
	public function index()
	{
		return View::make('login');
	}

	public function check()
	{
		$data = Input::all();
		$rules = array(
			'email'=> 'required',
			'password'=> 'required',
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Baga ba :attribute', 
		));
		if ($validator->passes()) 
		{
			$result = Libs\Users::authenticate($data);
			if ($result == 'success') 
			{
			 	return Redirect::route('home')->with('result', 'Hello, ' . Sentry::getUser()->first_name . ' ' . Sentry::getUser()->last_name . '!');
			} 
			return Redirect::route('login')->withinput()->with('result', $result);
		}
		return Redirect::route('login')->withinput()->witherrors($validator);
	}
}