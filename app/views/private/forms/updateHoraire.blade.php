@extends('private.layout')

@section('content')

<h1>Modification horaire </h1>

<div class="recapitulatif">
    
    <p id="ligne" data-idLigne="{{$idLigne}}">Ligne : <span class="strong">{{$idLigne}} {{$nomLigne[0]}}</span></p>
    <p id="typeSemaine" data-typeSemaine="{{$idTypeSemaine}}">Type de semaine : {{$nomTypeSemaine}}</p>
    
</div>

<div class="navigation">
    <div class="scrollLeft"><i class="fa fa-angle-double-left"></i></div>
    <div class="changeDirection" data-direction="1">Changer de direction</div>
    <div class="scrollRight"><i class="fa fa-angle-double-right"></i></div>
</div>

<div class="content-horaires">
    
    @if($horaires)

    @foreach($horaires as $typeSemaine => $horairesSemaine)
        <div class="aller">
            <table class="tableHoraires">

                    @foreach($horairesSemaine['aller'] as $arret => $horairesArret)
                        
                        <tr>
                            <td class="arret" title="{{$arret}}">{{str_limit($arret, 18)}}</td>
                            @foreach($horairesArret as $horaire)
                                <td class="horaire">
                                    @if($horaire != '00:00:00')
                                        {{str_limit($horaire, 5, $end = '')}}
                                    @else
                                        {{'&nbsp'}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

            </table>
        </div>
        
        <div class="retour hidden">
            <table class="tableHoraires">

                @foreach($horairesSemaine['retour'] as $arret => $horairesArret)
        
                    <tr>
                        <td class="arret" title="{{$arret}}">{{str_limit($arret, 18)}}</td>
                        @foreach($horairesArret as $horaire)
                            <td class="horaire">
                                @if($horaire != '00:00:00')
                                    {{str_limit($horaire, 5, $end = '')}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach

            </table>
        </div>
    @endforeach
    
        
@else
    <p>Pas d'horaires trouvés pour l'arrêt, la ligne et la date spécifiés.</p>
@endif
</div>

@stop