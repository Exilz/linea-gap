<?php

class OrdreArret extends Eloquent{

	public $timestamps = false;
	protected $table = 'ordrearret';
	public $fillable = ['idLigne', 'idArret', 'ordre'];

}
