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
include './assets/php/auth.php';
include './assets/php/header.php';
include './assets/php/sidebar.php';

//if ($_SESSION["access"] == "granted" && isset($_GET['pid'])) {
	//check if user is logged in
	$pid = $_GET['pid'];

	$connection = mysqli_connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_SCHEMA, $DB_PORT);
	$query = "SELECT * FROM TASK WHERE PID = $pid;";
	$result = mysqli_query($connection, $query) or die("Query fail: " . mysqli_error());
	$outp = "";

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

//} else {
	//header("Location: /index.php");

//	echo "<p>Hello world!</p>";
//}
?>

<div class="content-window">
<button onclick="previous()"><i class="fa fa-chevron-left" aria-hidden="true" pull-left></i></button>
<?php echo($outp);?>
</div>
