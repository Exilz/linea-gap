@extends('public.layout')

@section('content')
<div id="signup-block">
<h1>Formulaire d'inscription utilisateur</h1>

    {{Form::open(array('class' => 'form'))}}
        
        {{Form::label("Nom d'utilisateur *")}}
        {{Form::text('username', '', array('placeholder' => 'Votre identifiant', 'required' => 'required'))}}
        <br/>
        {{Form::label("Votre nom")}}
        {{Form::text('nom', '', array('placeholder' => 'Votre nom'))}}
        <br/>
        {{Form::label("Votre prénom")}}
        {{Form::text('prenom', '', array('placeholder' => 'Votre prénom'))}}
        <br/>
        {{Form::label("Adresse e-mail *")}}
        {{Form::text('email', '', array('placeholder' => 'Votre adresse e-mail', 'required' => 'required'))}}
        <br/>
        {{Form::label('Mot de passe *')}}
        {{Form::password('password1', array('placeholder' => 'Votre mot de passe', 'required' => 'required'))}}
        <br/>
        {{Form::label('Mot de passe (confirmez) *')}}
        {{Form::password('password2', array('placeholder' => 'Confirmez', 'required' => 'required'))}}
        <br/>
        {{Form::label('Adresse 1')}}
        {{Form::text('adresse1', '', array('placeholder' => 'Votre adresse'))}}
        <br/>
        {{Form::label('Adresse 2')}}
        {{Form::text('adresse2', '', array('placeholder' => 'Complément d\'adresse'))}}
        <br/>
        
        @if ($errors->has())
            <div class="errors">
                <p>Liste des erreurs de validation :</p>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br/>        
                @endforeach
            </div>
        @endif
        
        <div class="g-recaptcha" data-sitekey="6LcCwgATAAAAAKDF94q1bFJiROaMClquVYeRIuez"></div>
        {{Form::button('Inscription', array('class' => 'button button-classic button-center', 'type' => 'submit'))}}
        
        
    {{Form::close()}}
</div>
@stop