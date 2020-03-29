<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json");
//ini_set('display_errors',1); 
//error_reporting(E_ALL);
function slug($z){
    $z = strtolower($z);
    $z = preg_replace('/[^a-z0-9 -]+/', '', $z);
    $z = ucfirst($z);
    return trim($z, '-');
}
include 'auth.php';

//if ($_SESSION["access"] == "granted" && isset($_GET['pid'])) {
	//check if user is logged in
	$pid = $_GET['pid'];

	$connection = mysqli_connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_SCHEMA);
	$query = "SELECT * FROM NEWS WHERE SYS_CREATED_ON > CURRENT_DATE - 14";
	$result = mysqli_query($connection, $query) or die("Query fail: " . mysqli_error());
	$outp = "";

	while($rs = mysqli_fetch_array($result)) {
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"uid":"'  . $rs["UID"] . '",';
	    $outp .= '"title":"'   . $rs["TITLE"]        . '",';
	    $outp .= '"description":"'. $rs["DESCRIPTION"]     . '",';
	    $outp .= '"created":"'  . $rs["SYS_CREATED_ON"] . '",';
	    $outp .= '"author":"'   . $rs["WRITTEN_BY"]        . '"}';
	}
	$outp = '{"records":['.$outp.']}';
	$connection->close();
	echo $outp;
?>