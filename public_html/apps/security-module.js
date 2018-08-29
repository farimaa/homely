var SecurityModule = angular.module('SecurityModule', []);

SecurityModule.factory('SecurityService', [ '$resource', function($resource) {
	return $resource('rest/security/:action/:userId', {},
		{
			loadCurrentUser : {
				method : 'GET',
				params : {
					"action" : "current-user"
				}
			},
			loadUserById : {
				method : 'GET',
				params : {
					"action" : "user"
				}
			},
			login : {
				method : 'POST',
				params : {
					"action" : "login"
				}
			},
			logout : {
				method : 'GET',
				params : {
					"action" : "logout"
				}
			},
			checkEmail : {
				method : 'GET',
				params : {
					"action" : "check-email"
				}
			},
			register : {
				method : 'POST',
				params : {
					"action" : "register"
				}
			},
			resendConfirmationEmail : {
				method : 'GET',
				params : {
					"action" : "resend-confirmation-email"
				}
			},
			sendPasswordRecoverLink : {
				method : 'GET',
				params : {
					"action" : "send-password-recover-link"
				}
			},
			updateProfile : {
				method : 'POST',
				params : {
					"action" : "update-profile"
				}
			}
		});
} ]);