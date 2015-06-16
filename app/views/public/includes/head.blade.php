<meta charset=utf-8 />
<title>
    @if(isset($title)) 
        {{$title}}
    @else
        Bus Linéa - Ville de Gap
    @endif
</title>
<link rel="shortcut icon" type="image/x-icon" href="/back-office/public/favicon.ico" />
<link rel="icon" type="image/png" href="/back-office/public/favicon.png" />
<link rel="stylesheet" type="text/css" href="/back-office/public/css/mainFrontoffice.css" />
<!--<link rel="stylesheet" type="text/css" href="/back-office/public/css/font-awesome.min.css" />-->
<!--<link rel="stylesheet" type="text/css" href="/back-office/public/css/glDatePicker.flatwhite.css" />-->
<script type="text/javascript" src="/back-office/public/js/jquery.min.js"></script>
<script type="text/javascript" src="/back-office/public/js/unslider.min.js"></script>
<script type="text/javascript" src="/back-office/public/js/glDatePicker.min.js"></script>
<script type="text/javascript" src="/back-office/public/js/typeahead.bundle.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<meta name="viewport" content="width=device-width"/>
@if(Request::is('*faq'))
<script type="text/javascript" src="/back-office/public/ckeditor/ckeditor.js"></script>
@endif

@if(Request::is('*lieux') or Request::is('*plan') or Request::is('/'))
<script src="http://maps.googleapis.com/maps/api/js?libraries=geometry"></script>
@endif

@if(Request::is('*plan'))
<script src="/back-office/public/js/scriptMap.js"></script>
<script src="/back-office/public/js/scriptMapOverlay.js"></script>
@endif

@if(Request::is('/'))
<script src="/back-office/public/js/scriptMapAccueil.js"></script>
@endif

@if(Request::is('*find*'))
<script src="/back-office/public/js/scriptHoraires.js"></script>
@endif
