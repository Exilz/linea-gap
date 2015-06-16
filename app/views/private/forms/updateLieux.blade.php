@extends('private.layout')

@section('content')

<h1>Edition de "{{$lieu->nomLieu}}"</h1>

    {{Form::model($lieu, array('class' => 'form'))}}
    
        <a href="delete/{{$lieu->idLieu}}" class="button button-delete right delete">Supprimer</a>
        {{Form::button('Modifier', array('class' => 'button button-submit right', 'type' => 'submit'))}}
        
        {{Form::label('nomLieu', "Nom du lieu")}}
        {{Form::text('nomLieu')}}
        
        {{Form::label('map', "Position du lieu : déplacez le marqueur pour la positionner")}}
        <div id="map" style="height: 350px; width:100%;"></div>
        
        {{Form::label('adresse', "Adresse du lieu (facultatif)")}}
        {{Form::text('adresse', null, array('name' => 'adresse'))}}
        
        {{Form::label('latLieu', "Latitude du lieu")}}
        {{Form::text('latLieu', null, array('id' => 'latLieu'))}}
        
        {{Form::label('longLieu', "Longitude du lieu")}}
        {{Form::text('longLieu', null, array('id' => 'longLieu'))}}

        
        <!--{{Form::label('latLieu', "Latitude du lieu")}}-->
        <!--{{Form::text('latLieu')}}-->
        
        <!--{{Form::label('longLieu', "Longitude du lieu")}}-->
        <!--{{Form::text('longLieu')}}-->
        
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
