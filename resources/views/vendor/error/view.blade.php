@extends('layout.master-error')
@section('title', 'Error Occured')
@section('container')
    <p><b>500.</b> <ins>Error Occured.</ins></p>
    <div style="direction: ltr">
        {{ $exception->getMessage() }}
        <br> File: <b>{{ $exception->getFile() }}</b> 
        <br> line: <ins>{{ $exception->getLine() }} </ins>
    </div>
    <img src="{{ asset('/images/500.png') }}" class="icon">
@endsection
   