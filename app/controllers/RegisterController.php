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
			 	//Aici trebuie trimis un mail la adresa $data['email']
			 	//in care sa fie un link de activare a contului

				//Sa afli $user->activation_code

				$user = Sentry::findUserByLogin($data['email']);
				
			 	$emailcontent = array (
					'first_name'    => $user->first_name,
					'last_name'     => $user->last_name,
					'id'            => $user->id,
					'activation_code' => $user->activation_code
				);
			 	Mail::send('emails.activate-account', $emailcontent, function($message) use ($user)
				{
					$message
					->to($user->email, $user->first_name)
					->subject('Activate your ASD Class account');
				});
			 	return Redirect::route('home')->with('result', 'Ai primit un link de activare pe adresa ta de email!');
			} 
			return Redirect::route('register')->withinput()->with('result', $result);
		}
		return Redirect::route('register')->withinput()->witherrors($validator);
		
	}
}