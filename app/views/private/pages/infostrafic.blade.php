@extends('private.layout')

@section('content')

<h1>Edition des infos trafic</h1>
<p><a href="infostrafic/new" class="button button-new right">Nouvelle info trafic</a></p>

<ul class="admin-list-items">
    @foreach($infostrafic as $info)
        <li><a href="infostrafic/{{$info->idAlerte}}">{{$info->titreAlerte}}</a></li>
    @endforeach
</ul>

@stop