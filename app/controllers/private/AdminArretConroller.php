<?php

class AdminArretController extends \BaseController {
 
    public function arret()
    {
        $arrets = DB::table('arret')->orderBy('nomArret', 'asc')->get();;
        return View::make('private.pages.arret')->with('arrets', $arrets);
    }
    
    public function newArret()
    {
        return View::make('private.forms.newArret');
    }
    
    public function storeArret()
    {
        
        $arret = new Arret;
        
        $input = [
                    "nomArret"                  => Input::get('nomArret'),
                    "latArret"                  => Input::get('latArret'),
                    "longArret"                 => Input::get('longArret'),
                    "accesArret"                => Input::get('accesArret')
                 ];

        $rules = array(
                    'nomArret'                  => 'required',
                    'latArret'                  => 'required',
                    'longArret'                 => 'required',
                    'accesArret'                => 'required'
        );
        
        $messages = array(
                            'required'          => ":attribute est requis pour l'ajout d'un nouvel arrêt."
                         );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
    
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "Le nouvel arret a bien été ajouté.");
            Session::flash('flash_type', "success");
            $arret->fill($input)->save();
            return Redirect::to("/admin/arret");
        }
        
    }
    
     public function deleteArret($id)
    {
        $arret = Arret::find($id);
        Arret::destroy($id);
        
        Session::flash('flash_msg', "L'arrêt " . $arret->nomArret . " a bien été supprimé.");
        Session::flash('flash_type', "warning");
        
        return Redirect::to('/admin/arret');
        
    }   
    
    public function editArret($id)
    {
        $arret = Arret::find($id);
        return View::make('private.forms.updateArret')->with('arret', $arret);
    }
    
    public function updateArret($id)
    {
        
        $arret = Arret::find($id);
        
        $input = [
                    "nomArret"              => Input::get('nomArret'),
                    "latArret"              => Input::get('latArret'),
                    "longArret"             => Input::get('longArret'),
                    "accesArret"            => Input::get('accesArret')
                 ];
                 
        $messages = array(
                            'required'      => ":attribute est requis pour l'ajout d'un nouveau chauffeur."
                         );
        
        $rules = array(
            'nomArret'          => 'required',
            'latArret'          => 'required',
            'longArret'         => 'required',
            'accesArret'        => 'required'
        );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "L'arrêt a bien été changé.");
            Session::flash('flash_type', "success");
            $arret->fill($input)->save();
            return Redirect::to("/admin/arret");
        }
    }
}