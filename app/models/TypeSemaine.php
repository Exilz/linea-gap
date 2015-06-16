<?php

class TypeSemaine extends Eloquent{

	public $primaryKey = 'idTypeSemaine';
	public $timestamps = false;
	protected $table = 'typesemaine';
	
	/**
	 * Retourne le(s) ID(s) du type de la semaine correspondant à la date en parametre dans un tableau
	*/
    public static function getIdType($date)
    {
        $isHoliday = Periode::isHoliday($date);
        $day = Periode::getDay($date);
        $types = TypeSemaine::all();
        $results = [];
        
        // Si le jour n'est pas dimanche
        if($day != "0")
        {
            $day--;
            // On diminue de 1 pour correspondre à la position de la valeur dans nature
        }
        // Si c'est dimanche
        else
        {
            $day = "6";
            // La position dans nature est de 6
        }
        
        
        // Parcourir tous les types de semaine
        foreach($types as $type)
        {
            
            // Initialisation des variables à chaque itération
            $isDayOk = false;
            $isPeriodOk = false;
            $found = false;
            
            // Vérification du "1" à la place du jour de la date (-1 puisque provenant de getdate())
            if($type->nature[$day] == "1")
            {
                $isDayOk = true;
            }
            
            // Vérification de V / S / T en fonction de la période (vacances ou non)
            if($isHoliday)
            {
                if( ($type->nature[7] == "V") || ($type->nature[7] == "T"))
                {
                    $isPeriodOk = true;
                }
            }
            else{
                if( ($type->nature[7] == "S") || ($type->nature[7] == "T"))
                {
                    $isPeriodOk = true;
                }
            }
            
            // Si une période correspond
            if($isDayOk && $isPeriodOk)
            {
                // Trouvé à vrai et on remplit le tableau de résultas
                $found = true;
                array_push($results, $type->idTypeSemaine);
            }
            
        }

        if($found)
        {
            return $results;
        }
        else{
            // Retourne faux si aucune période ne correspond
            return false;
        }

    }
    
    public static function getLibelleTypeSemaine($ligne)
    {
        return Self::find($ligne)->libelleTypeSemaine;
    }

}
