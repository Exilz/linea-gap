@extends('private.layout')

@section('content')

<h1>Gestion des lignes</h1>
<h2><a href="lignes/generateLines">Gérer les tracés de la carte interactive</a></h2>

    <ul class="admin-list-items">
        @foreach($lignes as $ligne)
            <li><a href="lignes/{{$ligne->idLigne}}">{{$ligne->libelleLigne}}</a></li>
        @endforeach
    </ul>

@stop