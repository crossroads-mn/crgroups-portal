<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
function slug($z){
    $z = strtolower($z);
    $z = preg_replace('/[^a-z0-9 -]+/', '', $z);
    $z = ucfirst($z);
    return trim($z, '-');
}

include 'auth.php';
session_start();

if ($_SESSION["access"] == "granted") {
	//check if user is logged in
	$pid = $_SESSION['GUID'];

	if($_SESSION["isadmin"] == 1) {

	}
	$query = "SELECT FIRST_NAME, LAST_NAME, USERNAME, EMAIL, SYS_CREATED_ON, LAST_LOGGED_IN, LAST_IP_ADDRESS, ADMIN_FLAG, STREET_ADDR_1, STREET_ADDR_2, ZIPCODE, CITY, STATE, COUNTRY, DESCRIPTION, PROFILE_FILEPATH FROM ACCOUNTS WHERE SYS_ID ='" . $_SESSION['sys_id'] . "';";
	$result = mysqli_query($DB_CONN, $query) or die("Query fail: " . mysqli_error());
	//$user_data = mysqli_fetch_array($result);
	$info = array();

		while($rs = mysqli_fetch_assoc($result)) {
			//array_push($info, $rs);
			array_push($info, $rs);
		} 

		echo json_encode($info);
}?>