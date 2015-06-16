<?php

class LieuController extends \BaseController{
    
    public function lieux()
    {
        $lieux = DB::table('lieu')
                 ->join('categorielieu', 'lieu.idCatLieu', '=', 'categorielieu.idCatLieu')
                 ->orderBy('categorielieu.idCatLieu', 'asc')
                 ->get();
                 
        $cat = DB::table('categorielieu')
                 ->orderBy('categorielieu.idCatLieu', 'asc')
                 ->get();
                 
        // POUR PAGE TYPE 
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        //--------------------
                 
        return View::make('public.pages.lieu')->with('lieux', $lieux)
                                              ->with('cat', $cat)
                                              ->with('lastActu', $lastActu)
                                              ->with('lastInfo', $lastInfo);
    }
    
}
