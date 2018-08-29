MainApp = angular.module('MainApp', [ 'ngRoute', 'ngResource', 'ui.bootstrap', 'pascalprecht.translate', 'angularFileUpload',
		'UtilModule', 'SecurityModule', 'AttachmentsModule', 'MetadataModule', 'PropertyModule', 'PaymentsModule', 'RentStatesModule',
		'GoogleMapsModule']);

MainApp.config([ '$translateProvider', '$routeProvider', function($translateProvider, $routeProvider) {

	console.log("configuring...");

	//route
	$routeProvider
		.when("/login", {
			templateUrl : "views/login.do"
		})
		.when("/register", {
			templateUrl : "views/register.do"
		})
		.when("/profile", {
			templateUrl : "views/profile.do",
			controller : "ProfileController"
		})
		.when("/email-confirmed", {
			templateUrl : "views/email-confirmed.do"
		})
		.when("/email-confirmation-error", {
			templateUrl : "views/email-confirmation-error.do"
		})
		.when("/recover-password", {
			templateUrl : "views/recover-password.do"
		})
		.when("/listings", {
			templateUrl : "views/listings.do"
		})
		.when("/offer/:propertyGuid/:ownerGuid", {
			templateUrl : "views/offer.do",
			controller: "MakingOfferController"
		})
		.when("/bookings", {
			templateUrl : "views/bookings.do",
			controller: "BookingsController"
		})
		.when("/tenant/bookings", {
			templateUrl : "views/tenant-bookings.do",
			controller: "TenantBookingsController"
		})
		.when("/manage-listing/:propertyGuid", {
			templateUrl : "views/manage-listing.do"
		})
		.when("/manage-listing/gallery/:propertyGuid", {
			templateUrl : "views/manage-gallery.do"
		})
		.when("/search/:city", {
			templateUrl : "views/search-results.do",
			controller : "SearchResultListingController"
		})
		.when("/property/:propertyGuid", {
			templateUrl : "views/property-view.do"
		})
		.when("/payment-methods/:landlordGuid", {
			templateUrl : "views/payment-methods.do",
			controller : "PaymentMethodsController"
		})
		.when("/welcome", {
			templateUrl : "views/welcome.do",
			controller : "WelcomeController"
		})
		.when("/", {
			templateUrl : "views/welcome.do",
			controller : "WelcomeController"
		});

	//translation
	$translateProvider.useStaticFilesLoader({
		prefix : 'rest/i18n/ui-translations-',
		suffix : ''
	});

	$translateProvider.preferredLanguage('en');
	$translateProvider.useSanitizeValueStrategy('escape');
} ]);

MainApp.controller('HeaderController', [ '$rootScope', '$scope', '$translate', 'SecurityService', function($rootScope, $scope, $translate, SecurityService) {

	console.log("Inside header controller");

	$scope.status = {
		isopen : false
	};

//	$scope.toggled = function(open) {
//		//console.log('Dropdown is now: ', open);
//	};

//		$scope.toggleDropdown = function($event) {
//			$event.preventDefault();
//			$event.stopPropagation();
//			$scope.status.isopen = !$scope.status.isopen;
//		};

	$scope.appendToEl = angular.element(document.querySelector('#dropdown-long-content'));

	$scope.setLanguage = function(language) {
		console.log("Selected language: " + language);
		$translate.use(language);
	};
	
	var languageMap = {
			'en' : 'En',
			'da' : 'Da'
	};
	
	$scope.getCurrentLanguage = function() {
		return languageMap[$translate.use()];
	};

	$scope.logout = function() {
		console.log("Going to log out");
		SecurityService.logout(function(results) {
			console.log("Successfully logged out");
			$rootScope.currentUser = null;
			$scope.loadCurrentUser();
			$scope.navigate('/');
		}, function(error) {
			console.log("Log out error");
			MessagesService.addError("Cannot logout");
		});
	};

} ]);


