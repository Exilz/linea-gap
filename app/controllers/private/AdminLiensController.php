<?php

class AdminLiensController extends \BaseController{
    
    public function liens()
    {
        $liens = Lien::all();
        return View::make('private.pages.liensutiles')->with('liens', $liens);
    }
    
    public function newLien()
    {
        return View::make('private.forms.newLien');
    }
    
    public function storeLien()
    {
        $file = Input::file('logoLien');
        $ext = strtolower(Input::file('logoLien')->getClientOriginalExtension());
        $taille = $file->getSize();
        
        if($taille != false){
            $nameFile = Str::slug(Input::get('libelleLien'), '-');
    
            $lien = new Lien;
            
            $input = [
                        "libelleLien"           => Input::get('libelleLien'),
                        "urlLien"               => Input::get('urlLien'),
                        "logoLien"              => $nameFile.'.'.$ext,
                     ];
    
            $rules = array(
                'libelleLien'               => 'required|unique:lien,libelleLien',
                'urlLien'                   => 'required',
                'logoLien'                  => 'required|mimes:jpeg,jpg,png'
            );
            
            $messages = array(
                                'required' => ":attribute est requis pour l'ajout d'un nouveau lien.",
                                'unique'   => ':attribute est déjà utilisé',
                                'mimes'    => ':attribute ne correspond pas au extensions valides (jpg, jpeg, png)',
                             );
            
            $validator = Validator::make(Input::all(), $rules, $messages);

            if($validator->fails())
            {
                $messages = $validator->messages();
                return Redirect::to(URL::previous())->withErrors($validator);
            }
            else
            {
                $file->move('../public/img/upload', $nameFile.'.'.$ext);
                Session::flash('flash_msg', "Le nouveau lien a bien été ajouté.");
                Session::flash('flash_type', "success");
                
                $lien->fill($input)->save();
                return Redirect::to("/admin/liensutiles");
            }
        }
        else
        {
            Session::flash('flash_msg', "Le fichier est trop volumineux.");
            Session::flash('flash_type', "fail");
            return Redirect::to(URL::previous());
        }
        
    }
    
    public function deleteLien($id)
    {
        $lien = Lien::find($id);
        Lien::destroy($id);

        unlink('../public/img/upload/'.$lien->logoLien);
        
        Session::flash('flash_msg', "Le lien " . $lien->libelleLien . " a bien été supprimé.");
        Session::flash('flash_type', "warning");
        
        return Redirect::to('/admin/liensutiles');
    }
    
    public function editLien($id)
    {
        $lien = Lien::find($id);
        return View::make('private.forms.updateLien')->with('lien', $lien);
    }
    
    public function updateLien($id)
    {
       
        $file = Input::file('logoLien');
        
        
        if(empty($file))
        {
            $lien = Lien::find($id);
            
            $input = [
                        "libelleLien"          => Input::get('libelleLien'),
                        "urlLien"              => Input::get('urlLien'),
                     ];
                     
            $messages = array(
                    'required' => ":attribute est requis pour l'ajout d'un nouveau lien.",
                    'unique'   => ':attribute est déjà utilisé',
                );
            
            
            $rules = array(
                    'urlLien'                   => 'required',
                );
                
            // Si le nom du lien a été changé
            if(Input::get('libelleLien') != $lien->libelleLien)
            {
                $rules['libelleLien'] = 'required|unique:lien,libelleLien';
            }
                
            $validator = Validator::make(Input::all(), $rules, $messages);
            
            if($validator->fails())
            {
                $messages = $validator->messages();
                return Redirect::to(URL::previous())->withErrors($validator);
            }
            else
            {
                Session::flash('flash_msg', "Les modifications ont bien été changées.");
                Session::flash('flash_type', "success");
                $lien->fill($input)->save();
                return Redirect::to("/admin/liensutiles");
            }
        }
        else
        {
            $taille = $file->getSize();
       
            if($taille < 5242880 || $taille != false){
                $ext = Input::file('logoLien')->getClientOriginalExtension();
                $lien = Lien::find($id);
                
                unlink('../public/img/upload/'.$lien->logoLien);
                
                $nameFile = Str::slug(Input::get('libelleLien'), '-');
                
                $file->move('../public/img/upload', $nameFile.'.'.$ext);
                
                $input = [
                            "libelleLien"          => Input::get('libelleLien'),
                            "urlLien"              => Input::get('urlLien'),
                            "logoLien"             => $nameFile.'.'.$ext,
                         ];
                         
                $messages = array(
                        'required' => ":attribute est requis pour l'ajout d'un nouveau lien.",
                        'unique'   => ':attribute est déjà utilisé',
                    );
                
                
                $rules = array(
                        'urlLien'                   => 'required',
                        'logoLien'                  => 'required'
                    );
                    
                // Si le nom du lien a été changé
                if(Input::get('libelleLien') != $lien->libelleLien)
                {
                    $rules['libelleLien'] = 'required|unique:lien,libelleLien';
                }
                    
                $validator = Validator::make(Input::all(), $rules, $messages);
                
                if($validator->fails())
                {
                    $messages = $validator->messages();
                    return Redirect::to(URL::previous())->withErrors($validator);
                }
                else
                {
                    Session::flash('flash_msg', "Les modifications ont bien été changées.");
                    Session::flash('flash_type', "success");
                    $lien->fill($input)->save();
                    return Redirect::to("/admin/liensutiles");
                }
            }
            else
            {
                Session::flash('flash_msg', "Le fichier est trop volumineux.");
                Session::flash('flash_type', "fail");
                return Redirect::to("/admin/liensutiles");
            }
      }
    }
}