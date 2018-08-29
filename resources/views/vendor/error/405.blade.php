@extends('layout.master-error')
@section('title', 'Error Occured')
@section('container')
  	<p><b>405.</b> <ins>Error Occured.</ins></p>
  	<img src="{{ asset('/images/405.png') }}" class="icon">
  	<div style="direction: ltr">
        {{ $exception->getMessage() }}
        <br> File: <b>{{ $exception->getFile() }}</b> 
        <br> line: <ins>{{ $exception->getLine() }} </ins>
    </div>
    
@endsection