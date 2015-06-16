@extends('public.includes.contentType')

@section('contentType')

<h1>Foire aux questions</h1>

    @foreach($faq as $item)
        <div class="block-question">
            <p class="question"><i class="fa fa-plus question-icon"></i>{{$item->question}}</p>
            <div class="answer hidden">{{$item->reponse}}</div>
        </div>
    @endforeach

<h2 class="front-title-second">Une question ? Nous sommes à votre écoute</h2>

    {{Form::open(array('class' => 'form'))}}
    
        {{Form::label('sujetQuestion', "Sujet de la question")}}
        {{Form::text('sujetQuestion', null, array('placeholder' => 'Sujet de votre question'))}}
        
        {{Form::label('mail', "Votre adresse email")}}
        {{Form::text('mail', null, array('placeholder' => 'Votre adresse e-mail'))}}
        
        {{Form::label('contenuQuestion', "Veuillez décrire présicément votre question")}}
        {{Form::textarea('contenuQuestion', null, array('id' => 'contenuQuestion'))}}
        
        @if ($errors->has())
            <div class="errors">
                <p>Liste des erreurs de validation :</p>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br/>        
                @endforeach
            </div>
        @endif
        
        
        <div class="g-recaptcha" data-sitekey="6LcCwgATAAAAAKDF94q1bFJiROaMClquVYeRIuez"></div>
        {{Form::button('Envoyer', array('class' => 'button button-submit button-center', 'type' => 'submit'))}}
        
    {{Form::close()}}

@stop