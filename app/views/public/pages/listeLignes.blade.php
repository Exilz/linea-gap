@extends('public.includes.contentHoraires')

@section('contentHoraires')

<h1>Votre sélection</h1>

<div class="recapitulatif">
    <p>Arret :<span class="strong">{{$arret}}</span></p>
    <p>Liste des lignes où se situe cet arrêt</p>
    <p>Cliquez sur une ligne pour afficher ses horaires</p>
</div>


@if($lignes)
    <ul class="liste-lignes">
        @foreach($lignes as $ligne)
           <li><a href="findLA/{{$ligne}}/{{$arret}}/{{$date}}/{{$heureMin}}">{{Ligne::findNameById($ligne)[0]}}</a></li>
        @endforeach
    </ul>
    
    
@else
    <p>Pas de lignes trouvées pour l'arrêt spécifié.</p>
@endif

@stop