<?php

class LienController extends \BaseController{
    
    public function liensutiles()
    {
        $liens = Lien::all();
        
        // POUR PAGE TYPE 
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        
        return View::make('public.pages.liensutiles')->with('liens', $liens)
                                                     ->with('lastActu', $lastActu)
                                                     ->with('lastInfo', $lastInfo);;
    }
    
}