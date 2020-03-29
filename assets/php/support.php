<?php
?>

<div class="support-content" layout-gt-md="row">
<md-card layout-padding flex-gt-md="70">
	<md-card-title-text>
	<h1>Contact Customer Support</h1>
	</md-card-title-text>
	<md-card-content>
		<md-input-container style="width: 100%">
			<label>What is your name?</label>
			<input type="text" ng-model="current_ticket.data.OPENED_BY">
		</md-input-container>
				<md-input-container style="width: 100%">
			<label>What is the best email to reach you at?</label>
			<input type="email" ng-model="current_ticket.data.CONTACT_EMAIL">
		</md-input-container>
			<md-input-container style="width: 100%">
			<label>Please Describe the Issue</label>
			<textarea rows="5" ng-model="current_ticket.data.DESCRIPTION"></textarea>
		</md-input-container>
	</md-card-content>
	<md-card-actions>
		<md-button ng-click="save(current_ticket, 1)" class="md-primary md-raised">Submit</md-button>
	</md-card-actions>
</md-card>

<md-card layout-padding flex-gt-md="25">
	<md-card-title-text>
		Customer Support Details
	</md-card-title-text>
	<md-content>
		<span><h2><i class="fa fa-envelope-o" aria-hidden="true"></i>support@trythread.com</h2></span>
		<span><h2><i class="fa fa-phone" aria-hidden="true"></i>612-275-8960</h2></span>
	</md-content>
</md-card>
</div>