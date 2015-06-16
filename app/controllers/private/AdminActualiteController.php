<?php

class AdminActualiteController extends \BaseController{
    
    /**
     * Liste des actualités pour accéder à l'édition
    */
    public function actualites()
    {
        $actus = Actualites::all();
        return View::make('private.pages.actualites')->with('actus', $actus);
    }
    
    /**
     * Page de création d'une nouvelle actualité
    */    
    public function newActualite()
    {
        return View::make('private.forms.newActualite');
    }
    
    
    /**
     * Page d'édition d'une actualité déjà créé
    */
    public function editActualite($id)
    {
        $actu = Actualites::find($id);
        return View::make('private.forms.updateActualite')->with('actu', $actu);
    }
    
    /**
     * Action de suppression d'une actualité
    */
    public function deleteActualite($id)
    {
        $actu = Actualites::find($id);
        Actualites::destroy($id);
        
        Session::flash('flash_msg', "L'actualité " . $actu->titreActualite . " a bien été supprimée.");
        Session::flash('flash_type', "warning");
        
        return Redirect::to('/admin/actualites');
        
    }
    
    /**
     *  Action de stockage d'une nouvelle actualité 
    */
    public function storeActualite()
    {
        $actu = new Actualites;
        
        $input = [
                    "titreActualite"    => Input::get('titreActualite'),
                    "contenuActualite"  => Input::get('contenuActualite'),
                    "dateActualite"     => Input::get('dateActualite'),
                    "resumeActualite"   => Input::get('resumeActualite'),
                    "slug"              => Str::slug(Input::get('titreActualite'))
                 ];
                 
        $rules = array(
            'titreActualite'        => 'required',
            'contenuActualite'      => 'required',
            'resumeActualite'       => 'required|max:255',
            'slug'                  => 'unique:actualite,slug'
        );
        
        $messages = array(
              'required'        => ':attribute est requis pour la modification',
              'max'             => "Le résumé de l'actualité est trop long, 255 caractères max.",
              'unique'          => "L'URL générée à partir du titre se doit d'être unique."
        );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
    
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "L'actualité a bien été créée.");
            Session::flash('flash_type', "success");
            $actu->fill($input)->save();
            return Redirect::to("/admin/actualites");
        }
    }
    
    /**
     * Action de mise à jour d'une actualité
    */
    public function updateActualite($id)
    {
        $actu = Actualites::find($id);
        
        $input = [
                    "titreActualite"    => Input::get('titreActualite'),
                    "contenuActualite"  => Input::get('contenuActualite'),
                    "dateActualite"     => Input::get('dateActualite'),
                    "resumeActualite"   => Input::get('resumeActualite'),
                    "slug"              => Input::get('slug')
                 ];
                 
        $rules = array(
            'titreActualite'        => 'required',
            'contenuActualite'      => 'required',
            'resumeActualite'       => 'required|max:255'
        );
        
        $messages = array(
              'required'        => ':attribute est requis pour la modification',
              'max'             => "Le résumé de l'actualité est trop long, 255 caractères max."
        );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
    
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "L'actualité " . $actu->titreActualite . " a bien été modifiée.");
            Session::flash('flash_type', "success");
            $actu->fill($input)->save();
            return Redirect::to(URL::previous());
        }
        
    }
    
}