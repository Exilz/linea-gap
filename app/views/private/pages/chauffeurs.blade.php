@extends('private.layout')

@section('content')

<h1>Gestion des chauffeurs</h1>
<p><a href="chauffeurs/new" class="button button-new right">Ajouter un chauffeur</a></a></p>


<ul class="admin-list-items">
    @foreach($chauffeurs as $chauffeur)
        <li>
            <a href="chauffeurs/{{$chauffeur->idChauffeur}}">{{$chauffeur->nomChauffeur . " " . $chauffeur->prenomChauffeur}}</a>
            <a href="chauffeurs/delete/{{$chauffeur->idChauffeur}}" class="delete" title="Supprimer {{$chauffeur->nomChauffeur . ' ' . $chauffeur->prenomChauffeur}}"><i class="fa fa-close button-delete-small"></i></a>
        </li>
    @endforeach
    
</ul>

@stop