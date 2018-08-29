<div class="container">
	<div class="row">
		<div class="col-10 offset-1 col-sm-6 offset-sm-3">
			<img src="resources/img/home.png" class="img-fluid">
			<div class="spacer-3"></div>
		</div>
		<div class="col-12 text-center margin-auto">
			<h1 class="bold text-black">@{{'welcome.header' | translate}}</h1>
		</div>
	</div>
	<div class="spacer-2"></div>
	<form name="loginForm" ng-submit="searchProperties()" novalidate>
		<div class="row">
			<div class="col-12 col-sm-10 offset-sm-1">
				<div class="row homely-search-box">
					<div class="col-1 col-sm-1 text-center">
                        <i class="fas fa-search homely-search-icon"></i>
					</div>
					<div class="col-8 col-sm-8">
						<input name="text" ng-model="search.searchString" class="homely-search-input" placeholder="'@{{welcome.search.placeholder' | translate}}">
					</div>
					<div class="col-3 col-sm-3 p-0">
						<button class="homely-btn homely-btn-secondary homely-search-button p-4" type="submit">
							@{{'welcome.search.button' | translate}}
						</button>
					</div>
				</div>
				<div class="spacer-2"></div>
				<div class="row">
					<div class="offset-1 col-10">
						<div class="font-12px no-decoration text-orange">
							<span class="bold">@{{'welcome.search.recent' | translate}}:</span>
							<a href="javascript:void(0)">COPENHAGEN</a> |
							<a href="javascript:void(0)">AARHUS</a> |
							<a href="javascript:void(0)">ODENSE</a> |
							<a href="javascript:void(0)">VEJLE</a> |
							<a href="javascript:void(0)">AALIBORD</a> |
							<a href="javascript:void(0)">ROSKILDE</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="spacer-5"></div>
	<div class="spacer-5"></div>
</div>
<div class="homely-welcome-middle-background">
	<div class="container ">
		<!-- most popular section -->
		<div class="row text-center">
			<div class="col-12">
				<h2 class="text-black bold">The Most Popular Cities</h2>
				<div class="spacer-1"></div>
				<p class="text-orange bold font-20px">Find your dream place now!</p>
				<div class="star-box">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
				</div>
			</div>
		</div>
		<div class="spacer-2"></div>
		<div class="row" ng-if="popularCities">
			<div ng-repeat="city in popularCities" class="col-md-4 col-sm-6 col-12 btn btn-link" ng-click="searchByCityKey(city.key)">
				<div class="homely-popular-city">
					<img src="resources/img/cities/@{{city.key}}.jpg" alt="Card image cap">
					<p>@{{'city.' + city.key | translate}}</p>
					<div class="homely-overlay"></div>
				</div>
			</div>
		</div>
		<div class="spacer-5"></div>
	</div>
</div>