MainApp.controller('MainAppController', [ '$rootScope', '$scope', '$location', 'SecurityService', 'MessagesService', function($rootScope, $scope, $location, SecurityService, MessagesService) {
	$scope.loadCurrentUser = function() {
		console.log("Loading current user");
		SecurityService.loadCurrentUser(function(result) {
			$rootScope.currentUser = result.currentUser;
		}, function(error) {
			MessagesService.error("Cannot load current user");
		});
	};
	$scope.loadCurrentUser();

	$scope.passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
	$scope.test = "Inside angular";
	$rootScope.currentUser = null;

	$scope.navigate = function(path) {
		console.log("Navigating to: " + path);
		$location.path(path);
	};

	 $scope.goBack = function() {
		console.log(window.history.length);
		if (window.history.length > 1){
			console.log("going back...");
			window.history.back();
		} else {
			console.log("navigating to root");
			$scope.navigate("/");
		}
	 };
	
	$scope.getCurrentUser = function() {
		return $rootScope.currentUser;
	};

	$scope.loadUserById = function(guid) {
		SecurityService.loadUserById({
			"userId": guid
		}, function(result) {
			return result.userProfile;
		}, function(error) {
			MessagesService.addError("Cannot load user profile. Status: " + error.status);
		});
	};
	
	$scope.hasRole = function (role) {
		if ($rootScope.currentUser == null){
			return undefined;
		}
		for (i = 0; i < $rootScope.currentUser.authorities.length; i++){
			if ($rootScope.currentUser.authorities[i].authority == role){
				return true;
			}
		}
		return false;
	};
	
} ]);


MainApp.controller('RegisterLoginController', [ '$rootScope', '$scope', '$location', 'MessagesService', 'SecurityService', function($rootScope, $scope, $location, MessagesService, SecurityService) {

	$scope.profileTypes = ['landlord', 'tenant'];
	
	$scope.loginData = {};
	$scope.newProfile = {};

	$scope.authenticate = function() {
		console.log("trying authentication " + angular.toJson($scope.loginData));
		SecurityService.login(
			{
				'email' : $scope.loginData.email,
				'password' : $scope.loginData.password,
				'remember-me' : 'true'
			},
			{}, function(result) {
				$rootScope.currentUser = result.currentUser;
				//MessagesService.addSuccess("Logged in");
				$scope.navigate("/");
			}, function(error) {
				MessagesService.addError("Cannot log in");
			}
		);
	};

	$scope.setProfileType = function(profileType) {
		$scope.newProfile.profileType = profileType;
	};

	$scope.registerProfile = function() {
		console.log("registering profile");
		SecurityService.register(
			{
				'profileType' : $scope.newProfile.profileType,
				'email' : $scope.newProfile.email,
				'password' : $scope.newProfile.password,
				'displayName' : $scope.newProfile.displayName
			}, function(result) {
				$rootScope.currentUser = result.currentUser;
				$scope.loadCurrentUser();
				$scope.navigate("/");
			}, function(error) {
				console.log(angular.toJson(error.data));
				MessagesService.addError("Cannot register profile. Status: " + error.status);
			}
		);
	};

	$scope.checkEmail = function(email) {
		console.log("going to check email availability on server");
	};

} ]);

MainApp.controller('ProfileController', [ '$rootScope', '$scope', '$location', '$translate', 'MessagesService', 'SecurityService', 
		function($rootScope, $scope, $location, $translate, MessagesService, SecurityService) {
	console.log("Inside profile controller");

	if ($scope.getCurrentUser().guest){
		console.log("Need to navigate away");
		$scope.navigate("/");
		return;
	}
	
	$scope.profile = {};
	$scope.profile.profileType = $rootScope.currentUser.profileType;
	$scope.profile.username = $rootScope.currentUser.username;
	$scope.profile.displayName = $rootScope.currentUser.displayName;
	$scope.profile.emailConfirmed = $rootScope.currentUser.emailConfirmed;

	$scope.resendConfirmationEmail = function () {
		SecurityService.resendConfirmationEmail (function(result){
			MessagesService.addSuccess($translate.instant("profile.email.confirmation.sent"));
		}, function(error){
			MessagesService.addError("Cannot re-send confirmation email");
		})
	};
	
	$scope.updateProfile = function(){
		console.log("Updating profile");
		SecurityService.updateProfile({
			'displayName' : $scope.profile.displayName,
			'currentPassword' : $scope.profile.currentPassword,
			'newPassword' : $scope.profile.newPassword 
		}, function(result){
			$scope.loadCurrentUser();
			MessagesService.addSuccess($translate.instant("profile.update.success"));
		}, function(error){
			if (error.status == 403 || error.status == 401){
				MessagesService.addError($translate.instant("profile.update.error.forbidden") + " - "+ error.status);
			} else {
				MessagesService.addError($translate.instant("profile.update.error.general") + " - "+ error.status);
			}
		});
	};
	
} ]);

