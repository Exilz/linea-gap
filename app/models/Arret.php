<?php

class Arret extends Eloquent {

	public $primaryKey = 'idArret';
	public $timestamps = false;
	protected $table = 'arret';
	public $fillable = ['nomArret', 'accesArret', 'latArret', 'longArret'];
	
	/**
	 * Retourne l'ID de l'arrêt grâce au nom spécifié
	*/
	public static function findIdByName($nomArret)
	{
		return Self::where('nomArret', '=', $nomArret)->lists('idArret');
	}
	
	/**
	 * Retourne le nom de l'arrêt grâce à l'ID spécifiée
	*/
	public static function findNameById($idArret)
	{
		return Self::where('idArret', '=', $idArret)->lists('nomArret')[0];
	}
	
	/**
	 * Retourne un JSON contenant les arrêts
	*/
	public static function getArrets()
	{
		// Récupère la configuration du délais du cache, sinon deux heures par défaut
		(Config::get('cache.arretsCacheDelay')) ? $cacheDelay = Config::get('cache.arretsCacheDelay') : $cacheDelay = 120;
		
		$search = Input::get('search');

		$arrets = Self::remember($cacheDelay)
					->where('nomArret', 'like', '%'.$search.'%')
					->distinct('nomArret')
					->lists('nomArret');
		return Response::json($arrets);
	}
	
}
