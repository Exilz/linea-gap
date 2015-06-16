@extends('private.layout')

@section('content')

<h1>Edition de "{{$actu->titreActualite}}"</h1>

    {{Form::model($actu, array('class' => 'form'))}}
    
        <a href="delete/{{$actu->idActualite}}" class="button button-delete right delete">Supprimer</a>
        {{Form::button('Modifier', array('class' => 'button button-submit right', 'type' => 'submit'))}}
        
        {{Form::label('titreActualite', "Titre de l'actualité")}}
        {{Form::text('titreActualite')}}
        
        {{Form::label('resumeActualite', "Résumé de l'actualité")}}
        {{Form::textarea('resumeActualite', null, array('id' => 'resume', 'class' => 'input-count'))}}<span id="resumeLength" class="right"></span>
        
        {{Form::label('resumeActualite', "URL de l'actualité")}}
        {{Form::text('slug')}}
        
        {{Form::label('contenuActualite', "Contenu de l'actualité")}}
        {{Form::textarea('contenuActualite', null, array('id' => 'contenuActualite'))}}

        
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
    CKEDITOR.replace('contenuActualite');
</script>

@stop
