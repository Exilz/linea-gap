@extends('private.layout')

@section('content')

<h1>Ajouter une question à la FAQ</h1>

    {{Form::open(array('class' => 'form'))}}
    
        {{Form::button('Ajouter', array('class' => 'button button-submit right', 'type' => 'submit'))}}
    
        {{Form::label('question', "Libellé de la question")}}
        {{Form::text('question')}}
        
        
        {{Form::label('reponse', "Réponse complète")}}
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
