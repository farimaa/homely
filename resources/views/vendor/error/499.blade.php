@extends('layout.master-error')
@section('title', 'Error Occured')
@section('container')
  	<p><b>499.</b> <ins>Error Occured.</ins></p>
  	<p><small> csrf_field not found. </small></p>
  	<img src="{{ asset('/images/499.jpg') }}" class="icon">
@endsection