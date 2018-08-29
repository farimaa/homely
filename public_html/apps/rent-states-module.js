var RentStatesModule = angular.module('RentStatesModule', []);

RentStatesModule.factory('OffersService', [ '$resource', function($resource) {
	return $resource('rest/workflow/offers/:action/:guid/:propertyGuid', {},
		{
			makeOffer : {
				method : 'PUT',
				params : {
					"action" : "create"
				}
			},
			accept : {
				method : 'POST',
				params : {
					"action" : "accept"
				}
			},
			reject : {
				method : 'POST',
				params : {
					"action" : "reject"
				}
			},
			cancel : {
				method : 'POST',
				params : {
					"action" : "cancel"
				}
			},
			loadAllRentStatesForTenant : {
				method : 'GET',
				params : {
					"action" : "load-tenant-all"
				}
			},
			loadPropertyRentStateForTenant : {
				method : 'GET',
				params : {
					"action" : "load-tenant"
				}
			},
			loadAllRentStatesForLandlord : {
				method : 'GET',
				params : {
					"action" : "load-landlord"
				}
			}
		});
} ]);