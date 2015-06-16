@extends('private.layout')

@section('content')

<h1>Gestion des arrêts</h1>

<p><a href="arret/new" class="button button-new right">Ajouter un arret</a></a></p>


<ul class="admin-list-items">
    @foreach($arrets as $arret)
        <li>
            <a href="arret/{{$arret->idArret}}">{{$arret->nomArret}}</a>
            <a href="arret/delete/{{$arret->idArret}}" class="delete" title="Supprimer {{$arret->nomArret}}"><i class="fa fa-close button-delete-small"></i></a>
        </li>
    @endforeach
    
</ul>

@stop