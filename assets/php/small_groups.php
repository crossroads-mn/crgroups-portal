<?php

function convert_ascii($string) 
{ 
  // Replace Single Curly Quotes
  $search[]  = chr(226).chr(128).chr(152);
  $replace[] = "'";
  $search[]  = chr(226).chr(128).chr(153);
  $replace[] = "'";
  // Replace Smart Double Curly Quotes
  $search[]  = chr(226).chr(128).chr(156);
  $replace[] = '"';
  $search[]  = chr(226).chr(128).chr(157);
  $replace[] = '"';
  // Replace En Dash
  $search[]  = chr(226).chr(128).chr(147);
  $replace[] = '--';
  // Replace Em Dash
  $search[]  = chr(226).chr(128).chr(148);
  $replace[] = '---';
  // Replace Bullet
  $search[]  = chr(226).chr(128).chr(162);
  $replace[] = '*';
  // Replace Middle Dot
  $search[]  = chr(194).chr(183);
  $replace[] = '*';
  // Replace Ellipsis with three consecutive dots
  $search[]  = chr(226).chr(128).chr(166);
  $replace[] = '...';
  // Apply Replacements
  $string = str_replace($search, $replace, $string);
  // Remove any non-ASCII Characters
  $string = preg_replace("/[^\x01-\x7F]/","", $string);
  return $string; 
}

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
$query = "SELECT SYS_ID, DATE_SUBMITTED, TITLE, TARGET_AUDIENCE, MEET_DAY, MEET_TIME_START, DURATION, LEADER, PHONE_NUMBER, EMAIL, LOCATION, CAMPUS, GROUP_LINK, GROUP_TYPE, ACTIVE, TRIM(DESCRIPTION) as DESCRIPTION FROM SMALL_GROUPS LIMIT 999";
$result = mysqli_query($DB_CONN, $query) or die('{"records": [{"error": "' . mysqli_error($DB_CONN) . '"}]}');
$info = array();

while($rs = mysqli_fetch_assoc($result)) {
	//array_push($info, $rs);
	array_push($info, convert_ascii($rs));
} 

echo json_encode($info);
?>