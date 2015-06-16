@extends('private.layout')

@section('content')

<h1>Edition de "{{$page->titrePage}}"</h1>

    {{Form::model($page, array('class' => 'form'))}}
    
        <a href="delete/{{$page->idPage}}" class="button button-delete right delete">Supprimer</a>
        {{Form::button('Modifier', array('class' => 'button button-submit right', 'type' => 'submit'))}}
        
        {{Form::label('titrePage', "Titre de la page")}}
        {{Form::text('titrePage')}}
        
        @if ($page->submenu == 0)
            {{Form::text('titreLien', 'mentions-legales', array('class' => 'hidden'))}}
            {{Form::select('submenu', array('0' => 'Aucun'), $page->submenu, array('class' => 'hidden'))}}
        
        @else
        
            {{Form::label('titreLien', "Titre dans le menu")}}
            {{Form::text('titreLien')}}
        
            {{Form::label('submenu', "Rataché au menu")}}
            {{Form::select('submenu', array('1' => 'Se déplacer', '2' => 'Infos pratiques'), $page->submenu)}}
        
        @endif
        
        {{Form::label('contenu', "Contenu de la page")}}
        {{Form::textarea('contenu', null, array('id' => 'contenu'))}}

        
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
    CKEDITOR.replace('contenu', {
        customConfig: 'config_pages.js'
    });
</script>

@stop
