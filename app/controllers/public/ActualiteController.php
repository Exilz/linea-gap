<?php

class ActualiteController extends \BaseController{
    
    public function showActu($slug)
    {
        $actu = Actualites::where('slug', '=', $slug)->firstOrFail();
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        return View::make('public.pages.actu')
            ->with('actu', $actu)
            ->with('lastActu', $lastActu)
            ->with('lastInfo', $lastInfo);
    }
    
}