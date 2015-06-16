<?php

class UserLoginController extends \BaseController {
    
    public function login()
    {
        return View::make('public.pages.login');
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
            if(Auth::attempt(['loginClient' => $username, 'password' => $password], true))
    		{
    		        // Gestion de la connexion administrateur via le front-office
    		        $is_admin = Client::where('loginClient', '=', $username)->firstOrFail()->admin;
    		        if($is_admin == '1')
    		        {
    		            Session::put('admin', '1');
    		        }
    		        else
    		        {
    		            Session::put('admin', '0');
    		        }
    		        
        			Session::flash('flash_msg', "Vous êtes maintenant connecté.");
        			Session::flash('flash_type', "success");
        			return Redirect::to('/account');
    		}
    		else
    		{
            	    Session::flash('flash_msg', "Identifiants incorrects, veuillez réessayer.");
            		Session::flash('flash_type', "fail");
        			return Redirect::to('/login');
    		}
        }
        else
        {
            Session::flash('flash_msg', "Champ de vérification incorrect ou non coché.");
            Session::flash('flash_type', "fail");
            return Redirect::to(URL::previous());
        }
    
    }
    
    public function signup()
    {
        if (Auth::check())
        {
            return Redirect::to('/');
        }
        
        return View::make('public.pages.signup');
    }
    
    public function storeUser()
    {
        
        $captcha_string = Input::get('g-recaptcha-response');
        $captcha_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LcCwgATAAAAAKaXhPJOGPTBwX-n2-PPLZ7iupKj&response=' . $captcha_string);
        $captcha_json = json_decode($captcha_response);
        
        if($captcha_json->success)
        {
            $rules = array(
              'username'        => 'required|unique:client,loginClient',
              'email'           => 'required|email|unique:client,emailClient',
              'password1'       => 'required|min:5',
              'password2'       => 'required|same:password1'
            );
            
            $messages = array(
              'required'        => ':attribute est requis pour l\'inscription',
              'same'            => 'Les mots de passe entrés ne correspondent pas',
              'unique'          => ':attribute est déjà utilisé',
              'email'           => ':attribute n\'est pas valide',
              'min'            => "Le mot de passe entré est trop court (5 car. mini)"
            );
            
            $validator = Validator::make(Input::all(), $rules, $messages);
            
            if($validator->fails())
            {
                $messages = $validator->messages();
                return Redirect::to('/signup')->withErrors($validator);
            }
            else
            {
                $client = new Client;
                $input = [
                            "nomClient" => Input::get('nom'),
                            "prenomClient" => Input::get('prenom'),
                            "loginClient" => Input::get('username'),
                            "emailClient" => Input::get('email'),
                            "mdpClient" => Hash::make(Input::get('password1')),
                            "adresseClient" => Input::get('adresse1'),
                            "adresseClient2" => Input::get('adresse2')
                         ];
        
                $client->fill($input)->save();
                
                Session::flash('flash_msg', "Vous vous êtes bien inscrit, vous pouvez maintenant vous connecter.");
            	Session::flash('flash_type', "success");
            	
            	return Redirect::to('/');
            }
        }
        else
        {
            Session::flash('flash_msg', "Champ de vérification incorrect ou non coché.");
            Session::flash('flash_type', "fail");
            return Redirect::to(URL::previous());   
        }
        
        
    }
    
    public function updateUser()
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