<?php

namespace Libs;

class Users
{
	public static function register($data)
	{
		try
		{
   			 // Let's register a user.
		    $user = \Sentry::register(array(
		        'email'     => $data['email'],
		        'password'  => $data['password'],
		        'first_name'=> $data['first_name'],
		        'last_name' => $data['last_name'],
		    ));

		    // Let's get the activation code
		    $activationCode = $user->getActivationCode();

		    // Send activation code to the user so he can activate the account

		    $result = 'success';
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    $result = 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    $result = 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    $result = 'User with this login already exists.';
		}
		return $result;
	}

	public static function authenticate($data)
	{
		try
		{
		    // Login credentials
		    $credentials = array(
		        'email'    => $data['email'],
		        'password' => $data['password'],
		    );

		    // Authenticate the user
		    $user = \Sentry::authenticate($credentials, false);
		    $result = 'success';
		}
		catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    $result = 'Login field is required.';
		}
		catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    $result = 'Password field is required.';
		}
		catch (\Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		    $result = 'Wrong password, try again.';
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    $result = 'User was not found.';
		}
		catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    $result = 'User is not activated.';
		}

		// The following is only required if the throttling is enabled
		catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    $result = 'User is suspended.';
		}
		catch (\Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    $result = 'User is banned.';
		}
		return $result;
	}

	public static function resetpassword($id, $code)
	{
		$user = \User::find($id);
		if (! $user)
		{
			return 0;
		}

		if ($code == $user->reset_password_code)
		{
			return 1;
		}
		return 0;
	}

	public static function change_password($data)
	{
		try
		{
			$user = \Sentry::findUserByLogin($data['email']);
		}
		catch(\exception $e)
		{
			$user = NULL;
		}
		if (! $user)
		{
			return 'User not found!';
		}
		$user->password = $data['password'];
		$user->save();
		return 'success';
	}
	public static function activate($user_id, $activation_code)
	{
		try
		{
		    // Find the user using the user id
		    $user = \Sentry::findUserById($user_id);

		    // Attempt to activate the user
		    if ($user->attemptActivation($activation_code))
		    {
		        $result = 'success';
		    }
		    else
		    {
		        $result = 'failed';
		    }
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    $result = 'User was not found.';
		}
		catch (\Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
		{
		    $result = 'User is already activated.';
		}
		return $result;
	}

	public static function update($data)
	{
		try
		{
		    // Get the current active/logged in user
		    $user = \Sentry::getUser();
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    // User wasn't found, should only happen if the user was deleted
		    // when they were already logged in or had a "remember me" cookie set
		    // and they were deleted.
		}
		$user->first_name = $data['first_name'];
		$user->last_name = $data['last_name'];
		$user->save();
		return 'success';	
	}

	public static function passwordUpdate($data)
	{
		try
		{
			$user = \Sentry::getUser();
			if($user->checkPassword($data['password']))
    		{
      			$user->password = $data['new_password'];
				$user->save();
				$result = 'Parola a fost schimbata cu succes!';
    		}
   	 		else
    		{
       			$result = 'Parola nu este cea corecta.';
   			}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
    		echo 'User was not found.';
		}
		return $result;
	}
}