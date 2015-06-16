<?php

class Horaire extends Eloquent {

	public $timestamps = false;
	protected $table = 'horaire';
	
	
	/**
	 * Renvoie un tableau de résultat avec les horaires
	 * 	results =	[
	 * 					i 		= ['libelle semaine', 'horaires aller', 'horaires retour'],
	 * 					i++ 	= ['libelle semaine', 'horaires aller', 'horaires retour']
	 * 				];
	*/
	public static function getHorairesByLigneArret($ligne, $arret, $date)
	{
		$idArret = Arret::findIdByName($arret);
		$idSemaine = TypeSemaine::getIdType($date);
		$results = [];
		$i = 0;
		$trouve = false;
		
		// Si on a trouvé des types de semaine pouvant correspondre
		if($idSemaine)
		{
			foreach($idSemaine as $semaine)
			{
				$results[$i]['libelle'] = TypeSemaine::find($semaine)->libelleTypeSemaine;
				$results[$i]['aller'] = DB::table('horaire')
												->where('idLigne', '=', $ligne)
												->where('idTypeSemaine', '=', $semaine)
												->whereIn('idArret', $idArret)
												->where('sens', '=', '1')
												->orderBy('course', 'asc')
												->lists('heure', 'course');
				$results[$i]['retour'] = DB::table('horaire')
												->where('idLigne', '=', $ligne)
												->where('idTypeSemaine', '=', $semaine)
												->whereIn('idArret', $idArret)
												->where('sens', '=', '2')
												->orderBy('course', 'asc')
												->lists('heure', 'course');
				
				// Si la requête précédente a retourné des heures, on sort de la boucle
				if( (count($results[$i]['aller']) > 0) || (count($results[$i]['retour']) > 0))
				{
					$temp = $results[$i];
					$results = [];
					$results[0] = $temp;
					$trouve = true;
					break;
				}
				
				$i++;
			}
			
			// Si pas d'heures trouvées, on retourne false
			if(!$trouve)
			{
				$results = false;
			}
	
		}
		
		// Si aucun type de semaine ne correspond
		else{
			$results = false;
		}
		
		return $results;
		
	}
	
	public static function getNextArret($heure, $service)
	{
		$query = Horaire::where('service', '=', $service)
			->where('heure', '>', $heure)
			->orderBy('heure')
			->take(1)
			->lists('idArret', 'sens');
			
			
		foreach($query as $Rsens => $RidArret)
		{
			$sens = $Rsens;
			$idArret = $RidArret;
		}
		
		if(isset($idArret)){
			$ligne = $service[0];
			$nomArret = trim(ucfirst(strtolower(Arret::findNameById($idArret))));
			$nomSens = Ligne::findLibelleSens($service[0], $sens);
		}
		else
			return false;
			
		return [$nomSens, $nomArret];
			
	}
	
