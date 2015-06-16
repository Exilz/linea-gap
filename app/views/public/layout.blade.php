<!DOCTYPE html>
<html>
<head>
	@include('public.includes.head')

</head>
<body>
	<div class="content">
		<header>
			<a href="/back-office/public"><img src="/back-office/public/img/logo.png" alt="logo linéa"></a>
			@include('public.includes.nav')
		</header>
		
		@if(Request::url() == 'http://bus-gap-exilz.c9.io/back-office/public')
		<section id="page_accueil">
			@else
		<section>
		@endif

		<!--Message flash-->
		@if(Session::has('flash_msg'))
		      <div class="flash {{Session::get('flash_type')}}">
		      {{Session::get('flash_msg')}}
		      <a href="#" id="closeFlash"><i class="fa fa-times"></i></a>
		    </div>
		@endif
			@yield('content')
		</section>
	
	
		<footer>
			@include('public.includes.footer')
		</footer>
		
	</div>
	<script type="text/javascript" src="/back-office/public/js/scriptFrontoffice.js"></script>
</body>
</html>