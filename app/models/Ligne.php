<?php

class Ligne extends Eloquent{

	public $primaryKey = 'idLigne';
	public $timestamps = false;
	protected $table = 'ligne';
	public $fillable = ['polyline', 'couleurLigne', 'fichierPDF'];
	
	
	/**
	 * Retourne le nom de la ligne grâce à l'ID spécifiée
	*/
	public static function findNameById($idLigne)
	{
		return Self::where('numero', '=', $idLigne)->lists('libelleLigne');
	}

	public static function findIdByName($nomLigne)
	{
		return Self::where('libelleLigne', '=', $nomLigne)->lists('idLigne');
	}


	public static function findLibelleSens($ligne, $sens)
	{
		return Self::where('numero', '=', $ligne)->where('sens', '=', $sens)->lists('libelleLigne')[0];
	}
	
	public static function getLignes()
	{
		// Récupère la configuration du délais du cache, sinon deux heures par défaut
		(Config::get('cache.arretsCacheDelay')) ? $cacheDelay = Config::get('cache.arretsCacheDelay') : $cacheDelay = 120;
		
		$search = Input::get('search');

		$lignes = Self::remember($cacheDelay)
					->where('libelleLigne', 'like', '%'.$search.'%')
					->orWhere('idLigne', '=', $search)
					->groupBy('numero')
					->lists('libelleLigne', 'numero');
		return Response::json($lignes);
	}

}
