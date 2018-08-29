@extends('layout.master')
@section('title', 'Homely')
@section('keywords', 'Homely,buy home,rent home')
@section('description', 'Homely description will update soon')
@section('image', '/images/logo.png')
@section('container-fluid')

<div class="seperate"></div>
<div class="seperate"></div>
<div class="row">
	<div class="col-xs-12">
		<img src="images/main-page.png" class="homely-center-img" alt="homely home">
	</div>
</div>
<div class="seperate"></div>
<div class="seperate"></div>
<div class="row">
	<div class="col-xs-12">
		<h1 class="bold text-center homely-color-black">
			Hello! Where do you want to live?
		</h1>
	</div>
</div>
<div class="seperate"></div>
<div class="row">
	<div class="col-xs-8 col-xs-offset-2">
		<div class="homely-input-group">
			<span>
				<i class="fa fa-search"></i>
			</span>
			<input type="text" placeholder="Search by location of point of interest">
			<button class="homely-btn homely-red homely-btn-lg">
				SEARCH
			</button>
		</div>
	</div>
</div>

<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>

<div class="row text-center">
	<div class="col-xs-12">
		<h1 class="homely-color-black bold">
			The Most Popular Cities
		</h1>
	</div>
</div>
<div class="row homely-bg-blue">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<h3>
					Find your dream place now!
				</h3>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
				<i class="fa fa-star"></i>
			</div>
		</div>
		<div class="seperate"></div>
		<div class="row">
			@for($i = 0; $i < 9; $i++)
				<div class="col-xs-4">
					<div class="homely-card">
						<img src="{{ asset('images/sample-image-1.png') }}" alt="sample image" class="">
					</div>
					<div class="seperate"></div>
					<div class="seperate"></div>
				</div>
			@endfor
		</div>
	</div>
</div>
@endsection