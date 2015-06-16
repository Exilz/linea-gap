@extends('public.includes.contentType')

@section('contentType')

<h1>{{$actu->titreActualite}}</h1>

<span class="right">Publié le {{ date("d/m/Y",strtotime($actu->dateActualite))}}</span>

<div class="desc">
    {{$actu->contenuActualite}}
</div>

@stop