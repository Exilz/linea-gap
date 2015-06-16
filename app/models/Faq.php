<?php

class Faq extends Eloquent {

	public $primaryKey = 'idFAQ';
	public $timestamps = false;
	protected $table = 'faq';
	public $fillable = ['question', 'reponse'];

}
