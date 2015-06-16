<?php

class AdminLieuController extends \BaseController{
    
    public function lieux()
    {
        $lieux = DB::table('lieu')
                 ->join('categorielieu', 'lieu.idCatLieu', '=', 'categorielieu.idCatLieu')
                 ->orderBy('categorielieu.idCatLieu', 'asc')
                 ->get();
        
        $cat = DB::table('categorielieu')
                 ->orderBy('categorielieu.idCatLieu', 'asc')
                 ->get();
                 
        return View::make('private.pages.lieux')->with('lieux', $lieux)->with('cat', $cat);
    }
    
    public function newLieux()
    {
        $cat = CategorieLieu::lists('nomCatLieu', 'idCatLieu');
        return View::make('private.forms.newLieux')->with('cat', $cat);
    }
    
    public function storeLieux()
    {
        
        $lieu = new Lieu;
        
        $input = [
                    "nomLieu"                   => Input::get('nomLieu'),
                    "idCatLieu"                 => Input::get('idCatLieu'),
                    "latLieu"                   => Input::get('latLieu'),
                    "longLieu"                  => Input::get('longLieu'),
                 ];

        $rules = array(
                    'nomLieu'               => 'required|unique:lieu,nomLieu',
                    'idCatLieu'             => 'required',
                    'latLieu'               => 'required|regex:/^[0-9]+.([0-9]+)$/',
                    'longLieu'              => 'required|regex:/^[0-9]+.([0-9]+)$/'
        );
        
        $messages = array(
                            'required'          => ":attribute est requis pour l'ajout d'un nouveau lieu.",
                            'unique'            => ':attribute est déjà utilisé.',
                            'regex'             => ':attribute ne correspond pas à une coordonnée.'
                         );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
    
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "Le nouveau lieu a bien été ajouté.");
            Session::flash('flash_type', "success");
            $lieu->fill($input)->save();
            return Redirect::to("/admin/lieux");
        }
        
    }
    
    public function deleteLieux($id)
    {
        $lieu = Lieu::find($id);
        Lieu::destroy($id);
        
        Session::flash('flash_msg', "Le lieu " . $lieu->nomLieu . " a bien été supprimé.");
        Session::flash('flash_type', "warning");
        
        return Redirect::to('/admin/lieux');
    }
    
    public function editLieux($id)
    {
        $cat = CategorieLieu::lists('nomCatLieu', 'idCatLieu');
        $lieu = Lieu::find($id);
        return View::make('private.forms.updateLieux')->with('lieu', $lieu)->with('cat', $cat);
    }
    
    public function updateLieux($id)
    {
        
        $lieu = Lieu::find($id);
        
        $input = [
                    "nomLieu"           => Input::get('nomLieu'),
                    "idCatLieu"         => Input::get('idCatLieu'),
                    "latLieu"           => Input::get('latLieu'),
                    "longLieu"          => Input::get('longLieu')
                   
                 ];
                 
        $messages = array(
                            'required'      => ":attribute est requis pour l'ajout d'un nouveau lieu.",
                            'unique'        => ':attribute est déjà utilisé',
                            'regex'             => ':attribute ne correspond pas à une coordonnée.'
                         );
        
        
        $rules = array(
                'idCatLieu'             => 'required',
                'latLieu'               => 'required|regex:/^[0-9]+.([0-9]+)$/',
                'longLieu'              => 'required|regex:/^[0-9]+.([0-9]+)$/'
            );
            
        // Si le nom a été changé
        if(Input::get('nomLieu') != $lieu->nomLieu)
        {
            $rules['nomLieu'] = 'required|unique:lieu,nomLieu';
        }
            
        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "Le informations sur le lieu ont bien été changées.");
            Session::flash('flash_type', "success");
            $lieu->fill($input)->save();
            return Redirect::to("/admin/lieux");
        }
    }
    
    public function newCat()
    {
        return View::make('private.forms.newCat');
    }
    
    public function storeCat()
    {
        
        $cat = new CategorieLieu;
        
        $input = [
                    "nomCatLieu"    => Input::get('nomCatLieu')
                 ];

        $rules = array(
                    'nomCatLieu'            => 'required|unique:categorielieu,nomCatLieu'
        );
        
        $messages = array(
                            'required'          => ":attribute est requis pour l'ajout d'une nouvelle catégorie.",
                            'unique'            => ':attribute est déjà utilisé.'
                         );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
    
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "La nouvelle catégorie a bien été ajoutée.");
            Session::flash('flash_type', "success");
            $cat->fill($input)->save();
            return Redirect::to("/admin/lieux");
        }
        
    }
    
    public function editCat($id)
    {
        $cat = CategorieLieu::find($id);
        return View::make('private.forms.updateCat')->with('cat', $cat);
    }
    
    public function updateCat($id)
    {
        
        $cat = CategorieLieu::find($id);
        
        $input = [
                    "nomCatLieu"        => Input::get('nomCatLieu')
                 ];
                 
        $messages = array(
                            'required'      => ":attribute est requis pour l'ajout d'une nouvelle catégorie.",
                            'unique'        => ':attribute est déjà utilisé',
                         );
                         
        $rules = array();
        
        // Si le nom a été changé
        if(Input::get('nomCatLieu') != $cat->nomCatLieu)
        {
            $rules['nomCatLieu'] = 'required|unique:categorielieu,nomCatLieu';
        }
            
        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "Les informations sur la catégorie ont bien été changées.");
            Session::flash('flash_type', "success");
            $cat->fill($input)->save();
            return Redirect::to("/admin/lieux");
        }
    }
    
}