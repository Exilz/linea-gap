@extends('private.layout')

@section('content')

<h1>Choisir la ligne et la période à modifier </h1>

    {{Form::open(array('class' => 'form'))}}
    
        <select name="submenu">
            @foreach($lignes as $ligne)
                <option value="{{$ligne->numero}}">{{$ligne->libelleLigne}}</option>
            @endforeach
        </select>

        {{Form::button('Modifier', array('class' => 'button button-submit button-center', 'type' => 'submit'))}}
    
    {{Form::close()}}

@stop