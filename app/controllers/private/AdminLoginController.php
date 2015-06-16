<?php

class AdminLoginController extends \BaseController {
    
    public function login()
    {
        if (Auth::check())
        {
            return Redirect::to('/admin');
        }
        else
        {
            return View::make('private.pages.login');
        }
    }
    
    public function authenticate()
    {
        
        $username = Input::get('username');
        $password = Input::get('password');
        
        $captcha_string = Input::get('g-recaptcha-response');
        $captcha_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LcCwgATAAAAAKaXhPJOGPTBwX-n2-PPLZ7iupKj&response=' . $captcha_string);
        $captcha_json = json_decode($captcha_response);
        
        if($captcha_json->success)
        {
            if(Auth::attempt(['loginClient' => $username, 'password' => $password, 'admin' => 1], true))
    		{
        			Session::flash('flash_msg', "Vous êtes maintenant connecté.");
        			Session::flash('flash_type', "success");
        			Session::put('admin', '1');
        			return Redirect::to('/admin');
    		}
    		else
    		{
            	    Session::flash('flash_msg', "Identifiants incorrects, veuillez réessayer.");
            		Session::flash('flash_type', "fail");
        			return Redirect::to('/admin/login');
    		}
        }
        else
        {
            Session::flash('flash_msg', "Champ de vérification incorrect ou non coché.");
            Session::flash('flash_type', "fail");
            return Redirect::to(URL::previous());
        }
        
    }
    
    public function updateAdmin()
    {
            $client = Client::find(Auth::user()->idClient);
            
            if(Input::get('emailClient') !== $client->emailClient)
            {
                $rules = array(
                    'emailClient'       => 'required|email|unique:client,emailClient',
                    'emailClient2'      => 'required|email|same:emailClient'
                );
                
                $messages = array(
                      'required'        => ':attribute est requis pour la modification',
                      'same'            => 'Les adresses email entrées ne correspondent pas',
                      'unique'          => 'Cette adresse email est déjà utilisée',
                      'email'           => 'Ce n\'est pas une adresse email valide'
                );
                
                $validator = Validator::make(Input::all(), $rules, $messages);
            
                if($validator->fails())
                {
                    $messages = $validator->messages();
                    return Redirect::to(URL::previous())->withErrors($validator);
                }
                else
                {
                    $input = [
                                "emailClient" => Input::get('emailClient')
                             ];
            
                    $client->fill($input)->save();
                    
                    Session::flash('flash_msg', "Votre compte a bien été mis à jour.");
                	Session::flash('flash_type', "success");
                }
            }
            
            $input = [
                        "adresseClient" => Input::get('adresseClient'),
                        "adresseClient2" => Input::get('adresseClient2')
                     ];
    
            $client->fill($input)->save();
            
            Session::flash('flash_msg', "Votre compte a bien été mis à jour.");
        	Session::flash('flash_type', "success");
        	
            return Redirect::to(URL::previous());
    }
    
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('/');
    }
    
}