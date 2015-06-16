@extends('private.layout')

@section('content')

<h1>Nouveau lien utile</h1>

    {{Form::open(array('class' => 'form', 'files' => true))}}

        {{Form::button('Envoyer', array('class' => 'button button-submit right', 'type' => 'submit'))}}

        {{Form::label('libelleLien', "Nom du lien *")}}
        {{Form::text('libelleLien')}}
        
        {{Form::label('urlLien', "Adresse du lien *")}}
        {{Form::text('urlLien')}}
        
        {{Form::label('logoLien', "Logo du lien *")}}
        {{Form::file('logoLien')}}
        
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
