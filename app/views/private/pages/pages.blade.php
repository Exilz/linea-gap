@extends('private.layout')

@section('content')

<h1>Gestion des pages statiques</h1>
<p><a href="pages/new" class="button-new button right">Ajouter</a></a></p>

    <ul class="admin-list-items">
        @foreach($pages as $page)
            <li><a href="pages/{{$page->idPage}}">{{$page->titreLien}}</a><a href="pages/delete/{{$page->idPage}}" class="delete" title="Supprimer {{$page->titreLien}}"><i class="fa fa-close button-delete-small"></i></a></li>
        @endforeach
    </ul>

@stop