<?php

class Lien extends Eloquent{

	public $primaryKey = 'idLien';
	public $timestamps = false;
	protected $table = 'lien';
	public $fillable = ['urlLien', 'libelleLien', 'logoLien'];

}
