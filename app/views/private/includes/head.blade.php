<meta charset=utf-8 />
<title>Linéa gap - back office</title>
<link rel="shortcut icon" type="image/x-icon" href="/back-office/public/favicon.ico" />
<link rel="icon" type="image/png" href="/back-office/public/favicon.png" />
<!--<link rel="stylesheet" type="text/css" href="/back-office/public/css/font-awesome.min.css" />-->
<link rel="stylesheet" type="text/css" href="/back-office/public/css/mainBackoffice.css" />
<script type="text/javascript" src="/back-office/public/js/jquery.min.js"></script>
<script type="text/javascript" src="/back-office/public/ckeditor/ckeditor.js"></script>

@if(Request::is('*/login'))
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif

@if(Request::is('*/lignes*'))
<link rel="stylesheet" media="screen" type="text/css" href="/back-office/public/css/colorpicker/colorpicker.css" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="/back-office/public/js/generatePolylinesv2.js"></script>
<script type="text/javascript" src="/back-office/public/js/colorpicker/colorpicker.js"></script>
@endif

@if(Request::is('*/infostrafic*'))
<script src="http://maps.googleapis.com/maps/api/js?libraries=geometry"></script>
<link rel="stylesheet" type="text/css" href="/back-office/public/css/jquery-ui.min.css" />
<script type="text/javascript" src="/back-office/public/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/back-office/public/js/jquery.ui.addresspicker.js"></script>
<script type="text/javascript" src="/back-office/public/js/scriptMapAlerte.js"></script>
@endif

@if(Request::is('*/arret*'))
<script src="http://maps.googleapis.com/maps/api/js?libraries=geometry"></script>
<link rel="stylesheet" type="text/css" href="/back-office/public/css/jquery-ui.min.css" />
<script type="text/javascript" src="/back-office/public/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/back-office/public/js/jquery.ui.addresspicker.js"></script>
<script type="text/javascript" src="/back-office/public/js/scriptMapAlerte.js"></script>
@endif

@if(Request::is('*/lieu*'))
<script src="http://maps.googleapis.com/maps/api/js?libraries=geometry"></script>
<link rel="stylesheet" type="text/css" href="/back-office/public/css/jquery-ui.min.css" />
<script type="text/javascript" src="/back-office/public/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/back-office/public/js/jquery.ui.addresspicker.js"></script>
<script type="text/javascript" src="/back-office/public/js/scriptMapLieu.js"></script>
@endif

@if(Request::is('*/slider*'))
<script type="text/javascript" src="/back-office/public/js/jquery.sortable.min.js"></script>
<script type="text/javascript" src="/back-office/public/js/scriptSlider.js"></script>
@endif

@if(Request::is('*/horaire*'))
<script type="text/javascript" src="/back-office/public/js/scriptHoraires.js"></script>
<script type="text/javascript" src="/back-office/public/js/scriptAdminHoraire.js"></script>
<script type="text/javascript" src="/back-office/public/js/scriptHorairesForm.js"></script>
@endif