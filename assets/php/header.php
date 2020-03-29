<?php
//Maybe put code here to retrieve the Title of the damn thing 
error_reporting(E_ERROR | E_PARSE);
?>

<html ng-app="myserviceportal" ng-cloak lang="en">
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src=https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js></script>
  <title>Crossroads Church - Group Management</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/ico" href="/assets/img/thread_icon_boxed_351C4D_36x36.png" />

  <!-- Bootstrap and Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

  <!-- Angular Modules for Google Materials -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-route.js"></script>

  <!-- Angular Material Library -->
  <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round|Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

  <script src="assets/js/utilities.js"></script>
  <script src="assets/js/app.js"></script>
  <script src="assets/js/upload.js"></script>

  <!-- Lite Angular Editor for editing html inline -->
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112607252-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-112607252-1');
  </script>



</head>

<body ng-controller="uctrl" md-theme-watch="true" ng-cloak>
<header>
<div class="header-wrapper">
<div class="header-items" ng-cloak>
        <a href="/index.php">
            <img style="margin-left: 15px; margin-top: 3px; width:240px; margin-bottom: 2px"  src="/assets/img/cr_logo_white_horiz.png" alt="Crossroads Church" ng-click="selected='dashboard'" class="header-logo">
        </a>
        <input name="header_search" placeholder=" search" value="search" type="text" style="color: #666666;" id="header_search" ng-model="header_search"><button value="submit" ng-click="search_header()" class="icon"><i class="fa fa-search"></i></button>
        <button title="My Dashboard" ng-click="goto_page('/index.php')"><i class="fa fa-home" aria-hidden="true"></i></button>
        <button title="Notifications" ng-click="goto_page('/index.php?table=Notifications')"><i class="fa fa-envelope-o" aria-hidden="true"></i></button>
        <button title="Logout" ng-href="#logout" ng-click="logout()"><i class="fa fa-sign-out" aria-hidden="true"></i>
        <a href="/index.php?table=Profile"><button style="margin-top: 0px; margin-bottom:10px;" title="My Profile" ng-click="selected='showprofile'"><img style="border-radius: 50%; padding:5px;" width="40" height="40" ng-src="\\\user.PROFILE_FILEPATH\\\"></button></a>
</button>
</div>
</div>
</header>