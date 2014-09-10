<?php

class ActivateController extends BaseController
{
	public function index($user_id, $activation_code)
	{
		
		$user = User::find($user_id);
		if (! $user)
		{
			return Redirect::route('home');
		}
		echo '<pre>';
		// dd($user);
		dd($user->activation_code . '|' . $activation_code );
		//return View::make('activate-account');
	}
}