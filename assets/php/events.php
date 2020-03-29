<?php
//Here we will have our posts module.
//Created on January 3rd, 2018
//Responsible for creating a new blog post within the admin system.

?>
<!-- Subheader for the posts.php page -->

<div style="width: 100%" layout="column" >
  <md-content class="md-padding">
    <md-nav-bar ng-init="asset_selector" 
      md-no-ink-bar="disableInkBar"
      md-selected-nav-item="currentNavItem"
      nav-bar-aria-label="navigation links">
      <md-nav-item ng-if="events_sub_selected=='new' || events_sub_selected=='edit'" md-nav-click="previous()" name="previous"><i class="fa fa-chevron-left" aria-hidden="true"></i>Back</md-nav-item>
      <md-nav-item md-nav-click="goto_page('/index.php?table=events')" name="view">
        Browse events
      </md-nav-item>
      <md-nav-item md-nav-click="goto_page('/index.php?table=events&option=new')" name="new">
        New
      </md-nav-item>
      <md-nav-item ng-if="events_sub_selected=='new' || events_sub_selected=='edit'" md-nav-click="save(current_event)">
		Save
      </md-nav-item>
      <md-nav-item md-nav-click="copy_to_clipboard()" aria-label="Shareable Link" class="md-fab md-raised md-mini">
      	<i class="fa fa-share-square-o" aria-hidden="true"></i>Share
      </md-nav-item>

        <md-nav-item ng-if="events_sub_selected=='edit' && current_event.data.ACTIVE == '1'" md-nav-click="save(current_event, 0)">
		Delete
      </md-nav-item>

      	<md-nav-item ng-if="events_sub_selected=='edit' && current_event.data.ACTIVE == '0'" md-nav-click="save(current_event, 1)">
      		Restore
      	</md-nav-item>
    </md-nav-bar>
</md-content>
</div>

	<div ng-if="current_event.data.ACTIVE == '0'" class='archived'>
		<p>This record has been archived. <a href="#" ng-click="save(current_event, 1)">Click here to restore it</a></p>
	</div>


<div ng-if="events_sub_selected=='view'">
<md-card layout-align="start" layout-padding>
<md-card-title-text>
	<h1>Events</h1>
	<input type="text" ng-model="query" placeholder="Search Events">
</md-card-title-text>
<md-card-content>
	<table class="table table-hover">
    <thead>
      <tr>
        <th>Event Title</th>
        <th>Owner</th>
        <th>Location</th>
        <th>Event Date</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
    	<tr ng-repeat="p in events | filter : query | orderBy: ''">
    		<td><i title="This record has been archived." ng-show="\\\p.ACTIVE\\\=='0'" class="fa fa-exclamation-triangle" aria-hidden="true"></i><a href="/index.php?table=events&sys_id=\\\p.SYS_ID\\\">\\\p.TITLE\\\</a></td>
    		<td>\\\p.OWNER\\\</td>
    		<td>\\\p.LOCATION\\\</td>
    		<td>\\\p.SYS_EVENT_DATE\\\</td>
    		<td><md-button class="md-warn md-raised" ng-href="/index.php?table=events&sys_id=\\\p.SYS_ID\\\">edit</md-button></td>
    	</tr>
    </tbody>
</table>
	</md-card-content>
</md-card>
</div>


