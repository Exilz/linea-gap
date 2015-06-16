@extends('private.layout')

@section('content')

<h1>Nouvel horaire </h1>

<div class="navigation">
    <div class="scrollLeft"><i class="fa fa-angle-double-left"></i></div>
    <div class="changeDirection">Changer de direction</div>
    <div class="scrollRight"><i class="fa fa-angle-double-right"></i></div>
</div>
<div class="content-horaires">
    <div class="aller">
        <table class="tableHoraires">
            <tr id="ligne_0" data-num-ligne="0">
                <td class="arret">
                    <i class="fa fa-times addLine"></i>
                    <input type="text" name="arret_0" id="arret_0" placeholder="0a"/>
                </td>
                <td>
                    <i class="fa fa-times addCol" id="addCol_0"></i>
                    <input type="text" name="heure_0_0" id="heure_0_0" placeholder="00:00"/>
                </td>
                <td>
                    <i class="fa fa-times addCol" id="addCol_0"></i>
                    <input type="text" name="heure_0_0" id="heure_0_0" placeholder="00:00"/>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="retour hidden">
        <table class="tableHoraires">
            <tr>
                <td class="arret">
                    <input type="text" name="arret_0" id="arret_0" placeholder="1r"/>
                </td>
                <td>
                    <input type="text" name="heure_0_0" id="heure_0_0" placeholder="00:00"/>
                </td>
            </tr>
            
        </table>
    </div>
</div>

@stop