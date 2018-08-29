

<div ng-controller="PropertyViewController" class="container">
	<div class="homely-property-view-background">
		<img src="resources/img/property/property-background.png" alt="backgound">
	</div>
	<div class="spacer-1"></div>
	<div class="row text-white">
		<div class="col-12 col-md-9 col-sm-8 white-color">
			<span>
				<i class="fas fa-clock text-orange mr-1"></i>
				LISTED 14 DAYS AGO <!-- @todo (need translate) -->
			</span>
			<span class="ml-4">
				<i class="fas fa-map-marker-alt text-warning mr-1"></i>
				<small>@{{property.address.addressLine1}}, @{{'city.' + property.address.city | translate}} @{{property.address.postcode}}, @{{'country.' + property.address.country | translate}}</small>
			</span>
		
			<h1 class="mt-3">@{{property.alias}} sampleText </h1>
			<div class="spacer-5"></div>
			<div class="row">
				<div class="col-12">
					<span class="text-uppercase text-semi-muted">@{{'property.view.description' | translate}}</span>
				</div>
			</div>
			<div class="spacer-1"></div>
			<div class="row">
				<div class="col-12 col-sm-7 col-md-8">
					<p class="homely-property-description">
						@{{property.description}} 
						sampleText sampleText sampleText sampleText sampleText
						sampleText sampleText sampleText sampleText sampleText 
						sampleText sampleText sampleText sampleText sampleText
						sampleText sampleText sampleText sampleText sampleText
						<span class="btn btn-link m-0 p-0 text-orange font-14px">
							Read more.. <!-- @todo (need translate) -->
						</span>
					</p>
				</div>
				<div class="col-8 col-sm-5 col-md-4">
					<div class="media">
  						<img class="mr-3 rounded-circle w-50 h-50" src="resources/img/user.png" alt="homely user image">
  						<div class="media-body">
							<div class="text-uppercase text-semi-muted">
								<small>@{{'property.view.owner' | translate}}</small>
							</div>
							<span class="single-line">@{{owner.displayName}} sampleText </span>
							<small class="text-semi-muted">sampleText</small>
							<div class="spacer-1"></div>
							<span class="btn btn-link m-0 p-0 text-orange">
								<small class="text-overflow">@{{'property.view.contact' | translate}}</small>
								<i class="fa fa-arrow-circle-right font-14px ml-1"></i>
							</span>
  						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-12 col-md-3 col-sm-4">
			<div class="card shadow homely-card no-border">
				<div class="card-body text-right">
					<table class="float-right">
						<tr>
							<td><div class="text-muted">@{{'listing.monthly.rent' | translate}}:</div></td>
							<td>@{{'system.currency' | translate}}</td>
							<td>@{{property.economy.monthlyRent | danishnumber}}</td>
						</tr>
						<tr>
							<td><div class="text-muted">@{{'listing.utilities' | translate}}:</div></td>
							<td>@{{'system.currency' | translate}}</td>
							<td>@{{property.economy.utilities | danishnumber}}</td>
						</tr>
						<tr>
							<td><div class="text-muted">@{{'listing.deposit' | translate}}:</div></td>
							<td>@{{'system.currency' | translate}}</td>
							<td>@{{property.economy.deposit | danishnumber}}</td>
						</tr>
						<tr>
							<td><div class="text-muted">@{{'listing.advance.rent' | translate}}:</div></td>
							<td>@{{'system.currency' | translate}}</td>
							<td>@{{property.economy.advanceRent | danishnumber}}</td>
						</tr>
						<tr>
							<td colspan=3><hr></td>
						</tr>
						<tr>
							<td></td>
							<td>@{{'system.currency' | translate}}</td>
							<td>@{{property.economy.totalOnMoveIn | danishnumber}}</td>
						</tr>
					</table>
					<div class="spacer-1"></div>
					<span class="text-muted">AVAILABLE <!-- @todo (need translate) --></span>
					<div class="text-orange bold font-24px">
						Right Now <!-- @todo (need translate) -->
					</div>
				</div>
				<div class="spacer-1"></div>
				<button type="button" 
					class="homely-btn homely-btn-secondary homely-card-footer-btn font-24px bold"
					ng-disabled="!isMakingOfferAvailable()" 
					ng-click="makeOffer()">
					@{{'property.view.button.offer' | translate}}
				</button>
			</div>
		</div>
	</div>
	<div class="spacer-5"></div>
	<div class="spacer-5"></div>
	<div class="spacer-5"></div>
	<div class="row">
		<div class="col-12 col-sm-6 col-md-8">
			@include('homely.gallery')
		</div>
		<div class="col-12 col-sm-6 col-md-4">
			<div class="card shadow homely-card no-border">
				<div class="card-body text-center">
					<div class="spacer-3"></div>
					<i class="fa fa-building text-gray font-72px"></i>
					<div class="spacer-1"></div>
					<p class="text-black bold font-36px">Tour Date <!-- @todo (need translate) --></p>
				</div>
				<div class="spacer-1"></div>
				<button class="homely-btn homely-btn-secondary homely-card-footer-btn font-24px bold" 
					type="button" ng-click="scheduleTour()">
					@{{'property.view.button.scheduleTour' | translate}}
				</button>
			</div>			
		</div>
	</div>
	<div class="spacer-3"></div>
	<div class="row">
		<div class="col-12 col-md-8">
			<p class="bold text-black text-center font-36px mb-0">@{{'listing.group.amenities' | translate}}</p>
			<p class="text-center text-orange bold">EVERYTHING YOU NEED <!-- @todo (need translate) --></p>
			<div class="spacer-2"></div>
			<div class="row text-center">
				<!-- just for testing css -->
				<div class="col-4">
					<i class="fas fa-check-circle homely-amenities-check"></i>
					<i class="fas fa-parking font-72px text-gray"></i>
					<p class="text-black bold mt-1">
						Washer/Dryer
					</p>
				</div>
				<div class="col-4">
					<i class="fas fa-check-circle homely-amenities-check"></i>
					<i class="fas fa-car font-72px text-gray"></i>
					<p class="text-black bold mt-1">
						Air Condition
					</p>
				</div>
				<div class="col-4">
					<i class="fas fa-check-circle homely-amenities-check"></i>
					<i class="fa fa-fire-extinguisher font-72px text-gray"></i>
					<p class="text-black bold mt-1">
						Dishwasher
					</p>
				</div>
				<!-- just for testing css -->
				<div class="col-4" ng-repeat="(amenityKey, amenityValue) in property.amenities"
					ng-if="amenityValue">
					<i class="fas fa-check-circle homely-amenities-check"></i>
					<i class="@{{getIcon(amenityKey)}} font-72px text-gray"></i>
					<p class="text-black bold mt-1">
						@{{'listing.amenities.' + amenityKey | translate}}</p>
				</div>
				<!-- <span class="col-2 text-success" ng-repeat="(amenityKey, amenityValue) in property.amenities" ng-if="amenityValue">
					<i class="@{{getIcon(amenityKey)}}"></i>
					<small>@{{'listing.amenities.' + amenityKey | translate}}</small>
				</span> -->
			</div>
		</div>
	</div>
	<div class="spacer-3"></div>
	<div class="row">
		<div class="col-12 col-md-8">
			<p class="bold text-black text-center font-36px mb-0">@{{'property.view.map' | translate}}</p>
			<p class="text-center text-orange bold">PROPERTY LOCATION <!-- @todo (need translate) --></p>
			<div class="spacer-1"></div>
			<div class="text-center homely-btn-on-map">
				<button class="homely-btn homely-btn-secondary shadow bold">
					<span class="p-5">MAP VIEW</span> | <span class="p-5 opacity-50">STREET VIEW</span>
				</button> <!-- @todo (need translate) -->
			</div>
			<div ng-controller="GoogleMapsController">
				<div class="map shadow" id="property-view-map"></div>
			</div>

			<p class="mt-2">
				<i class="fas fa-map-marker-alt text-warning mr-1"></i>
				<small>@{{property.address.addressLine1}}, @{{'city.' + property.address.city | translate}} @{{property.address.postcode}}, @{{'country.' + property.address.country | translate}}</small>
			</p>
		</div>
	</div>
</div>