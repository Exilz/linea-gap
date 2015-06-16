<?php

class Slider extends Eloquent {

	public $primaryKey = 'id';
	public $timestamps = false;
	protected $table = 'slider';
	public $fillable = ['id', 'nom', 'alt', 'link', 'pos'];

}
