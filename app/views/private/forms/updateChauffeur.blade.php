@extends('private.layout')

@section('content')

<h1>Edition de "{{$chauffeur->loginChauffeur}}"</h1>


    {{Form::model($chauffeur, array('class' => 'form'))}}
    
        <a href="delete/{{$chauffeur->idChauffeur}}" class="button button-delete delete right">Supprimer ce chauffeur</a>
        {{Form::button('Modifier', array('class' => 'button button-submit right', 'type' => 'submit'))}}
    
        <h2 class="title">Informations personnelles</h2>
        
        {{Form::label('nomChauffeur', "Nom du chauffeur *")}}
        {{Form::text('nomChauffeur')}}
        
        {{Form::label('nomChauffeur', "Prénom du chauffeur *")}}
        {{Form::text('prenomChauffeur')}}
        
        {{Form::label('loginChauffeur', "Identifiant de connexion *")}}
        {{Form::text('loginChauffeur')}}

        <h2 class="title">Modification du mot de passe</h2>

        {{Form::label('password1', "Nouveau mot de passe")}}
        {{Form::password('password1')}}
        
        {{Form::label('password2', "Confirmez le nouveau mot de passe")}}
        {{Form::password('password2')}}

        
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