MainApp.controller('GalleryController', ['$rootScope', '$scope', 'AttachmentsService', function($rootScope, $scope, AttachmentsService) {
//	here should be propertyGuid 
	$scope.propertyGuid = $rootScope.selectedPropertyGuid;
	$scope.myInterval = 5000;
	$scope.noWrapSlides = false;
	$scope.active = 0;
	
	$scope.getSlides = function() {
		AttachmentsService.loadSlides(
				{
					'guid': $scope.propertyGuid
				}, function(result) {
					$scope.slides = result.slides;
				}, function(error) {
					MessagesService.addError("Cannot load gallery. Status: " + error.status);
				}
		);
	};
}]);

MainApp.controller('ImagesManagementController', ['$rootScope', '$scope', '$routeParams', 'AttachmentsService', 'PropertyService', function($rootScope, $scope, $routeParams, AttachmentsService, PropertyService) {
	$scope.propertyGuid = $routeParams.propertyGuid;
	$scope.uploadedFiles = {};
	
	$scope.loadAttachmentDescriptors = function() {
		AttachmentsService.loadAttachmentDescriptors(
				{
					'guid': $scope.propertyGuid
				}, function(result) {
					$scope.attachmentDescriptors = result.attachmentDescriptors;
				}, function(error) {
					MessagesService.addError("Cannot load images. Status: " + error.status);
				}
		);
	};
	
	$scope.$watch('uploadedFiles.result', function(newValue, oldValue) {
		if (newValue != oldValue) {
			$scope.loadAttachmentDescriptors();
		}
	});
	
	$scope.updateAttachmentDescriptor = function(ad) {
		AttachmentsService.updateAttachmentDescriptor({}, ad, 
				function(error) {
					MessagesService.addError("Cannot update descriptor. Status: " + error.status);
				}
		);
	};
	
	$scope.deleteImage = function(guid) {
		AttachmentsService.deleteImage(
				{
					'guid': guid
				}, function(result) {
					$scope.loadAttachmentDescriptors();
				}, function(error) {
					MessagesService.addError("Cannot delete images. Status: " + error.status);
				}
		);
	};
	
	$scope.makePrimaryImage = function(adGuid) {
		$scope.selectedProperty.imageId = adGuid;
		PropertyService.update({
			"landlordGuid": $scope.selectedProperty.ownerGuid
		}, $scope.selectedProperty, function(result) {
			$scope.selectedProperty = result.profile;
			$rootScope.selectedProperty = $scope.selectedProperty;
		}, function(error) {
//			MessagesService.addError("Cannot save property profile. Status: " + error.status);
		});
	};
	
	$scope.back = function() {
		$scope.navigate('manage-listing/' + $routeParams.propertyGuid);
	};

	$scope.loadProperty = function() {
		PropertyService.loadProperty({
			"propertyGuid": $routeParams.propertyGuid
		}, function(result) {
			$scope.selectedProperty = result.property;
		}, function(error) {
			MessagesService.addError("Cannot load property. Status: " + error.status);
		});
	};
	
	$scope.loadProperty();

}]);

MainApp.controller('PropertiesListingController', ['$rootScope', '$scope', '$location', 'AttachmentsService', 'PropertyService', function($rootScope, $scope, $location, AttachmentsService, PropertyService) {
	$scope.landlordGuid = $rootScope.currentUser.guid;
	$scope.search = {};
	
	$scope.loadListing = function() {
		PropertyService.loadAll({
			"landlordGuid": $scope.landlordGuid
		}, function(result) {
			$scope.profiles = result.profiles;
		}, function(error) {
			MessagesService.addError("Cannot load listing. Status: " + error.status);
		});
	};
	
	$scope.createNew = function() {
		$scope.navigate('manage-listing/new');
	};
	
	$scope.edit = function(property) {
		$scope.navigate('manage-listing/' + property.guid);
	};
	
	$scope.searchProperties = function() {
		PropertyService.search({
			"landlordGuid": $scope.landlordGuid,
			"query": $scope.search.searchString
		}, function(result) {
			$scope.profiles = result.profiles;
		}, function(error) {
			MessagesService.addError("Cannot load listing. Status: " + error.status);
		});
	};
}]);

