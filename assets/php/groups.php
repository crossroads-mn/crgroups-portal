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
      <md-nav-item ng-if="groups_sub_selected=='new' || groups_sub_selected=='edit'" md-nav-click="previous()" name="previous"><i class="fa fa-chevron-left" aria-hidden="true"></i>Back</md-nav-item>
      <md-nav-item md-nav-click="goto_page('/index.php?table=Groups')" name="view">
        Browse Groups
      </md-nav-item>
      <md-nav-item md-nav-click="goto_page('/index.php?table=Groups&option=new')" name="new">
        New
      </md-nav-item>
      <md-nav-item ng-if="groups_sub_selected=='new' || groups_sub_selected=='edit'" md-nav-click="save(current_group)">
		Save
      </md-nav-item>
      <md-nav-item md-nav-click="copy_to_clipboard()" aria-label="Shareable Link" class="md-fab md-raised md-mini">
      	<i class="fa fa-share-square-o" aria-hidden="true"></i>Share
      </md-nav-item>
        <md-nav-item ng-if="groups_sub_selected=='edit' && current_group.data.ACTIVE == '1'" md-nav-click="save(current_group, 0)">
		Delete
      </md-nav-item>
       <md-nav-item ng-if="groups_sub_selected=='edit' && current_group.data.ACTIVE == '0'" md-nav-click="save(current_group, 1)">
      		Restore
      	</md-nav-item>
    </md-nav-bar>
</md-content>
</div>

	<div ng-if="current_group.data.ACTIVE == '0'" class='archived'>
		<p>This record has been archived. <a href="#" ng-click="save(current_group, 1)">Click here to restore it</a></p>
	</div>


<div ng-if="groups_sub_selected=='view'">
<md-card layout-align="start" layout-padding>
<md-card-title-text>
	<h1>Small Groups</h1>
	<input type="text" ng-model="query" placeholder="Search Small Groups">
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
    		<td>
    			<i title="This record has been archived." ng-show="\\\p.ACTIVE\\\=='0'" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
    			<a href="/index.php?table=Groups&sys_id=\\\p.SYS_ID\\\">\\\p.TITLE\\\</a>
    		</td>
    		<td>\\\p.LEADER\\\</td>
    		<td>\\\p.CAMPUS\\\</td>
    		<td>\\\p.DATE_SUBMITTED\\\</td>
    		<td><md-button class="md-warn md-raised" ng-href="/index.php?table=Groups&sys_id=\\\p.SYS_ID\\\">edit</md-button></td>
    	</tr>
    </tbody>
</table>
	</md-card-content>
</md-card>
</div>

<div layout-gt-md="row" ng-if="groups_sub_selected=='new'" >
	<div flex-gt-md="70">
		<md-card layout-padding>
			<md-card-title-text>
				<md-input-container style="width: 100%">
					<label>Title</label>
					<input type="text" ng-model="current_group.data.TITLE">
				</md-input-container>
			</md-card-title-text>
			<md-card-content>
				<md-input-container style="width: 100%">
				<label>Group Description</label>
			<textarea name="content" ng-model="current_group.data.DESCRIPTION" rows="8"></textarea>
		</md-input-container>
		<md-input-container style="width: 100%">
			<label>Why Pick this Group?</label>
			<textarea name="content" ng-model="current_group.data.WHY" rows="8"></textarea>
		</md-input-container>
		<md-input-container style="width: 100%">
				<label>Notes</label>
			<textarea name="content" ng-model="current_group.data.NOTES" rows="8"></textarea>
		</md-input-container>
				<md-input-container>
			<label>Registration Link</label>
			<input required type="text" ng-model="current_group.data.GROUP_LINK">
		</md-input-container>
	</md-card-content>
		</md-card>
	</div>

	<!-- Here we will put the sidebar for editting a post -->
	<div flex-gt-md="30" layout-fill style="max-height: 1800px">
		<md-card layout-padding style="width: 100%; max-height: 250% !important; min-height: 150% !important;">
			<md-card-content layout="column">
				<md-input-container>
					<label>Author</label>
					<input type="text" ng-model="user.USERNAME" readonly>
				</md-input-container>
				<md-input-container>
					<label>Who Should Attend?</label>
					<input type="text" ng-model="current_group.data.TARGET_AUDIENCE">
				</md-input-container>
				<md-input-container>
					<label>Day of Meeting</label>
					<input type='text' ng-model="current_group.data.MEET_DAY">
				</md-input-container>
				<md-input-container>
					<label>What time is the meetings held?</label>
					<input required type="text" ng-model="current_group.data.MEET_TIME_START">
				</md-input-container>
				<md-input-container>
					<label>Leader's Names</label>
					<input required type="text" ng-model="current_group.data.LEADER">
				</md-input-container>
				<md-input-container>
					<label>Contact Phone Number</label>
					<input required type="tel" ng-model="current_group.data.PHONE_NUMBER">
				</md-input-container>
				<md-input-container>
					<label>Contact Email Address</label>
					<input required type="email" ng-model="current_group.data.EMAIL">
				</md-input-container>
				<md-input-container>
					<label>Which City?</label>
					<input required type="text" ng-model="current_group.data.CAMPUS">
				</md-input-container>
				<md-input-container>
					<label>Where will the meeting be held?</label>
					<input required type="text" ng-model="current_group.data.LOCATION">
				</md-input-container>
				<md-input-container>
					<label>What is the cost?</label>
					<input required type="text" ng-model="current_group.data.COST">
				</md-input-container>
				<md-input-container>
					<label>What is the ideal size of the group?</label>
					<input required type="text" ng-model="current_group.data.IDEAL_SIZE">
				</md-input-container>
				<md-input-container>
					<label>Book Link</label>
					<input required type="text" ng-model="current_group.data.BOOK_LINKS">
				</md-input-container>
				<md-input-container>
					<label>Semester</label>
					<input required type="text" ng-model="current_group.data.SEMESTER">
				</md-input-container>
				<md-input-container>
					<label>Group Type</label>
					<input required type="text" ng-model="current_group.data.GROUP_TYPE">
				</md-input-container>
				<md-input-container>
					<label>Duration</label>
					<input required type="text" ng-model="current_group.data.DURATION">
				</md-input-container>
				<md-input-container>
					<label>Co-Leader Phone</label>
					<input required type="text" ng-model="current_group.data.CO_LEADER_PHONE">
				</md-input-container>
				<md-input-container>
					<label>Co-Leader Email</label>
					<input required type="text" ng-model="current_group.data.CO_LEADER_EMAIL">
				</md-input-container>
				<md-input-container>
					<label>Is Child Care Provided?</label>
					<md-select ng-model="current_group.data.CARE_PROVIDED" required>
						<md-option ng-value="yorn.value" ng-repeat="yorn in yesorno">\\\yorn.label\\\</md-option>
					</md-select>
				<br/>
			</md-card-content>
		</md-card>
	</div>
