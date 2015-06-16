<?php

class Alerte extends Eloquent {

	public $primaryKey = 'idAlerte';
	public $timestamps = false;
	protected $table = 'alerte';
	public $fillable = ['titreAlerte', 'contenuAlerte', 'dateAlerte', 'resumeAlerte', 'slug', 'latitude', 'longitude'];

}
