 <md-card flex='70' layout-align="start">
          <md-card-title-text id="card-title-text">
             \\\urlparms.Table.capitalize()\\\
          </md-card-title-text>

          <md-card-content class="base-content" layout-align="start">
            <md-input-container ng-repeat="(key, value) in record.data">
              <label ng-hide="key=='PASSWORD' || key=='SALT'">\\\key\\\</label>
                <input ng-hide="key=='PASSWORD' || key=='SALT'" ng-disabled="key=='SYS_ID' || key=='SYS_CREATED_ON' || key=='SYS_CREATED_BY' || key=='GUID'" ng-model="record.data[key]" type="text">
            </md-input-container>
          </md-card-content>
          <div>
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
            <md-subheader-text><span style="padding-left: 12px;" class="md-title">Recent Workers</span></md-subheader-text>
            <md-list-item layout-align="start start" id="searchitem" class="md-3-line" ng-repeat="item in records.data | filter:search_text" ng-click="load_record(item)">
                <img style="border-radius: 50%; padding:12px;" ng-src="./assets/img/default.png">
            <div class="md-list-item-text" layout="column">
            <h3>\\\item.ACCOUNTS_GUID\\\</h3>
            <h4>\\\item.PHONE_NUMBER\\\</h4>
            <p></p>
          </div>
            </md-list-item>
        </md-list>
      </md-card>
        <md-fab-speed-dial style="position: aboslute" md-open="is_fab_open" md-direction="up">
          <md-fab-trigger>
            <md-button aria-label="menu" class="md-fab md-warn">
              <md-icon md-font-icon="menu">menu</md-icon>
            </md-button>
          </md-fab-trigger>
          <md-fab-actions>
          <md-button aria-label="Shareable Link" class="md-fab md-raised md-mini">
            <md-icon ng-click="copy_to_clipboard()" md-font-icon="open_in_new" aria-label="Shareable Link">open_in_new</md-icon>
          </md-button>          </md-fab-actions>
        </md-fab-speed-dial>