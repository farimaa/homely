var AttachmentsModule = angular.module('AttachmentsModule', []);

AttachmentsModule.factory('AttachmentsService', [ '$resource', function($resource) {
	return $resource('rest/attachments/:action/:guid', {},
		{
			loadImage : {
				method : 'GET',
				isArray: false,
				params : {
					"action" : "image"
				}
			},
			loadSlides : {
				method : 'GET',
				params : {
					"action" : "slides"
				}
			},
			loadAttachmentDescriptors : {
				method : 'GET',
				params : {
					"action" : "descriptors"
				}
			},
			deleteImage : {
				method : 'DELETE',
				params : {
					"action" : "delete"
				}
			},
			updateAttachmentDescriptor : {
				method : 'POST',
				params : {
					"action" : "update"
				}
			},
			uploadAttachments : {
				method : 'POST',
				isArray: false,
				params : {
					"action" : "upload"
				}
			}
		});
} ]);