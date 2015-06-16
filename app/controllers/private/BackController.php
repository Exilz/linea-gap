<?php

class BackController extends \BaseController {
    
    public function index()
    {
        return View::make('private.pages.index');
    }
    
    public function account()
    {
        $user = Client::find(Auth::user()->idClient);
        return View::make('private.forms.account')->with('user', $user);
    }
    
}