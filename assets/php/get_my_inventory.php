<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
function slug($z){
    $z = strtolower($z);
    $z = preg_replace('/[^a-z0-9 -]+/', '', $z);
    $z = ucfirst($z);
    return trim($z, '-');
}
include 'auth.php';

//if ($_SESSION["access"] == "granted") {
	//check if user is logged in
	$connection = mysqli_connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_SCHEMA);
	$pid = $_SESSION['pid'];
	$query = "SELECT * FROM INVENTORY WHERE PID = $pid";
	$result = mysqli_query($connection, $query) or die("Query fail: " . mysqli_error());
	$outp = "";

	//while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	while($rs = mysqli_fetch_array($result)) {
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"Item_ID":"'  . $rs["ITEM_ID"] . '",';
	    $outp .= '"Name":"'   . slug($rs["NAME"])        . '",';
	    $outp .= '"Description":"'. slug($rs["DESCRIPTION"])     . '",';
	    $outp .= '"Item_Type":"'. $rs["ITEM_TYPE"]     . '",';
	    $outp .= '"Weight":"'  . $rs["WEIGHT"] . '"}';
	}
	$outp = '{"records":['.$outp.']}';
	$connection->close();
	echo($outp);
//}
?>