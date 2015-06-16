@extends('private.layout')

@section('content')

<h1>Edition de "{{$cat->nomCatLieu}}"</h1>

    {{Form::model($cat, array('class' => 'form'))}}
    
        {{Form::button('Modifier', array('class' => 'button button-submit right', 'type' => 'submit'))}}
        
        {{Form::label('nomCatLieu', "Nom de la catégorie")}}
        {{Form::text('nomCatLieu')}}

        
        @if ($errors->has())
            <div class="errors">
                <p>Liste des erreurs de validation :</p>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br/>        
                @endforeach
            </div>
        @endif
    
    {{Form::close()}}


@stop