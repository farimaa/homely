var PropertyModule = angular.module('PropertyModule', []);

PropertyModule.factory('PropertyService', ['$resource', function($resource) {
	return $resource('rest/property/:action/:landlordGuid/:propertyGuid', {}, 
		{
			loadAll: {
				method: 'GET',
				params : {
					"action" : "landlord-all"
				}
			},
			search: {
				method: 'GET',
				params : {
					"action" : "search"
				}
			},
			searchByCityPublished: {
				method: 'GET',
				params : {
					"action" : "search-published"
				}
			},
			create: {
				method: 'PUT',
				params : {
					"action" : "create"
				}
			},
			update: {
				method: 'POST',
				params : {
					"action" : "update"
				}
			},
			loadProperty: {
				method: 'GET',
				params: {
					"action": "load-property"
				}
			}
		});
}]);