@extends('public.layout')

@section('content')

<div id="login-block">
    <p>Mot de passe oublié ?</p>
    
        {{Form::open()}}
            
            {{Form::label("Email: *")}}
            {{Form::text('email')}}
            
            {{Form::submit('M\'envoyer les instructions par email')}}
        
        {{Form::close()}}

</div>

@stop