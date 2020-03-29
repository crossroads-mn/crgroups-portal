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
      
      <md-nav-item md-nav-click="goto_page('/index.php?table=Posts')" name="view">
        Browse Posts
      </md-nav-item>
      <md-nav-item md-nav-click="goto_page('/index.php?table=Posts&option=new')" name="new">
        New
      </md-nav-item>
      <md-nav-item ng-if="posts_sub_selected=='new' || posts_sub_selected=='edit'" md-nav-click="save(current_post)">
		Save
      </md-nav-item>
      <md-nav-item aria-label="Shareable Link" class="md-fab md-raised md-mini">
       <md-icon ng-click="copy_to_clipboard()" md-font-icon="open_in_new" aria-label="Shareable Link">open_in_new</md-icon>
       </md-nav-item>
    </md-nav-bar>
</md-content>
</div>


<div ng-if="posts_sub_selected=='view'">
<md-card flex="80" layout-align="start">
<md-card-title-text>
	<h1>Posts</h1>
</md-card-title-text>
<md-card-content>
	<table class="table table-hover">
    <thead>
      <tr>
        <th>Post #</th>
        <th>Title</th>
        <th>Author</th>
        <th>Created</th>
      </tr>
    </thead>

    <tbody>
    	<tr ng-repeat="p in posts">
    		<td><a href="/index.php?table=POSTS&sys_id=\\\p.SYS_ID\\\">\\\p.GUID\\\</a></td>
    		<td>\\\p.TITLE\\\</td>
    		<td>\\\p.AUTHOR\\\</td>
    		<td>\\\p.SYS_CREATED_ON\\\</td>
    	</tr>
    </tbody>
</table>
	</md-card-content>
</md-card>
</div>

<div layout="row" ng-if="posts_sub_selected=='new'" >
	<div layout="column" flex="75">
		<md-card layout-padding>
			<md-card-title-text>
				<md-input-container style="width: 100%">
					<label>Post Title</label>
					<input type="text" ng-model="current_post.data.TITLE">
				</md-input-container>
			</md-card-title-text>
			<md-card-content>
				<md-input-container style="width: 100%">
				<label>Post Content</label>
			<textarea name="content" ng-model="current_post.data.CONTENT" rows="8"></textarea>
		</md-input-container>
	</md-card-content>
		</md-card>
	</div>

	<!-- Here we will put the sidebar for editting a post -->
	<div layout="column" flex="25" layout-fill>
		<md-card layout-padding style="width: 100%">

				<md-input-container>
					<label>Author</label>
					<input type="text" ng-model="user.USERNAME" readonly>
				</md-input-container>
				<md-input-container>
					<label>Order</label>
					<input type="text" ng-model="current_post.data.ORDER_STATUS">
				</md-input-container>
				<md-input-container>
					<label>Post Type</label>
					<md-select ng-model="current_post.data.POST_TYPE">
	        			<md-option ng-repeat="at in post_types" value="\\\at\\\">\\\at\\\</md-option>
			      	</md-select>
				</md-input-container>
				<md-input-container>
					<label>Header Color</label>
					<input type="text" maxlength="20" ng-model="current_post.data.HEADER_COLOR">
					<canvas height="32" width="32" style="background-color: \\\current_post.data.HEADER_COLOR\\\; border:1px; border-color:#000;"  />
				</md-input-container>
				<md-input-container>
					<label>Font Color</label>
					<input type="text" maxlength="20" ng-model="current_post.data.FONT_COLOR">
					<canvas height="32" width="32" style="background-color: \\\current_post.data.FONT_COLOR\\\; border:1px; border-color:#000;"  />
				</md-input-container>
				<md-input-container>
					<label>Image Link URL</label>
					<input type="text" ng-model="current_post.data.IMAGE_LINK">
				</md-input-container>
				<b>Thumbnail Preview:</b><br />
	       <img style="width: 280px" ng-src="\\\current_post.data.IMAGE_LINK\\\" /><br/>

		</md-card>
	</div>
</div>

<div layout="row" ng-if="posts_sub_selected=='edit'" >
	<div layout="column" flex="75">
		<md-card layout-padding>
			<md-card-title-text>
				<md-input-container style="width: 100%">
					<label>Post Title</label>
					<input type="text" ng-model="current_post.data.TITLE">
				</md-input-container>
			</md-card-title-text>
			<md-card-content>
				<md-input-container style="width: 100%">
				<label>Post Content</label>
			<textarea name="content" ng-model="current_post.data.CONTENT" rows="8"></textarea>
		</md-input-container>
	</md-card-content>
		</md-card>
	</div>

	<!-- Here we will put the sidebar for editting a post -->
	<div layout="column" flex="25" layout-fill>
		<md-card layout-padding style="width: 100%">

				<md-input-container>
					<label>Author</label>
					<input type="text" ng-model="current_post.data.AUTHOR" readonly>
				</md-input-container>
				<md-input-container>
					<label>Order</label>
					<input type="text" ng-model="current_post.data.ORDER_STATUS">
				</md-input-container>
				<md-input-container>
					<label>Post Type</label>
					<md-select ng-model="current_post.data.POST_TYPE">
	        			<md-option ng-repeat="at in post_types" value="\\\at\\\">\\\at\\\</md-option>
			      	</md-select>
				</md-input-container>
				<md-input-container>
					<label>Header Color</label>
					<input type="text" maxlength="20" ng-model="current_post.data.HEADER_COLOR">
					<canvas height="32" width="32" style="background-color: \\\current_post.data.HEADER_COLOR\\\; border:1px; border-color:#000;"  />
				</md-input-container>
				<md-input-container>
					<label>Font Color</label>
					<input type="text" maxlength="20" ng-model="current_post.data.FONT_COLOR">
					<canvas height="32" width="32" style="background-color: \\\current_post.data.FONT_COLOR\\\; border:1px; border-color:#000;"  />
				</md-input-container>
				<md-input-container>
					<label>Image Link URL</label>
					<input type="text" ng-model="current_post.data.IMAGE_LINK">
				</md-input-container>
				<b>Thumbnail Preview:</b><br />
	       <img style="width: 280px" ng-src="\\\current_post.data.IMAGE_LINK\\\" /><br/>

		</md-card>
	</div>
</div>