<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "Home";
/*load head-utils*/
require_once("utilities.php");

require_once("prefix-utilities.php");

?>

<!DOCTYPE html>
<html lang="en" ng-app="BreadBasket">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="x-ua-compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- CSS stylesheets -->
		<!--latest compiled and minified bootstrap css files-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
		<link type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
		<!--optional theme-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<!--minified font awesome css-->
		<link type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
		<!-- CUSTOM stylesheets -->
		<link type="text/css" rel="stylesheet" href="../../css/custom-style.css"/>

		<!--jQuery for Bootstrap's .js plugins-->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!--latest compiled and minified bootstrap javascript-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

		<!-- CUSTOM js-->
		<?php require_once("js-utilities.php")?>

		<!--Google Fonts-->
		<link href='https://fonts.googleapis.com/css?family=Dosis|Josefin+Sans|Raleway' rel='stylesheet' type='text/css'>


		<title>Bread Basket Home</title>
		<script> console.log("-=^.^=- fuzzy kitty!"); </script>

	</head>

	<body class="sfooter">
		<div class="home-img sfooter-content">
				<div class="container-fluid">
					<!--begin navbar-->
					<nav class="home-nav nav navbar">
						<!--logo and mobile toggle button get grouped together-->
						<div class="navbar-header">
							<button class="na-nav navbar-toggle collapsed" data-toggle="collapse" data-target="#my-navbar" aria-expanded="false">
								<span class="sr-only">Main Menu</span>
								<span class="fa fa-bars"></span>
							</button>
							<div class="nav navbar-brand">
							<a href="#">
								<span class="glyphicon glyphicon-grain"></span>
								Bread Basket
							</a>
							</div>
						</div>

						<!--nav links are grouped together here-->
						<div class="collapse navbar-collapse navbar-right" id="my-navbar">
							<ul class="home-nav nav navbar-nav">
								<li ng-controller="SigninController" ng-click="openSigninModal();"><a href="#">Login</a></li>
								<li ng-controller="SignupController" ng-click="openSignupModal();"><a href="#">Sign Up</a></li>
							</ul>
						</div>
					</nav>
				</div>
			<!--main content-->
			<main>
				<!--container 1-->
				<div class="container-fluid">
					<div class="padding-top-bottom-lg">
						<div class="row">
							<div class="col-lg-4 col-lg-offset-4">
								<div class="text-center">
									<h1>Connecting People To End Hunger</h1>
								</div>
							</div>
						</div>
						<div class="row">
							<div ng-controller="SignupController" class="col-md-4 col-md-offset-4 text-center">
								<button ng-click="openSignupModal();" class="btn btn-lg btn-home">Sign Up</a></button>
							</div>
						</div>
					</div>
				</div>
				<!--container 2-->
				<div class="bg-drk container-fluid">
					<div class="padding-top-bottom-sm">
						<div class="row">
							<div class="col-sm-4 col-sm-offset-4">
								<div class="text-center">
									<h1>How It Works</h1>
									<hr />
								</div>
							</div>
						</div>
						<!--HOW IT WORKS-->
						<div class="row">
							<div class="container">
								<div class="col-sm-6 col-sm-offset-2">
									<h2>Food Provider</h2>
									<ul>
										<li>Step 1</li>
										<li>Step 2</li>
										<li>Step 3</li>
									</ul>
								</div>
								<div class="col-sm-4">
									<img class="img-responsive img-circle" src="<?php echo $PREFIX; ?>img/grocery.jpg" alt="food provider image" />
								</div>
							</div>
						</div>
						<div class="container"><hr /></div>
						<div class="row">
							<div class="container">
								<div class="col-sm-6 col-sm-offset-2">
									<h2 class="text-center">Food Receiver</h2>
										<ul>
											<li>Step 1</li>
											<li>Step 2</li>
											<li>Step 3</li>
										</ul>
									</div>
								<div class="col-sm-4">
									<img class="img-responsive img-circle" src="<?php echo $PREFIX; ?>img/buffet2.jpg" alt="food provider image" />
								</div>
								</div>
							</div>
						</div>
					</div>

				<!--container 3-->
				<div class="container-fluid">
					<div class="padding-top-bottom-sm">
						<div class="row">
							<div class="col-md-4 col-md-offset-4">
								<div class="text-center">
									<h1>Learn More</h1>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-md-offset-4 text-center">
								<div ng-controller="ContactController">
								<button class="btn btn-lg btn-home" ng-click="openContactModal();">Contact Us</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>

		</div>

		<?php require_once("footer.php")?>
	</body>


</html>