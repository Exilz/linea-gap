@extends('public.includes.contentType')

@section('contentType')

<h1>Horaires pour l'arrêt {{$nomArret}} sur la ligne {{$idLigne}}</h1>

@if($horaires)
    @foreach($horaires as $horaire)
    
        <h3>{{$horaire['libelle']}}</h3>
        
        <h4>Direction aller</h4>
        
        <table>
            @foreach($horaire['aller'] as $course => $aller)
                @if($aller != '00:00:00')
                    <tr>
                            <td>Passage {{$course}}</td>
                            <td>{{$aller }} </td>
                    </tr>
                @endif
            @endforeach
        </table>
        
        <h4>Direction retour</h4>
        
        <table>
            @foreach($horaire['retour'] as $course => $retour)
                @if($retour != '00:00:00')
                    <tr>
                            <td>Passage {{$course}}</td>
                            <td>{{$retour}} </td>
                    </tr>
                @endif
            @endforeach
        </table>
        
    
    @endforeach
@else
    <p>Pas d'horaires trouvés pour l'arrêt, la ligne et la date spécifiés.</p>
@endif

@stop