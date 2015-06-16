@extends('private.layout')

@section('content')

<h1>Gestion des horaires</h1>
<p>
    <a href="horaire/new" class="button button-new right">Nouvelle horaire</a></a>
    <a href="horaire/selectLine" class="button button-new right">Modification horaire</a></a>
    <a href="#" id="btn_semaine" class="button button-new right">Types de semaines</a></a>
    <a href="#" id="btn_vacance" class="button button-new right">Vacances et jours feriés</a></a>
</p>

<div class="gestionsemaines hidden">
    <h2>Gestion des types de semaines</h2>
    <ul>
        @foreach($typesSemaines as $typeSemaine)
            <li>{{$typeSemaine->libelleTypeSemaine}}   <a href="horaire/delType/{{$typeSemaine->idTypeSemaine}}" class="delete">Supprimer</a></li>
        @endforeach
    </ul>
    
    {{Form::open(array('class' => 'form', 'url' => 'admin/horaire/addType'))}}
    
        {{Form::label('libelle', "Libellé du type de semaine")}}
        {{Form::text('libelle')}}
        
        <label>Jours :</label>
        <div class="typesSemaines">
            {{Form::label('lun', "Lundi")}}
            {{Form::checkbox('lun')}}
            {{Form::label('mar', "Mardi")}}
            {{Form::checkbox('mar')}}
            {{Form::label('mer', "Mercredi")}}
            {{Form::checkbox('mer')}}
            {{Form::label('jeu', "Jeudi")}}
            {{Form::checkbox('jeu')}}
            {{Form::label('ven', "Vendredi")}}
            {{Form::checkbox('ven')}}
            {{Form::label('sam', "Samedi")}}
            {{Form::checkbox('dan')}}
        </div>
        <label>Periodes :</label>
        <div class="typesSemaines">
            {{Form::label('vac', "Vacances")}}
            {{Form::checkbox('vac')}}
            {{Form::label('scol', "Scolaire")}}
            {{Form::checkbox('scol')}}
            
        </div>
        <!--<p>Lundi{{Form::checkbox('lun')}}</p>-->
        <!--<p>Mardi{{Form::checkbox('mar')}}</p>-->
        <!--<p>Mercredi{{Form::checkbox('mer')}}</p>-->
        <!--<p>Jeudi{{Form::checkbox('jeu')}}</p>-->
        <!--<p>Vendredi{{Form::checkbox('ven')}}</p>-->
        <!--<p>Samedi{{Form::checkbox('sam')}}</p>-->
        
        <!--<p>Période de vacances : {{Form::radio('periode', 'vac', true)}}</p>-->
        <!--<p>Période scolaire : {{Form::radio('periode', 'scol')}}</p>-->
        <!--<p>Vacances et scolaire : {{Form::radio('periode', 'scolvac')}}</p>-->
        
        {{Form::button('Valider', array('class' => 'button button-submit button-center', 'type' => 'submit'))}}
        
    {{Form::close()}}
    
</div>

@stop