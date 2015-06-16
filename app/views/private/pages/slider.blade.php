@extends('private.layout')

@section('content')

<h1>Gestion du slider</h1>
<div class="flash-temp"></div>
<p class="slider-info">Cliquez-glissez les images pour changer leur position. Cliquez sur l'icône d'édition pour modifier leurs attributs.</p>
<p><a href="#" class="button-new button right" id="slider-add">Ajouter</a></p>



@if ($errors->has())
 <div class="errors">
     <p>Liste des erreurs de validation :</p>
     @foreach ($errors->all() as $error)
         {{ $error }}<br/>        
     @endforeach
 </div>
@endif

<div id="slider-form" class="form hidden">
        {{Form::open(array('class' => 'form', 'files' => true))}}

        <p><a href="#" class="button-close button right" id="slider-close">Fermer</a></p>

        {{Form::label('nom', "Nom de l'image *")}}
        {{Form::text('nom')}}
        
        {{Form::label('alt', "Descrition courte de l'image (alt) *")}}
        {{Form::text('alt')}}
        
        {{Form::label('image', "Image")}}
        {{Form::file('image', array('name' => 'image'))}}
        
        {{Form::label('resample', 'Redimensionner l\'image automatiquement ?')}}
        {{Form::checkbox('resample', '1', true)}}
        
        {{Form::button('Envoyer', array('class' => 'button button-submit button-center', 'type' => 'submit'))}}

    {{Form::close()}}
</div>

<div class="slides">
    @foreach($slides as $slide)
        <div class="slide" data-id="{{$slide->id}}">
            <div class="editOverlay"></div>
            <img src="../uploads/slider/{{$slide->link}}"/>
            {{Form::open(array('url' => 'admin/slider/update/' . $slide->id, 'class' => 'form hidden', 'method' => 'POST'))}}
                {{Form::text('nom', $slide->nom)}}
                {{Form::text('alt', $slide->alt)}}
                <p><a href="#" class="button-center slider-update-attr">Modifier</a></p>
                <p><a href="#" class="button-center slider-delete">Supprimer</a></p>
            {{Form::close()}}
        </div>
    @endforeach
</div>



@stop