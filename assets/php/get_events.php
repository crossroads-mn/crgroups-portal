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

$json = file_get_contents('php://input');
$obj = json_decode($json, true); //true means it will be an assoc array
$table = strtoupper($obj['table']); //This should yield which table in database to use
//$guid = $_SESSION['GUID'];

mysqli_set_charset($DB_CONN, "utf8");
//TARGET_AUDIENCE, MEET_DAY, MEET_TIME_START, DURATION, LEADER, PHONE_NUMBER, EMAIL, LOCATION, CAMPUS, GROUP_LINK, GROUP_TYPE,TRIM(DESCRIPTION) as DESCRIPTION 
$query = "SELECT `GUID`, `TITLE`, `DATE_OF_EVENT`, `START_TIME`, `END_TIME`, `LOCATION`, `DESCRIPTION`, `OWNER`, `CONTACT_EMAIL`, `COST`, `REGISTRATION_LINK`, `CHILDCARE_LINK`, `CATEGORY`, `SYS_CREATED_ON`, `SYS_CREATED_BY`, `SYS_UPDATED_BY`, `SYS_UPDATED_ON`, `SYS_ID`, `ACTIVE`, `SYS_EVENT_DATE` FROM `EVENTS` WHERE 1 LIMIT 0, 999 ";

$result = mysqli_query($DB_CONN, $query) or die('{"records": [{"error": "' . mysqli_error($DB_CONN) . '"}]}');
$info = array();

while($rs = mysqli_fetch_assoc($result)) {
	//array_push($info, $rs);
	array_push($info, $rs);
} 

echo json_encode($info);
?>    