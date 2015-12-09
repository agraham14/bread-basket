app.controller("SignupController", ["$scope", "$uibModal", "$window", "AlertService", "SignupService", function($scope, $uibModal, $window, AlertService, SignupService) {
	$scope.signupData = {};

	$scope.openSignupModal = function () {
		var signupModalInstance = $uibModal.open({
			templateUrl: "../../js/views/signup-modal.php",
			controller: "SignupModal",
			resolve: {
				signupData: function () {
					console.log("this is a message")
					return($scope.signupData);
				}
			}
		});
		signupModalInstance.result.then(function (signupData) {
			console.log("I am a teapot")
			$scope.signupData = signupData;
			SignupService.signup(signupData)
			console.log("I am a kitty!")
					.then(function(reply) {
						console.log("I am a fluffy kitty!")
						if(reply.status === 200) {
							AlertService.addAlert({type: "success", msg: reply.message});
							$window.location.assign("../../php/template/login-landing-page.php");
							console.log("I am a noisy kitty!")
						} else {
							AlertService.addAlert({type: "danger", msg: reply.message});
						}
					});
		}, function() {
			$scope.signupData = {};
		});
	};
}]);