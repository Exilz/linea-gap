@extends('public.includes.contentType')

@section('contentType')

<h1>
    Actualités Linéa
</h1>

<div>
    <ul class="front-list-items">
        @foreach($actus as $actu)
            <li>
                <a href="actu/{{$actu->slug}}" class="list-title">{{$actu->titreActualite}}</a>
                <span class="right">Publié le {{ date("d/m/Y",strtotime($actu->dateActualite))}}</span>
            </li>
            <li class="list-desc">{{$actu->resumeActualite}}</li>
        @endforeach
    </ul>
</div>

@stop