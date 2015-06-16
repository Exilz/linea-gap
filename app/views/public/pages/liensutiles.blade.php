@extends('public.includes.contentType')

@section('contentType')
<h1>Liens utiles</h1>

    @foreach($liens as $item)
        <div class="block-liens">
            <a href="{{$item->urlLien}}" target="_blank"><img src="http://bus-gap-exilz.c9.io/back-office/public/img/upload/{{$item->logoLien}}"/><h2>{{$item->libelleLien}}</h2></a>
        </div>
    @endforeach
   
@stop