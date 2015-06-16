<?php

class Actualites extends Eloquent{

	public $primaryKey = 'idActualite';
	public $timestamps = false;
	protected $table = 'actualite';
	public $fillable = ['titreActualite', 'contenuActualite', 'dateActualite', 'resumeActualite', 'slug'];

}
