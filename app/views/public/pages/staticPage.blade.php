@extends('public.includes.contentType')

@section('contentType')

<h1>{{$page->titrePage}}</h1>
{{$page->contenu}}

@stop