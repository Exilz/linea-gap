@extends('private.layout')

@section('content')

<h1>Répondre à une question</h1>

@if($question->lue == '0')
<a href="lue/{{$question->idQuestion}}" class="button button-submit right">Marquer comme traitée</a>
@endif

<a href="../faq/new" class="button button-classic right">Ajouter à la FAQ</a>
<a href="delete/{{$question->idQuestion}}" class="button button-delete delete right">Supprimer</a>

<div class="answer-block">
    <h3 class="question-text">{{$question->sujetQuestion}}</h3>
    <p class="center">Question posée par  : <a href="mailto:{{$question->mail}}">{{$question->mail}}</a></p>
    
    {{Form::label('contenuQuestion', "Description de la question")}}
    <div class="question-description">
        {{$question->contenuQuestion}}
    </div>
</div>
    
<script>
    CKEDITOR.replace('xxx');
</script>

@stop
