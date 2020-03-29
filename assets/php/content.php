<?php
?>


<div ng-cloak class="content-window">

  <div ng-show="selected=='profile'">
  </div>


  <div ng-show="selected=='dashboard'" layout-gt-md="row"> 
    <md-card layout-padding>
      <md-card-title-text>
        <h2>How to use this tool?</h2>
      </md-card-title-text>
      <md-content>
        <ul>
          <li>Click on "Groups" in the sidebar on the right</li>
          <li>Select "New" to create a new small group</li>
          <li>Fill out any details needed, scroll back up to the top and press the "Save" button</li>
          <li>Make sure to Save any progress before navigating away from the screen!</li>
          <li>Click the "< Back" button or "Browse Groups" to return to the groups page</li>
          <li>To edit any existing groups, simply press the "EDIT" button next to the group</li>
          <li>For any questions, please contact support@trythread.com</li>
        </ul>
      </md-content>
    </md-card>
    </div>



  <div ng-show="selected=='Assets'" layout-gt-xs="column">
    <?php include "assets.php"; ?>
  </div>
  <div ng-show="selected=='Workers'" layout-gt-xs="row">
    <?php include "workers.php"; ?>
  </div>

    <div ng-show="selected=='Integrations'">
    <?php include "integrations.php"; ?>
  </div>

  <div ng-show="selected=='Data'" layout-gt-xs="row">
    <?php include "home.php"; ?>
  </div>

  <div ng-show="selected=='Settings'" layout-gt-xs="row">
    <?php include "settings.php"; ?>
  </div>

  <div ng-show="selected=='notifications'" layout-gt-xs="row">
    <?php include "chat.php"; ?>
  </div>

  <div ng-show="selected=='Posts'">
    <?php include "posts.php"; ?>
  </div>

  <div ng-show="selected=='Groups'">
    <?php include "groups.php"; ?>
  </div>

  <div ng-show="selected=='Support'">
    <?php include "support.php"; ?>
  </div>

  <div ng-show="selected=='Upload'">
    <?php include "upload_page.php";?>
  </div>

  <div ng-show="selected=='Events'">
    <?php include "events.php";?>
  </div>








  <div ng-show="selected=='Accounts'" layout-gt-xs="row">
      <md-card flex='70' layout-align="start">
          <md-card-title-text id="card-title-text">
             \\\urlparms.Table.capitalize()\\\
          </md-card-title-text>

          <md-card-content class="base-content" layout-align="start">
            <md-input-container ng-repeat="(key, value) in record.data">
              <label ng-hide="key=='PASSWORD' || key=='SALT'">\\\key\\\</label>
                <input ng-hide="key=='PASSWORD' || key=='SALT'" ng-disabled="key=='SYS_ID' || key=='SYS_CREATED_ON' || key=='SYS_CREATED_BY' || key=='GUID'" ng-model="record.data[key]" type="text">
            </md-input-container>

            <!--<md-input-container>
              <label>Enter New Password</label>
              <input ng-model="record.data.PASSWORD" type="password">
            </md-input-container>-->
          </md-card-content>
          <div ng-hide='record.data===undefined'>
          <md-button layout-align="start start" ng-click="save()" class="md-raised md-primary">Save</md-button>
          <md-button ng-click="delete()" class="md-raised md-warn">Delete</md-button>
        </div>
      </md-card>
      <md-card style="height: 95%; overflow-y: auto" flex>
        <md-input-container layout="row">
            <label><i class="fa fa-search" aria-hidden="true"></i> Search</label>
            <input ng-model="search_text" type="text">
        </md-input-container>
        <md-list layout-align="start start" flex>
            <md-subheader-text><span style="padding-left: 12px;" class="md-title">Recent Accounts</span></md-subheader-text>
            <md-list-item layout-align="start start" id="searchitem" class="md-3-line" ng-repeat="item in records.data | filter:search_text" ng-click="load_record(item)">
                <img style="border-radius: 50%; padding:12px;" ng-src="./assets/img/default.png">
            <div class="md-list-item-text" layout="column">
            <h3>\\\item.FIRST_NAME\\\ \\\item.LAST_NAME\\\</h3>
            <h4>\\\item.USERNAME\\\</h4>
            <p></p>
          </div>
            </md-list-item>
        </md-list>
      </md-card>
        <md-fab-speed-dial md-open="false" md-direction="up">
          <md-fab-trigger>
            <md-button aria-label="menu" class="md-fab md-warn">
              <md-icon md-font-icon="menu">menu</md-icon>
            </md-button>
          </md-fab-trigger>
          <md-fab-actions>
          <md-button aria-label="Add New" class="md-fab md-raised md-mini">
            <md-icon ng-click="add_new(urlparms.Table.capitalize())" md-font-icon="add_circle_outline" aria-label="Add New">add_circle_outline</md-icon>
          </md-button>
          <md-button aria-label="Shareable Link" class="md-fab md-raised md-mini">
            <md-icon ng-click="copy_to_clipboard()" md-font-icon="open_in_new" aria-label="Shareable Link">open_in_new</md-icon>
          </md-button>
          </md-fab-actions>
        </md-fab-speed-dial>
  </div>


<div ng-show="selected=='Financials'" layout-gt-xs="row">
<!--php include 'financial_balance_sheet.php';?>-->
</div>








  <div ng-show="selected=='notifications'">
    <md-card ng-repeat="item in notifications">
      <md-card-header-text>
        <span class="md-title">\\\item.SHORT_DESCRIPTION\\\</span>
      </md-card-header-text>
      <md-card-content>
        <p>\\\item.CONTENT\\\</p>
      </md-card-content>
    </md-card>
  </div>

</div>
</body>