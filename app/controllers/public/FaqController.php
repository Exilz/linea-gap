<?php

class FaqController extends \BaseController{
    
    public function faq()
    {
        $faq = Faq::all();
        
        // POUR PAGE TYPE 
        $lastActu = Actualites::orderBy('dateActualite', 'desc')->take(1)->get();
        $lastInfo = Alerte::orderBy('dateAlerte', 'desc')->take(1)->get();
        //--------------------
        
       
        return View::make('public.pages.faq')
                    ->with('faq', $faq)
                    ->with('lastActu', $lastActu)
                    ->with('lastInfo', $lastInfo);
    }
    
    public function faqSend()
    {
        $question = new Question;
        $input = Input::all();
        
        $captcha_string = Input::get('g-recaptcha-response');
        $captcha_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LcCwgATAAAAAKaXhPJOGPTBwX-n2-PPLZ7iupKj&response=' . $captcha_string);
        $captcha_json = json_decode($captcha_response);
        
        if($captcha_json->success)
        {
            
            $rules =    [
                           "sujetQuestion"      => "required",
                           "mail"               => "required|email",
                           "contenuQuestion"    => "required"
                         ];
                     
            $messages = [
                            "required"          => ":attribute est requis pour l'envoi d'une question",
                            "email"             => "L'adresse email précisée n'est pas valide"
                        ];
                        
            $validator = Validator::make(Input::all(), $rules, $messages);
        
            if($validator->fails())
            {
                $messages = $validator->messages();
                Session::flash('flash_msg', "Certains champs spécifiés sont incorrects.");
            	Session::flash('flash_type', "fail");
                return Redirect::to(URL::previous())->withErrors($validator);
            }
            else
            {
                $question->fill($input)->save();
                Session::flash('flash_msg', "Votre question nous est bien parvenue. Nous vous répondrons sous peu.");
            	Session::flash('flash_type', "success");
                return Redirect::to(URL::previous());
            }
        }
        else
        {
                Session::flash('flash_msg', "Champ de vérification incorrect ou non coché.");
            	Session::flash('flash_type', "fail");
                return Redirect::to(URL::previous());
        }
        
    }
    
}