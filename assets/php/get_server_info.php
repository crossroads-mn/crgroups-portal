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
	$query = "SELECT * FROM SERVERS;";
	$result = mysqli_query($connection, $query) or die("Query fail: " . mysqli_error());
	$outp = "";

	//while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	while($rs = mysqli_fetch_array($result)) {
		if ($outp != "") {$outp .= ",";}
		$outp .= '{"PID":"'  . $rs["PID"] . '",';
	    $outp .= '"Name":"'   . slug($rs["NAME"])        . '",';
	    $outp .= '"IP":"'. $rs["IP_ADDRESS"]     . '",';
	    $outp .= '"Type":"'  . slug($rs["ASSET_TYPE"]) . '",';
	    $outp .= '"Created":"'   . $rs["SYS_CREATED_ON"]        . '",';
	    $outp .= '"Host":"'   . $rs["HOST"]        . '",';
	    $outp .= '"Status":"' 	   . $rs["STATUS"]			 . '",';
	    $outp .= '"Environment":"'. $rs["ENVIRONMENT"]     . '"}';
	}
	$outp = '{"records":['.$outp.']}';
	$connection->close();
	echo($outp);
//}
?>