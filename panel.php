<?php
	if ($_SESSION["access"] == "granted") {
  	echo '        <div class="sidebar" ng-init="dashboard=false;">
    <md-sidenav class="md-sidenav-left" md-component-id="left" md-is-locked-open="true" md-whiteframe="4">
      <md-toolbar>
        <div><h1 class="md-toolbar-tools"><a href="/panel.php">Restart Inc. Dashboard</a></h1></div>
      </md-toolbar>
      <md-content>
      <md-list flex>
        <md-list-item ng-click="change_selected(opt.name)" ng-repeat="opt in options">
        <i class="fa //opt.icon//" aria-hidden="true" pull-left></i>//opt.name//
        </md-list-item>
      </md-list>
      </md-content>
    </md-sidenav>
    </div>';
} else {
	echo '<div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>MyServicePortal</strong> Login Form</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <p>Enter your username and password to log on:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="/assets/php/validate.php" method="post" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Username</label>
                                        <input type="text" name="form-username" placeholder="Username" class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="form-password" placeholder="Password" class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="submit" class="btn">Sign in!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
}
	
?>