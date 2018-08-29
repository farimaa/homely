var DynamicFormModule= angular.module('DynamicFormModule', ['ngResource']);

DynamicFormModule.factory('DynamicFormService', [ '$resource', function ($resource) {
    return $resource('rest/dynamicform/:action/', {}, {
        loadForm: {
            method: 'GET',
            isArray: false,
            params: {
                "action": "form-load"
            }
        },
        saveFormData: {
            method: 'POST',
            isArray: false,
            params: {
                "action": "form-data-save"
            }
        },
        loadFormData: {
            method : 'GET',
            isArray : false,
            params : {
                "action" : "form-data-load"
            }
        },
        exportPdf: {
        		method : 'GET',
        		isArray : false,
        		params : {
        			"action" : "export-pdf"
        		}
        },
        recalculate : {
            method : 'POST',
            isArray : false,
            params : {
                "action" : "recalculate"
            }
        }
    });
}]);

DynamicFormModule.controller('DynamicFormController', ['$scope', '$upload', '$timeout', 'DynamicFormService', 'MessagesService', '$modal', '$sce', function ($scope, $upload, $timeout, DynamicFormService, MessagesService, $modal, $sce) {

    $scope.projectId;
    $scope.journalNumber;
    $scope.startDate;
    $scope.endDate;
    $scope.docType;
    $scope.guid;
    $scope.email;
    $scope.name;
    $scope.cpr;
    $scope.historyDocType;
    $scope.constructorMode = false;
    $scope.isHistory = false;
    $scope.isViewMode = false;
    $scope.openingForm = true;
    $scope.formId;

    $scope.paramMap = new Object();
    $scope.dynamicformData = {}
    $scope.formsData = new Object();
    $scope.selectedForm = {};
    $scope.mode = 'dynamicform-main';
    $scope.validParamCount = 0;
    $scope.formForSubmit;
    $scope.formName;
    $scope.formContent;
    $scope.content = {};
    $scope.originContent = {};
    $scope.dataChanged = false;
    $scope.formData;
    $scope.errorData =  {};
    $scope.localesMap = new Object();
    $scope.language;
    $scope.status = [];
    $scope.format = 'dd-MM-yyyy';
	$scope.dateOptions = {
			formatYear: 'yyyy',
			startingDay: 1
	};
	

    $scope.constructorDataChanged = false;

	$scope.open = function($event, opened) {
		$event.preventDefault();
	    $event.stopPropagation();
	    $scope.status[opened] = !$scope.status[opened];
	};

//    $scope.init = function(projectId, projectStartDate, projectEndDate) {
//           $scope.init(projectId)
//    }
//
//    $scope.init = function(projectId){
//        DynamicFormService.loadFormTemplate({
//            id : projectId
//        }, function(result){
//            $scope.schemaDefinition = result.schemaDefinition;
//
//        });
//    };

    $scope.initConstructor = function(){
        $scope.constructorMode = true;
        $scope.loadFormConfig();
        $scope.initLocalesMap();
        $scope.constructorDataChanged = false;

    }

    $scope.$watch('content', function(newVal, oldVal){
    	if (newVal != oldVal) {
    		console.log('changed');
    		$scope.dataChanged = true;
    	}
        if (!$scope.isEditing() && $scope.openingForm && $scope.schemaDefinition.openInEditMode) {
        	$scope.startEdit();
        	$scope.openingForm = false;
        	$scope.dataChanged = false;
        }
    }, true);

    $scope.initFormData = function(projectId, journalNumber, docType, historyDocType, guid, name, email, cpr){
        $scope.projectId = projectId;
        $scope.journalNumber = journalNumber;
        $scope.docType = docType;
        $scope.historyDocType = historyDocType;
        $scope.guid = guid;
        $scope.email = email;
        $scope.cpr = cpr;
        $scope.name = name;
        $scope.loadFormDataTemplate();
        LoggingService.logOpenApplication($scope.journalNumber, $scope.docType);
    }

    $scope.initFormDataView =  function(data, docType){
        $scope.constructorMode = true;
        $scope.docType = docType;
        $scope.isViewMode = true;
        $scope.loadFormDataTemplateForView(data);

    }

    $scope.loadFormDataTemplateForView = function(data){
        DynamicFormService.loadFormTemplate({
            id : data.projectId,
            doctype : $scope.docType
        }, function(result){
            $scope.schemaDefinition = result.schemaDefinition;
            $scope.language = result.language;
            $scope.content = data.content;
            $scope.setSelected($scope.getSelectedMenu($scope.schemaDefinition.menu));
        });

    }

    $scope.loadFormDataTemplate = function(){
        DynamicFormService.loadFormTemplate({
            id : $scope.projectId,
            doctype : $scope.docType
        }, function(result){
            $scope.schemaDefinition = result.schemaDefinition;
            $scope.language = result.language;
            $scope.loadFormData();
            $scope.setSelected($scope.getSelectedMenu($scope.schemaDefinition.menu));
        });
    }

    $scope.loadHistory = function(){


        DynamicFormService.loadFormDataHistory({
            guid : $scope.guid,
            doctype : $scope.historyDocType

        } ,function(result){

            $scope.schemaDefinition = result.schemaDefinition;
            $scope.language = result.language;
            $scope.formData = result;
            if ($scope.formData.form != null) {
                $scope.content = $scope.formData.form.content == null ? {} : $scope.formData.form.content;
            }
            $scope.setSelected($scope.getSelectedMenu($scope.schemaDefinition.menu));
            $scope.isHistory = true;
            $scope.dataChanged = false;
        });
    }

    $scope.getSelectedMenu = function(menu) {
    	if (menu != null && menu != undefined) {
    		for (key in menu) {
    			if (menu[key].openedOnStart) {
    				return menu[key];
    			}
    		}
    	}
    	return null;
    };
    
    $scope.checkChanges = function(oldVersion, newVersion) {
    	delta = {};
    	delta.entityGuid = $scope.guid;
    	delta.timestamp = new Date();
    	delta.changes = {};
    	if (oldVersion == null) oldVersion = {};
    	
    	for (var key in newVersion) {
    		if (oldVersion[key] !== newVersion[key]) {
    			delta.changes[key] = (oldVersion[key] + " -> " + newVersion[key]);
    		}
    	}
    	$scope.originContent = {};
    	LoggingService.addDelayActivity(delta);
    };
    
    $scope.saveOrUpdateFormData = function(){
        var form = {}
        form.projectId = $scope.projectId;
        form.guid = $scope.guid;
        form.content = $scope.content;
        $scope.checkChanges($scope.originContent, $scope.content);
        
        DynamicFormService.saveOrUpdateFormData({
            doctype : $scope.docType
        }, form ,function(){
            $scope.loadFormData();
            $scope.dataChanged = false;
            LoggingService.logDelayActivities();
        });
    }

    $scope.validateFormData = function(){
        $scope.errorData = {}
        var form = {}
        form.projectId = $scope.projectId;
        form.guid = $scope.guid;
        form.content = $scope.content;

        DynamicFormService.validateForm({
            doctype : $scope.docType
        }, form ,function(result){
            $scope.errorData = result;
            if ($scope.errorData.errorFlag) {
                MessagesService.addSuccess("${dynamicform.error.validation.success}");
            } else {
                MessagesService.addError("${dynamicform.error.validation.fail}")
            }
//            $scope.dataChanged = false;

        });
    };

    $scope.beforeSubmit = function(){
        $scope.errorData = {};
        var form = {};
        form.projectId = $scope.projectId;
        form.guid = $scope.guid;
        form.content = $scope.content;
        LockingService.disableWarning = true;
        DynamicFormService.beforeSubmit({  
            doctype : $scope.docType,
            "name": $scope.name,
            "email": $scope.email,
            "cpr": $scope.cpr
        }, form, function(result) {
        	if (result.errorFlag) {
        		LoggingService.logActivity(LoggingService.SUBMIT);
            	$scope.signFormHtml = $sce.trustAsHtml(result.signForm);
                $timeout(function() {
                    document.forms["signForm"].submit();
                }, 500);
            } else {
            	$scope.errorData = result;
                MessagesService.addError("${dynamicform.error.validation.fail}")
            }
        });
    };

    $scope.cancel = function() {
    	$scope.content = angular.copy($scope.originContent);
    	$scope.loadFormDataTemplate();
        $scope.dataChanged = false;
    };

    $scope.loadFormData = function() {
        DynamicFormService.loadFormData({
            doctype: $scope.docType,
            guid: $scope.guid,
            projectid : $scope.projectId
        }, function(result){
            $scope.formData = result;
            if ($scope.formData.form != null) {
                $scope.content = $scope.formData.form.content == null ? {} : $scope.formData.form.content;
                $scope.originContent = angular.copy($scope.content);
            }
//            $scope.selectedMenu = null;
            $scope.isHistory = false;
            $scope.dataChanged = false;

        });

    }

    $scope.recalculate = function (data) {
        var form = {}
        form.projectId = $scope.projectId;
        form.guid = $scope.guid;
        form.content = data;

        DynamicFormService.recalculate({
            id: $scope.projectId,
            doctype: $scope.docType
        }, form, function (result) {
            $scope.content = result;
        })
    }

    $scope.isEditing = function() {
        return LockingService.isEditing();
    };

    $scope.startEdit = function() {
        $scope.dataChanged = false;
        LockingService.startEdit($scope.formData.lockResource, $scope.formData.version);
        LoggingService.logActivity(LoggingService.EDIT);
    };

    $scope.endEdit = function() {
    	LockingService.endEditResource($scope.formData.lockResource, $scope.formData.version);
        $scope.loadFormDataTemplate();
        $scope.dataChanged = false;
    };


    $scope.initLocalesMap = function () {
        $scope.localesMap['ordningregion'] = "${dynamicform.ordningregion}"
        $scope.localesMap['ordningfond'] = "${dynamicform.ordningfond}"
        $scope.localesMap['budgetomraade'] = "${dynamicform.budgetomraade}"
        $scope.localesMap['indsatsomraade'] = "${dynamicform.indsatsomraade}"
        $scope.localesMap['formaalsart'] = "${dynamicform.formaalsart}"
    }


    $scope.dynamicFormDocType = [
        {guid: "42", name: "Start Schema"},
        {guid: "50", name: "Stop Schema"},
        {guid: "46", name: "Consensus Declaration Employee"},
        {guid: "48", name: "Consensus Declaration Participant"},
        {guid: "44", name: "Prosa"}
    ];

    $scope.getLocal = function (word) {
        return $scope.localesMap[word];
    };

    $scope.update = function (value, key) {

        if (value == null) {
            delete $scope.paramMap[key];
        } else {
            $scope.paramMap[key] = value.guid;
        }
        $scope.loadForms();
    };


    $scope.paramLength = function () {
        return Object.keys($scope.paramMap).length;
    };

    $scope.runEditMode = function (formId) {
    	$scope.formId = formId;
        $scope.changeMode("dynamicform-edit");
        DynamicFormService.loadForm({
            id: formId
        }, function (result) {
            $scope.selectedForm.form = result;


        });
        $scope.setConstructorDataChanged(false);
    }

    $scope.updateForm = function () {
        console.log($scope.selectedForm.form)
        DynamicFormService.saveForm({
        }, $scope.selectedForm.form, function (result) {
            $scope.changeMode("dynamicform-main");
            $scope.paramMap = new Object();
            $scope.loadForms();
            $scope.setConstructorDataChanged(false);


        }, function (error) {
            MessagesService.addError("${dynamic.form.error}: " + error.data.error_message);
        });

    }

    $scope.editFormContent = function(data){
        $scope.selectedForm.form.content = data;

        $scope.setConstructorDataChanged(true);
    }

    $scope.saveForm = function (form) {
        DynamicFormService.saveForm({
        }, form, function (result) {
            $scope.changeMode("dynamicform-main");
            $scope.paramMap = new Object();
            $scope.setConstructorDataChanged(false);
            $scope.loadForms();
        }, function (error) {
            MessagesService.addError("${dynamic.form.error}: " + error.data.error_message);
        });
    }

    $scope.loadFormConfig = function () {
        DynamicFormService.loadConfig({
        }, function (result) {
            $scope.dynamicformData = result;
            $scope.loadForms();
            $scope.preview = false;
            $scope.formContent = "";
            $scope.setConstructorDataChanged(false);
        }, function (error) {
            MessagesService.addError("${dynamic.form.error}: " + error.status);
        });
    }

    $scope.loadForms = function () {
        DynamicFormService.loadForms({
        }, $scope.paramMap, function (result) {
            $scope.formsData = result;
            $scope.selectedForm = {};
            $scope.formContent = "";
            $scope.preview = false;

        }, function (error) {
            MessagesService.addError("${dynamic.form.error}: " + error.status);

        });
    }

    $scope.deleteForm = function (formGuid) {
        DynamicFormService.deleteForm({
            guid: formGuid
        }, function () {
            $scope.loadForms();
            $scope.setConstructorDataChanged(false);
        }, function (error) {
            MessagesService.addError("${dynamic.form.error}: " + error.status);
        });

    }

    $scope.back = function () {
        $scope.paramMap = new Object();
        $scope.loadForms();
        $scope.changeMode("dynamicform-main");
        $scope.setConstructorDataChanged(false);
    };

    $scope.cancelFormChanges = function() {
    	$scope.runEditMode($scope.formId);
    }
    
    $scope.submitForm = function () {
        $scope.saveForm($scope.formForSubmit);
    };


    $scope.changeMode = function (mode) {
        $scope.mode = mode;
    };

    $scope.formSetName = function (value) {
        $scope.formForSubmit['formname'] = value;
    }

    $scope.formSetContent = function (value) {
        $scope.formForSubmit['content'] = value;
        $scope.setConstructorDataChanged(true);

    }

    $scope.newForm = function () {
        $scope.formName = "";
        $scope.changeMode("dynamicform-create");
        $scope.formForSubmit = angular.copy($scope.paramMap);
    }

    /*From copy paste */
    $scope.serverResponse = "N/A";
    $scope.schemaDefinition = null;
    $scope.schemaSource = null;
    $scope.schemaErrors = [];
    $scope.state="show-form";

    $scope.preview = false;

    $scope.previewForm = function (formContent){

        DynamicFormService.previewForm({

        }, formContent, function (result) {
            $scope.schemaDefinition = result.schemaDefinition;
            $scope.language = result.language;
            $scope.preview = true;
            $scope.setSelected($scope.getSelectedMenu($scope.schemaDefinition.menu));
        }, function (error) {
            $scope.schemaDefinition = {};
            MessagesService.addError("${dynamic.form.error}: " + error.status);
        });
        $scope.preview = true;
    };

    $scope.previewFormCreate = function (){
        console.log($scope.formForSubmit['content'])

        DynamicFormService.previewForm({

        }, $scope.formForSubmit['content'], function (result) {
            $scope.schemaDefinition = result.schemaDefinition;
            $scope.language = result.language;
            $scope.formContent = result.schemaSource;
            $scope.preview = true;
            $scope.setSelected($scope.getSelectedMenu($scope.schemaDefinition.menu));
        }, function (error) {
            MessagesService.addError("${dynamic.form.error}: " + error.status);
        });
        $scope.preview = true;
    };

    $scope.editform = function (){
        $scope.preview = false;
    }

    $scope.selectedMenuPage = 1;
    $scope.selectedMenuPages = [];
    $scope.selectedMenu == null;

    $scope.toHtml = function(text){
        return $sce.trustAsHtml(text);
    };

    $scope.showHelp = function(title, message) {
        var modalInstance = $modal.open({
            templateUrl : 'myModalContent.html',
            controller : ModalInstanceCtrl,
            size : 'lg',
            resolve : {
                message : function() {
                    return message;
                },
                title : function() {
                    return title;
                }
            }
        });
    };

    $scope.getStringValue = function (element){
        res = null;
        if (angular.isDefined(element) && element != null && element.length > 0){
        	res = element[0].value;
            for (var i = 0; i < element.length; i++){
                value = element[i];
                if (value.language == $scope.language){
                    return value.value;
                }
            }
        }
        return res;
    };

    $scope.getStringSet = function (options){
        res = null;
        if (angular.isDefined(options) && options != null && options.length > 0){
        	res = options[0];
            for (var i = 0; i < options.length; i++){
                option = options[i];
                if (option.language == $scope.language){
                    return option;
                }
            }
        }
        return res;
    };

    $scope.setSelected = function (menu){
        $scope.selectedMenuPage = 1;
        $scope.selectedMenuPages = [];
        $scope.selectedMenu = menu;
        if (menu != null){
            pageIdx = 1;
            console.log("Menu selected: " + $scope.getStringValue(menu.name));
            for (i = 0; i < menu.input.length; i++){
                input = menu.input[i];
                input.$pageIndex = pageIdx;
                if (input.type == "PageBreak"){
                    if ($scope.selectedMenuPages.length == 0){
                        page = {index : pageIdx};
                        $scope.selectedMenuPages.push(page);
                    }
                    pageIdx++;
                    page = {index : pageIdx};
                    $scope.selectedMenuPages.push(page);
                }
            }
        } else {
            console.log("Menu unselected");
        }
    };

    //upload
    $scope.files = [];
    $scope.uploadProgress = '';
    $scope.data = {
        description : "nothing"
    };
    $scope.uploadUrl = "api/dynamicform/uploadDefinition";

    $scope.resetUploadProgress = function() {
    	$scope.uploadProgress = '';
    };
    
    $scope.setFiles = function(dataFile){
        $scope.files = dataFile;
        for (var i = 0; i < $scope.files.length; i++) {
            var file = $scope.files[i];
            $scope.uploadProgress = '0%';
            $scope.upload = $upload.upload({
                url : $scope.uploadUrl,
                data : $scope.data,
                file : file
            }).progress(function(evt) {
                console.log("Progress")
                $scope.uploadProgress = parseInt(100.0 * evt.loaded / evt.total) + '%';
            }).success(function(data, status, headers, config) {
                console.log("success")
                $scope.uploadProgress = "${attachments.uploaded}";
                if (angular.isDefined($scope.$parent)){

                    $scope.formName = data.fileName;
                    $scope.formContent = data.fileContent;
                    $scope.formSetName(data.fileName);
                    $scope.formSetContent(data.fileContent);
                    $scope.setConstructorDataChanged(true);


                }
                MessagesService.addSuccess("${file.upload.success} " + file.name);
            }).error(function(data, status, headers, config){
                MessagesService.addError("${file.upload.error} " + file.name);
            });
        }
    };


    $scope.isConstructorDataChanged = function(){
        return $scope.constructorDataChanged;
    }

    $scope.setConstructorDataChanged = function(flag){
        $scope.constructorDataChanged = flag;
    }

    $scope.setHeightToContent = function(id) {
    	height = angular.element( document.querySelector( '#'+id ) )[0].offsetHeight+'px';
    	$scope.content[id+'-height'] = height;
    };
}]);

var ModalInstanceCtrl = function($scope, $modalInstance, $sce, message, title) {

    $scope.message = $sce.trustAsHtml(message);
    //$scope.message = angular.element('<div>' + message + '</div>');
    $scope.title = title;

    $scope.ok = function() {
        $modalInstance.dismiss('cancel');
    };
};

