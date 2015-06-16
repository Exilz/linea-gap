@extends('public.layout')

@section('content')
<div class="content-type content-horaires">
<h1>Rechercher un horaire</h1>
<div id="page-search">
    <div class="block-search">
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
</div>
@stop