MainApp.controller('PropertyViewController', ['$rootScope', '$scope', '$routeParams', 'PropertyService', 'AttachmentsService', 'SecurityService', 'OffersService', 
					function($rootScope, $scope, $routeParams, PropertyService, AttachmentsService, SecurityService, OffersService) {
	$scope.amenitiesIcons = {
			'WasherOrDryerUnits': '',
			'Gym': 'fas fa-dumbbell',
			'PoolElevator': '',
			'ParkingSpot': 'fas fa-parking',
			'AirConditioning': '',
			'DishwasherStorage': '',
			'HardwoodFloors': '',
			'Balcony': '',
			'View': '',
			'HighRise': '',
			'Fireplace': '',
			'Doorman': '',
			'Deck': '',
			'Wheelchair': 'fas fa-wheelchair',
			'AccessibleGarden': '',
			'Furnished': '',
			'StudentFriendly': 'fas fa-user-graduate',
			'UtilitiesIncluded': '',
	};
	
	$scope.getIcon = function(amenity) {
		if ($scope.amenitiesIcons[amenity]) {
			return $scope.amenitiesIcons[amenity];
		}
		
		return "fas fa-check";
	};
	
	$rootScope.selectedPropertyGuid = $routeParams.propertyGuid;
	$scope.loadProperty = function() {
		PropertyService.loadProperty({
			"propertyGuid": $routeParams.propertyGuid
		}, function(result) {
			$scope.property = result.property;
			$scope.loadOwnerProfile($scope.property.ownerGuid);
			$scope.currentUser = $scope.getCurrentUser();
			$scope.loadPropertyRentStateForTenant();
		}, function(error) {
			MessagesService.addError("Cannot load property. Status: " + error.status);
			$scope.navigate('search/' + $routeParams.city);
		});
	};
	
	$scope.loadOwnerProfile = function(ownerGuid) {
		SecurityService.loadUserById({
			"userId": ownerGuid
		}, function(result) {
			$scope.owner = result.userProfile;
		}, function(error) {
			MessagesService.addError("Cannot load owner profile. Status: " + error.status);
		});
	};
	
	$scope.loadPropertyRentStateForTenant = function() {
		OffersService.loadPropertyRentStateForTenant({
			"propertyGuid": $scope.property.guid,
			"guid": $scope.currentUser.guid
		}, function(result) {
			$scope.rentState = result.rentState;
		}, function(error) {
			$scope.rentState = null;
		});
	};
	
	$scope.makeOffer = function() {
		$scope.navigate("/offer/" + $scope.property.guid + "/" + $scope.property.ownerGuid);
	};
	
	$scope.isMakingOfferAvailable = function() {
		// if ($scope.currentUser.profileType != 'tenant') {
		// 	return false;
		// }
		// if ($scope.rentState && ($scope.rentState.status == 'Offered' || $scope.rentState.status == 'Accepted')) {
		// 	return false;
		// }
		return true;
	};
	
	$scope.loadProperty();
}]);

