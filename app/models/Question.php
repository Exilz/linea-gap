<?php

class Question extends Eloquent {

	public $primaryKey = 'idQuestion';
	public $timestamps = false;
	protected $table = 'question';
	public $fillable = ['sujetQuestion', 'mail', 'contenuQuestion'];

}
