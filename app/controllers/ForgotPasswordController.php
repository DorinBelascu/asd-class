<?php

class ForgotPasswordController extends BaseController {

	public function index($id, $code)
	{
		$result = Libs\Users::resetpassword($id, $code);
		if (! $result)
		{
			return Redirect::route('home')->with('result','Cerere de resetare parola incorecta');
		}
		return Redirect::route('reset-password');
	}

	public function reset()
	{
		return View::make('reset-password');
	}

	public function change()
	{
		$data = Input::all();
		$rules = array(
			'email'=> 'required',
			'password'=> 'required',
			'password_confirmed' => 'required|same:password',
		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Baga ba :attribute', 
			'same'     => 'Parolele introduse nu sunt identice',
		));
		if ($validator->passes()) 
		{
			$result = Libs\Users::change_password($data);
			if ($result == 'success') 
			{
			 	return Redirect::route('home')->with('result','Parola a fost schimbata cu succes');
			} 
			return Redirect::route('reset-password')->withinput()->with('result', $result);
		}
		return Redirect::route('reset-password')->withinput()->witherrors($validator);
	}

}