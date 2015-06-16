@extends('public.layout')

@section('content')
<div id="login-block">
<p>Veuillez saisir votre nouveau mot de passe</p>

    {{Form::open()}}
            
            {{Form::label('Mot de passe :')}}
            {{Form::password('password1')}}
            
            {{Form::label('Confirmation du mot de passe :')}}
            {{Form::password('password2')}}
            
        
        @if ($errors->has())
            <div class="errors">
                <p>Liste des erreurs de validation :</p>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br/>        
                @endforeach
            </div>
        @endif

        {{Form::submit('Valider')}}
    
    {{Form::close()}}
</div>
@stop