
<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All Listings";
/*load head-utils*/
require_once("utilities.php");

/*require once the header*/
require_once("giver-header.php");

?>

<div class="list-bg sfooter-content">
<!--main content-->
<main ng-controller="ListingController">
	<!--this container houses the h1 tag/headline and the back to listing button-->
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<div class="h2-bb">All Listings</div>
			</div>
			<div class="col-md-2">
				<button class="btn btn-info btn-block" ng-click="openListingModal();">New Listing</button>
			</div>
		</div>
	</div>
	<hr class="media-hide" />
	<!--starts table-->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<uib-alert ng-repeat="alert in alerts" type="{{ alert.type }}" close="alerts.length = 0;">{{ alert.msg }}</uib-alert>
				<table class="table table-condensed table-hover">
					<thead class="table-style">
						<th>Description</th>
						<th>Date Posted</th>
						<th>Actions</th>
						<th>Claimed</th>
					</thead>
					<tr class="table-style" ng-repeat="listing in listings | orderBy:'-listingPostTime'">
						<td>{{ listing.listingMemo }}</td>
						<td>{{ listing.listingPostTime | date : format : timezone }}</td>
						<td>
							<button class="btn btn-info" ng-click="setEditedListing(listing, listings.indexOf(listing));"><i class="fa fa-pencil"></i></button>
							<form class="inline" ng-submit="deleteListing(listing.listingId, listings.indexOf(listing));">
								<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
							</form>
						</td>
						<td><button class="btn btn-warning btn-block" ng-show="listing.listingClaimedBy" ng-click="getWhoClaimed(listing)">Claimed</button>
						</td>
					</tr>

				</table>
			</div>
		</div>
	</div>

</main>
</div>
</body>
</html>