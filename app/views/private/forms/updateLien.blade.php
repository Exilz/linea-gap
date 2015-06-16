@extends('private.layout')

@section('content')

<h1>Edition de "{{$lien->libelleLien}}"</h1>


    {{Form::model($lien, array('class' => 'form', 'files' => true))}}
    
        <a href="delete/{{$lien->idLien}}" class="button-delete button delete right">Supprimer ce lien</a>
        {{Form::button('Modifier', array('class' => 'button button-submit right', 'type' => 'submit'))}}
        
        <h2 class="title">Informations concernant le lien</h2>
        
        {{Form::label('libelleLien', "Nom du lien *")}}
        {{Form::text('libelleLien')}}
        
        {{Form::label('urlLien', "Adresse du lien *")}}
        {{Form::text('urlLien')}} 
        
        {{Form::label('logoLien', "Logo du lien *")}}
        {{Form::file('logoLien')}}

        @if ($errors->has())
            <div class="errors">
                <p>Liste des erreurs de validation :</p>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br/>        
                @endforeach
            </div>
        @endif
    
    {{Form::close()}}
    
<script>
    CKEDITOR.replace('contenuActualite');
</script>

@stop
