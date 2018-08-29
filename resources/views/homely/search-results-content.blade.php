

<div class="container-fluid">
	<div class="alert alert-warning" ng-if="profiles.length == 0">
		<span>@{{'search.no.results' | translate}}</span>
	</div>
	<div class="row">
		<div class="col-12 col-sm-4">
			<div class="homely-property-list-container" ng-if="profiles.length > 0">
				<div class="homely-property-list-item shadow" 
					ng-repeat="property in profiles"
					ng-click="openPropertyView(property.guid)">
					<div class="homely-property-list-gallery">
						<img ng-src="rest/attachments/image/@{{property.imageId}}" alt="property image">
						<span class="homely-property-list-index shadow">@{{ 1 + $index }}</span>
						<span class="homely-property-list-price">@{{'system.currency' | translate}} @{{property.economy.monthlyRent | danishnumber}} </span>
						<p class="homely-property-list-address">
							<i class="fas fa-map-marker-alt text-warning mr-1"></i>
							<small>@{{property.address.addressLine1}}, @{{'city.' + property.address.city | translate}} @{{property.address.postcode}}, @{{'country.' + property.address.country | translate}}</small>
						</p>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-4">
								<p class="homely-property-list-tag">BEDS</p> 
								<span class="homely-property-list-value">@{{property.bedrooms}}</span>
							</div>
							<div class="col-4 border-left">
								<p class="homely-property-list-tag">BATHS</p>
								<span class="homely-property-list-value">@{{property.baths}}</span>
							</div>
							<div class="col-4 border-left">
								<p class="homely-property-list-tag">PETHS</p>
								<span class="homely-property-list-value">@{{property.peths}}</span>
							</div>
						</div>
					</div>
				</div>
				<!-- <div ng-if="profiles.length > 0">
					<ul class="list-unstyled">
						<li class="media mb-4 shadow rounded border" ng-repeat="property in profiles"><img class="rounded-left" ng-src="rest/attachments/image/@{{property.imageId}}" style="width: 300px;">
							<div class="media-body">
								<div class="container mt-2 float-left">
									<h5 class="mt-0 mb-1 float-left btn btn-link p-0 text-dark" ng-click="openPropertyView(property.guid)">
										@{{property.alias}}, @{{'city.'+property.address.city | translate}} <i class="far fa-eye text-primary"></i>
									</h5>
									<h6 class="float-right">@{{'system.currency' | translate}} @{{property.economy.monthlyRent | danishnumber}}</h6>
								</div>
								<div class="container float-left">
									<p class="m-0">
										<i class="fas fa-map-marker-alt"></i> <small>@{{property.address.addressLine1}}</small>
									</p>
									<p class="m-0">
										<small>@{{property.description}}</small>
									</p>
								</div>
							</div>
						</li>
					</ul>
				</div> -->
			</div>
		</div>
		<div class="col-12 col-sm-8">
			<div class="row">
				<div class="col-6 col-sm-3">
					<img src="resources/img/home.png" class="img-fluid" alt="homely">
				</div>
			</div>
			<div ng-controller="GoogleMapsListController">
				<div class="map shadow map-list" id="property-list-map"></div>
			</div>
		</div>
	</div>
</div>