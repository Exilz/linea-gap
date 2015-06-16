<?php

class Page extends Eloquent{

	public $primaryKey = 'idPage';
	public $timestamps = false;
	protected $table = 'page';
	public $fillable = ['idPage', 'titrePage', 'titreLien', 'contenu', 'submenu', 'slug'];
	
	public static function getMenuLinks($idSubmenu)
	{
		return Self::where('submenu', '=', $idSubmenu)->get();
	}

}
