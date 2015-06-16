@extends('private.layout')

@section('content')

<h1>Edition de "{{$ligne->libelleLigne}}"</h1>


    {{Form::model($ligne, array('class' => 'form', 'files' => true))}}
    
        {{Form::button('Modifier', array('class' => 'button button-submit right', 'type' => 'submit'))}}

        {{Form::label('couleurLigne', "Couleur de la ligne sur la carte")}}
        {{Form::text('couleurLigne', null, array('id' => 'color'))}}
        
        {{Form::label('fichierPDF', "Fichier PDF téléchargeable")}}
        {{Form::file('fichierPDF', array('name' => 'fichierPDF'))}}
        
        {{Form::label('polyline', "Coordonnées de la ligne")}}
        {{Form::text('polyline')}}
        <a href="#" id="help" class="center">Afficher l'aide</a>
        
        <div class="polyline-help hidden">
            <p>Les "polylines" sont à générer ici : <a href="https://developers.google.com/maps/documentation/utilities/polylineutility" target="_blank">Accéder à Google Polyline</a></p>
            <p>Le contenu à insérer sur cette page est celui du champ "Encoded Polyline" obtenu après avoir placé les points.</p>
            <p><img src="/back-office/public/img/help-polyline.jpg" alt="help polyline"></p>
        </div>

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
    
    $('#color').ColorPicker({
    	onSubmit: function(hsb, hex, rgb, el) {
    		$('#color').val("#" + hex);
    		$('#color').ColorPickerHide();
    	},
    	onBeforeShow: function () {
    		$(this).ColorPickerSetColor(this.value);
    	}
    });
    
    $('#help').click(function(event){
        event.preventDefault();
       $('.polyline-help').toggleClass('hidden'); 
    });
    
    
</script>
@stop
