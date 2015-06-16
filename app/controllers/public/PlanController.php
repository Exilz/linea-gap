<?php

class PlanController extends \BaseController{
    
    public function plan()
    {
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        $lignes = Ligne::all();

        return View::make('public.pages.plan')
            ->with('lastActu', $lastActu)
            ->with('lastInfo', $lastInfo)
            ->with('lignes', $lignes);
    }
    
    public function getLignes()
    {
        // Mise en prod : remettre le cache d'une heure ou plus 
        //return Response::json(DB::table('ligne')->remember(60)->get());
        return Response::json(DB::table('ligne')->get());
    }
    
    public function getArrets()
    {
        // Mise en prod : remettre le cache d'une heure ou plus 
        return Response::json(DB::table('arret')->get());
        //return Response::json(DB::table('arret')->remember(60)->get());
    }
    
    public function getBus()
    {
        $buses = DB::table('positionbus')->where('visible', '=', '1')->get();
        $res = [];
        foreach($buses as $bus)
        {
            $res[$bus->service] = [
                                    "latitude"      => $bus->latitude,
                                    "longitude"     => $bus->longitude
                                  ];
        }
        
        return Response::json($res);
    }
    
    /**
     * Infos pop-up clic marqueur bus
    */
    public function getInfos()
    {
        $infoBus = Service::find(Input::get('service'));
        $ligne = $infoBus->ligne;
        $service = $infoBus->service;
        $heure = date('H:i:s');
        $arretSuivant = Horaire::getNextArret($heure, $service);
        return Response::json($arretSuivant);
    }
    
    /**
     * Récupère le nom de tous les arrêts formatés correctement (autocomplete)
    */ 
    public function getNomArrets()
    {
        $arrets =DB::table('arret')->groupBy('nomArret')->lists('nomArret');
        $res = array();
        foreach($arrets as $arret)
        {
            $nom = ucfirst(strtolower(trim($arret)));
            array_push($res, $nom);

        }
        return Response::json($res);
    }
    
}