MainApp.controller('ManageListingController', ['$rootScope', '$scope', '$routeParams', 'MessagesService', 'PropertyService', 'MetadataService',
		function($rootScope, $scope, $routeParams, MessagesService, PropertyService, MetadataService) {	
	$scope.manageGallery = false;
	
	$scope.$watch ('selectedProperty.economy', function (newValue, oldValue){
		if (angular.isDefined($scope.selectedProperty)){
			$scope.selectedProperty.economy.totalOnMoveIn = isNaN(newValue.monthlyRent) ? 0 : Number(newValue.monthlyRent); 
			$scope.selectedProperty.economy.totalOnMoveIn += isNaN(newValue.utilities) ? 0 : Number(newValue.utilities); 
			$scope.selectedProperty.economy.totalOnMoveIn += isNaN(newValue.deposit) ? 0 : Number(newValue.deposit); 
			$scope.selectedProperty.economy.totalOnMoveIn += isNaN(newValue.advanceRent) ? 0 : Number(newValue.advanceRent); 
		}
	}, true);
	
	$scope.loadListingMetadata = function() {
		MetadataService.loadListingMetadata (function(result){
			$scope.propertyTypes = result.propertyTypes;
			$scope.propertyStatuses = result.propertyStatuses;
			$scope.rentingPeriods = result.rentingPeriods;
			$scope.animalPolicies = result.animalPolicies;
			$scope.cities = result.cities;
			$scope.countries = result.countries;
			$scope.amenities = result.amenities;
			$scope.loadProperty();
		}, function (error){
			MessagesService.addError("Cannot load city list");
		})
	};
	
	$scope.save = function() {
		if (!$scope.selectedProperty.guid) {
			PropertyService.create({
				"landlordGuid": $scope.selectedProperty.ownerGuid
			}, $scope.selectedProperty, function(result) {
				$scope.selectedProperty = result.profile;
				$scope.loginForm.$setPristine();
				MessagesService.addSuccess("Property profile created");
			}, function(error) {
				MessagesService.addError("Cannot save property profile. Status: " + error.status);
			});
		} else {
			PropertyService.update({
				"landlordGuid": $scope.selectedProperty.ownerGuid
			}, $scope.selectedProperty, function(result) {
				$scope.selectedProperty = result.profile;
				$scope.loginForm.$setPristine();
				MessagesService.addSuccess("Property profile saved");
			}, function(error) {
				MessagesService.addError("Cannot save property profile. Status: " + error.status);
			});
		}
	};

	$scope.loadProperty = function() {
		if ('new' === $routeParams.propertyGuid){
			$scope.selectedProperty = {
					'ownerGuid' : $scope.getCurrentUser().guid,
					'address' : {},
					'amenities' : {},
					'economy' : {}
			};
		} else {
			PropertyService.loadProperty({
				"propertyGuid": $routeParams.propertyGuid
			}, function(result) {
				$scope.selectedProperty = result.property;
			}, function(error) {
				MessagesService.addError("Cannot load property. Status: " + error.status);
			});
		}
	};

	$scope.manageImagesGallery = function() {
		$scope.navigate('manage-listing/gallery/' + $scope.selectedProperty.guid);
	};
	
	$scope.loadListingMetadata();
	
}]);

MainApp.controller('WelcomeController', ['$rootScope', '$scope', 'MetadataService', 'MessagesService', 
		function($rootScope, $scope, MetadataService, MessagesService) {
	
	$scope.popularCities = undefined;
	$scope.search = {};
	
	$scope.searchProperties = function () {
		if ($scope.search.searchString) {
			$scope.navigate('search/' + $scope.search.searchString);
		}
//		console.log("Searching for " + $scope.searchString);
	};
	
	$scope.searchByCityKey = function(cityKey) {
		console.log("Searching by city: " + cityKey);
		$scope.navigate('search/' + cityKey);
	};
	
	$scope.loadPopularCities = function () {
		MetadataService.loadPopularCities(function(result){
			$scope.popularCities = result.popularCities;
			console.log(angular.toJson($scope.popularCities));
		}, function(error){
			MessagesService.addError("Cannot load popular cities");
		})
	};
	
	$scope.loadPopularCities();
}]);

MainApp.controller('SearchResultListingController', ['$rootScope', '$scope', '$routeParams', 'MetadataService', 'MessagesService', 'PropertyService', 
	function($rootScope, $scope, $routeParams, MetadataService, MessagesService, PropertyService) {
	
	$scope.searchPropertiesByCity = function() {
		PropertyService.searchByCityPublished({
			"query": $routeParams.city
		}, function(result) {
			$scope.profiles = result.profiles;
			$scope.city = $scope.profiles.length > 0 ? $scope.profiles[0].address.city : "";
		}, function(error) {
			MessagesService.addError("Cannot load listing. Status: " + error.status);
		});
	};
	
	$scope.loadListingMetadata = function() {
		MetadataService.loadListingMetadata (function(result){
			$scope.propertyTypes = result.propertyTypes;
			$scope.propertyStatuses = result.propertyStatuses;
			$scope.rentingPeriods = result.rentingPeriods;
			$scope.animalPolicies = result.animalPolicies;
			$scope.cities = result.cities;
			$scope.countries = result.countries;
			$scope.amenities = result.amenities;
		}, function (error){
			MessagesService.addError("Cannot load city list");
		})
	};
	
	
	$scope.openPropertyView = function(propertyGuid) {
		$scope.navigate('property/' + propertyGuid);
	};
	
	if (angular.isDefined($routeParams.city)){
		$scope.searchPropertiesByCity();
	};
	
	$scope.loadListingMetadata();
}]);

