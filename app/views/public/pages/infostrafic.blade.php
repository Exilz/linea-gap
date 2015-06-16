@extends('public.includes.contentType')

@section('contentType')

<h1>
    Informations trafic
</h1>

<div>
    <ul class="front-list-items">
        @foreach($infos as $info)
            <li>
                <a href="infostrafic/{{$info->slug}}" class="list-title">{{$info->titreAlerte}}</a>
                <span class="right">Publié le {{ date("d/m/Y",strtotime($info->dateAlerte))}}</span>
            </li>
            <li class="list-desc">{{$info->resumeAlerte}}</li>
        @endforeach
    </ul>
</div>

@stop