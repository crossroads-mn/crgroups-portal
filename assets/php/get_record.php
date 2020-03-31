<?php
//This file will take in JSON data exactly as follows:
/*

{'table': 'tablename',
 'sys_id': 'sys_id_goes_here'}

Simple json data that will pull in an individual record from the database, such as a client, worker, job, or ANYTHING

*/

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

$json = file_get_contents('php://input');
$obj = json_decode($json, true); //true means it will be an assoc array
$table = strtoupper($obj['table']); //This should yield which table in database to use
$sys_id = $obj['sys_id'];

$connection = mysqli_connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_SCHEMA);
$query = "SELECT * FROM $table WHERE SYS_ID='$sys_id';";
$result = mysqli_query($connection, $query) or die('{"records": [{"error": "' . mysqli_error($connection) . '"}]}');
$info = array();

if($rs = mysqli_fetch_assoc($result)) {
	//array_push($info, $rs);
	echo json_encode(convert_ascii($rs));
} 

else {
	echo '{}';
}

?>