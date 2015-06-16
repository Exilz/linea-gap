@extends('private.layout')

@section('content')

<h1>Liste des administrateurs</h1>
<p><a href="users/new" class="button button-new right">Ajouter un administrateur</a></p>

<ul class="admin-list-items">
    @foreach($users as $user)
        <li>
            {{$user->loginClient}}<a href="users/delete/{{$user->idClient}}" class="delete" title="Supprimer {{$user->loginClient}}"><i class="fa fa-close button-delete-small"></i></a>
        </li>
    @endforeach
</ul>

@stop