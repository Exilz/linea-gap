@extends('private.layout')

@section('content')

<h1>Gestion des questions</h1>

<div class="block-nonRead center">
    <span class="question-icon"><i class="fa fa-envelope"></i></span>
    <h2>Questions en attente</h2>
    <p class="question-count">{{$countNonLues}}</p> 

    <ul class="admin-list-items question-list">
        @foreach($questionsNonLues as $question)
            <li><a href="questions/{{$question->idQuestion}}">{{str_limit($question->sujetQuestion, 50)}}</a></li>
        @endforeach
    </ul>
</div>

<div class="block-read center">
    <span class="question-icon"><i class="fa fa-check-square-o"></i></span>
    <h2>Questions traitées</h2>
    <p class="question-count">{{$countLues}}</p>

    <ul class="admin-list-items question-list">
        @foreach($questionsLues as $question)
            <li><a href="questions/{{$question->idQuestion}}">{{str_limit($question->sujetQuestion, 50)}}</a></li>
        @endforeach
    </ul>
</div>

@stop