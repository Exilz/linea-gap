@extends('private.layout')

@section('content')

<h1>Gestion de la foire aux questions</h1>
<p><a href="faq/new" class="button button-new right">Ajouter une question</a></p>
<br/>

    <ul class="admin-list-items">
        @foreach($faq as $item)
            <li><a href="faq/{{$item->idFAQ}}">{{Str::limit($item->question, 50)}}</a></li>
        @endforeach
    </ul>

@stop