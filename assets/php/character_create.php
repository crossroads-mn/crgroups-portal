<?php 
include "auth.php";
session_start();
if ($_SESSION["access"] == "granted") {
    //check if user is logged in
    $pid = $_SESSION['GUID'];
}

if ($_POST) {
            //Store the info from the post request into MySQL
            $connection = mysqli_connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_SCHEMA);
            $sys_id = md5(uniqid());
            $fname = $_POST['form-firstname'];
            $lname = $_POST['form-lastname'];
            $user = $_POST['form-username'];
            $password = $_POST['form-password'];
            $query = "INSERT INTO ACCOUNTS (SYS_ID, FIRST_NAME, LAST_NAME, USERNAME, PASSWORD, ADMIN_FLAG) VALUES ('$sys_id', '$fname', '$lname', '$user', MD5('$password'), 0);";
            $result = mysqli_query($connection, $query) or die("Query fail: " . mysqli_error($connection));
            header("Location: /index.php");
        }
?>
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <style>

        md-select span {color: white;}
        .icon, #header_search {visibility: hidden;}

    </style>
<div class="top-content">
            <!--<div ng-include="'assets/php/validate.php'"></div>-->
           <!--<div ng-include="assets/php/app.php"></div>-->
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <!--<div class="form-top-left">-->
                                <!--</div>
                                <div class="form-top-right">-->
                                    <h3 ng-show="createpage==1" style="color: white; margin: 0px; margin-top: 15px;">more about your business</h3>
                                    <h3 ng-show="createpage==2" style="color: white; margin: 0px; margin-top: 15px;">Tell us more</h3>
                                    <h3 ng-show="createpage==3" style="color: white; margin: 0px; margin-top: 15px;">Statistics</h3>
                                <!--</div>-->
                            </div>
                            <div class="form-bottom">
                              <div ng-show="createpage==1" class="form-group" layout="column" ng-init="profile">
                                <md-input-container>
                                    <label style="color:white">street address</label>
                                    <input required type="text" ng-model="profile.street_addr_1" placeholder="street address">
                                </md-input-container>
                                <md-input-container>
                                    <label style="color:white">street address 2</label>
                                    <input required type="text" ng-model="profile.street_addr_2" placeholder="street address 2">
                                </md-input-container>
                                <md-input-container>
                                    <label style="color: white" for="selectstate">state</label>
                                    <md-select ng-model="state" id="selectstate" placeholder="select a state" style="color: white">
                                        <md-option ng-value="state.abbreviation" ng-repeat="state in states">\\\state.name\\\</md-option>
                                    </md-select>
                                </md-input-container>
                                <md-input-container>
                                    <label style="color: white">Select your Class</label>
                                    <md-select ng-model="character.class" placeholder="Select your Class" style="color: white">
                                        <md-option ng-value="cl" ng-repeat="cl in classes">\\\cl\\\</md-option>
                                    </md-select>
                                </md-input-container>


                                <div flex layout="row" layout-align="space-between end">

                                  <div flex>
                                    <md-button ng-show="createpage>1" class="md-accent md-raised" ng-click="create_page_back()"> Go Back </md-button>
                                  </div>
                                  <div flex>
                                    <md-button class="md-accent md-raised" ng-click="create_page_forward()"> Continue</md-button>
                                  </div>
                                </div>
                              </div>
                              <div ng-show="createpage==2" class="form-group" layout="column">

                                <md-input-container>
                                    <label style="color:white">How old is \\\character.name\\\?</label>
                                    <input required type="number" ng-model="character.age" placeholder="30">    
                                </md-input-container>
                                <md-input-container>
                                    <label style="color:white">Weight</label>
                                    <input required type="number" ng-model="character.weight" placeholder="165">
                                </md-input-container>

                                <md-input-container>
                                    <label style="color:white">Height</label>
                                    <input required type="text" ng-model="character.height" placeholder="165">
                                </md-input-container>

                              
                              <div flex layout="row" layout-align="space-between end">
                                <div flex>
                                    <md-button ng-show="createpage > 1" class="md-accent md-raised" ng-click="create_page_back()"> Go Back </md-button>
                                      </div>
                                      <div flex>
                                        <md-button class="md-accent md-raised" ng-click="create_page_forward()"> Continue</md-button>
                                      </div>
                                </div>
                                </div>
                                

                                <div ng-show="createpage==3" class="form-group">
                                <div layout="row" layout-align="space-between center">
                                    <div flex="40" layout="column">
                                            
                                            <label style="color:white">Strength</label>
                                            <input required type="number" ng-model="character.str">    
                                        

                                            <label style="color:white">Dexterity</label>
                                            <input required type="number" ng-model="character.dex">    

                                            <label style="color:white">Constitution</label>
                                            <input required type="number" ng-model="character.con">    
                                    </div>
                                    <div flex="40" layout="column">
                                            <label style="color:white">Intelligence</label>
                                            <input required type="number" ng-model="character.int">    

                                            <label style="color:white">Wisdom</label>
                                            <input required type="number" ng-model="character.wis">    

                                            <label style="color:white">Charisma</label>
                                            <input required type="number" ng-model="character.cha">    

                                    </div>
                                    </div>

                              
                              <div flex layout="row" layout-align="space-between end">

                                    <md-button ng-show="createpage>1" class="md-accent md-raised" ng-click="create_page_back()"> Go Back </md-button>
    
                                        <md-button class="md-accent md-raised" ng-click="create_page_forward()"> Continue</md-button>
                                </div>
                                </div>

                                 <div ng-show="createpage==4" class="form-group">
                                <div layout="row" layout-align="space-between center">
                                    <div flex="40" layout="column">
                                            
                                            <label style="color:white">Strength</label>
                                            <input required type="number" ng-model="character.str">    
                                        

                                            <label style="color:white">Dexterity</label>
                                            <input required type="number" ng-model="character.dex">    

                                            <label style="color:white">Constitution</label>
                                            <input required type="number" ng-model="character.con">    
                                    </div>
                                    <div flex="40" layout="column">
                                            <label style="color:white">Intelligence</label>
                                            <input required type="number" ng-model="character.int">    

                                            <label style="color:white">Wisdom</label>
                                            <input required type="number" ng-model="character.wis">    

                                            <label style="color:white">Charisma</label>
                                            <input required type="number" ng-model="character.cha">    

                                    </div>
                                    </div>

                              
                              <div flex layout="row" layout-align="space-between end">

                                    <md-button ng-show="createpage>1" class="md-accent md-raised" ng-click="create_page_back()"> Go Back </md-button>
    
                                        <md-button class="md-accent md-raised" ng-click="create_page_forward()"> Continue</md-button>
                                </div>
                                </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/character_creation.js"></script>
</body>