<!DOCTYPE html>
<html lang="fa" dir="ltr">
	<head>
	  	<meta charset=utf-8>
	  	<meta name=viewport content="initial-scale=1, width=device-width">
	  	<title>@yield('title')</title>
	  	<link rel="stylesheet" type="text/css" href="{{ asset('css/error.css') }}">
	</head>
	<body>
		<a href="{{ url('/') }}" class="no-decoration">
			<h2>{{ $constant['name'] }}</h2>
			<div class="seperate"></div>
			<img src="{{ asset($constant['logo']) }}" alt="{{ $constant['name'] }}" class="logo">
			<div class="seperate"></div>
		</a>
		@yield('container')
  	</body>
</html>