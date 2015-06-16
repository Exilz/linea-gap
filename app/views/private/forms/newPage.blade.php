@extends('private.layout')

@section('content')

<h1>Ajouter une page statique</h1>

    {{Form::open(array('class' => 'form'))}}
    
        {{Form::button('Ajouter', array('class' => 'button button-submit right', 'type' => 'submit'))}}
    
        {{Form::label('titrePage', "Titre de la page")}}
        {{Form::text('titrePage')}}
        
        {{Form::label('titreLien', "Titre dans le menu")}}
        {{Form::text('titreLien')}}
        
        {{Form::label('submenu', "Rataché au menu")}}
        <select name="submenu">
            <option value="1">Se déplacer</option>
            <option value="2">Infos pratiques</option>
        </select>
        
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
    CKEDITOR.replace('contenu');
</script>

@stop
