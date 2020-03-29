<?php
    include '/assets/php/auth.php';
    session_start();
    ini_set('display_errors', 1);

    if (isset($_SESSION['access'])) {
        if ($_SESSION["access"] == "granted" && $_SESSION["isadmin"] == 1) {
            //Include the admin header bar
            //include the sidebar
            //include the content stuff :D
            include './assets/php/header.php';
            include './assets/php/sidebar.php';
            include './assets/php/content.php';
            //echo '<h2>Are you an admin?: ' . $_SESSION['isadmin'] . '</h2>';
            //echo '<h2>PID: ' . $_SESSION['pid'] . '</h2>';
            //
        }

        //Check for create_status to show "create" page before tool
        // else if ($_SESSION["access"] == "granted" && $_SESSION["isadmin"] == 0 && $_SESSION['create_status'] == 0) {
        //      include './assets/php/header.php';
        //     include './assets/php/character_create.php';
        // }
        // else if ($_SESSION["access"] == "granted" && $_SESSION["isadmin"] == 0 && $_SESSION['create_status'] > 0) {
        //     include './assets/php/header.php';
        //     include './assets/php/player_sidebar.php';
        //     include './assets/php/player_content.php';

        // }

}
    else {?>

<html ng-app="myserviceportal">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crossroads Church - Manage Small Groups</title>

        <!-- CSS -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Varela+Round" rel="stylesheet">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" type="image/ico" href="./assets/img/thread_icon_boxed_351C4D_36x36.png" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

        <!-- Angular Modules for Google Materials -->

        <!-- Angular Material Library -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-route.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
        <script src="/assets/js/utilities.js"></script>
        <script src="/assets/js/app.js"></script>


    </head>

    <body ng-controller="uctrl" md-theme-watch="true" style="overflow:hidden">

        <!-- Top content -->
        <div class="top-content">
            <!--<div ng-include="'assets/php/validate.php'"></div>-->
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <!--<div class="form-top-left">-->
                                    <!--<img src="../assets/img/bee.png" style="max-width: 80%; height: auto; margin-top:15px">-->
                                <!--</div>
                                <div class="form-top-right">-->
                                    <div><br></div>
                                    <h1 style="color:white">Crossroads Church</h1>
                                    <h4 style="color:white">Small Groups</h4>
                                    <!--<h3 style="color: white; margin: 0px;">Admin Panel (DEV)</h3>-->
                                <!--</div>-->
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="/assets/php/validate.php" method="post" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Username</label>
                                        <input required type="text" name="form-username" placeholder="Username" class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input required type="password" name="form-password" placeholder="Password" class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="submit" class="btn">Let's Go!</button>
                                </form>
                                <a style="color: white" href="/register.php">register</a>
                                <a style="color: white; float:right;" href="/forgot.php">forgot password</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>
</html>
<?php }
;?>
