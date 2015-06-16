@extends('public.layout')

@section('content')

<div class="block-navigation">
    <div class="block-navigation-nav">
        <div class="block-cat active actif" id="home">
            <i class="fa fa-home"></i>
            <div>Accueil</div>
        </div>
        <div class="block-cat" id="clock">
            <i class="fa fa-clock-o"></i>
            <div>Horaires</div>
        </div>
        <div class="block-cat" id="path">
            <i class="fa fa-compass"></i>
            <div>Trajet</div>
        </div>
        <div class="block-cat" id="plan">
            <i class="fa fa-road"></i>
            <div>Plan</div>
        </div>
    </div>
    <div class="block-navigation-content">
        <div class="block-navigation-inset active home">
            <ul>
            @foreach($slides as $slide)
                <li style="background-image: url('uploads/slider/{{$slide->link}}')"></li>
            @endforeach
            </ul>
            <div id="appli-index">
                <p>Retrouvez tout le contenu du site sur nos applications !</p>
                <a href="#" class="first-link" alt="Télécharger l'application linea pour Androïd"><img src="/back-office/public/img/dowload_googleplay.png" alt="Application linea pour Androïd" /></a>
                <a href="#" alt="Télécharger l'application linea pour Iphone"><img src="/back-office/public/img/dowload_apple.png" alt="Application linea pour Iphone" /></a>
            </div>
        </div>
        <div class="block-navigation-inset clock">
            <h3>Rechercher un horaire de bus</h3>
            <div class="block-search first-block">
                {{Form::open(array('route' => 'horairesDispatch'))}}
                    <div class="block-search-input">
                        {{Form::label('arret', "Horaires d'un arrêt")}}
                        <br>
                        {{Form::text('arret', '', array('id' => 'arret', 'placeholder' => 'Nom de l\'arrêt'))}}
                    </div>
                    <div class="block-select-date">
                        <div>
                            {{Form::label('date', 'Date')}}<br>
                            <input type="text" id="dateA" gldp-id="dateA" name="date" value="{{date('d-m-Y')}}"/>
                            <label for="dateA"><i class="fa fa-calendar"></i></label>
                        </div>
                        
                         <div gldp-el="dateA" style="width:231px; height:230px; display:block;"></div>
                        
                        <div>
                            {{Form::label('heure', 'Heure')}}<br>
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
                    {{Form::submit('Rechercher', array('name' => 'findA', 'class' => 'button-search'))}}
                {{Form::close()}}
                    </div>
            </div>
            
            <div class="block-search">
                {{Form::open(array('route' => 'horairesDispatch'))}}
                    <div class="block-search-input">
                        {{Form::label('ligne', "Horaires d'une ligne")}}
                        <br>
                        {{Form::text('ligne', '', array('id' => 'ligne', 'placeholder' => 'Nom ou numéro de la ligne'))}}
                    </div>
                    
                    <div class="block-select-date">
                        <div>
                            {{Form::label('date', 'Date')}}<br>
                            <input type="text" id="dateL" gldp-id="dateL" name="date" value="{{date('d-m-Y')}}"/>
                            <label for="dateL"><i class="fa fa-calendar"></i></label>
                        </div>
                        
                         <div gldp-el="dateL" style="width:231px; height:230px; display:block;"></div>
                        
                        <div>
                            {{Form::label('heure', 'Heure')}}<br>
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
                    
                    
                        {{Form::submit('Rechercher', array('name' => 'findL', 'class' => 'button-search'))}}
                    </div>
                
                {{Form::close()}}
            </div>
        </div>
        <div class="block-navigation-inset path">
            <h3>Rechercher un itinéraire</h3>
            <div class="block-search search-itineraire first-block">
                {{Form::open()}}
                {{Form::label('depart', 'Arrêt de depart')}}
                {{Form::text('depart', '', array('id' => 'depart', 'placeholder' => 'Nom de l\'arrêt'))}}
            </div>
            <div class="block-search search-itineraire">
                {{Form::label('arrive', 'Arrêt d\'arrivé')}}
                {{Form::text('arrive', '', array('id' => 'arrive', 'placeholder' => 'Nom de l\'arrêt'))}}
            </div>
            {{Form::submit('Rechercher mon itinéraire', array('class' => 'button-search'))}}
            {{Form::close()}}
        </div>
        <div class="block-navigation-inset plan">
            <h3>Plan intéractif</h3>
            <div id="map"></div>
        </div>
    </div>
</div>

<div class="block-infos">
    <div class="block-trafic">
        <h2>
            <i class="fa fa-exclamation"></i> Infos trafic
        </h2>
        @foreach($lastInfos as $info)
            <div>
                <h3><a href="infostrafic/{{$info->slug}}">{{$info->titreAlerte}}</a></h3>
                <p>{{$info->resumeAlerte}}</p>
                <span>Publié le {{ date("d/m/Y",strtotime($info->dateAlerte))}}</span>
            </div>
        @endforeach
    </div>
    
    <div class="block-actu">
        <h2>
            <i class="fa fa-question"></i> Actualités
        </h2>
        @foreach($lastActus as $actu)
            <div>
                <h3><a href="actu/{{$actu->slug}}">{{$actu->titreActualite}}</a></h3>
                <p>{{$actu->resumeActualite}}</p>
                <span>Publié le {{ date("d/m/Y",strtotime($actu->dateActualite))}}</span>
            </div>
        @endforeach
    </div>
</div>
@stop