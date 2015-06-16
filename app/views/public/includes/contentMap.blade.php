@extends('public.layout')

@section('content')
<div class="content-type">
    <div class="block-content">
        @yield('contentMap')
    </div>
    <div class="block-right">
        <ul class="arrets-list">
            <li class="resetLignes">Afficher toutes les lignes</li>
            @foreach($lignes as $ligne)
                <li class="changeLigne" data-idLigne="{{$ligne->idLigne}}"><span class="ligne-carre" style="background:{{$ligne->couleurLigne}}">{{$ligne->numero}}</span>{{$ligne->libelleLigne}}</li>
            @endforeach
            <li class="toggleArrets">Afficher/cacher les arrêts</li>
        </ul>
    </div>
    
    <div class="map-fullscreen-overlay hidden">
        <span class="ligne-overlay"><i class="fa fa-chevron-left"></i></span>
        <img src="/back-office/public/img/logo.png" alt="linéa" class="map-logo-overlay">
        <ul class="arrets-list">
            <li class="resetLignes">Afficher toutes les lignes</li>
            @foreach($lignes as $ligne)
                <li class="changeLigne" data-idLigne="{{$ligne->idLigne}}"><span class="ligne-carre" style="background:{{$ligne->couleurLigne}}">{{$ligne->numero}}</span>{{$ligne->libelleLigne}}</li>
            @endforeach
            <li class="toggleArrets">Afficher/cacher les arrêts</li>
        </ul>
    </div>
    
</div>
@stop