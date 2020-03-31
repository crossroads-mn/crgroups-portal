<?php
//This file will take in JSON data exactly as follows:
/*

{'table': 'tablename',
 'sys_id': 'sys_id_goes_here'}

Simple json data that will pull in an individual record from the database, such as a client, worker, job, or ANYTHING

*/

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
$guid = $_SESSION['GUID'];

$connection = mysqli_connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_SCHEMA, $DB_PORT);
$query = "SELECT * FROM NOTIFICATIONS WHERE ACCOUNTS_GUID=$guid";
$result = mysqli_query($connection, $query) or die('{"records": [{"error": "' . mysqli_error($connection) . '"}]}');
$info = array();

while($rs = mysqli_fetch_assoc($result)) {
	//array_push($info, $rs);
	array_push($info, $rs);
} 

echo json_encode($info);
?>