	public static function getHorairesByLigne($ligne, $date, $heure, $minute, $idTypeSemaine = null)
	{
		if(is_null($idTypeSemaine))
		{
			if(!TypeSemaine::getIdType($date)) return false;
			$idTypeSemaine = TypeSemaine::getIdType($date);
		}
		else
		{
			$idTypeSemaine = [0 => $idTypeSemaine];
		}
		
		if($heure == null || $minute == null) $heureMin = '00:00'; else $heureMin = $heure . ':' . $minute;
		
		$results = [];
		$trouve = false;
		$idSemaine = 	DB::table('horaire')
							->remember(120)
							->where('idLigne', '=', $ligne)
							->whereIn('idTypeSemaine', $idTypeSemaine)
							->groupBy('idTypeSemaine')
							->lists('idTypeSemaine');
							

		foreach($idSemaine as $semaine)
		{
			
			$arretsAller = DB::table('horaire')
							->remember(120)
							->where('idLigne', '=', $ligne)
							->where('idTypeSemaine', '=', $semaine)
							->where('sens', '=', '1')
							->orderBy('ordre1')
							->groupBy('ordre1')
							->lists('idArret');
							
			$arretsRetour = DB::table('horaire')
								->remember(120)
							->where('idLigne', '=', $ligne)
							->where('idTypeSemaine', '=', $semaine)
							->where('sens', '=', '2')
							->orderBy('ordre1')
							->groupBy('ordre1')
							->lists('idArret');
			
			$premiereCourse = 50;
			$derniereCourse = 0;

			foreach($arretsAller as $arret)
			{
				$horairesArret =  DB::table('horaire')
									->remember(120)
									->where('idLigne', '=', $ligne)
									->where('idTypeSemaine', '=', $semaine)
									->where('idArret', $arret)
									->where('sens', '=', '1')
									->where('heure', '>', $heureMin)
									->orderBy('course', 'asc')
									->lists('heure', 'course');
				
				if($heureMin != '00:00:00')
				{
					foreach($horairesArret as $course => $horaire)
					{
						if($horaire != '00:00:00' && $course < $premiereCourse)
							$premiereCourse = $course;

						if($horaire != '00:00:00' && $course > $derniereCourse)
							$derniereCourse = $course;							
						
					}
				}
				
				$nomArret = trim(Arret::findNameById($arret));
				$results[$semaine]['aller'][$nomArret] = $horairesArret;
				
			}
			

			if($heureMin != '00:00:00')
			{
				foreach($results[$semaine]['aller'] as $nomArret => $horaire)
				{

					for($i = $premiereCourse; $i < $derniereCourse+1; $i++)
					{
						if(!isset($horaire[$i]))
							$results[$semaine]['aller'][$nomArret][$i] = '00:00:00';
					}
					
					foreach($horaire as $course => $horaireArret)
					{

						if($course < $premiereCourse)
						{
							unset($results[$semaine]['aller'][$nomArret][$course]);
						}
					}
					
					ksort($results[$semaine]['aller'][$nomArret]);
					
				}

			}

			$premiereCourse = 50;
			$derniereCourse = 0;
			
			foreach($arretsRetour as $arret)
			{
				$horairesArret =  DB::table('horaire')
									->remember(120)
									->where('idLigne', '=', $ligne)
									->where('idTypeSemaine', '=', $semaine)
									->where('idArret', $arret)
									->where('sens', '=', '2')
									->where('heure', '>', $heureMin)
									->orderBy('course', 'asc')
									->lists('heure');
									
				if($heureMin != '00:00:00')
				{
					foreach($horairesArret as $course => $horaire)
					{
						if($horaire != '00:00:00' && $course < $premiereCourse)
							$premiereCourse = $course;

						if($horaire != '00:00:00' && $course > $derniereCourse)
							$derniereCourse = $course;							
						
					}
				}
				$nomArret = trim(Arret::findNameById($arret));
				$results[$semaine]['retour'][$nomArret] = $horairesArret;
				
			}
			
			if($heureMin != '00:00:00')
			{
				foreach($results[$semaine]['retour'] as $nomArret => $horaire)
				{
					for($i = $premiereCourse; $i < $derniereCourse+1; $i++)
					{
						if(!isset($horaire[$i]))
							$results[$semaine]['retour'][$nomArret][$i] = '00:00:00';
					}
					
					foreach($horaire as $course => $horaireArret)
					{

						if($course < $premiereCourse)
						{
							unset($results[$semaine]['retour'][$nomArret][$course]);
						}
					}
					
					ksort($results[$semaine]['retour'][$nomArret]);
					
				}

			}

		}

			return $results;
						
	}
	
	public static function findLignesByArret($nomArret)
	{
		
		$idArret = Arret::findIdByName($nomArret);
		$lignes = DB::table('horaire')
					->remember(240)
					->whereIn('idArret', $idArret)
					->groupBy('idLigne')
					->orderBy('idLigne')
					->lists('idLigne');
					
		return $lignes;
	}
	
	public static function changeHoraire($idArret, $course, $idTypeSemaine, $idLigne, $sens)
	{
		$horaire = DB::table('horaire')
						->where('idArret', $idArret)
						->where('course', $course)
						->where('idTypeSemaine', $idTypeSemaine)
						->where('idLigne', $idLigne)
						->where('sens', $sens);
		return $horaire;
	}

}
