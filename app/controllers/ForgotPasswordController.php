<?php

class ForgotPasswordController extends BaseController 
{
	public function ShowStartForm()
	{
		return View::make('forgot-password-start-form');
	}

	public function StartFormProcess()
	{
		$data = Input::all();
		$rules = array(
			'email'=> 'required|exists:users,email'

		);
		$validator = Validator::make($data, $rules, array(
			'required' => 'Baga ba :attribute', 
			'exists' => 'Nu exista acest :attribute'
		));
		if ($validator->passes()) 
		{
			$result = Libs\Users::getResetPasswordCode($data);
			if ($result['success']) 
			{
				$user = $result['user'];
					
				$emailcontent = array (
					'first_name'    => $user->first_name,
					'last_name'     => $user->last_name,
					'id'            => $user->id,
					'reset_password_code' => $user->reset_password_code
				);
				Mail::send('emails.forgot-password', $emailcontent, function($message) use ($user)
				{
					$message
					->to($user->email, $user->first_name)
					->subject('Reseteaza-ti parola ASD');
				});
				return Redirect::route('home')->with('result', 'Ai primit un link de resetare a parolei pe adresa ta de email!');
			}
			return Redirect::route('show-forgot-password-form')->withinput()->with('result', $result);
		}
		return Redirect::route('show-forgot-password-form')->withinput()->witherrors($validator);
	}

	public function ShowChangePasswordForm($id, $code)
	{
		return View::make('forgot-password-reset-form')->with('id', $id)->with('code', $code);
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
			 	return Redirect::route('login')->with('result','Parola a fost schimbata cu succes');
			} 
			return Redirect::route('home')->withinput()->with('result', $result);
		}
		return Redirect::route('show-set-password-form')->withinput()->witherrors($validator);
	}

}