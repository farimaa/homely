<div class="container">
	<button type="button" ng-click="goBack()" class="btn btn-outline-secondary">@{{'system.return' | translate}}</button>
	<div style="margin-bottom: 10px;"></div>
	<button type="button" ng-click="runFilter()" class="btn btn-outline-success">@{{'search.filter.go' | translate}}</button>
	<button type="button" ng-click="clearFilter()" class="btn btn-outline-secondary">@{{'search.filter.clear' | translate}}</button>
</div>
<div style="margin-bottom: 10px;"></div>
<div class="container-fluid">
<div class="row">
<div class="col">
	<form name="searchForm" novalidate>
		<uib-accordion close-others="false" style="font-size: smaller;">
			<div uib-accordion-group is-open="true">
				<uib-accordion-heading>
					<small>@{{'listing.group.details' | translate}}</small>
				</uib-accordion-heading>
				<div>
					@{{selectedProperty}}
					<div class="form-group">
						<label>@{{'listing.type' | translate}}</label> 
						<div  ng-repeat="pt in propertyTypes">
							<label>
								<input ng-model="selectedProperty.propertyTypes[pt]" 
									type="checkbox"  />
									@{{'listing.type.' + pt | translate}}
							</label>
						</div>
					</div>

					<label>@{{'listing.bedrooms' | translate}}</label>
					<div class="form-row">
						<div class="form-group col-4">
							<input name="bedrooms" ng-model="selectedProperty.bedroomsmin" ng-pattern="/^[0-9]\d{0,1}$/" 
							class="form-control" placeholder="Min"
							/>
						</div>
						<div class="form-group col-4">
							<input name="bedrooms" ng-model="selectedProperty.bedroomsmax" ng-pattern="/^[0-9]\d{0,1}$/" 
							class="form-control" placeholder="Max"
							/>
						</div>
					</div>
					
					<label>@{{'listing.area' | translate}}</label>
					<div class="form-row">
						<div class="form-group col-4">
							<input danishnumber name="area" ng-model="selectedProperty.areamin" 
							class="form-control" placeholder="Min"
							/>
						</div>
						<div class="form-group col-4">
							<input danishnumber name="area" ng-model="selectedProperty.areamax" 
							class="form-control" placeholder="Max"
							/>
						</div>
					
					</div>

					<div class="form-group">
						<label>@{{'listing.animals' | translate}}</label> 
						<select name="animalPolicy" 
							class="form-control" 
							ng-model="selectedProperty.animalPolicy" 
							ng-options="ap as 'listing.animals.'+ap|translate for ap in animalPolicies">
								<option></option>
						</select>
					</div>
				
				</div>
		    </div>
			
			<div uib-accordion-group is-open="true">
				<uib-accordion-heading>
					<small>@{{'listing.group.address' | translate}}</small>
				</uib-accordion-heading>
				<div>
					<div class="form-group">
						<label>@{{'listing.address.postcode' | translate}}</label>
						<input name="postcode" ng-model="selectedProperty.address.postcode" ng-pattern="/^\d{4}$/" 
							class="form-control"  />
					</div>

					<div class="form-group">
						<label>@{{'listing.address.city' | translate}}</label> 
						<div  ng-repeat="city in cities">
							<label>
								<input ng-model="selectedProperty.cities[city.key]" 
									type="checkbox"  />
									@{{'city.' + city.key | translate}}
							</label>
						</div>
					</div>

					<div class="form-group">
						<label>@{{'listing.address.city' | translate}}</label> 
						<select required name="city" class="form-control" 
							ng-model="selectedProperty.address.city" ng-options="city.key as 'city.'+city.key|translate for city in cities">
							<option></option>
						</select>
					</div>
				</div>
			</div>
			
			<div uib-accordion-group is-open="true">
				<uib-accordion-heading>
					<small>@{{'listing.group.economy' | translate}}</small>
				</uib-accordion-heading>
				<div>
					<div class="form-group">
						<label>@{{'listing.monthly.rent.max' | translate}}</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">@{{'system.currency' | translate}}</span>
							</div>
							<input danishnumber name="monthlyRent" ng-model="selectedProperty.economy.monthlyRent.max" 
								 class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label>@{{'listing.total.on.move.in.max' | translate}}</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">@{{'system.currency' | translate}}</span>
							</div>
							<input danishnumber ng-model="selectedProperty.economy.totalOnMoveIn" class="form-control" />
						</div>
					</div>
				</div>
			</div>

			<div uib-accordion-group is-open="true">
				<uib-accordion-heading>
					<small>@{{'listing.group.amenities' | translate}}</small>
				</uib-accordion-heading>
				<div  ng-repeat="amn in amenities">
						<label>
							<input ng-model="selectedProperty.amenities[amn]" 
								type="checkbox"  />
								@{{'listing.amenities.' + amn | translate}}
						</label>
				</div>
			</div>		
						
		</uib-accordion>
	</form>
</div>
</div>
</div>
