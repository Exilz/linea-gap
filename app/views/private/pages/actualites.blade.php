@extends('private.layout')

@section('content')

<h1>Edition des actualités</h1>
<a href="actualites/new" class="button button-new right">Nouvelle actualité</a>


<ul class="admin-list-items">
    @foreach($actus as $actu)
        <li><a href="actualites/{{$actu->idActualite}}">{{$actu->titreActualite}}</a></li>
    @endforeach
</ul>

@stop