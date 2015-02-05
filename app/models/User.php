<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function groupName()
	{
		$user = Sentry::getUser();
		$groups = $user->getGroups();
		return($groups[0]->name);
	}

	public static function Group()
	{
		return self::find(Sentry::getUser()->id)->groupName();
	}

	public static function CanChange()
	{
		return in_array(self::Group(), ['admin', 'diriginte']);
	}

}
