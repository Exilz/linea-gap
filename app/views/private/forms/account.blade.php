@extends('private.layout')

@section('content')

<h2>Bienvenue, {{Auth::user()->loginClient}}</h2>
<h3>Modifier les paramètres de votre compte</h3>

    {{Form::model($user, array('class' => 'form'))}}
    
        {{Form::label('Adresse principale')}}
        {{Form::text('adresseClient')}}
        <br/>
        {{Form::label('Adresse secondaire')}}
        {{Form::text('adresseClient2')}}   
        <br/>
        <hr/>
        
        <h3>Changement d'adresse mail</h3>
        
        {{Form::label('Adresse email')}}
        {{Form::text('emailClient')}}
        <br/>
        {{Form::label('Confirmez la nouvelle adresse')}}
        {{Form::text('emailClient2')}}
        <br/>
        
        @if ($errors->has())
            <div class="errors">
                <p>Liste des erreurs de validation :</p>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br/>        
                @endforeach
            </div>
        @endif
        <br/>
        {{Form::button('Modifier', array('class' => 'button button-submit button-center', 'type' => 'submit'))}}

    
    {{Form::close()}}

@stop