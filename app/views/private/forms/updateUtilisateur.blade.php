@extends('private.layout')

@section('content')

<h1>Edition de "{{$utilisateur->prenomClient}} {{$utilisateur->nomClient}}"</h1>


    {{Form::model($utilisateur, array('class' => 'form'))}}
    
        <a href="delete/{{$utilisateur->idClient}}" class="button button-delete delete right">Supprimer cet utilisateur</a>
        {{Form::button('Modifier', array('class' => 'button button-submit right', 'type' => 'submit'))}}
    
        <h2 class="title">Informations personnelles</h2>
        
        {{Form::label('nomClient', "Nom de l'utilisateur ")}}
        {{Form::text('nomClient')}}
        
        {{Form::label('prenomClient', "Prénom de l'utilisateur ")}}
        {{Form::text('prenomClient')}}
        
        {{Form::label('loginClient', "Identifiant de connexion *")}}
        {{Form::text('loginClient')}}
        
        
<!--
        <h2 class="title">Modification du mot de passe</h2>

        {{Form::label('password1', "Nouveau mot de passe")}}
        {{Form::password('password1')}}
        
        {{Form::label('password2', "Confirmez le nouveau mot de passe")}}
        {{Form::password('password2')}}
-->
        
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
