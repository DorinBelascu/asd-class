<?php

class ActivateController extends BaseController
{
	public function index($user_id, $activation_code)
	{

		$result = Libs\Users::activate($user_id, $activation_code);
		if ($result != 'success')
		{

			return Redirect::route('home')->with('result', $result);
		}
		$user = Sentry::findUserById($user_id);
		if ($user->user_type == 'elev') 
		{
			$elev = new Elevi;
			$elev->nume = $user->first_name;
			$elev->prenume = $user->last_name;
			$elev->photo = 'default.png';
			$elev->user_id = $user->id;
			$elev->save();
		}
		else
		{
			$profesor = new Profesori;
			$profesor->nume = $user->first_name;
			$profesor->prenume = $user->last_name;
			$profesor->user_id = $user->id;
			$profesor->save();
		}
		return Redirect::route('login')->with('result', 'Contul tau s-a activat cu succes!');
	}
}