@extends('layout.master-error')
@section('title', 'Error Occured')
@section('container')
  	<p><b>429.</b> <ins>Error Occured.</ins></p>
  	<img src="{{ asset('/images/429.jpg') }}" class="icon">
@endsection