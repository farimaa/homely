var UtilModule = angular.module('UtilModule', []);

UtilModule.directive("compareTo", function() {
	return {
		require : "ngModel",
		scope : {
			otherModelValue : "=compareTo"
		},
		link : function(scope, element, attributes, ngModel) {

			ngModel.$validators.compareTo = function(modelValue) {
				return modelValue == scope.otherModelValue;
			};

			scope.$watch("otherModelValue", function() {
				ngModel.$validate();
			});
		}
	};
});

UtilModule.config([ '$httpProvider',
	function($httpProvider) {
//		console.log("interceptors " + angular.toJson($httpProvider));
//		$httpProvider.interceptors.push(function($q) {
//			return {
//				'request' : function(config) {
//					console.log("op +++");
//					UtilModule.operationsInProgress++;
//					return config;
//				},
//
//				'response' : function(response) {
//					console.log("op ---");
//					UtilModule.operationsInProgress--;
//					return response;
//				}
//			};
//		}); 
	
	//			
	// Interception
	//			UtilModule.operationsInProgress = 0;
	//
	//			$httpProvider.interceptors.push(function($q) {
	//				return {
	//					request : function(config) {
	//						console.log("op ++");
	//						UtilModule.operationsInProgress++;
	//						return config;
	//					}
	//				};
	//			});
	//			$httpProvider.responseInterceptors.push(function($q, $window) {
	//				return function(promise) {
	//					return promise.then(function(response) {
	//						console.log("op --");
	//						UtilModule.operationsInProgress--;
	//						return response;
	//
	//					}, function(response) {
	//						console.log("op -- error");
	//						UtilModule.operationsInProgress--;
	//						return $q.reject(response);
	//					});
	//				};
	//			});
	//		}).run(function($rootScope) {
	//	$rootScope.shouldDisableUI = function() {
	//		return UtilModule.operationsInProgress > 0;
	//	};
}]);

UtilModule.factory('MessagesService', [ function() {
	var res = {};
	res.alerts = [];
	res.maxMessages = 3;

	res.addError = function(message) {
		res.addMessage(message, 'alert alert-dismissible alert-danger');
	};

	res.addWarning = function(message) {
		res.addMessage(message, 'alert alert-dismissible alert-warning');
	};

	res.addSuccess = function(message) {
		res.addMessage(message, 'alert alert-dismissible alert-success');
	};

	res.addInfo = function(message) {
		res.addMessage(message, 'alert alert-dismissible alert-info');
	};

	res.addMessage = function(message, type) {
		res.alerts.push({
			'type' : type,
			'message' : (res.getTime() + " - " + message)
		});
		if (res.alerts.length > res.maxMessages) {
			res.alerts.splice(0, 1);
		}
	}

	res.removeAlert = function(idx) {
		res.alerts.splice(ind, 1);
		res.alerts = res.alerts.slice(0);
	};

	res.getTime = function() {
		var date = new Date();
		var hh = date.getHours();
		var mm = date.getMinutes();
		var ss = date.getSeconds();
		// These lines ensure you have two-digits
		if (hh < 10) {
			hh = "0" + hh;
		}
		if (mm < 10) {
			mm = "0" + mm;
		}
		if (ss < 10) {
			ss = "0" + ss;
		}
		// This formats your string to HH:MM:SS
		var t = hh + ":" + mm + ":" + ss;
		return t;
	}

	return res;
} ]);

/*
UtilModule.formatDate = function(date) {
	d = new Date(date);
	day = d.getDate();
	if (day < 10) {
		day = "0" + day;
	}
	month = d.getMonth() + 1;
	if (month < 10) {
		month = "0" + month;
	}
	year = d.getFullYear();
	return day + "-" + month + "-" + year;
};

UtilModule.getMonth = function(date) {
	d = new Date(date);

	return d.getMonth() + 1;
};

UtilModule.getYear = function(date) {
	d = new Date(date);

	return d.getFullYear();
};

UtilModule.formatDateTime = function(date) {
	d = new Date(date);
	var hh = d.getHours();
	var mm = d.getMinutes();
	var ss = d.getSeconds();
	if (hh < 10) {
		hh = "0" + hh;
	}
	if (mm < 10) {
		mm = "0" + mm;
	}
	if (ss < 10) {
		ss = "0" + ss;
	}
	day = d.getDate();
	if (day < 10) {
		day = "0" + day;
	}
	month = d.getMonth() + 1;
	if (month < 10) {
		month = "0" + month;
	}
	return UtilModule.formatDate(date) + " " + hh + ":" + mm + ":" + ss;
};
*/

UtilModule.controller('MessagesController', [ '$scope', 'MessagesService',
	function($scope, MessagesService) {
		$scope.alerts = MessagesService.alerts;
		$scope.maxMessages = MessagesService.maxMessages;

		$scope.removeAlert = function(idx) {
			$scope.alerts.splice(idx, idx + 1);
		};
	} ]);

UtilModule.uuid = function() {
	function s4() {
		return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
	}

	return {
		newuuid : function() {
			// http://www.ietf.org/rfc/rfc4122.txt
			var s = [];
			var hexDigits = "0123456789abcdef";
			for (var i = 0; i < 36; i++) {
				s[i] = hexDigits.substr(Math.floor(Math.random() * 0x10), 1);
			}
			s[14] = "4"; // bits 12-15 of the time_hi_and_version field to 0010
			s[19] = hexDigits.substr((s[19] & 0x3) | 0x8, 1); // bits 6-7 of the clock_seq_hi_and_reserved to 01
			s[8] = s[13] = s[18] = s[23] = "-";
			return s.join("");
		},
		newguid : function() {
			return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
		}
	}
};

