@extends('private.layout')

@section('content')

<h1>Modification d'une question</h1>


    {{Form::model($question, array('class' => 'form'))}}
    
        <a href="delete/{{$question->idFAQ}}" class="button button-delete delete right">Supprimer</a>
        {{Form::button('Valider', array('class' => 'button button-submit right', 'type' => 'submit'))}}
        
        
        {{Form::label('question', "Libellé de la question")}}
        {{Form::text('question')}}
        
        {{Form::label('response', "Réponse complète")}}
        {{Form::textarea('reponse', null, array('id' => 'reponse'))}}
        
        
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
    CKEDITOR.replace('reponse');
</script>

@stop
