@extends('private.layout')

@section('content')

<h1>Edition de "{{$infotrafic->titreAlerte}}"</h1>

    {{Form::model($infotrafic, array('class' => 'form'))}}
    
        <a href="delete/{{$infotrafic->idAlerte}}" class="button button-delete right delete">Supprimer</a>
        {{Form::button('Modifier', array('class' => 'button button-submit right', 'type' => 'submit'))}}
        
        {{Form::label('titreAlerte', "Titre de infos trafic")}}
        {{Form::text('titreAlerte')}}
        
        {{Form::label('resumeAlerte', "Résumé de infos trafic")}}
        {{Form::text('resumeAlerte', null, array('id' => 'resume', 'class' => 'input-count'))}}<span id="resumeLength" class="right"></span>
        
        {{Form::label('slug', "URL de infos trafic")}}
        {{Form::text('slug')}}
        
        {{Form::label('map', "Position de l'alerte : déplacez le marqueur pour la positionner")}}
        <div id="map" style="height: 350px; width:100%;"></div>
        
        {{Form::label('adresse', "Adresse de l'info trafic (facultatif)")}}
        {{Form::text('adresse', null, array('name' => 'adresse'))}}
        
        {{Form::label('adresse', "Latitude du marqueur sur la carte (facultatif)")}}
        {{Form::text('latitude', null, array('id' => 'latitude'))}}
        
        {{Form::label('adresse', "Longitude du marqueur sur la carte (facultatif)")}}
        {{Form::text('longitude', null, array('id' => 'longitude'))}}
        
        {{Form::label('contenuAlerte', "Contenu de infos trafic")}}
        {{Form::textarea('contenuAlerte', null, array('id' => 'contenuAlerte'))}}

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