MainApp.controller('PaymentMethodsController', ['$rootScope', '$scope', 'MetadataService', 'MessagesService', 'PaymentsService',
	function($rootScope, $scope, MetadataService, MessagesService, PaymentsService) {

	console.log("Hello from PaymentMethodsController");
	$scope.loadMetadata = function() {
		MetadataService.loadListingMetadata (function(result){
			$scope.cities = result.cities;
			$scope.countries = result.countries;
		}, function (error){
			MessagesService.addError("Cannot load city list");
		})
	};
	
	$scope.loadPaymentMethods = function () {
		PaymentsService.loadPaymentMethods (function(results){
			$scope.paymentMethods = results.paymentMethods;
		}, function(error){
			MessagesService.addError("Cannot load payment methods " + error.status);
		});
	};

	$scope.savePaymentMethods = function () {
		PaymentsService.savePaymentMethods ($scope.paymentMethods, function(results){
			$scope.paymentMethods = results.paymentMethods;
			$scope.loginForm.$setPristine();
			MessagesService.addSuccess("Payment methods updated");
		}, function(error){
			MessagesService.addError("Cannot save payment methods " + error.status);
		});
	};

	$scope.loadMetadata();
	$scope.loadPaymentMethods();
}]);

MainApp.controller('BookingsController', ['$rootScope', '$scope', 'MessagesService', 'OffersService', 'SecurityService', 'PropertyService',
	function($rootScope, $scope, MessagesService, OffersService, SecurityService, PropertyService) {
	
	$scope.loadAllRentStatesForLandlord = function() {
		OffersService.loadAllRentStatesForLandlord({
			"guid": $scope.getCurrentUser().guid
		}, function(result) {
			$scope.rentStates = result.rentStates;
			for(var i = 0; i < $scope.rentStates.length; i++) {
				$scope.setTenantName($scope.rentStates[i]);
				$scope.setProperty($scope.rentStates[i]);
			}
		}, function(error) {
			MessagesService.addError("Cannot load bookings " + error.status);
		});
	};
	
	$scope.setTenantName = function(rentState) {
		SecurityService.loadUserById({
			"userId": rentState.tenantGuid
		}, function(result) {
			rentState.tenantName = result.userProfile.displayName;
		}, function(error) {
			MessagesService.addError("Cannot load user profile. Status: " + error.status);
		});
	};
	
	$scope.setProperty = function(rentState) {
		PropertyService.loadProperty({
			"propertyGuid": rentState.propertyGuid
		}, function(result) {
			rentState.property = result.property;
		}, function(error) {
			MessagesService.addError("Cannot load property. Status: " + error.status);
		});
	};
	
	$scope.reject = function(rentState) {
		OffersService.reject({
		}, rentState, function(result) {
			rentState.status = 'Rejected';
		}, function(error) {
			MessagesService.addError("Cannot reject offer. Status: " + error.status);
		});
	};
	
	$scope.accept = function(rentState) {
		//HelloSign call
		
		OffersService.accept({
		}, rentState, function(result) {
			rentState.status = 'Accepted';
		}, function(error) {
			MessagesService.addError("Cannot accept offer. Status: " + error.status);
		});
	};
	
	$scope.loadAllRentStatesForLandlord();
}]);

