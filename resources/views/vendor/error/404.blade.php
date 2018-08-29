@extends('layout.master-error')
@section('title', 'Not Found')
@section('container')
  	<p><b>404.</b> <ins>Not Found.</ins></p>
  	<p>Check Url.</p>
  	<img src="{{ asset('/images/404.jpg') }}" class="icon">
@endsection