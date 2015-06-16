@extends('private.layout')

@section('content')

<h1>Nouvel arrêt</h1>

    {{Form::open(array('class' => 'form'))}}
    
        {{Form::button('Valider', array('class' => 'button button-submit right', 'type' => 'submit'))}}
    
        {{Form::label('nomArret', "Nom de l'arrêt")}}
        {{Form::text('nomArret')}}
        
        <label>Accessibilité :</label>
        {{Form::label('accesArret', "Oui")}}
        {{Form::radio('accesArret', '1' )}}
        {{Form::label('accesArret', "Non")}}
        {{Form::radio('accesArret', '0' )}}
        
        {{Form::label('map', "Position de l'arrêt : déplacez le marqueur pour le positionner")}}
        <div id="map" style="height: 350px; width:100%;"></div>
        
        {{Form::label('adresse', "Adresse de l'info trafic (facultatif)")}}
        {{Form::text('adresse', null, array('name' => 'adresse'))}}
        
        {{Form::label('adresse', "Latitude du marqueur sur la carte")}}
        {{Form::text('latArret', null, array('id' => 'latitude'))}}
        
        {{Form::label('adresse', "Longitude du marqueur sur la carte")}}
        {{Form::text('longArret', null, array('id' => 'longitude'))}}

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
