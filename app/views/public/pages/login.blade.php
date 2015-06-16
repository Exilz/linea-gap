@extends('public.layout')

@section('content')

<div id="login-block">
    <p>Login côté front-office</p>
    
        {{Form::open()}}
            
            {{Form::label("Nom d'utilisateur")}}
            {{Form::text('username')}}
            
            {{Form::label('Mot de passe')}}
            {{Form::password('password')}}
            
            <div class="g-recaptcha" data-sitekey="6LcCwgATAAAAAKDF94q1bFJiROaMClquVYeRIuez"></div>
            
            {{Form::submit('Connexion')}}
            
        <a href="admin/motdepasse">Mot de passe oublié ?</a>
        
        {{Form::close()}}
    
        
    

</div>

@stop