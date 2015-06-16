@extends('public.includes.contentType')

@section('contentType')

<h1>{{$info->titreAlerte}}</h1>

<span class="right">Publié le {{ date("d/m/Y",strtotime($info->dateAlerte))}}</span>

<div class="desc">
    {{$info->contenuAlerte}}
</div>

@stop