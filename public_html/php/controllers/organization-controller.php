<?php

//autoload?
require_once dirname(__DIR__)."/classes/organization.php";
require_once dirname(__DIR__)."lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * controller/api for the organization class
 *
 * @author Bradley Brown <tall.white.ninja@gmail.com>
 */
try {

	//verify the xsrf challenge
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	//if the volunteer session is empty, and the user is not logged in, throw an exception
	//note: this may be redundant with some logic below, and is this what we should check to ensure the presence of a user?
	//also, double check that BOTH volunteer and admin are set for an admin instance, rather than just one or the other
	if(empty($_SESSION["volunteer"]) === true) {
		throw(new RuntimeException("Please log-in or sign up"));
	}

	verifyXsrf();

	//prepare an empty reply
	$reply = new stdClass();
	$reply->status = 200;
	$reply->data = null;

	//create the pusher connection
	//make sure pusher details get put into the config file!!!!
	//does EVERY class need to push things, or are we only pushing messages?
	$config = readConfig("/etc/apache2/capstone-mysql/breadbasket.ini");
	$pusherConfig = json_decode($config["pusher"]);
	$pusher = new Pusher($pusherConfig->key, $pusherConfig->secret, $pusherConfig->id, ["encrypted" => true]);

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize inputs
	//NOTE: the labels here are coming from angular, right?
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	$city = filter_input(INPUT_GET, "city", FILTER_SANITIZE_STRING);
	$name = filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING);
	$state = filter_input(INPUT_GET, "state", FILTER_SANITIZE_STRING);
	$type = filter_input(INPUT_GET, "type", FILTER_SANITIZE_STRING);
	$zip = filter_input(INPUT_GET, "zip", FILTER_SANITIZE_STRING);

	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/encrypted-config.ini");

	//handle REST calls, while only allowing administrators access to database-modifying methods
	if(empty($_SESSION["volunteer"]) === false) { //NOTE: is this redundant with the check above?
		if($method === "GET") {
			//set XSRF cookie
			setXsrfCookie("/");
			//get the organization based on the given field
			if(empty($id) === false) {
				$reply->data = Organization::getOrganizationByOrgId($pdo, $id);
			} else if(empty($city) === false) {
				$reply->data = Organization::getOrganizationByOrgCity($pdo, $city)->toArray();
			} else if(empty($name) === false) {
				$reply->data = Organization::getOrganizationByOrgName($pdo, $name)->toArray();
			} else if(empty($type) === false) {
				$reply->data = Organization::getOrganizationByOrgType($pdo, $type)->toArray();
			} else if(empty($zip) === false) {
				$reply->data = Organization::getOrganizationByOrgZip($pdo, $zip)->toArray();
			} else {
				$reply->data = Organization::getAllOrganizations($pdo)->toArray();
			}

		}
	}
	//if the session belongs to an admin, allow post, put, and delete methods
	if(empty($_SESSION["admin"]) === false) {

		if($method === "PUT") {
			//put goes here

		} else if($method === "POST") {
			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);

			$organization = new Organization(null, $requestObject->orgAddress1, $requestObject->orgAddress2, $requestObject->orgCity,
					$requestObject->orgDescription, $requestObject->orgHours, $requestObject->orgName, $requestObject->orgPhone, $requestObject->orgState,
					$requestObject->orgType, $requestObject->orgZip);
			$organization->insert($pdo);

			//do we really want the pusher notifications for this?
			$pusher->trigger("organization", "new", $organization);
			$reply->message("Organization created OK");

		} else if($method === "DELETE") {
			//see put questions
		}

	} else {
		//if not an admin, and attempting a method other than get, throw an exception
		if((empty($method) === false) && ($method !== "GET")) {
			throw new RuntimeException("Only administrators are allowed to modify entries");
		}
	}


} catch(Exception $exception) {
	//send exception back to the caller
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data == null) {
	unset($reply->data);
}
echo json_encode($reply);