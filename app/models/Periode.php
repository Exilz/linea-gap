<?php

class Periode extends Eloquent{

	public $primaryKey = 'idPeriode';
	public $timestamps = false;
	protected $table = 'periode';
	
	/**
	 * Retourne true si la période en param est pdt les vacs sinon false
	*/
	public static function isHoliday($date)
	{
	    $isHoliday = false;
	    $periodes = Periode::all();
	    $stampDateInput = strtotime($date);
	    
	    // Parcoure toutes les périodes
	    foreach($periodes as $periode)
	    {
	        $stampDateDebut = strtotime($periode->dateDebut);
	        $stampDateFin = strtotime($periode->dateFin);
	       
	        // Si la date entrée est comprise entre le début et la fin de la période parcourue
	        if( ($stampDateInput > $stampDateDebut) && ($stampDateInput < $stampDateFin))
	        {
	            $isHoliday = true;
	        }
	    }
	    return $isHoliday;
	}
	
	/**
	 * Retourne le jour de la semaine en fonction de la date en parametre
	 * 0 (pour Dimanche) à 6 (pour Samedi)
	*/
	public static function getDay($date)
	{
	    $stampDateInput = strtotime($date);
	    return getdate($stampDateInput)['wday'];
	}

}
