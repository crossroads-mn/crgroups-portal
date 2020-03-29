<?php
  include 'get_user_info.php';
?>

<div class="content-window">
  <div ng-show="selected=='Home'">
  <h3>Home</h3>
  <div layout="row">
    <md-card flex="50">
    <md-card-title-text>
      <span><h1>Get Lessons!</h1></span>
    </md-card-title-text>
    <md-card-content>
    <p>Skills represent some of the most basic and yet most fundamental abilities your character possesses. As your character advances in level, he can gain new skills and improve his existing skills dramatically. This section describes each skill, including common uses and typical modifiers. Characters can sometimes use skills for purposes other than those noted here, at the GM’s discretion.</p>
    </md-card-content>

    </md-card>

    <md-card flex="50">
    <md-card-title-text>
    <span><h1>It's not safe to go alone..</h1></span>
    </md-card-title-text>
    <md-card-content>
    <p>Gear up with some awesome gear. Click on "My Inventory" on the side there to start adding some equipment to your character.</p>
    </md-card-content>

    </md-card>


  </div>
  </div>

  <div ng-show="selected=='Character Sheet'">
  <div ng-include="'../assets/php/pathfinder_char_sheet.php'"></div>
  </div>

  <div ng-show="selected=='My Inventory'" layout="column">

  <md-content class="md-padding">
  <md-tabs md-selected="0" md-border-bottom md-autoselect>
      <md-tab ng-click="player_change_inv(o)" ng-repeat="o in inv_options" label="\\\o\\\">
      
      <md-tab-body>
      <md-card flex">
      <table class="table table-bordered table-striped">
              <th><a href="#" ng-click="sortType = 'Name'; sortReverse = !sortReverse">Name<span ng-show="sortType == 'Name' && !sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="sortType == 'Name' && sortReverse" class="fa fa-caret-up"></span></a></th>
              <th><a href="#" ng-click="sortType = 'Description'; sortReverse = !sortReverse">Description<span ng-show="sortType == 'Description' && !sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="sortType == 'Description' && sortReverse" class="fa fa-caret-up"></span></a></th>
              <th><a href="#" ng-click="sortType = 'Weight'; sortReverse = !sortReverse">Weight<span ng-show="sortType == 'Weight' && !sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="sortType == 'Weight' && sortReverse" class="fa fa-caret-up"></span></a></th>
              <th><a href="#" ng-click="sortType = 'Item_Type'; sortReverse = !sortReverse">Item Type<span ng-show="sortType == 'Item_Type' && !sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="sortType == 'Item_Type' && sortReverse" class="fa fa-caret-up"></span></a></th>

                <tr ng-repeat="x in inventory | orderBy:sortType:sortReverse | filter:item_type">
            <td>\\\x.Name\\\</td>
            <td>\\\x.Description\\\</td>
            <td>\\\x.Weight\\\</td>
            <td>\\\x.Item_Type\\\</td>
          </tr>
      </table>
      </md-card>
      </md-tab-body>
      </md-tab>
    </md-tabs>

    <!--<md-nav-bar
      md-selected-nav-item="currentNavItem"
      nav-bar-aria-label="navigation links">
      <md-nav-item style="background: white" class="md-primary" ng-repeat="o in inv_options" md-nav-click="player_change_inv(o)" name="\\\o\\\">
        \\\o\\\
      </md-nav-item>
      </md-nav-bar>
      
  <div layout="column" layout-align="start start">

    <md-card flex="20">
    <md-list>
      <md-list-item ng-click="player_change_inv(o)" ng-repeat="o in inv_options">
        <p style="color: white" class="option-name">\\\o\\\</p>
      </md-list-item>
    </md-list>
    </md-card>
    </div>

    <md-card flex">
      <table class="table table-bordered table-striped">
              <th><a href="#" ng-click="sortType = 'Name'; sortReverse = !sortReverse">Name<span ng-show="sortType == 'Name' && !sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="sortType == 'Name' && sortReverse" class="fa fa-caret-up"></span></a></th>
              <th><a href="#" ng-click="sortType = 'Description'; sortReverse = !sortReverse">Description<span ng-show="sortType == 'Description' && !sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="sortType == 'Description' && sortReverse" class="fa fa-caret-up"></span></a></th>
              <th><a href="#" ng-click="sortType = 'Weight'; sortReverse = !sortReverse">Weight<span ng-show="sortType == 'Weight' && !sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="sortType == 'Weight' && sortReverse" class="fa fa-caret-up"></span></a></th>
              <th><a href="#" ng-click="sortType = 'Item_Type'; sortReverse = !sortReverse">Item Type<span ng-show="sortType == 'Item_Type' && !sortReverse" class="fa fa-caret-down"></span>
                  <span ng-show="sortType == 'Item_Type' && sortReverse" class="fa fa-caret-up"></span></a></th>

                <tr ng-repeat="x in inventory | orderBy:sortType:sortReverse | filter:item_type">
            <td>\\\x.Name\\\</td>
            <td>\\\x.Description\\\</td>
            <td>\\\x.Weight\\\</td>
            <td>\\\x.Item_Type\\\</td>
          </tr>
      </table>
      </md-card>-->
      </md-content>
    </div>


  <div ng-show="selected=='My Spells'">
  <h3>My Spells</h3>
  </div>

  <div ng-show="selected=='Notes'">
  <h3>Notes</h3>
  </div>

</div>
</body>