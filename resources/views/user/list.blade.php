@extends('layout.master')
@section('title', 'Homely')
@section('keywords', 'Homely,buy home,rent home')
@section('description', 'Homely description will update soon')
@section('image', '/images/logo.png')
@section('container-fluid')
<div class="row" ng-app="homelyApp" ng-controller="homelyMapController">
	<div class="col-xs-4">
		<div class="seperate"></div>
		<div class="seperate"></div>
		<div class="seperate"></div>
		<div class="row">
			<div class="col-xs-5 col-xs-offset-1">
				<p class="homely-color-gray">UNITS FOR RENT</p>
				<p class="bold homely-font-20">300</p>
			</div>
			<div class="col-xs-6">
				<div class="pull-right">
					<p class="homely-color-gray">SORT</p>
					<p class="bold">Relevance <i class="fa fa-arrow-down"></i></p>
				</div>
			</div>
		</div>
		<div class="seperate"></div>
		<div class="row homely-container-list">
			@for($i = 0; $i < 4; $i++)
				@include('common.porperty-box')
			@endfor
		</div>
	</div>
	<div class="col-xs-8">
		<div class="row">
			<div class="col-xs-4">
				<img src="images/main-page.png" class="img-responsive" alt="homely home">
			</div>
			<div class="col-xs-8">
				<div class="seperate"></div>
				<div class="seperate"></div>
				<div class="seperate"></div>
	            <div class="input-group">
	                <input id="search-input" type="text" class="form-control" placeholder="input search">
	                <!-- <div class="input-group-btn">
	                    <button class="btn btn-default btn-normal" ng-click="searchPlace()">
	                        <i class="fa fa-search"></i>
	                    </button>
	                </div> -->
	            </div>
	        </div>
		</div>
		<div class="row">
			<div class="col-xs-11">
				<div id="map" class="homely-map-list"></div>
			</div>
		</div>
	</div>
</div>
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
@endsection

@push('script')
<script type="text/javascript" src="{{ asset('js/marker-cluster-google-map.js') }}"></script>

@if( !strpos(url('/'), "com") )
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCaTGuyJD5pQKp9i2zkyhg5NJ76RH3vLlA"></script>
@else
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCkJQb0rZgsmwa7VhFVp0kkZAAi_Zm-sVY"></script>

@endif


<script type="text/javascript" src="{{ asset('js/angular/homely-map-list.js') }}"></script>
homely 1:
AIzaSyBYH_ATGvJoXiHjCgPeyKYFTu7_Eum_8VM
ghadim: 
AIzaSyCaTGuyJD5pQKp9i2zkyhg5NJ76RH3vLlA
@endpush
