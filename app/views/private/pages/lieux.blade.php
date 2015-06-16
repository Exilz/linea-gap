@extends('private.layout')

@section('content')

<h1>Gestion des lieux</h1>
<p>
    <a href="lieux/newcat" class="button button-new right">Ajouter une catégorie</a></a>
    <a href="lieux/new" class="button button-new right">Ajouter un lieu</a></a>
</p>
<br/>


    @foreach($cat as $item)
        <h2 class="list-place"><a href="cat/{{$item->idCatLieu}}">{{$item->nomCatLieu}}</a></h2>
        <ul class="admin-list-items">
        @foreach($lieux as $lieu)
            @if($item->idCatLieu == $lieu->idCatLieu)
                <li>
                    <a href="lieux/{{$lieu->idLieu}}">{{$lieu->nomLieu}}</a>
                    <a href="lieux/delete/{{$lieu->idLieu}}" class="delete" title="Supprimer {{$lieu->nomLieu}}"><i class="fa fa-close button-delete-small"></i></a>
                </li>
            
            @endif
        @endforeach
        </ul>
    @endforeach


@stop