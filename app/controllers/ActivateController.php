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
		return Redirect::route('login')->with('result', 'Contul tau s-a activat cu succes!');
	}
}