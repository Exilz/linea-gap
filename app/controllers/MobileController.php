<?php

class MobileController extends \BaseController{
    
    /**
     * Retourne la liste des arrets en fonction de la recherche (autocomplete)
    */
	public function getArrets()
	{
		return Arret::getArrets();
	}
	
	/**
	 * Retourne la liste des lignes en fonction de la recherche (autocomplete)
	*/
	public function getLignes()
	{
		return Ligne::getLignes();
	}
	
	/**
	 * Retourne l'id de la ligne à partir du nom pour la recherche par ligne
	*/
	public function getIdLigne()
	{
		return Response::json(Ligne::findIdByName(Input::get('nomLigne')));
	}
	
	/**
	 * Retourne la liste des lignes correspondant à un arrêt
	*/
	public function getLignesArret()
	{
		$lignes = Horaire::findLignesByArret(Input::get('arret'));
		return Response::json($lignes);
	}
	
	/**
	 * Retourne un JSON contenant les horaires aller et retour
	 * En fonction des paramètres idLigne, date et heureMin
	*/
	public function getHoraires($idLigne, $date, $heureMin)
	{
		$heure = explode(':', $heureMin)[0];
		$minute = explode(':', $heureMin)[1];
		$horaires = Horaire::getHorairesByLigne($idLigne, $date, $heure, $minute);
		
		return Response::json($horaires);
	}
	
	public function connect()
	{
		$password = Input::get('password');
		$username = Input::get('username');
		
        if(Auth::attempt(['loginClient' => $username, 'password' => $password], true))
		{
			$id = (int)Client::getIdByLogin($username);
        	return Response::json([
        					'status' => 'OK',
     						'id'	 => $id
        					]);
		}
		else
		{
        	return Response::json([
        					'status' => 'FAIL'
        					]);
		}
		
	}
    
    
}