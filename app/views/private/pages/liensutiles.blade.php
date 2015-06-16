@extends('private.layout')

@section('content')

<h1>Gestion des liens utiles</h1>
<p><a href="liensutiles/new" class="button-new button right">Ajouter</a></p>


<ul class="admin-list-items">
    @foreach($liens as $lien)
        <li>
            <a href="liensutiles/{{$lien->idLien}}">{{$lien->libelleLien}}</a>
            <a href="liensutiles/delete/{{$lien->idLien}}" class="delete" title="Supprimer {{$lien->libelleLien}}"><i class="fa fa-close button-delete-small"></i></a>
        </li>
    @endforeach
    
</ul>

@stop