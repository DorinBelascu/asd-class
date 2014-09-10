<?php

class RegisterController extends BaseController {

	public function index()
	{
		return View::make('register');
	}

	public function create()
	{
		$data = Input::all();
		$rules = array(
			'first_name'=> 'required',
			'last_name'=> 'required',
			'email'=> 'required',	
			'email_confirmed'=> 'required|same:email',
			'password'=> 'required',
			'password_confirmed'=> 'required|same:password',
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Baga ba :attribute', 
			'same' => 'Vezi ca nu e la fel cu campul anterior'
		));
		if ($validator->passes()) 
		{
			$result = Libs\Users::register($data);
			if ($result == 'success') 
			{
			 	return Redirect::route('home');
			} 
			return Redirect::route('register')->withinput()->with('result', $result);
		}
		return Redirect::route('register')->withinput()->witherrors($validator);
		
	}
}