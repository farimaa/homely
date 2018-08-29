var MapsModule = angular.module('MapsModule', []);



MapsModule.factory('MapsService', [ '$resource', function($resource) {
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

// var MapsModule = angular.module('MapsModule', []);

// MapsModule.controller('MapsController', ['$scope', 'MapsService',
// 	function($scope, MapsService) {
// 		// $scope.alerts = MapsService.alerts;
// 		// $scope.maxMessages = MapsService.maxMessages;

// 		$scope.removeAlert = function(idx) {
// 			$scope.alerts.splice(idx, idx + 1);
// 		};
// 	} 
// ]);

// MapModule.factory('MapService', [ '$resource', function($resource, $q, $http) {
//     return $resource('rest/metadata/:action/:guid', {},
//         {
//             loadPopularCities : {
//                 method : 'GET',
//                 params : {
//                     "action" : "popular-cities"
//                 }
//             },
//             loadCityList : {
//                 method : 'GET',
//                 params : {
//                     "action" : "city-list"
//                 }
//             },
//             loadListingMetadata : {
//                 method : 'GET',
//                 params : {
//                     "action" : "listing-metadata"
//                 }
//             }
//         });
// } ]);

// MapsModule.factory('MapsService', ['$window', '$q',
//     function ($window, $q) {

//         var deferred = $q.defer();

//         // Load Google map API script
//         function loadScript() {
//             var script = document.createElement('script');
//             script.src = '//maps.googleapis.com/maps/api/js?sensor=false&language=en&callback=initMap';

//             document.body.appendChild(script);
//         }

//         // Script loaded callback, send resolve
//         $window.initMap = function () {
//             deferred.resolve();
//         }

//         loadScript();

//         return deferred.promise;
//     }
// ]);



// angular.module("myApp")
//     .service('loadGoogleMapAPI', ['$window', '$q',
//         function ($window, $q) {

//             var deferred = $q.defer();

//             // Load Google map API script
//             function loadScript() {
//                 // Use global document since Angular's $document is weak
//                 var script = document.createElement('script');
//                 script.src = '//maps.googleapis.com/maps/api/js?sensor=false&language=en&callback=initMap';

//                 document.body.appendChild(script);
//             }

//             // Script loaded callback, send resolve
//             $window.initMap = function () {
//                 deferred.resolve();
//             }

//             loadScript();

//             return deferred.promise;
//         }]);



// MapsModule.factory('MapsService', [ '$resource', function($resource) {
// 	return $resource('rest/payments/:action/:guid', {},
// 		{
// 			loadPaymentMethods : {
// 				method : 'GET',
// 				params : {
// 					"action" : "methods"
// 				}
// 			},
// 			savePaymentMethods : {
// 				method : 'POST',
// 				params : {
// 					"action" : "methods"
// 				}
// 			}
// 		});
// } ]);

// MapsModule.factory('MapsService', [ function() {
// 	var res = {};
// 	res.alerts = [];
// 	res.maxMessages = 3;

// 	res.addError = function(message) {
// 		res.addMessage(message, 'alert alert-dismissible alert-danger');
// 	};

// 	res.addWarning = function(message) {
// 		res.addMessage(message, 'alert alert-dismissible alert-warning');
// 	};

// 	res.addSuccess = function(message) {
// 		res.addMessage(message, 'alert alert-dismissible alert-success');
// 	};

// 	res.addInfo = function(message) {
// 		res.addMessage(message, 'alert alert-dismissible alert-info');
// 	};

// 	res.addMessage = function(message, type) {
// 		res.alerts.push({
// 			'type' : type,
// 			'message' : (res.getTime() + " - " + message)
// 		});
// 		if (res.alerts.length > res.maxMessages) {
// 			res.alerts.splice(0, 1);
// 		}
// 	}

// 	res.removeAlert = function(idx) {
// 		res.alerts.splice(ind, 1);
// 		res.alerts = res.alerts.slice(0);
// 	};

// 	res.getTime = function() {
// 		var date = new Date();
// 		var hh = date.getHours();
// 		var mm = date.getMinutes();
// 		var ss = date.getSeconds();
// 		// These lines ensure you have two-digits
// 		if (hh < 10) {
// 			hh = "0" + hh;
// 		}
// 		if (mm < 10) {
// 			mm = "0" + mm;
// 		}
// 		if (ss < 10) {
// 			ss = "0" + ss;
// 		}
// 		// This formats your string to HH:MM:SS
// 		var t = hh + ":" + mm + ":" + ss;
// 		return t;
// 	}

// 	return res;
// } ]);

