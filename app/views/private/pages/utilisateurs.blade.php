@extends('private.layout')

@section('content')

<h1>Gestion des utilisateurs</h1>

    <table>
        <thead>
            <tr><td>Prénom Nom</td><td>Email</td><td>Adresse</td><td>Supprimer</td></tr>
        </thead>
        <tbody>
            @foreach($utilisateurs as $utilisateur)
                <tr><td>{{$utilisateur->nomClient . " " . $utilisateur->prenomClient}}</td><td>{{$utilisateur->emailClient}}</td><td>{{$utilisateur->adresseClient}}</td><td><a href="utilisateurs/delete/{{$utilisateur->idClient}}" class="delete" title="Supprimer {{$utilisateur->nomClient . ' ' . $utilisateur->prenomClient}}"><i class="fa fa-close button-delete-small"></i></a></td></tr>
            @endforeach
        </tbody>
    </table>

@stop

