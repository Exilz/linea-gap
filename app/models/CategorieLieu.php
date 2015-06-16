<?php

class CategorieLieu extends Eloquent{

	public $primaryKey = 'idCatLieu';
	public $timestamps = false;
	protected $table = 'categorielieu';
	public $fillable = ['nomCatLieu'];

}
