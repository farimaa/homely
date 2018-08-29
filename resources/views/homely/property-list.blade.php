<div ng-controller="SearchResultListingController" class="container-fluid" ng-init="searchProperties()">

<div class="alert alert-warning" ng-if="profiles.length == 0">
	<span>{{'search.no.results' | translate}}</span>
</div>

<div ng-if="profiles.length > 0">
	<div class="row">
		<div class="col">
			<h4>{{'city.' + city | translate}}</h4>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<div class="card shadow">
				<div class="card-header">
					<strong>{{'properties.listing.filter' | translate}}</strong>
				</div>
				<div class="card-body">
				</div>
			</div>
		</div>
		<div class="col-10">
			<ul class="list-unstyled">
				<li class="media mb-4 shadow rounded border" ng-repeat="property in profiles">
					<img class="rounded-left" ng-src="rest/attachments/image/{{property.imageId}}" style="width: 300px;">
					<div class="media-body">
						<div class="container mt-2 float-left">
							<h5 class="mt-0 mb-1 float-left btn btn-link p-0 text-dark" ng-click="openPropertyView(property.guid)">{{property.alias}}, {{'city.'+property.address.city | translate}} <i class="far fa-eye text-primary"></i></h5>
							<h6 class="float-right">{{'system.currency' | translate}} {{property.economy.monthlyRent | danishnumber}}</h6>
						</div>
						<div class="container float-left">
							<p class="m-0"><i class="fas fa-map-marker-alt"></i> <small>{{property.address.addressLine1}}</small></p>
							<p class="m-0"><small>{{property.description}}</small></p>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
</div>