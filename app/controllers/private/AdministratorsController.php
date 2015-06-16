<?php

class AdministratorsController extends \BaseController{
    
    public function users()
    {
        $users = Client::where('admin', '=', '1')->get();
        return View::make('private.pages.users')->with('users', $users);
    }
    
    public function newUser()
    {
        return View::make('private.forms.newUser');
    }
    
    public function storeUser()
    {
        
        $rules = array(
          'username'        => 'required|unique:client,loginClient',
          'email'           => 'required|email|unique:client,emailClient',
          'password1'       => 'required',
          'password2'       => 'required|same:password1'
        );
        
        $messages = array(
          'required'        => ':attribute est requis pour l\'inscription',
          'same'            => 'Les mots de passe entrés ne correspondent pas',
          'unique'          => ':attribute est déjà utilisé',
          'email'           => ':attribute n\'est pas valide'
        );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to('/admin/users/new')->withErrors($validator);
        }
        else
        {
            $client = new Client;
            $input = [
                        "nomClient"         => Input::get('nom'),
                        "prenomClient"      => Input::get('prenom'),
                        "loginClient"       => Input::get('username'),
                        "emailClient"       => Input::get('email'),
                        "mdpClient"         => Hash::make(Input::get('password1')),
                        "adresseClient"     => Input::get('adresse1'),
                        "adresseClient2"    => Input::get('adresse2'),
                        "admin"             => '1'
                     ];
    
            $client->fill($input)->save();
            $setAdmin = Client::find($client->idClient);
            $setAdmin->admin = '1';
            $setAdmin->save();
            
            
            Session::flash('flash_msg', "L'administrateur" . $input['loginClient'] . " a bien été créé.");
        	Session::flash('flash_type', "success");
        	
        	return Redirect::to('/admin/users');
        }
        
    }
    
    public function deleteUser($id)
    {
        $admin = Client::find($id);
        Client::destroy($id);
        
        Session::flash('flash_msg', "L'administrateur " . $admin->loginClient . " a bien été supprimé.");
        Session::flash('flash_type', "warning");
        
        return Redirect::to('/admin/users');
    }
    
}