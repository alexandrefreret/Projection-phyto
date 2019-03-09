<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<!-- Styles -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

	<header>
		<div class="container">
			<nav class="navbar navbar-expand-lg">
				<a class="navbar-brand" href="#">
					<img src="{{ asset('img/logo.png') }}" alt="">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fa fa-bars"></i>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<div class="menu menu--iris ml-auto">
						<ul class="menu__list">
							<li class="menu__item {{ (new \App\Helpers\Helper)->isActiveRoute('home', 'menu__item--current') }}">
								<a href="{{ route('home') }}" class="menu__link">Accueil</a>
							</li>
							<li class="menu__item {{ (new \App\Helpers\Helper)->isActiveRoute('actualites', 'menu__item--current') }}">
								<a href="{{ route('actualites') }}" class="menu__link">Actualités</a>
							</li>
							<li class="menu__item {{ (new \App\Helpers\Helper)->isActiveRoute('prestation', 'menu__item--current') }}">
								<a href="#" class="menu__link">Prestations <i class="fas fa-caret-down"></i></a>
								<ul>
									<li><a href="{{ route('prestations') }}">Plan</a></li>
									<li><a href="{{ route('prestations') }}">Cahier</a></li>
								</ul>
							</li>
							<li class="menu__item {{ (new \App\Helpers\Helper)->isActiveRoute('contact', 'menu__item--current') }}">
								<a href="{{ route('contact') }}" class="menu__link">Contact</a>
							</li>
						</ul>
					</div>
			  </div>
			</nav>
			<h1>Manche agri conseil</h1>
		</div>
		{{-- <div> --}}
			{{-- <img src="{{ asset('') }}" alt=""> --}}
		{{-- </div> --}}
	</header>

	<div id="app">
		@yield('content')
	</div>
</body>
</html>
