<?php

?>
<div layout="row">
<div class="sidebar" ng-init="dashboard=true;">
    <md-sidenav class="md-sidenav-left" md-component-id="left" md-is-locked-open="true" md-whiteframe="4">
      <md-content>
      <md-list flex>
        <md-list-item ng-click="player_change_selected(opt.name)" ng-repeat="opt in player_options">
        <i class="fa \\\opt.icon\\\" aria-hidden="true" pull-left></i><p class='option-name'>\\\opt.name\\\</p>
        </md-list-item>
      </md-list>
      </md-content>
    </md-sidenav>
    </div>

<div class="right-sidebar">
     <md-sidenav ng-show="selected=='Map'" class="md-sidenav-right right-aligned" md-whiteframe="4"  id="sidenav-right" md-is-locked-open="true" md-component-id="right">
     <h3>News</h3>
  <md-card ng-repeat="cards in news">
      <md-card-title>
          <md-card-title-text layout="row" layout-align="space-between center">
            <span class="md-headline">\\\cards.title\\\</span>
          </md-card-title-text>
        </md-card-title>
     </md-card-content>
          <md-card-content>
          <p>\\\cards.description\\\</p>
          </md-card-content>

        <md-card-actions layout="row" layout-align="end center">
            <p>\\\cards.created\\\</p>
            <md-button>Written By:  \\\cards.author\\\</md-button>
        </md-card-actions>
  </md-card>
</md-sidenav>
</div>
