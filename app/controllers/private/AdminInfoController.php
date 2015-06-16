<?php

class AdminInfoController extends \BaseController{
    
    /**
     * Page de création d'une nouvelle info trafic
    */
    
    public function newInfotrafic()
    {
        return View::make('private.forms.newInfotrafic');
    }
    
    /**
     * Listes des infos trafic pour accéder à l'édition
    */
    public function infotrafic()
    {
        $infostrafic = Alerte::all();
        return View::make('private.pages.infostrafic')->with('infostrafic', $infostrafic);
    }
    
    /**
     * Page d'édition d'une info trafic
    */
    public function editInfoTrafic($id)
    {
        $infotrafic = Alerte::find($id);
        return View::make('private.forms.updateInfotrafic')->with('infotrafic', $infotrafic);
    }
    
    /**
     * Action de suppression d'une info trafic
    */
    public function deleteInfotrafic($id)
    {
        $info = Alerte::find($id);
        Alerte::destroy($id);
        
        Session::flash('flash_msg', "L'info trafic " . $info->titreAlert . " a bien été supprimée.");
        Session::flash('flash_type', "warning");
        
        return Redirect::to('/admin/infostrafic');
        
    }
   
    /**
     * Action de stockage d'une nouvelle info trafic
    */ 
    public function storeInfotrafic()
    {
        $info = new Alerte;
        
        $input = [
                    "titreAlerte"    => Input::get('titreAlerte'),
                    "contenuAlerte"  => Input::get('contenuAlerte'),
                    "dateAlerte"     => Input::get('dateAlerte'),
                    "resumeAlerte"   => Input::get('resumeAlerte'),
                    "latitude"       => Input::get('latitude'),
                    "longitude"      => Input::get('longitude'),
                    "slug"           => Str::slug(Input::get('titreAlerte'))
                 ];
                 
        $rules = array(
            'titreAlerte'        => 'required',
            'contenuAlerte'      => 'required',
            'resumeAlerte'       => 'required|max:255',
            'slug'               => 'unique:alerte,slug'
        );
        
        $messages = array(
              'required'        => ':attribute est requis pour la modification',
              'max'             => "Le résumé de l'info trafic est trop long, 255 caractères max.",
              'unique'          => "L'URL spécifiée se doit d'être unique."
        );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
    
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "L'info trafic a bien été créée.");
            Session::flash('flash_type', "success");
            $info->fill($input)->save();
            return Redirect::to("/admin/infostrafic");
        }
    }
    
    /**
     * Action de mise à jour d'une info trafic
    */
    public function updateInfotrafic($id)
    {
        $alerte = Alerte::find($id);
        
        $input = [
                    "titreAlerte"    => Input::get('titreAlerte'),
                    "contenuAlerte"  => Input::get('contenuAlerte'),
                    "dateAlerte"     => Input::get('dateAlerte'),
                    "resumeAlerte"   => Input::get('resumeAlerte'),
                    "latitude"       => Input::get('latitude'),
                    "longitude"      => Input::get('longitude'),
                    "slug"           => Str::slug(Input::get('titreAlerte'))
                 ];
                 
        $rules = array(
            'titreAlerte'        => 'required',
            'contenuAlerte'      => 'required',
            'resumeAlerte'       => 'required|max:255'
        );
        
        $messages = array(
              'required'        => ':attribute est requis pour la modification',
              'max'             => "Le résumé de l'alerte est trop long, 255 caractères max."
        );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
    
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "L'alerte " . $alerte->titreAlerte . " a bien été modifiée.");
            Session::flash('flash_type', "success");
            $alerte->fill($input)->save();
            return Redirect::to(URL::previous());
        }
    }
    
}