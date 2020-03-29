<style>

.header-wrapper {
  background: \\\loaded_user_settings.PRIMARY_HEADER_COLOR.VALUE\\\ !important;
  color: \\\loaded_user_settings.HEADER_FONT_COLOR.VALUE\\\ !important;
}

md-list-item:hover {
  background: #\\\loaded_user_settings.SECONDARY_SIDEBAR_COLOR.VALUE\\\ !important;
}

.md-button.md-default-theme.md-accent, .md-button.md-accent {
  color: \\\loaded_settings.SUBHEADER_FONT_COLOR.VALUE\\\ !important;
  background-color: \\\loaded_settings.SUBHEADER_ITEM_BACKGROUND_COLOR.VALUE\\\ !important;
}

.md-button._md-nav-button:hover {
    background-color: \\\loaded_settings.SUBHEADER_HOVER_COLOR.VALUE\\\ !important;
}

.md-nav-bar .md-nav-item {
  background-color: \\\loaded_settings.SUBHEADER_ITEM_BACKGROUND_COLOR.VALUE\\\ !important;
}

</style>
<div layout="row" flex="100">
  <md-content>
  <md-card layout-padding  flex="100" height="auto">
        <md-card-content>
    <h2>Header Settings</h2>
    <md-input-container>
      <label>Header Background Color</label>
      <input ng-model="loaded_user_settings.PRIMARY_HEADER_COLOR.VALUE" type="text">
       <canvas height="32" width="32" style="background-color: \\\loaded_user_settings.PRIMARY_HEADER_COLOR.VALUE\\\; border:1px; border-color:#000;"  />
    </md-input-container>
    <md-input-container>
      <label>Header Font Color</label>
      <input ng-model="loaded_user_settings.HEADER_FONT_COLOR.VALUE" type="text">
       <canvas height="32" width="32" style="background-color: \\\loaded_user_settings.HEADER_FONT_COLOR.VALUE\\\; border:1px; border-color:#000;"  />
    </md-input-container>
    <md-input-container>
      <label>Subheader Font Color</label>
      <input ng-model="loaded_settings.SUBHEADER_FONT_COLOR.VALUE" type="text">
       <canvas height="32" width="32" style="background-color: \\\loaded_settings.SUBHEADER_FONT_COLOR.VALUE\\\; border:1px; border-color:#000;"  />
    </md-input-container>
    <md-input-container>
      <label>Subheader Item Color on Hover</label>
     <input ng-model="loaded_settings.SUBHEADER_HOVER_COLOR.VALUE" type="text">
       <canvas height="32" width="32" style="background-color: \\\loaded_settings.SUBHEADER_HOVER_COLOR.VALUE\\\; border:1px; border-color:#000;"  />
    </md-input-container>
        <md-input-container>
      <label>Subheader Background Color</label>
     <input ng-model="loaded_settings.SUBHEADER_ITEM_BACKGROUND_COLOR.VALUE" type="text">
       <canvas height="32" width="32" style="background-color: \\\loaded_settings.SUBHEADER_ITEM_BACKGROUND_COLOR.VALUE\\\; border:1px; border-color:#000;" />
    </md-input-container>

    <h2>Sidebar Settings</h2>
    <md-input-container>
      <label>Primary Sidebar Color</label>
      <input ng-model="loaded_user_settings.PRIMARY_SIDEBAR_COLOR.VALUE" type="text">
       <canvas height="32" width="32" style="background-color: \\\loaded_user_settings.PRIMARY_SIDEBAR_COLOR.VALUE\\\; border:1px; border-color:#000;"  />
    </md-input-container>
    <md-input-container>
      <label>Secondary Sidebar Color</label>
     <input ng-model="loaded_user_settings.SECONDARY_SIDEBAR_COLOR.VALUE" type="text">
       <canvas height="32" width="32" style="background-color: \\\loaded_user_settings.SECONDARY_SIDEBAR_COLOR.VALUE\\\; border:1px; border-color:#000;"  />
    </md-input-container>

    <h2>Footer Settings</h2>


    <md-input-container>
      <label>System Version</label>
      <input ng-model="loaded_settings.SYSTEM_VERSION.VALUE" type="text" readonly>
    </md-input-container>
  </md-card-content>
    <md-card-actions>
      <md-button layout-align="start start" ng-click="#" class="md-raised md-primary">Save Changes</md-button>
    </md-card-actions>
  </md-card>
      </md-content>
</div>


