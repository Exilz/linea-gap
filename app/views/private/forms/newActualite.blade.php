@extends('private.layout')

@section('content')

<h1>Nouvelle actualité</h1>

    {{Form::open(array('class' => 'form'))}}

        {{Form::button('Valider', array('class' => 'button button-submit right', 'type' => 'submit'))}}
    
        {{Form::label('titreActualite', "Titre de l'actualité")}}
        {{Form::text('titreActualite')}}
        
        {{Form::label('titreActualite', "Résumé de l'actualité")}}
        {{Form::text('resumeActualite', null, array('id' => 'resume', 'class' => 'input-count'))}}<span id="resumeLength" class="right"></span>
        
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
