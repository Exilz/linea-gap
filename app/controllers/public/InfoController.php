<?php

class InfoController extends \BaseController{
    
    public function infostrafic()
    {
        $infos = Alerte::all();
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        
        return View::make('public.pages.infostrafic')
            ->with('infos', $infos)
            ->with('lastActu', $lastActu)
            ->with('lastInfo', $lastInfo);
    }
    
    public function showInfo($slug)
    {
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        $info = Alerte::where('slug', '=', $slug)->firstOrFail();
        
        return View::make('public.pages.info')
            ->with('info', $info)
            ->with('lastActu', $lastActu)
            ->with('lastInfo', $lastInfo);
    }
    
    public function renderJson()
    {
        $alertes = Alerte::whereNotNull('latitude')->whereNotNull('latitude')->get();
        return Response::json($alertes);
    }
    
    
}