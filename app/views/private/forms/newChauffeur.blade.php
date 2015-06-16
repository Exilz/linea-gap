@extends('private.layout')

@section('content')

<h1>Nouveau chauffeur</h1>

    {{Form::open(array('class' => 'form'))}}
    
        {{Form::button('Envoyer', array('class' => 'button button-submit right', 'type' => 'submit'))}}
    
        {{Form::label('nomChauffeur', "Nom du chauffeur")}}
        {{Form::text('nomChauffeur')}}
        
        {{Form::label('prenomChauffeur', "Prénom du chauffeur")}}
        {{Form::text('prenomChauffeur')}} 
        
        {{Form::label('loginChauffeur', "Identifiant de connexion")}}
        {{Form::text('loginChauffeur')}} 
        
        {{Form::label('password1', "Mot de passe *")}}
        {{Form::password('password1')}} 
        
        {{Form::label('password2', "Mot de passe (confirmez)*")}}
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
    
<script>
    CKEDITOR.replace('contenuAlerte');
</script>

@stop