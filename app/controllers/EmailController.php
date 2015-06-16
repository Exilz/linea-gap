<?php

class EmailController extends \BaseController {
    
    public function contactSend()
    {
        
        $data = [
                    "nom"       => Input::get('nom'),
                    "prenom"    => Input::get('prenom'),
                    "email"     => Input::get('email'),
                    "message"   => Input::get('message'),
                    "sujet"     => Input::get('sujet')
                ];
        
        $rules = array(
            'email'       => 'required',
            'message'     => 'required',
            'sujet'       => 'required'
        );
        
        $messages = array(
              'required'        => ':attribute est requis pour nous contacter',
              'max'             => "Le résumé de l'info trafic est trop long, 255 caractères max.",
              'email'           => "L'adresse email fournie n'est pas valide."
        );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            $captcha_string = Input::get('g-recaptcha-response');
            $captcha_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LcCwgATAAAAAKaXhPJOGPTBwX-n2-PPLZ7iupKj&response=' . $captcha_string);
            $captcha_json = json_decode($captcha_response);
            
            if($captcha_json->success)
            {
                Mail::send('emails.contact', $data, function($message)
                {
                    $message->from('lol@lol.fr', 'sujet du message');
                
                    $message->to('m.bertonnier@gmail.com', 'Linéa Gap')->subject('Sujet du message !');
    
                });
                
                Session::flash('flash_msg', "Message bien envoyé.");
        		Session::flash('flash_type', "success");
        		
                return Redirect::to(URL::previous());
            }
            else
            {
                Session::flash('flash_msg', "Champ de validation incorrect.");
        		Session::flash('flash_type', "fail");
        		
                return Redirect::to(URL::previous());    
            }
            
        }
        
    }
    
}