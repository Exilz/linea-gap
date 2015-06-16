<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Client extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'client';
	public $timestamps = false;
	public $fillable = ['nomClient', 'prenomClient', 'loginClient', 'mdpClient', 'emailClient', 'adresseClient', 'adresseClient2'];
	public $primaryKey = 'idClient';
	
	public static function getIdByLogin($login)
	{
		return Self::where('loginClient', '=', $login)->lists('idClient')[0];
	}

}
