<div style="width: 100%" layout="column">
  <md-content class="md-padding">
    <md-nav-bar ng-init="asset_selector" 
      md-no-ink-bar="disableInkBar"
      md-selected-nav-item="currentNavItem"
      nav-bar-aria-label="navigation links">
      <md-nav-item md-nav-click="select_reports('players')" name="players">
        Users
      </md-nav-item>
      <md-nav-item md-nav-click="select_reports('economy')" name="economy">
        Network Usage
      </md-nav-item>
      <md-nav-item md-nav-click="select_reports('other')" name="other">
        Other
      </md-nav-item>
    </md-nav-bar>
</md-content>


<div ng-show="selected_report=='players'" layout="row" layout-padding>
	<md-card  flex="50" layout-padding>
		<md-card-title-text>
			<h2>Users Online: \\\players_online\\\</h2>
		</md-card-title-text>
	<md-content>
		<canvas id="players-online"></canvas>
	</md-content>
	</md-card>

	<md-card  flex="50" layout-padding>
		<md-card-title-text>
			<h2>Active Subscriptions / Time: \\\active_subscriptions\\\</h2>
		</md-card-title-text>
	<md-content>
		<canvas id="active-subscriptions"></canvas>
	</md-content>
	</md-card>
</div>

<div ng-show="selected_report=='players'" layout="row" layout-padding>
		<md-card  flex="50" layout-padding>
		<md-card-title-text>
			<h2>Whitelisted Addresses: \\\ban_repeals\\\</h2>
		</md-card-title-text>
	<md-content>
		<md-list flex>
	        <md-subheader class="md-no-sticky">most recent whitelisted addresses</md-subheader>
	        <md-list-item class="md-3-line" ng-repeat="item in sample_whitelist" ng-click="null">
	        	 <div class="md-list-item-text" layout="column">
	        	<h3>\\\item.ip\\\</h3>
            	<h4>\\\item.location\\\</h4>
            	<p>\\\item.provider\\\</p>
            </div>
	    	</md-list-item>
	    </md-list>
	</md-content>
	</md-card>

	<md-card  flex="50" layout-padding>
		<md-card-title-text>
			<h2>Blacklisted Addresses: \\\offenses_pending\\\</h2>
		</md-card-title-text>
	<md-content>
		<canvas id="offenses-pending" width="600px" height="400px"></canvas>
	</md-content>
	</md-card>
</div>

 <script src="assets/js/chart_data.js"></script>
</div>