</div>

<div layout-gt-md="row" ng-if="groups_sub_selected=='edit'" >
	<div flex-gt-md="70">
		<md-card layout-padding>
			<md-card-title-text>
				<md-input-container style="width: 100%">
					<label>Title</label>
					<input type="text" ng-model="current_group.data.TITLE">
				</md-input-container>
			</md-card-title-text>
			<md-card-content>
				<md-input-container style="width: 100%">
				<label>Group Description</label>
			<textarea name="content" ng-model="current_group.data.DESCRIPTION" rows="8"></textarea>
		</md-input-container>
		<md-input-container style="width: 100%">
			<label>Why Pick this Group?</label>
			<textarea name="content" ng-model="current_group.data.WHY" rows="8"></textarea>
		</md-input-container>
				<md-input-container style="width: 100%">
				<label>Notes</label>
			<textarea name="content" ng-model="current_group.data.NOTES" rows="8"></textarea>
		</md-input-container>
		<md-input-container>
			<label>Registration Link</label>
			<input required type="text" ng-model="current_group.data.GROUP_LINK">
		</md-input-container>
	</md-card-content>
		</md-card>
	</div>

	<!-- Here we will put the sidebar for editting a post -->
	<div flex-gt-md="30" layout-fill style="max-height: 1800px">
		<md-card layout-padding style="width: 100%; max-height: 250% !important; min-height: 150% !important;">
			<md-card-content layout="column">
				<md-input-container>
					<label>Author</label>
					<input type="text" ng-model="current_group.data.AUTHOR" readonly>
				</md-input-container>
				<md-input-container>
					<label>Who Should Attend?</label>
					<input type="text" ng-model="current_group.data.TARGET_AUDIENCE">
				</md-input-container>
				<md-input-container>
					<label>Day of Meeting</label>
					<input type='text' ng-model="current_group.data.MEET_DAY">
				</md-input-container>
				<md-input-container>
					<label>What time is the meeting held?</label>
					<input required type="text" value="current_group.data.MEET_TIME_START" ng-model="current_group.data.MEET_TIME_START">
				</md-input-container>
				<md-input-container>
					<label>Leader's Names</label>
					<input required type="text" ng-model="current_group.data.LEADER">
				</md-input-container>
				<md-input-container>
					<label>Contact Phone Number</label>
					<input required type="tel" ng-model="current_group.data.PHONE_NUMBER">
				</md-input-container>
				<md-input-container>
					<label>Contact Email Address</label>
					<input required type="email" ng-model="current_group.data.EMAIL">
				</md-input-container>
				<md-input-container>
					<label>Which City?</label>
					<input required type="text" ng-model="current_group.data.CAMPUS">
				</md-input-container>
				<md-input-container>
					<label>Where will the meeting be held?</label>
					<input required type="text" ng-model="current_group.data.LOCATION">
				</md-input-container>
				<md-input-container>
					<label>What is the cost?</label>
					<input required type="text" ng-model="current_group.data.COST">
				</md-input-container>
				<md-input-container>
					<label>What is the ideal size of the group?</label>
					<input required type="text" ng-model="current_group.data.IDEAL_SIZE">
				</md-input-container>
				<md-input-container>
					<label>Book Link</label>
					<input required type="text" ng-model="current_group.data.BOOK_LINKS">
				</md-input-container>
				<md-input-container>
					<label>Semester</label>
					<input required type="text" ng-model="current_group.data.SEMESTER">
				</md-input-container>
				<md-input-container>
					<label>Group Type</label>
					<input required type="text" ng-model="current_group.data.GROUP_TYPE">
				</md-input-container>
				<md-input-container>
					<label>Duration</label>
					<input required type="text" ng-model="current_group.data.DURATION">
				</md-input-container>
				<md-input-container>
					<label>Co-Leader Phone</label>
					<input required type="text" ng-model="current_group.data.CO_LEADER_PHONE">
				</md-input-container>
				<md-input-container>
					<label>Co-Leader Email</label>
					<input required type="text" ng-model="current_group.data.CO_LEADER_EMAIL">
				</md-input-container>
				<md-input-container>
					<label>Is Child Care Provided?</label>
					<md-select ng-model="current_group.data.CARE_PROVIDED" required>
						<md-option ng-value="yorn.value" ng-repeat="yorn in yesorno">\\\yorn.label\\\</md-option>
					</md-select>
				<br/>
			</md-card-content>
		</md-card>
	</div>
</div>
