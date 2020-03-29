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
        <md-nav-item ng-if="events_sub_selected=='edit'" md-nav-click="delete(current_event)">
		Delete
      </md-nav-item>
    </md-nav-bar>
</md-content>
</div>


<div ng-if="events_sub_selected=='view'">
<md-card layout-align="start" layout-padding>
<md-card-title-text>
	<h1>Small events</h1>
	<input type="text" ng-model="query" placeholder="Search Small events">
</md-card-title-text>
<md-card-content>
	<table class="table table-hover">
    <thead>
      <tr>
        <th>Title</th>
        <th>Owner</th>
        <th>Location</th>
        <th>Created On</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
    	<tr ng-repeat="p in posts | filter : query | orderBy: 'TITLE'">
    		<td><a href="/index.php?table=events&sys_id=\\\p.SYS_ID\\\">\\\p.TITLE\\\</a></td>
    		<td>\\\p.LEADER\\\</td>
    		<td>\\\p.CAMPUS\\\</td>
    		<td>\\\p.DATE_SUBMITTED\\\</td>
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
				<md-input-container style="width: 100%">
				<label>Group Description</label>
			<textarea name="content" ng-model="current_event.data.DESCRIPTION" rows="8"></textarea>
		</md-input-container>
		<md-input-container style="width: 100%">
			<label>Why Pick this Group?</label>
			<textarea name="content" ng-model="current_event.data.WHY" rows="8"></textarea>
		</md-input-container>
	</md-card-content>
		</md-card>
	</div>

	<!-- Here we will put the sidebar for editting a post -->
	<div flex-gt-md="30" layout-fill style="max-height: 1800px">
		<md-card layout-padding style="width: 100%; max-height: 200% !important; min-height: 150% !important;">
			<md-card-content layout="column">
				<md-input-container>
					<label>Author</label>
					<input type="text" ng-model="user.USERNAME" readonly>
				</md-input-container>
				<md-input-container>
					<label>Who Should Attend?</label>
					<input type="text" ng-model="current_event.data.TARGET_AUDIENCE">
				</md-input-container>
				<md-input-container>
					<label>Day of Meeting</label>
					<md-select ng-model="current_event.data.MEET_DAY">
						<md-option ng-value="opt" ng-repeat="opt in days_of_week">\\\opt\\\</md-option>
					</md-select>
				</md-input-container>
				<md-input-container>
					<label>What time is the meetings held?</label>
					<input required type="text" ng-model="current_event.data.MEET_TIME_START">
				</md-input-container>
				<md-input-container>
					<label>Leader's Names</label>
					<input required type="text" ng-model="current_event.data.LEADER">
				</md-input-container>
				<md-input-container>
					<label>Contact Phone Number</label>
					<input required type="tel" ng-model="current_event.data.PHONE_NUMBER">
				</md-input-container>
				<md-input-container>
					<label>Contact Email Address</label>
					<input required type="email" ng-model="current_event.data.EMAIL">
				</md-input-container>
				<md-input-container>
					<label>Where will the meeting be held?</label>
					<md-select required type="text" ng-model="current_event.data.CAMPUS">
						<md-option ng-value='campus' ng-repeat='campus in campuses'>\\\campus\\\</md-option>
					</md-select>
				</md-input-container>
				<md-input-container>
					<label>What is the cost?</label>
					<input required type="text" ng-model="current_event.data.COST">
				</md-input-container>
				<md-input-container>
					<label>Is Child Care Provided?</label>
					<md-select ng-model="current_event.data.CCPROVIDED" required>
						<md-option ng-value="yorn.value" ng-repeat="yorn in yesorno">\\\yorn.label\\\</md-option>
					</md-select>
				<br/>
			</md-card-content>
		</md-card>
	</div>
</div>

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
				<md-input-container style="width: 100%">
				<label>Group Description</label>
			<textarea name="content" ng-model="current_event.data.DESCRIPTION" rows="8"></textarea>
		</md-input-container>
		<md-input-container style="width: 100%">
			<label>Why Pick this Group?</label>
			<textarea name="content" ng-model="current_event.data.WHY" rows="8"></textarea>
		</md-input-container>
	</md-card-content>
		</md-card>
	</div>

	<!-- Here we will put the sidebar for editting a post -->
	<div flex-gt-md="30" layout-fill style="max-height: 1800px">
		<md-card layout-padding style="width: 100%; max-height: 200% !important; min-height: 150% !important;">
			<md-card-content layout="column">
				<md-input-container>
					<label>Author</label>
					<input type="text" ng-model="current_event.data.AUTHOR" readonly>
				</md-input-container>
				<md-input-container>
					<label>Who Should Attend?</label>
					<input type="text" ng-model="current_event.data.TARGET_AUDIENCE">
				</md-input-container>
				<md-input-container>
					<label>Day of Meeting</label>
					<md-select ng-model="current_event.data.MEET_DAY">
						<md-option ng-value="opt" ng-repeat="opt in days_of_week">\\\opt\\\</md-option>
					</md-select>
				</md-input-container>
				<md-input-container>
					<label>What time is the meeting held?</label>
					<input required type="text" value="current_event.data.MEET_TIME_START" ng-model="current_event.data.MEET_TIME_START">
				</md-input-container>
				<md-input-container>
					<label>Leader's Names</label>
					<input required type="text" ng-model="current_event.data.LEADER">
				</md-input-container>
				<md-input-container>
					<label>Contact Phone Number</label>
					<input required type="tel" ng-model="current_event.data.PHONE_NUMBER">
				</md-input-container>
				<md-input-container>
					<label>Contact Email Address</label>
					<input required type="email" ng-model="current_event.data.EMAIL">
				</md-input-container>
				<md-input-container>
					<label>Where will the meeting be held?</label>
					<md-select required type="text" ng-model="current_event.data.CAMPUS">
						<md-option ng-value='campus' ng-repeat='campus in campuses'>\\\campus\\\</md-option>
					</md-select>
				</md-input-container>
				<md-input-container>
					<label>What is the cost?</label>
					<input required type="text" ng-model="current_event.data.COST">
				</md-input-container>
				<md-input-container>
					<label>Is Child Care Provided?</label>
					<md-select ng-model="current_event.data.CARE_PROVIDED" required>
						<md-option ng-value="yorn.value" ng-repeat="yorn in yesorno">\\\yorn.label\\\</md-option>
					</md-select>
				<br/>
			</md-card-content>
		</md-card>
	</div>
</div>
