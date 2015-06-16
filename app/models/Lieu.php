<?php

class Lieu extends Eloquent{

	public $primaryKey = 'idLieu';
	public $timestamps = false;
	protected $table = 'lieu';
	public $fillable = ['nomLieu', 'idCatLieu', 'latLieu', 'longLieu'];

}
