@extends('layout.master')
@section('title', 'Homely | Dashboar')
@section('container-fluid')
	<div class="bread-crumb">
		<a href="{{ url('/') }}">
			HOME 
		</a>
		/ 
		<a href="{{ url('/dashboard') }}">
			DASHBOARD
		</a>
	</div>
	@yield('content')
@endsection
@push('script')
	
@endpush