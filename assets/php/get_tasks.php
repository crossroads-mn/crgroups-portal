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

//if ($_SESSION["access"] == "granted") {
	//check if user is logged in
	$server = mysql_connect($DB_ADDRESS, $DB_USER, $DB_PASS);
	$connection = mysqli_connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_SCHEMA);
	$query = "SELECT * FROM TASK;";
	$result = mysqli_query($connection, $query) or die("Query fail: " . mysqli_error());
	$outp = "";

	//while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	while($rs = mysqli_fetch_array($result)) {
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"pid":"'  . $rs["PID"] . '",';
	    $outp .= '"number":"'   . $rs["NUMBER"]        . '",';
	    $outp .= '"priority":"'. $rs["PRIORITY"]     . '",';
	    $outp .= '"due_date":"'  . $rs["DUE_DATE"] . '",';
	    $outp .= '"state":"'   . $rs["STATE"]        . '",';
	    $outp .= '"assigned_to":"'   . $rs["ASSIGNED_TO"]        . '",';
	    $outp .= '"short_desc":"' 	   . $rs["SHORT_DESC"]			 . '",';
	    $outp .= '"created_on":"' 	   . $rs["SYS_CREATED_ON"]			 . '",';
	    $outp .= '"description":"'. $rs["DESCRIPTION"]     . '"}';
	}
	$outp = '{"records":['.$outp.']}';
	$connection->close();
	echo($outp);
//}
?>