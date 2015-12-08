app.controller("ListingController", ["$scope", "$uibModal", "ListingService", "AlertService",  function($scope, $uibModal,ListingService, AlertService) {
	$scope.editedListing = {};
	$scope.newListing = {listingId: null, description: "", estimatedCost: "",  listingType: ""}//todo are these the correct fields?
	$scope.isEditing = false;
	$scope.alerts = [];
	$scope.listings = [];

	/**
	 * opens new listing modal and adds sends listing to the listing API
	 */

	$scope.openListingModal = function() {
		var ListingModalInstance = $uibModal.open({
			templateUrl: "../../js/views/newlisting-modal.php",
			controller: "ListingModal",
			resolve: {
				listing: function() {
					return ($scope.listing);
				}
			}
		});
		ListingModalInstance.result.then(function(listing) {
			$scope.listing = listing;
			ListingService.create(listing)
					.then(function(reply) {
						console.log("STATUS: " + reply.data.status);
						console.log("MSG: " + reply.data.message + "this is the message.");
						if(reply.status === 200) {
							console.log("yes");
							AlertService.addAlert({type: "success", msg: reply.message});
						} else {
							AlertService.addAlert({type: "danger", msg: reply.message});
						}
					});
		}, function() {
			$scope.listing = {};
		});
	};

	/**
	 * sets which listing is being edited and activates the editing form
	 *
	 * @param listing the listing to be edited
	 */

	$scope.setEditedListing = function(listing) {
		$scope.isEditing = true;
	};

	/**
	 * cancels editing doesn't change listing being edited
	 */
	$scope.cancelEditing = function() {
		$scope.editedListing = {};
		$scope.isEditing = false;
	};

	/**
	 * fulfills the promise from retrieving all the listings from the listing API
	 */
	$scope.getListings = function() {
		ListingService.all()
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.listings = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
	};
	/**
	 * creates a listing and sends it to the listing API
	 *
	 * @param listing the listing to send
	 * @param validated true is angular validated the form, false if not
	 */
	$scope.createListing = function(listing, validated) {
		if(validated === true) {
			ListingService.create(listing)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};





	///**
	// * fulfills the promise from retrieving the listing by Id from the listing API
	// */
	//$scope.getListings = function() {
	//	ListingService.fetchId()
	//			.then(function(result) {
	//				if(result.data.status === 200) {
	//					$scope.listings = result.data.data;
	//				} else {
	//					$scope.alerts[0] = {type: "danger", msg: result.data.message};
	//				}
	//			});
	//};

	////fulfills the promise from retrieving the listing by org id
	//$scope.getListingsByOrgId = function(orgId, validated) {
	//	if(validated === true) {
	//		ListingService.fetchOrgId(orgId)
	//				.then(function(result) {
	//					if(result.data.status === 200) {
	//						$scope.listings = result.data.data;
	//					} else {
	//						$scope.alerts[0] = {type: "danger", msg: result.data.message};
	//					}
	//				});
	//	}
	//};

	////fulfills the promise from retrieving the listings by parent id
	//$scope.getListingByParentId = function(parentId, validated) {
	//	if(validated === true) {
	//	ListingService.fetchParentId(parentId)
	//			.then(function(result) {
	//				if(result.data.status === 200) {
	//					$scope.listings = result.data.data;
	//				} else {
	//					$scope.alerts[0] = {type: "danger", msg: result.data.message};
	//				}
	//			});
	//	}
	//};

	////fulfills the promise from retrieving the listings by post time
	//$scope.getListingByPostTime = function(postTime, validated) {
	//	if(validated === true) {
	//		ListingService.fetchPostTime(postTime)
	//				.then(function(result) {
	//					if(result.data.status === 200) {
	//						$scope.listings = result.data.data;
	//					} else {
	//						$scope.alerts[0] = {type: "danger", msg: result.data.message};
	//					}
	//				});
	//	}
	//};

	////fulfills the promise from retrieving the listings by Type Id
	//$scope.getListingByTypeId = function(typeId, validated) {
	//	if(validated === true) {
	//		ListingService.fetchTypeId(typeId)
	//				.then(function(result) {
	//					if(result.data.status === 200) {
	//						$scope.listings = result.data.data;
	//					} else {
	//						$scope.alerts[0] = {type: "danger", msg: result.data.message};
	//					}
	//				});
	//	}
	//};

	/**
	 * updates a listing and sends it to the listing API
	 *
	 * @param listing the listing to send
	 * @param validated true is angular validated the form, false if not
	 */
	$scope.updateListing = function(listing, validated) {
		if(validated === true && $scope.isEditing === true) {
			ListingService.update(listing.listingId, listing)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	/**
	 * deletes a listing and sends it to the listing API if the user confirms deletion
	 *
	 * @param listingId the listing id of the listing to be deleted
	 */
	$scope.deleteListing = function(listingId) {
		//create a modal instance to prompt the user if she/he is sure they want to delete the listing
		var message = "Are you sure you want to delete this listing?";

		var modalHtml = '<div class="modal-body">' + message + '</div><div class="modal-footer"><button class="btn btn-primary" ng-click="yes()">Yes</button><button class="btn btn-warning" ng-click="no()">No</button></div>';

		var modalInstance = $uibModad.open({
			template: modalHtml,
			controller: ModalInstanceCtrl
		});

		//if the user clicked yes, delete the listing
		modalInstance.result.then(function() {
			ListingService.destroy(listingId)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					})
		});
	};

	////subscribe to the delete channel; this will delete from the listings array on demand
	//Pusher.subscribe("listing", "delete", function(listing){
	//	for(var i = 0; i < $scope.listings.length; i++) {
	//		if($scope.listings[i].listingId ===listing.listingId) {
	//			$scope.listings.splice(i, 1);
	//			break;
	//		}
	//	}
	//});

	////subscribe to the new channel; this will add to the listings array on demand
	//Pusher.subscribe("listing", "new", function(listing){
	//	$scope.listings.push(listing);
	//});

	////subscribe to the update channel; this will update the listings array on demand
	//Pusher.subscribe("listing", "update", function(listing){
	//	for(var i = 0; i < $scope.listings.length; i++) {
	//		if($scope.listings[i].listingId === listing.listingId) {
	//			$scope.listings[i] = listing;
	//			break;
	//		}
	//	}
	//});

	////when the window is closed/reloaded, gracefully close the channel
	//$scope.$on("$destroy", function() {
	//	Pusher.unsubscribe("listings");
	//});

	//load the array on first view
	if($scope.listings.length === 0) {
		$scope.linstings = $scope.getListings();
	}
}]);

//embedded modal instance controller to create deletion prompt
var ModalInstanceCtrl = function($scope,  $uibModalInstance) {
	$scope.yes = function() {
		$uibModalInstance.close();
	};

	$scope.no = function() {
		$uibModalInstance.dismiss('cancel');
	};
};