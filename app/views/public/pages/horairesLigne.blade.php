@extends('public.includes.contentHoraires')

@section('contentHoraires')

<h1><i class="fa fa-search"></i> Résultat de votre recherche</h1>

<div class="recapitulatif">
    
    <p>Ligne : <span class="strong">{{$idLigne}} {{$nomLigne[0]}}</span></p>
    @if($date)
        <p>Le : <span class="strong">{{$date}}</span></p>
    @endif
    @if($heureMin != '00:00' && $heureMin != ':')
        <p>A partir de : <span class="strong">{{$heureMin}}</span></p>
    @endif
    <p>
        Direction : <span class="strong">
                        <span class="nomAller">{{$nomLigne[0]}}</span>
                        <span class="nomRetour hidden">{{$nomLigne[1]}}</span>
                    </span>
    </p>
    <p><a href="uploads/horaires{{$idLigne}}.pdf"><i class="fa fa-download"></i> Télécharger les horaires en PDF</a></p>
    <p><a href="generate/{{$idLigne}}"><i class="fa fa-download"></i> Génération PDF</a></p>
    
    <div class="navigation">
        <div class="scrollLeft"><i class="fa fa-angle-double-left"></i></div>
        <div class="changeLigne">Nouvelle recherche</div>
        <div class="changeDirection">Changer de direction</div>
        <div class="scrollRight"><i class="fa fa-angle-double-right"></i></div>
    </div>
    
    <div id="new-search" class="block-right">
        <div class="block-search hidden">
            {{Form::open(array('route' => 'horairesDispatch'))}}
                <div class="block-search-input">
                    {{Form::label('arret', 'Rechercher un arrêt')}}
                    <div>
                        {{Form::text('arret', '', array('id' => 'arret', 'placeholder' => 'Nom de l\'arrêt'))}}
                        {{Form::submit('OK', array('name' => 'findA', 'class' => 'button-search'))}}
                    </div>
                    {{Form::label('ligne', 'Rechercher une ligne')}}
                    <div>
                        {{Form::text('ligne', '', array('id' => 'ligne', 'placeholder' => 'Nom ou num. de la ligne'))}}
                        {{Form::submit('OK', array('name' => 'findL', 'class' => 'button-search'))}}
                    </div>
                </div>
                <div class="block-select-date">
                    <div>
                            {{Form::label('date', 'Date')}}
                                <input type="text" id="dateL" gldp-id="dateL" name="date" value="{{date('d-m-Y')}}"/>
                                <label for="dateL"><i class="fa fa-calendar"></i></label>
                    </div>
                        
                    <div gldp-el="dateL" style="width:231px; height:230px; display:block; position: absolute; z-index: 999;"></div>
                    
                    
                    <div>
                        {{Form::label('heure', 'Heure')}}
                        <select class="select-style" name="heure" id="heure">
                            
                            @for ($i = 0; $i < 24; $i++)
                                @if($i < 10)
                                {
                                    <option>{{ '0' . $i }}</option>
                                }
                                @else
                                
                                    <option>{{ $i }}</option>
                                }
                                @endif
                            @endfor
                            
                        </select>

                        <select class="select-style" name="minute" id="minute">
                            @for ($i = 0; $i < 60; $i+=5)
                                @if($i < 10)
                                {
                                    <option>{{ '0' . $i }}</option>
                                }
                                @else
                                
                                    <option>{{ $i }}</option>
                                }
                                @endif
                            @endfor
                        </select>
                    </div>
                
                
                    {{Form::submit('Rechercher mon horaire', array('name' => 'findLA'))}}
                </div>
            
            {{Form::close()}}
        </div>
    </div>
    
</div>


@if($horaires)

    @foreach($horaires as $typeSemaine => $horairesSemaine)
        <div class="aller">
            <table class="tableHoraires">
                <thead>
                    @if($selectedArret)
                        <h3>Votre Arret</h3>
                        <tr class="selected first-arret">
                            <td class="arret" title="{{$selectedArret}}">{{str_limit($selectedArret, 18)}}</td>
                            @foreach($horairesSemaine['aller'][$selectedArret] as $horaire)
                                <td>
                                    @if($horaire != '00:00:00')
                                        {{str_limit($horaire, 5, $end = '')}}
                                    @endif
                                    
                                </td>
                            @endforeach
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @foreach($horairesSemaine['aller'] as $arret => $horairesArret)
                        
                        <tr {{ (trim($selectedArret) == trim($arret)) ? 'class="selected"' : '' }}>
                            <td class="arret" title="{{$arret}}">{{str_limit($arret, 18)}}</td>
                            @foreach($horairesArret as $horaire)
                                <td>
                                    @if($horaire != '00:00:00')
                                        {{str_limit($horaire, 5, $end = '')}}
                                    @else
                                        {{'&nbsp'}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="retour hidden">
            <table class="tableHoraires">
                <thead>
                    @if($selectedArret)
                        <h3>Votre Arret</h3>
                        <tr class="selected first-arret">
                            <td class="arret" title="{{$selectedArret}}">{{str_limit($selectedArret, 18)}}</td>
                            @foreach($horairesSemaine['retour'][$selectedArret] as $horaire)
                                <td>
                                    @if($horaire != '00:00:00')
                                        {{str_limit($horaire, 5, $end = '')}}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endif
                </thead>
                <tbody>
                @foreach($horairesSemaine['retour'] as $arret => $horairesArret)
        
                    <tr {{ (trim($selectedArret) == trim($arret)) ? 'class="selected"' : '' }}>
                        <td class="arret" title="{{$arret}}">{{str_limit($arret, 18)}}</td>
                        @foreach($horairesArret as $horaire)
                            <td>
                                @if($horaire != '00:00:00')
                                    {{str_limit($horaire, 5, $end = '')}}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
    
        
@else
    <p>Pas d'horaires trouvés pour l'arrêt, la ligne et la date spécifiés.</p>
@endif

@stop