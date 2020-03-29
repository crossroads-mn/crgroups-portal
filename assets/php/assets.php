<div style="width: 100%" layout="column">
  <md-content class="md-padding">
    <md-nav-bar ng-init="asset_selector" 
      md-no-ink-bar="disableInkBar"
      md-selected-nav-item="currentNavItem"
      nav-bar-aria-label="navigation links">
      <md-nav-item md-nav-click="select_assets('upload')" name="upload">
        UPLOAD
      </md-nav-item>
      <md-nav-item md-nav-click="select_assets('gui')" name="page1">
        GUI
      </md-nav-item>
      <md-nav-item md-nav-click="select_assets('music')" name="page2">
        MUSIC
      </md-nav-item>
      <md-nav-item md-nav-click="select_assets('sounds')" name="page3">
        SOUNDS
      </md-nav-item>
    </md-nav-bar>
</md-content>
</div>

<div layout="row" ng-show="selected_asset=='upload'">
  <md-card layout-padding style="width: 100%">
    <md-card-title-text>
    <h2>Upload a new asset</h2>
  </md-card-title-text>
    <md-input-container>
      <label>Title of Asset</label>
      <input ng-model="new_asset_data.title" type="text">
    </md-input-container>
    <md-input-container>
      <label>Asset Type</label>
      <md-select ng-model="new_asset_data.asset_type">
        <md-option ng-repeat="at in asset_types" value="\\\at\\\">\\\at\\\</md-option>
      </md-select>
    </md-input-container>
    <md-input-container>
      <label>Asset File URL</label>
      <input type="text" ng-model="new_asset_data.url">
    </md-input-container>
    <div ng-show="new_asset_data.asset_type=='IMAGE'">
       <b>Thumbnail Preview:</b><br />
       <img style="width: 280px" ng-src="\\\new_asset_data.url\\\" /><br/>
    </div>

    <div ng-show="new_asset_data.asset_type=='MUSIC'">
             <b>Music Preview:</b><br />
       <audio>
        <source ng-src="\\\new_asset_data.url\\\" type="audio/ogg">
        </audio>
    </div>
      </md-card>
</div>

<div layout="row" ng-show="selected_asset=='gui'">
  <div ng-repeat="a in assets.data">
    <md-card ng-show="a.ASSET_TYPE=='IMAGE'" layout-padding>
      <h2>\\\a.NAME\\\</h2>
      <a href="\index.php?table=\\\selected\\\&category=\\\selected_asset\\\&sys_id=\\\a.SYS_ID\\\" target="_blank">
      <img ng-src="\\\a.URL\\\" style="width:280px">
    </a>
    </md-card>
  </div>
</div>

<div layout="row" ng-show="selected_asset=='music'">
  <div ng-repeat="a in assets.data">
    <md-card ng-show="a.ASSET_TYPE=='MUSIC'" layout-padding>
      <h2>\\\a.NAME\\\</h2>
      <audio>
      </audio>
    </md-card>
  </div>
</div>