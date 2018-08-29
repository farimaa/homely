
<meta charset="utf-8">
<title>@yield('title')</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="@yield('keywords')">
<meta name="author" content="farid shahidi">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="@yield('description')">
<meta itemprop="name" content="@yield('title')">
<meta itemprop="description" content="@yield('description')">
<meta itemprop="image" content="@yield('image')">

<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="@yield('title')">
<meta property="og:description" content="@yield('description')">
<meta property="og:type" content="website">
<meta property="og:locale" content="en" />
<meta property="og:locale:alternate" content="en" />
<meta property="og:image" content="@yield('image')">
<meta property="og:site_name" content="{{ url('/') }}">

<meta property="twitter:card" content="summary">
<meta property="twitter:site" content="{{ url()->current() }}">
<meta property="twitter:title" content="@yield('title')">
<meta property="twitter:description" content="@yield('description')">
<meta property="twitter:creator" content="farid shahidi">
<meta property="twitter:image" content="@yield('image')">
<meta property="twitter:domain" content="{{ url('/') }}">

<link rel="canonical" href="{{ url('/') }}">

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-icon-180x180.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}/">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}/">
<link rel="manifest" href="{{ asset('images/favicon_package_v0.16/site.webmanifest') }}/">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">


<link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
<link href="resources/css/homely.css" rel="stylesheet" />
<link href="resources/css/svg-icons.css" rel="stylesheet" />
<link href="resources/css/fontawesome-all.min.css" rel="stylesheet" />

@stack('style')
