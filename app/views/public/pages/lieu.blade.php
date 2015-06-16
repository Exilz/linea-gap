@extends('public.includes.contentType')

@section('contentType')

<h1>Lieux importants</h1>
    <!--MAP-->
    <div id="popup">
        <i class="fa fa-times close-popup"></i>
        <div id="map-lieu"><!--MAP--></div>
        <span id="nomLieu"><!--NOM LIEU--></span>
    </div>
    @foreach($cat as $item)
        <div class="block-lieu">
            <h2><i class="fa fa-plus question-icon"></i> {{$item->nomCatLieu}} </h2>
        @foreach($lieux as $item2)
                
            @if($item->idCatLieu == $item2->idCatLieu)
                <h3 class="nomLieu hidden" data-lat="{{$item2->latLieu}}" data-long="{{$item2->longLieu}}">{{$item2->nomLieu}}</h3>
            @endif
        
        @endforeach
        </div>
            
    @endforeach

@stop