<div layout-gt-md="row" ng-if="events_sub_selected=='new'" >
	<div flex-gt-md="70">
		<md-card layout-padding>
			<md-card-title-text>
				<md-input-container style="width: 100%">
					<label>Title</label>
					<input type="text" ng-model="current_event.data.TITLE">
				</md-input-container>
			</md-card-title-text>
			<md-card-content>
				<md-input-container>
					<label>Event Owner</label>
					<input type="text" ng-model="current_event.data.OWNER">
				</md-input-container>

				<md-input-container style="width: 100%">
				<label>Event Description</label>
			<textarea name="content" ng-model="current_event.data.DESCRIPTION" rows="8"></textarea>
		</md-input-container>
		<md-input-container style="width: 100%">
			<label>Campus</label>
			<input type="text" name="content" ng-model="current_event.data.LOCATION" rows="8"></textarea>
		</md-input-container>
	</md-card-content>
		</md-card>
	</div>

	<!-- Here we will put the sidebar for editting a post -->
	<div flex-gt-md="30" layout-fill style="max-height: 1800px">
		<md-card layout-padding style="width: 100%; max-height: 200% !important; min-height: 150% !important;">
			<md-card-content layout="column">

				<md-input-container>
					<label>Event Date</label>
					<md-datepicker ng-model="current_event.data.SYS_EVENT_DATE"></md-datepicker>
				</md-input-container>

				<md-input-container>
					<label>Event Start Time</label>
					<input type="text" ng-model="current_event.data.START_TIME" >
				</md-input-container>

				<md-input-container>
					<label>Event End Time</label>
					<input type="text" ng-model="current_event.data.END_TIME" >
				</md-input-container>

				<md-input-container>
					<label>Contact Email</label>
					<input type="email" ng-model="current_event.data.CONTACT_EMAIL" >
				</md-input-container>

				<md-input-container>
					<label>Cost</label>
					<input type="text" ng-model="current_event.data.COST" >
				</md-input-container>

				<md-input-container>
					<label>Registration Link</label>
					<input type="text" ng-model="current_event.data.REGISTRATION_LINK" >
				</md-input-container>

				<md-input-container>
					<label>Childcare Link</label>
					<input type="text" ng-model="current_event.data.CHILDCARE_LINK">
				</md-input-container>

				<md-input-container>
					<label>Category</label>
					<input type="text" ng-model="current_event.data.CATEGORY" >
				</md-input-container>


			</md-card-content>
		</md-card>
	</div>
</div>


<!-- Beginning Events Groups -->



<div layout-gt-md="row" ng-if="events_sub_selected=='edit'" >
	<div flex-gt-md="70">
		<md-card layout-padding>
			<md-card-title-text>
				<md-input-container style="width: 100%">
					<label>Title</label>
					<input type="text" ng-model="current_event.data.TITLE">
				</md-input-container>
			</md-card-title-text>
			<md-card-content>
				<md-input-container>
					<label>Event Owner</label>
					<input type="text" ng-model="current_event.data.OWNER">
				</md-input-container>

				<md-input-container style="width: 100%">
				<label>Event Description</label>
			<textarea name="content" ng-model="current_event.data.DESCRIPTION" rows="8"></textarea>
		</md-input-container>
		<md-input-container style="width: 100%">
			<label>Campus</label>
			<input type="text" name="content" ng-model="current_event.data.LOCATION" rows="8"></textarea>
		</md-input-container>
	</md-card-content>
		</md-card>
	</div>

	<!-- Here we will put the sidebar for editting a post -->
	<div flex-gt-md="30" layout-fill style="max-height: 1800px">
		<md-card layout-padding style="width: 100%; max-height: 200% !important; min-height: 150% !important;">
			<md-card-content layout="column">

				<md-input-container>
					<label>Event Date</label>
					<md-datepicker ng-model="current_event.data.SYS_EVENT_DATE"></md-datepicker>

				</md-input-container>

				<md-input-container>
					<label>Event Start Time</label>
					<input type="text" ng-model="current_event.data.START_TIME" >
				</md-input-container>

				<md-input-container>
					<label>Event End Time</label>
					<input type="text" ng-model="current_event.data.END_TIME" >
				</md-input-container>

				<md-input-container>
					<label>Contact Email</label>
					<input type="email" ng-model="current_event.data.CONTACT_EMAIL" >
				</md-input-container>

				<md-input-container>
					<label>Cost</label>
					<input type="text" ng-model="current_event.data.COST" >
				</md-input-container>

				<md-input-container>
					<label>Registration Link</label>
					<input type="text" ng-model="current_event.data.REGISTRATION_LINK" >
				</md-input-container>

				<md-input-container>
					<label>Childcare Link</label>
					<input type="text" ng-model="current_event.data.CHILDCARE_LINK">
				</md-input-container>

				<md-input-container>
					<label>Category</label>
					<input type="text" ng-model="current_event.data.CATEGORY" >
				</md-input-container>


			</md-card-content>
		</md-card>
	</div>
</div>



<!-- End of Event Editting -->