MainApp.controller('TenantBookingsController', ['$rootScope', '$scope', 'MessagesService', 'OffersService', 'SecurityService', 'PropertyService',
	function($rootScope, $scope, MessagesService, OffersService, SecurityService, PropertyService) {
	
	$scope.loadAllRentStatesForTenant = function() {
		OffersService.loadAllRentStatesForTenant({
			"guid": $scope.getCurrentUser().guid
		}, function(result) {
			$scope.rentStates = result.rentStates;
			for(var i = 0; i < $scope.rentStates.length; i++) {
				$scope.setLandlordName($scope.rentStates[i]);
				$scope.setProperty($scope.rentStates[i]);
			}
		}, function(error) {
			MessagesService.addError("Cannot load bookings " + error.status);
		});
	};
	
	$scope.setLandlordName = function(rentState) {
		SecurityService.loadUserById({
			"userId": rentState.ownerGuid
		}, function(result) {
			rentState.landlordName = result.userProfile.displayName;
		}, function(error) {
			MessagesService.addError("Cannot load user profile. Status: " + error.status);
		});
	};
	
	$scope.setProperty = function(rentState) {
		PropertyService.loadProperty({
			"propertyGuid": rentState.propertyGuid
		}, function(result) {
			rentState.property = result.property;
		}, function(error) {
			MessagesService.addError("Cannot load property. Status: " + error.status);
		});
	};
	
	$scope.cancel = function(rentState) {
		OffersService.cancel({
		}, rentState, function(result) {
			rentState.status = 'Canceled';
		}, function(error) {
			MessagesService.addError("Cannot reject offer. Status: " + error.status);
		});
	};
	
	$scope.loadAllRentStatesForTenant();
}]);

MainApp.controller('RecoverPasswordController', [ '$rootScope', '$scope', '$location', '$translate', 'MessagesService', 'SecurityService', 
	function($rootScope, $scope, $location, $translate, MessagesService, SecurityService) {
	console.log("Inside RecoverPasswordController");
	$scope.linkSent = false;
	$scope.recover = {};
	
	$scope.sendRecoverLink = function(){
		console.log("Sending password recover link to: " + $scope.recover.email);
		SecurityService.sendPasswordRecoverLink({ 'email' : $scope.recover.email}, function (result) {
			$scope.linkSent = true;
		}, function (error){
			MessagesService.addError("Cannot send link: " + error.status);
		});
	};
} ]);

MainApp.controller('MakingOfferController', ['$rootScope', '$scope', '$routeParams', 'MessagesService', 'OffersService', 'SecurityService', 'PropertyService',
	function($rootScope, $scope, $routeParams, MessagesService, OffersService, SecurityService, PropertyService) {

	$scope.startDateOptions = {
		minDate: new Date(),
		startingDay: 1
	};

	$scope.afterStartDate = function() {
		var afterStartDate = null;
		if ($scope.offer && $scope.offer.startDate) {
			afterStartDate = $scope.offer.startDate;
			afterStartDate.setDate(afterStartDate.getDate() + 1);
		}
		
		return afterStartDate;
	};
	
	$scope.endDateOptions = {
		minDate: $scope.afterStartDate(),
		startingDay: 1
	};
	
	$scope.$watch('offer.startDate', function(newValue, oldValue) {
		if (newValue != oldValue) {
			$scope.endDateOptions.initDate = $scope.afterStartDate();
			$scope.endDateOptions.minDate = $scope.endDateOptions.initDate;
			if ($scope.offer.endDate && $scope.offer.startDate >= $scope.offer.endDate) {
				$scope.offer.endDate = null;
			}
		}
	});
	
	$scope.format = 'dd-MM-yyyy';

	$scope.status = [];
	
	$scope.today = new Date();
	
	$scope.open = function($event, opened) {
		$event.preventDefault();
	    $event.stopPropagation();
	    $scope.status[opened] = !$scope.status[opened];
	};

	$scope.init = function() {
		$scope.currentUser = $scope.getCurrentUser();
		PropertyService.loadProperty({
			"propertyGuid": $routeParams.propertyGuid
		}, function(result) {
			$scope.property = result.property;
			$scope.offer = {
					"tenantGuid": $scope.currentUser.guid,
					"propertyGuid": $scope.property.guid,
					"ownerGuid": $routeParams.ownerGuid
			};
		}, function(error) {
			MessagesService.addError("Cannot load property. Status: " + error.status);
		});
	};
	
	$scope.makeOffer = function() {
		console.log($scope.offer);
		OffersService.makeOffer({
		}, $scope.offer, function(result) {
			$scope.rentState = result.rentState;
			$scope.navigate("/tenant/bookings");
		}, function(error) {
			MessagesService.addError("Cannot make an offer. Status: " + error.status);
		});
	};
	
	$scope.isMakingOfferAvailable = function() {
		if ($scope.currentUser.profileType != 'tenant') {
			return false;
		}
		if ($scope.rentState && ($scope.rentState.status == 'Offered' || $scope.rentState.status == 'Accepted')) {
			return false;
		}
		return true;
	};
	
	$scope.init();
}]);