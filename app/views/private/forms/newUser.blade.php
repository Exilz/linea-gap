@extends('private.layout')

@section('content')

<h1>Ajouter un administrateur</h1>

    {{Form::open(array('class' => 'form'))}}
    
        {{Form::button('Envoyer', array('class' => 'button button-submit right', 'type' => 'submit'))}}
        
        {{Form::label("Nom d'utilisateur *")}}
        {{Form::text('username', '', array('placeholder' => 'Identifiant', 'required' => 'required'))}}
        <br/>
        {{Form::label("Nom")}}
        {{Form::text('nom', '', array('placeholder' => 'Nom'))}}
        <br/>
        {{Form::label("Prénom")}}
        {{Form::text('prenom', '', array('placeholder' => 'Prénom'))}}
        <br/>
        {{Form::label("Adresse e-mail *")}}
        {{Form::text('email', '', array('placeholder' => 'Adresse e-mail', 'required' => 'required'))}}
        <br/>
        {{Form::label('Mot de passe *')}}
        {{Form::password('password1', array('placeholder' => 'Mot de passe', 'required' => 'required'))}}
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
    
    {{Form::close()}}

@stop