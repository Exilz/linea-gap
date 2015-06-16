<?php

class MotPasseController extends \BaseController{
    
    public function page(){
        return View::make('public.pages.motdepasse');
    }
    
    public function motdepasse()
    {
        $email = Input::get('email');
        $utilisateur = Client::where('emailClient', '=', $email)->get();
        if($utilisateur == "[]")
        {
            Session::flash('flash_msg', "Cette adresse email n'est pas correcte.");
            Session::flash('flash_type', "fail");
            return Redirect::to(URL::previous());
        }
        
        else{
            $token = uniqid(rand(), true);
            $token = md5($token);
            DB::table('client')->where('emailClient', $email)->update(array('token' => $token));
            
            // Envoi du mail:
            $message = "Bonjour, vous avez demandé la réinitialisation de votre mot de passe.\r\nPour cela, cliquez sur le lien suivant et suivez les instructions :\r\nhttp://bus-gap-exilz.c9.io/back-office/public/admin/motdepasseinit/$token";
            mail($email, 'Changement de mot de passe !', $message);
            
            Session::flash('flash_msg', "Un mail vous a été envoyé à l'adresse mail que vous avez renseignée.");
            Session::flash('flash_type', "success");
            return Redirect::to(URL::previous());
        }
    }
    
    public function initmotdepasse($token)
    {
        $verif = Client::where('token', '=', $token)->get();
        if($verif == "[]"){
            Session::flash('flash_msg', "Ce lien est invalide.");
            Session::flash('flash_type', "fail");
            return View::make('public.pages.motdepasse');
        }
        else{
            return View::make('public.pages.motdepasseinit');
        }
    }
    
    public function updatemotdepasse($token){
        
        $client = Client::where('token', '=', $token)->firstOrFail();
        
        $input = [
                    "password1"             => Input::get('password1'),
                    "password2"             => Input::get('password2'),
                    "mdpClient"             => Hash::make(Input::get('password1'))
                 ];

        $messages = array(
                            'required'      => ":attribute est requis pour changer votre mot de passe.",
                            'same'          => 'Les mots de passe ne correspondent pas',
                            'min'           => "Le mot de passe entré est trop court (5 car. mini)"
                         );
        
        
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
            
            $client->mdpClient = $input['mdpClient'];
            $client->token = '';
            $client->save();
            
            return Redirect::to("/login");
        }
    
    }
}