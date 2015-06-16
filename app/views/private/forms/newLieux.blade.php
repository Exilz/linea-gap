@extends('private.layout')

@section('content')

<h1>Nouveau lieu</h1>

    {{Form::open(array('class' => 'form'))}}

        {{Form::button('Valider', array('class' => 'button button-submit right', 'type' => 'submit'))}}
    
        {{Form::label('nomLieu', "Nom du lieu")}}
        {{Form::text('nomLieu')}}
        
        {{Form::label('latLieu', "Latitude du lieu")}}
        {{Form::text('latLieu')}}
        
        {{Form::label('longLieu', "Longitude du lieu")}}
        {{Form::text('longLieu')}}
        
        {{Form::label('idCatLieu', "Catégorie du lieu")}}
        {{Form::select('idCatLieu', $cat, Input::get('idCatLieu'))}}

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
