var MetadataModule = angular.module('MetadataModule', []);

MetadataModule.factory('MetadataService', [ '$resource', function($resource) {
	return $resource('rest/metadata/:action/:guid', {},
		{
			loadPopularCities : {
				method : 'GET',
				params : {
					"action" : "popular-cities"
				}
			},
			loadCityList : {
				method : 'GET',
				params : {
					"action" : "city-list"
				}
			},
			loadListingMetadata : {
				method : 'GET',
				params : {
					"action" : "listing-metadata"
				}
			}
		});
} ]);