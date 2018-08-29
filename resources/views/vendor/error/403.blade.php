@extends('layout.master-error')
@section('title', 'No permission')
@section('container')
  	<p><b>403.</b> <ins>No permission.</ins></p>
  	<img src="{{ asset('/images/403.jpg') }}" class="icon">
@endsection