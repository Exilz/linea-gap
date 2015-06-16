@extends('public.includes.contentType')

@section('contentType')

<h1>Contact</h1>
<!--<img src="http://lorempixel.com/1020/300/cats/" class="banner"></img>-->

    {{Form::open(array('class' => 'form'))}}

        @if(Auth::check())

            {{Form::label('nom', "Votre nom *")}}
            {{Form::text('nom', Auth::user()->nomClient, array('required' => 'required'))}}
            
            {{Form::label('prenom', "Votre prénom")}}
            {{Form::text('prenom', Auth::user()->prenomClient)}}
            
            {{Form::label('email', "Votre adresse e-mail *")}}
            {{Form::text('email', Auth::user()->emailClient, array('required' => 'required'))}}
            
            {{Form::label('sujet', "Sujet du message *")}}
            {{Form::text('sujet')}}
            
            {{Form::label('message', "Message *")}}
            {{Form::textarea('message')}}

            <div class="g-recaptcha" data-sitekey="6LcCwgATAAAAAKDF94q1bFJiROaMClquVYeRIuez"></div>
            {{Form::button('Envoyer', array('class' => 'button button-classic button-center', 'type' => 'submit'))}}
            
        @else
        
            {{Form::label('nom', "Votre nom *")}}
            {{Form::text('nom', null, array('required' => 'required'))}}
            
            {{Form::label('prenom', "Votre prénom")}}
            {{Form::text('prenom')}}
            
            {{Form::label('email', "Votre adresse e-mail *")}}            
            {{Form::text('email', null, array('required' => 'required'))}}
            
            
            {{Form::label('sujet', "Sujet du message *")}}
            {{Form::text('sujet')}}
            
            {{Form::label('message', "Message *")}}
            {{Form::textarea('message')}}
            
            <div class="g-recaptcha" data-sitekey="6LcCwgATAAAAAKDF94q1bFJiROaMClquVYeRIuez"></div>
            {{Form::button('Envoyer', array('class' => 'button button-classic button-center', 'type' => 'submit'))}}
            
        @endif
        
        @if ($errors->has())
            <div class="errors">
                <p>Liste des erreurs de validation :</p>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br/>        
                @endforeach
            </div>
        @endif
            
            
    {{Form::close()}}

@stop