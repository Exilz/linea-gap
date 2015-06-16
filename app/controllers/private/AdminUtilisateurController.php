<?php

class AdminUtilisateurController extends \BaseController{
    
    public function utilisateurs()
    {
        $utilisateurs = Client::where('admin', '=', '0')->get();
        return View::make('private.pages.utilisateurs')->with('utilisateurs', $utilisateurs);
    }
    
    public function deleteUtilisateur($id)
    {
        $utilisateur = Client::find($id);
        Client::destroy($id);
        
        Session::flash('flash_msg', "L'utilisateur " . $utilisateur->prenomClient . " " . $utilisateur->nomClient . " a bien été supprimé.");
        Session::flash('flash_type', "warning");
        
        return Redirect::to('/admin/utilisateurs');
    }
    
}