UtilModule.controller('FileUploadController', [ '$scope', '$upload', 'MessagesService', function($scope, $upload, MessagesService) {
	$scope.files = [];
	$scope.uploadProgress = '';
	$scope.uploadUrl = '';
	$scope.data = {
		description : "nothing"
	};

	$scope.setupData = function(uploadUrl, data) {
		console.log('data set up');
		$scope.uploadUrl = uploadUrl;
		$scope.data = data;
	}

	$scope.$watch('files', function() {
		for (var i = 0; i < $scope.files.length; i++) {
			var file = $scope.files[i];
			$scope.uploadProgress = '0%';
			$scope.upload = $upload.upload({
				url : $scope.uploadUrl,
				data : $scope.data,
				file : file
			}).progress(function(evt) {
				$scope.uploadProgress = parseInt(100.0 * evt.loaded / evt.total) + '%';
			}).success(function(data, status, headers, config) {
				$scope.uploadProgress = "";
				if (angular.isDefined($scope.$parent)) {
					$scope.data.result = data;
				}
				MessagesService.addSuccess("File upload success " + file.name);
			}).error(function(data, status, headers, config) {
				MessagesService.addError("File upload error " + file.name);
			});
		}
	});
} ]);

UtilModule.filter('danishnumber', function() {
    return function(input) {
        if (input != null){
            input = input.toString();
            input = input.replace(".", ",");
            input = input.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            var commaIdx = input.search(',');
            if (commaIdx == -1){
            	input = input + ',00';
            } else if (input.length - commaIdx == 2) {
            	input = input + '0';
            } else if (input.length - commaIdx == 1) {
            	input = input + '00';
            }
            return input;
        }
        return input;
    };
});

UtilModule.directive('danishnumber', [ function() {
	return {
		restrict : 'A',
		require : 'ngModel',
		scope : {},
		link : function(scope, elem, attrs, ngModel) {

			lastOkValue = "";
			scope.focusInInput = false;

			elem.bind('focus', function() {
				//            	console.log("focus occured " + ngModel.$name);
				lastOkValue = ngModel.$modelValue;
				scope.focusInInput = true;
				var self = this;
				scope.$evalAsync(function() {
					ngModel.$setViewValue(toView(lastOkValue));
					ngModel.$render();
					self.select()
				});
			});

			elem.bind("blur", function() {
				//            	console.log("blur occured " + ngModel.$name);
				scope.focusInInput = false;
				ngModel.$setViewValue(toView(ngModel.$modelValue));
				ngModel.$render();
			});

			elem.bind("change", function() {
				//            	console.log("blur occured " + ngModel.$name);
				scope.focusInInput = false;
				ngModel.$setViewValue(toView(ngModel.$modelValue === '' ? 0 : ngModel.$modelValue));
				ngModel.$render();
			});

			elem.bind('keyup', function(e) {
				validValues = [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-', ',' ];

				var char = String.fromCharCode(e.which || e.charCode || e.keyCode); 
				matches = [];

				angular.forEach(validValues, function(value, key) {
					if (char === value) {
						matches.push(char);
					}
				}, matches);
				if (matches.length == 0) {
					e.preventDefault();
					return false;
				}
			});

			//            elem.bind("keyup",function(e) {
			//                if (e.keyCode === 13) {
			//                	console.log("enter pressed");
			//                }
			//            });

			var toView = function(val) {
				if (val == null) {
					return "";
				}
				viewVal = val.toString();
				lastOkValue = val;

				if (viewVal != null) {
					viewVal = viewVal.replace('.', ',');
					if (!scope.focusInInput) {
						viewVal = viewVal.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
						//viewVal = viewVal.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
						if (viewVal.length > 0) {
							var commaIdx = viewVal.search(',');
							if (commaIdx == -1) {
								viewVal = viewVal + ',00';
							} else if (viewVal.length - commaIdx == 2) {
								viewVal = viewVal + '0';
							} else if (viewVal.length - commaIdx == 1) {
								viewVal = viewVal + '00';
							}
						}
					}
					//                    console.log("to view: " + ngModel.$name + " = " + viewVal + " " + scope.focusInInput);

					return viewVal;
				}
				return "";
			};


			regExp = /[-]{0,1}\d+(\,\d{0,2}){0,1}/;
			var toModel = function(val) {
				if (val == null) {
					return "";
				}
				val = val.toString();
				//console.log("To Model " + val);

				if (val != null && (val == "" || val.match(regExp) && val.match(regExp)[0] == val)) {
					var viewVal = val.replace(",", ".");
					lastOkValue = viewVal;
					return viewVal;
				} else {
					//                    scope.$evalAsync(function(){
					//	                    ngModel.$setViewValue(toView(lastOkValue));
					//	                    ngModel.$render();
					//                    });
					return lastOkValue;
				}
				return lastOkValue;
			};

			ngModel.$formatters.unshift(toView);
			ngModel.$parsers.unshift(toModel);
		}
	};
} ]);