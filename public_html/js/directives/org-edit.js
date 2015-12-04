app.directive("orgEdit", ["$http", "$window", "OrganizationService", function($http, $window, OrganizationService) {
	return {
		restrict: "E",
		link: function($scope, element, attr) {
			element.on("submit", function(event) {
				event.preventDefault();//what does this do?
				//call the service to fetch the information for this organization to display
				//can also go via the controller, or make a direct request
				$scope.updateOrganization(orgId, organization)
					.then(function(reply) {
						if(typeof reply.data === "object") {
							if(reply.data.status !== 200) {
								$scope.alerts[0] = {type: "danger", msg: reply.data.message};
							} else {
								//not exactly sure what this does; does this redirect me to the view?
								$window.location.href = $scope.redirectUrl;
							}
						}
					})
			});
		},
		//need to make this template
		templateUrl: "php/template/org-profile-edit.php"
	};
}]);