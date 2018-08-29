var PaymentsModule = angular.module('PaymentsModule', []);

PaymentsModule.factory('PaymentsService', [ '$resource', function($resource) {
	return $resource('rest/payments/:action/:guid', {},
		{
			loadPaymentMethods : {
				method : 'GET',
				params : {
					"action" : "methods"
				}
			},
			savePaymentMethods : {
				method : 'POST',
				params : {
					"action" : "methods"
				}
			}
		});
} ]);