<?php

class FrontController extends \BaseController {
    
    public function index()
    {
        $lastActus = Actualites::orderBy('dateActualite', 'desc')->take(2)->get();
        $lastInfos = Alerte::orderBy('dateAlerte', 'desc')->take(2)->get();
        $slides = Slider::orderBy('pos')->get();
        
        return View::make('public.pages.index')
            ->with('lastActus', $lastActus)
            ->with('lastInfos', $lastInfos)
            ->with('slides', $slides)
            ->with('title', "Bus Linéa - Ville de Gap - Se déplacer à Gap");
    }

    public function infos()
    {
        // POUR PAGE TYPE 
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        //--------------------
        
        return View::make('public.pages.infos')
            ->with('lastActu', $lastActu)
            ->with('lastInfo', $lastInfo);
    }

    public function account()
    {
        if(Auth::check())
        {
            $user = Client::find(Auth::user()->idClient);
            return View::make('public.pages.account')->with('user', $user);
        }
        else
        {
            return Redirect::to('/');
        }
    }
    
    public function actualites()
    { 
        $actus = Actualites::all();
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        
        return View::make('public.pages.actualites')
            ->with('actus', $actus)
            ->with('lastActu', $lastActu)
            ->with('lastInfo', $lastInfo);
    }
    
    public function getPage($slug)
    {
        $page = Page::where('slug', '=', $slug)->firstOrfail();
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        
        return View::make('public.pages.staticPage')
                        ->with('page', $page)
                        ->with('lastActu', $lastActu)
                        ->with('lastInfo', $lastInfo);
    }
    
    public function deplacer(){ return View::make('public.pages.deplacer'); }
    
    public function errorPage()
    {
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        
        return View::make('public.pages.error')
                        ->with('lastActu', $lastActu)
                        ->with('lastInfo', $lastInfo);
    }
    
    public function contact()
    {
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        
        return View::make('public.pages.contact')
            ->with('lastActu', $lastActu)
            ->with('lastInfo', $lastInfo);;
    }
    
    public function mentions(){ return View::make('public.pages.mentions'); }
    
    public function plan(){ return View::make('public.pages.plan'); }
    
    public function recherchehoraire(){ return View::make('public.pages.rechercheHoraire'); } 
    
    public function recherchetrajet(){ return View::make('public.pages.rechercheTrajet'); } 
    
    public function credits(){ return View::make('public.pages.credits'); } 
    
    
    public function accessibilite()
    { 
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        
        return View::make('public.pages.accessibilite')
            ->with('lastActu', $lastActu)
            ->with('lastInfo', $lastInfo);
    }
    
    public function parkings()
    { 
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        
        return View::make('public.pages.parkings')
            ->with('lastActu', $lastActu)
            ->with('lastInfo', $lastInfo);
    }
    
    public function navettes()
    { 
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        
        return View::make('public.pages.navettes')
            ->with('lastActu', $lastActu)
            ->with('lastInfo', $lastInfo);
    }
    
    public function scolaires()
    { 
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        
        return View::make('public.pages.scolaires')
            ->with('lastActu', $lastActu)
            ->with('lastInfo', $lastInfo);
    }
    
    public function tad()
    { 
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        
        return View::make('public.pages.tad')
            ->with('lastActu', $lastActu)
            ->with('lastInfo', $lastInfo);
    }
    
}