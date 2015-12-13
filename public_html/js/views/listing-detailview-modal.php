<div class="modal-header">
	<h3 class="modal-title">Details</h3>
	<h4>Posted On: {{ editedlisting.listingPostTime | date : 'medium' }}</h4>
</div>
<div class="modal-body">
	<h4>{{ listingType.listingTypeId }} </h4>
	<h4>Description</h4>
	<p>{{ editedListing.listingMemo }}</p>
	<h4>Location</h4>
	<span>{{ organization.orgAddress1 }}</span> <span>{{ organization.orgCity }} </span> <span>{{ organization.orgState }}</span> <span>{{ organization.orgZip }}</span>
	<h4>Hours</h4>
	<span>{{ organization.orgHours }}</span>
	<h4>Contact Provider</h4>
	<span>{{ organization.orgPhone }}</span>
</div>
<div class="modal-footer">
	<button class="btn btn-lg btn-info" type="button" ng-click="ok()">Claim Listing</button>
	<form class="inline" ng-submit="update(listing.listingId, listing.listingClosed);">
	<button class="btn btn-lg btn-warning" type="button" ng-click="cancel()">Cancel Claim</button>
</div>