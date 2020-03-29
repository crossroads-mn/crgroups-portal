<div width="100%">

	<md-card layout-padding>
		<md-card-title-text>
			<h1>Integrations</h1>
		</md-card-title-text>
		<div layout-gt-xs="row">
		<md-card flex-gt-xs="50">
			<i class="fa fa-twitter"></i>
			<md-input-container>
				<label>Consumer API Key</label>
				<input name="twitter_api" type="text" ng-model="integrations.twitter.consumer_key">
			</md-input-container>
			<md-input-container>
				<label>Consumer API Secret</label>
				<input style="-webkit-text-security: disc;" name="twitter_secret" type="text" ng-model="integrations.twitter.consumer_secret">
			</md-input-container>
						<md-input-container>
				<label>Access API Key</label>
				<input name="twitter_api" type="text" ng-model="integrations.twitter.access_key">
			</md-input-container>
			<md-input-container>
				<label>Access API Secret</label>
				<input style="-webkit-text-security: disc;" name="twitter_secret" type="text" ng-model="integrations.twitter.access_secret">
			</md-input-container>
		</md-card>

		<md-card flex-gt-xs="50">
			<i class="fa fa-facebook"></i>
			<md-input-container>
				<label>API Key</label>
				<input name="facebook_api" type="text" ng-model="integrations.facebook.api_key">
			</md-input-container>
			<md-input-container>
				<label>API Secret</label>
				<input style="-webkit-text-security: disc;" name="facebook_secret" type="text" ng-model="integrations.facebook.secret">
			</md-input-container>
		</md-card>
	</div>

	<div layout-gt-xs="row">
		<md-card flex-gt-xs="50">
			<i class="fa fa-linkedin"></i>
			<md-input-container>
				<label>API Key</label>
				<input name="linkedin_api" type="text" ng-model="integrations.linkedin.api_key">
			</md-input-container>
			<md-input-container>
				<label>API Secret</label>
				<input style="-webkit-text-security: disc;" name="linkedin_secret" type="text" ng-model="integrations.linkedin.secret">
			</md-input-container>
		</md-card>

		<md-card flex-gt-xs="50">
			<i class="fa fa-facebook"></i>
			<md-input-container>
				<label>API Key</label>
				<input name="facebook_api" type="text" ng-model="integrations.facebook.api_key">
			</md-input-container>
			<md-input-container>
				<label>API Secret</label>
				<input style="-webkit-text-security: disc;" name="facebook_secret" type="text" ng-model="integrations.facebook.secret">
			</md-input-container>
		</md-card>
	</div>

	</md-card>
</div>