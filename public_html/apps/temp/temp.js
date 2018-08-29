
// MainApp.controller('MapController', [ 'Map', '$rootScope', '$scope', '$location', '$translate', 'MessagesService', 'SecurityService', 
// 	function(Map, $rootScope, $scope, $location, $translate, MessagesService, SecurityService) {
// 	Map.init(); // init the map
//     Map.initCheckBounds(); // check changing map zoom and position, and send bound of map to server
//     Map.getMarkers(); // get properties from server and show with clustering
//     Map.searchPlace(); // input search will have autocomplete and input will bind with map 
//     // Map.findMyLocation();  // find user location with navigator.geolocation
// }]);

MainApp.controller('MapsController', ['$rootScope', '$scope', 'MapsService',
	function($rootScope, $scope, MapsService) {
		// $scope.alerts = MapsService.alerts;
		// $scope.maxMessages = MapsService.maxMessages;

		// $scope.removeAlert = function(idx) {
		// 	$scope.alerts.splice(idx, idx + 1);
		// };
		// $scope.init();
	} 
]);

MainApp.controller('Maps1Controller', ['$scope',
	function($scope) {
		// $scope.alerts = MapsService.alerts;
		// $scope.maxMessages = MapsService.maxMessages;
		console.log(1);	
	} 
]);