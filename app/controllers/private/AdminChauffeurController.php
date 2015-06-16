<?php

class AdminChauffeurController extends \BaseController{
    
    public function chauffeurs()
    {
        $chauffeurs = Chauffeur::all();
        return View::make('private.pages.chauffeurs')->with('chauffeurs', $chauffeurs);
    }
    
    public function newChauffeur()
    {
        return View::make('private.forms.newChauffeur');
    }
    
    public function storeChauffeur()
    {
        
        $chauffeur = new Chauffeur;
        
        $input = [
                    "nomChauffeur"              => Input::get('nomChauffeur'),
                    "prenomChauffeur"           => Input::get('prenomChauffeur'),
                    "loginChauffeur"            => Input::get('loginChauffeur'),
                    "password1"                 => Input::get('password1'),
                    "password2"                 => Input::get('password2'),
                    "mdpChauffeur"              => sha1(Input::get('password1'))
                 ];

        $rules = array(
                    'nomChauffeur'              => 'required',
                    'prenomChauffeur'           => 'required',
                    'loginChauffeur'            => 'required|unique:chauffeur,loginChauffeur',
                    'password1'                 => 'required|same:password2|min:5',
                    'password2'                 => 'required'
        );
        
        $messages = array(
                            'required'          => ":attribute est requis pour l'ajout d'un nouveau chauffeur.",
                            'unique'            => ':attribute est déjà utilisé',
                            'same'              => 'Les mots de passe ne correspondent pas',
                            'min'               => "Le mot de passe entré est trop court (5 car. mini)"
                         );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
    
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "Le nouveau chauffeur a bien été ajouté.");
            Session::flash('flash_type', "success");
            $chauffeur->fill($input)->save();
            return Redirect::to("/admin/chauffeurs");
        }
        
    }
    
    public function deleteChauffeur($id)
    {
        $chauffeur = Chauffeur::find($id);
        Chauffeur::destroy($id);
        
        Session::flash('flash_msg', "Le chauffeur " . $chauffeur->loginChauffeur . " a bien été supprimé.");
        Session::flash('flash_type', "warning");
        
        return Redirect::to('/admin/chauffeurs');
    }
    
    public function editChauffeur($id)
    {
        $chauffeur = Chauffeur::find($id);
        return View::make('private.forms.updateChauffeur')->with('chauffeur', $chauffeur);
    }
    
    public function updateChauffeur($id)
    {
        
        $chauffeur = Chauffeur::find($id);
        
        $input = [
                    "nomChauffeur"          => Input::get('nomChauffeur'),
                    "prenomChauffeur"       => Input::get('prenomChauffeur'),
                    "loginChauffeur"        => Input::get('loginChauffeur'),
                    "password1"             => Input::get('password1'),
                    "password2"             => Input::get('password2'),
                    "mdpChauffeur"          => sha1(Input::get('mdpChauffeur'))
                 ];
                 
        $messages = array(
                            'required'      => ":attribute est requis pour l'ajout d'un nouveau chauffeur.",
                            'unique'        => ':attribute est déjà utilisé',
                            'same'          => 'Les mots de passe ne correspondent pas',
                            'min'           => "Le mot de passe entré est trop court (5 car. mini)"
                         );
        
        
        if(!empty(Input::get('password1')))
        {
            
            $rules = array(
                'password1'              => 'required|same:password2|min:5',
                'password2'              => 'required'
            );
            
            $validator = Validator::make(Input::all(), $rules, $messages);
        
            if($validator->fails())
            {
                $messages = $validator->messages();
                return Redirect::to(URL::previous())->withErrors($validator);
            }
            else
            {
                Session::flash('flash_msg', "Le mot de passe a bien été changé.");
                Session::flash('flash_type', "success");
                $chauffeur->fill($input)->save();
                return Redirect::to("/admin/chauffeurs");
            }
        
        }
        else
        {
            $rules = array(
                'nomChauffeur'                  => 'required',
                'prenomChauffeur'               => 'required'
            );
            
            // Si le login a été changé
            if(Input::get('loginChauffeur') != $chauffeur->loginChauffeur)
            {
                $rules['loginChauffeur'] = 'required|unique:chauffeur,loginChauffeur';
            }
            
            $validator = Validator::make(Input::all(), $rules, $messages);
        
            if($validator->fails())
            {
                $messages = $validator->messages();
                return Redirect::to(URL::previous())->withErrors($validator);
            }
            else
            {
                Session::flash('flash_msg', "Le informations personnelles ont bien été changées.");
                Session::flash('flash_type', "success");
                $chauffeur->fill($input)->save();
                return Redirect::to("/admin/chauffeurs");
            }
        }
    }
    
    
}