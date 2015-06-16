@extends('public.layout')

@section('content')
<div class="content-type content-horaires">
<h1>Rechercher un trajet</h1>
    <div id="page-search">
        
            <div class="block-search">
                {{Form::open()}}
                {{Form::label('depart', 'Arrêt de depart')}}
                {{Form::text('depart', '', array('id' => 'depart', 'placeholder' => 'Nom de l\'arrêt'))}}
            </div>
            <div class="block-search">
                {{Form::label('arrive', 'Arrêt d\'arrivé')}}
                {{Form::text('arrive', '', array('id' => 'arrive', 'placeholder' => 'Nom de l\'arrêt'))}}
            </div>
            {{Form::submit('Rechercher mon itiniraire', array('class' => 'button-search'))}}
        {{Form::close()}}
    </div>
</div>
@stop