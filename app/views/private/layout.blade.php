<!DOCTYPE html>
<html>
<head>
	@include('private.includes.head')

</head>
<body>
	<div id="overlay-admin">
		<i class="fa fa-chevron-left panel-arrow hidden-panel"></i>
		<i class="fa fa-chevron-right panel-arrow show-panel"></i>
		<h3>Panel administration</h3>
		<ul>
			@include('private.includes.linkpanel')
		</ul>
	</div>
	<div class="content">
		<header>
			@if(Auth::check())
				<a href="/back-office/public"><img src="/back-office/public/img/logo.png" alt="logo linéa"></a>
				@include('private.includes.nav')
			@endif
		</header>
		
		
		<section>
		<!--Message flash-->
		@if(Session::has('flash_msg'))
		      <div class="flash {{Session::get('flash_type')}}">
		      {{Session::get('flash_msg')}}
		      <a href="#" id="closeFlash"><i class="fa fa-times"></i></a>
		    </div>
		@endif
			@yield('content')
		</section>
	</div>

	<script type="text/javascript" src="/back-office/public/js/scriptBackoffice.js"></script>
</body>
</html>