<?php

class ProfileController extends BaseController {

	public function index()
	{
		return View::make('profile');
	}

	public function update()
	{
		$data = Input::all();
		$rules = array(
			'first_name'=> 'required',
			'last_name'=> 'required',
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Introdu :attribute', 
		));
		if ($validator->passes()) 
		{
			$result = Libs\Users::update($data);
			if ($result == 'success') 
			{
			 	return Redirect::route('user-profile')->with('result','Contul a fost actualizat.');
			} 
			return Redirect::route('user-profile')->withinput()->with('result', $result);	
		}
		return Redirect::route('user-profile')->withinput()->witherrors($validator);
	}

	public function passwordUpdate()
	{
		$data = Input::all();
		$rules = array(
			'password'=> 'required',
			'new_password'=> 'required',
			'new_password_confirmed'=> 'required|same:new_password',
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Introdu :attribute', 
			'same'     => 'Campurile in care ati introdus parola noua nu sunt identice',
		));
		if ($validator->passes()) 
		{
			$result = Libs\Users::passwordUpdate($data);
			if ($result == 'success') 
			{
			 	return Redirect::route('user-profile')->with('result', $result);
			} 
			return Redirect::route('user-profile')->withinput()->with('password_result', $result);	
		}
		return Redirect::route('user-profile')->withinput()->witherrors($validator);
	}	
}