@extends('public.layout')

@section('content')
<div class="content-type">
    <div class="block-content">
        @yield('contentType')
    </div>
    <div class="block-right">
        <div class="block-search">
            <h3 id="title-search-horaire"><i class="fa fa-clock-o"></i> Horaires</h3>
            <div id="block-search-horaire">
               {{Form::open(array('route' => 'horairesDispatch'))}}
                    <div class="block-search-input">
                        {{Form::label('arret', 'Rechercher un arrêt')}}
                        <br>
                        <div>
                            {{Form::text('arret', '', array('id' => 'arret', 'placeholder' => 'Nom de l\'arrêt'))}}
                            {{Form::submit('OK', array('name' => 'findA', 'class' => 'button-search'))}}
                        </div>
                        {{Form::label('ligne', 'Rechercher une ligne')}}
                        <br>
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
                        
                         <div gldp-el="dateL" style="width:231px; height:230px; display:block; position: absolute;"></div>
                        
                        <div>
                            {{Form::label('heure', 'Heure')}}<br>
                            <select class="select-style" name="heure" id="heure">
                                
                                @for ($i = 0; $i < 24; $i++)
                                    @if($i < 10)
                                        <option>{{ '0' . $i }}</option>
                                    @else
                                        <option>{{ $i }}</option>
                                    @endif
                                @endfor
                                
                            </select>
                            <select class="select-style" name="minute" id="minute">
                                @for ($i = 0; $i < 60; $i+=5)
                                    @if($i < 10)
                                        <option>{{ '0' . $i }}</option>
                                    @else
                                        <option>{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        {{Form::submit('Rechercher mon horaire', array('name' => 'findLA'))}}
                    </div>
                {{Form::close()}} 
            </div>
            <h3 id="title-search-itiniraire"><i class="fa fa-compass"></i> Itineraire</h3>
            <div id="block-search-itiniraire">
                {{Form::open()}}
                    {{Form::label('depart', 'Arrêt de depart')}}
                    {{Form::text('depart', '', array('id' => 'depart', 'placeholder' => 'Nom de l\'arrêt'))}}
                    
                    {{Form::label('arrive', 'Arrêt d\'arrivé')}}
                    {{Form::text('arrive', '', array('id' => 'arrive', 'placeholder' => 'Nom de l\'arrêt'))}}
                    
                    {{Form::submit('Rechercher mon itinéraire')}}
                {{Form::close()}}
            </div>
            
        </div>
        <div class="block-last-infos">
            <div class="block-title">
                <h2 class="active infos-trafic" ><i class="fa fa-exclamation"></i> Infos trafic</h2>
                <h2 class="infos-actu"><i class="fa fa-question"></i> Actualités</h2>
            </div>
            <div class="active infos-trafic">
                @foreach($lastInfo as $info)
                    <div>
                        <h3><a href="/back-office/public/infostrafic/{{$info->slug}}">{{$info->titreAlerte}}</a></h3>
                        <p>{{$info->resumeAlerte}}</p>
                        <span>Publié le {{ date("d/m/Y",strtotime($info->dateAlerte))}}</span>
                    </div>
                @endforeach
                <a href="/back-office/public/infostrafic">Afficher toutes les infos</a>
            </div>
            <div class="infos-actu">
                @foreach($lastActu as $actu)
                    <div>
                        <h3><a href="/back-office/public/actu/{{$actu->slug}}">{{$actu->titreActualite}}</a></h3>
                        <p>{{$actu->resumeActualite}}</p>
                        <span>Publié le {{ date("d/m/Y",strtotime($actu->dateActualite))}}</span>
                    </div>
                @endforeach
                <a href="/back-office/public/actualites">Afficher toutes les actualités</a>
            </div>
        </div>
        <div class="block-download">
            <h2>Application mobile</h2>
            <div>
                <a href="#"><img class="google-app" src="/back-office/public/img/french_get.svg" alt="disponible sur google play"></img></a>
                <a href="#"><img class="appel-app" src="/back-office/public/img/App_Store_Badge_FR.svg" alt="télécharger dans l'app store"></img></a>
                <div>Téléchargez l'application dès maintenant !</div>
            </div>
        </div>
    </div>
</div>
@stop