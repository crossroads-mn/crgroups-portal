<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
function slug($z){
    $z = strtolower($z);
    $z = preg_replace('/[^a-z0-9 -]+/', '', $z);
    $z = ucfirst($z);
    return trim($z, '-');
}


require_once(__DIR__ . '/auth.php');
session_start();
//Create a connection

//Write the Logging Statement here:
//$logging = "INSERT INTO ACCESS_LOG "

//This will be a powerful file that translates json objects into PHP insert or update statements
//FIRST we will have to parse the data out into.
//We will then use the "sys_id" to query and see if the record exists in the table.
//If it does: we will generate an update.
//If not: we will generate an insert.

$exists_in_db = false;
$newfile = false;
$json = file_get_contents('php://input');
$obj = json_decode($json, true); //true means it will be an assoc array
$table = strtoupper($obj['table']); //This should yield which table in database to use

$connection = mysqli_connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_SCHEMA);
$sys_id = $obj['data']['SYS_ID'];
if ($sys_id == '') {
	//Generate a new SYS_ID
	$obj['data']['SYS_ID'] = md5(uniqid());
	$newfile = true;
}

if (array_key_exists('PASSWORD', $obj['data'])) {
	$obj['data']['PASSWORD'] = md5($obj['data']['PASSWORD']);
}

if (array_key_exists('CONTENT', $obj['data'])) {
	$obj['data']['CONTENT'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['CONTENT']));
}

if (array_key_exists('LOCATION', $obj['data'])) {
	$obj['data']['LOCATION'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['LOCATION']));
}

if (array_key_exists('REGISTRATION_LINK', $obj['data'])) {
	$obj['data']['REGISTRATION_LINK'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['REGISTRATION_LINK']));
}

if (array_key_exists('NOTES', $obj['data'])) {
	$obj['data']['NOTES'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['NOTES']));
}

if (array_key_exists('LEADER', $obj['data'])) {
	$obj['data']['LEADER'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['LEADER']));
}

if (array_key_exists('PHONE_NUMBER', $obj['data'])) {
	$obj['data']['PHONE_NUMBER'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['PHONE_NUMBER']));
}

if (array_key_exists('DESCRIPTION', $obj['data'])) {
	$obj['data']['DESCRIPTION'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['DESCRIPTION']));
}

if (array_key_exists('TARGET_AUDIENCE', $obj['data'])) {
	$obj['data']['TARGET_AUDIENCE'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['TARGET_AUDIENCE']));
}

if (array_key_exists('NOTES', $obj['data'])) {
	$obj['data']['NOTES'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['NOTES']));
}

if (array_key_exists('TITLE', $obj['data'])) {
	$obj['data']['TITLE'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['TITLE']));
}

if (array_key_exists('COST', $obj['data'])) {
	$obj['data']['COST'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['COST']));
}

if (array_key_exists('WHY', $obj['data'])) {
	$obj['data']['WHY'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['WHY']));
}

if (array_key_exists('BOOK_LINKS', $obj['data'])) {
	$obj['data']['BOOK_LINKS'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['BOOK_LINKS']));
}

if (array_key_exists('SEMESTER', $obj['data'])) {
	$obj['data']['SEMESTER'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['SEMESTER']));
}

if (array_key_exists('GROUP_TYPE', $obj['data'])) {
	$obj['data']['GROUP_TYPE'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['GROUP_TYPE']));
}

if (array_key_exists('START_TIME', $obj['data'])) {
	$obj['data']['START_TIME'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['START_TIME']));
}

if (array_key_exists('END_TIME', $obj['data'])) {
	$obj['data']['END_TIME'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['END_TIME']));
}

if (array_key_exists('CO_LEADER_PHONE', $obj['data'])) {
	$obj['data']['CO_LEADER_PHONE'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['CO_LEADER_PHONE']));
}

if (array_key_exists('CONTACT_EMAIL', $obj['data'])) {
	$obj['data']['CONTACT_EMAIL'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['CONTACT_EMAIL']));
}

if (array_key_exists('CO_LEADER_EMAIL', $obj['data'])) {
	$obj['data']['CO_LEADER_EMAIL'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['CO_LEADER_EMAIL']));
}

if (array_key_exists('DATE_OF_EVENT', $obj['data'])) {
	$obj['data']['DATE_OF_EVENT'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['DATE_OF_EVENT']));
}

if (array_key_exists('DURATION', $obj['data'])) {
	$obj['data']['DURATION'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['DURATION']));
}

if (array_key_exists('CHILDCARE_LINK', $obj['data'])) {
	$obj['data']['CHILDCARE_LINK'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['CHILDCARE_LINK']));
}

if (array_key_exists('GROUP_LINK', $obj['data'])) {
	$obj['data']['GROUP_LINK'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['GROUP_LINK']));
}

if (array_key_exists('IDEAL_SIZE', $obj['data'])) {
	$obj['data']['IDEAL_SIZE'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['IDEAL_SIZE']));
}

if (array_key_exists('MEET_TIME_START', $obj['data'])) {
	$obj['data']['MEET_TIME_START'] = iconv('UTF-8', 'ASCII//TRANSLIT', $connection->real_escape_string($obj['data']['MEET_TIME_START']));
}


if (array_key_exists('SYS_CREATED_BY', $obj['data'])) {
	if(isset($_SESSION['GUID'])) {
		$obj['data']['SYS_CREATED_BY'] = $_SESSION['GUID'];
	}
}

// Client should not set `DATE_SUBMITTED` or `SYS_CREATED_ON`
if (array_key_exists('DATE_SUBMITTED', $obj['data'])) {
	unset($obj['data']['DATE_SUBMITTED']);
}

if (array_key_exists('SYS_CREATED_ON', $obj['data'])) {
	unset($obj['data']['SYS_CREATED_ON']);
}

$insert_statement = "INSERT INTO $table ";
$insert_set = "(" . implode(',', array_keys($obj['data'])) . ")";
$insert_values = "('" . implode("','", $obj['data']) . "')";
$insert = $insert_statement . $insert_set . " VALUES " . $insert_values . ";"; //completed insert statement from JSON



//After insert statement, we're gonna do some incident logging check
if($table == "INCIDENT") {
	//We will connect to the global incident table and submit the ticket into there. 
	//We will also create an email and send it out.
	//$subject = "Incident Logged for " . implode($_SERVER['HTTP_HOST']);
	$connection = mysqli_connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_SCHEMA);
	$headers = "Content-Type: text/html";
	//$url = implode($_SERVER['HTTP_HOST']);
	$url = "test";
	$message = '<div style="background: #231432; color: white; height: 120px;padding-left: 20px; padding-top: 6px; margin:0px;"><h1>a new incident has been created.</h1></div><div style="background: #666; color:white; height:400px; margin:0px; padding-top:10px; padding-left: 20px;"><h4><strong>To the wonderful support team at thread. software,</strong></h4><p><em>A ticket has been submitted, therefore something is not quite working right. For more information on this ticket, please follow the button below.</em></p><p>Thank you for taking a look at this, your support is not overlooked. You help this company run smoothly and are valued! If you have any concerns or questions, always feel free to reach out to your manager/supervisor and have an open discussion with them about the issue. </p><form action="https://admin-dev.trythread.com?table=Incident&sys_id=' . $sys_id . '"><input style="background-color: #4B3A5C; color: white; height: 40px; width: auto; padding: 10px;"  type="submit" value="View the Incident" /></form>';
	error_log($message, 1, "support@trythread.com", $headers);
	mysqli_query($connection, $insert) or die('{"records": [{"error": "' . mysqli_error($connection) . '"}]}');
	//$headers .= "MIME-Version: 1.0\r\n";
	//$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
}



$update_statement = "UPDATE $table SET ";
$update_set = implode(', ', array_map(function ($v, $k) { return sprintf("`%s`='%s'", strtoupper($k), $v); },
    $obj['data'],
    array_keys($obj['data'])
));
$update = $update_statement . $update_set . " WHERE SYS_ID = '" . $obj['data']['SYS_ID'] . "';";


//Now we gotta check whether we should query the insert or update
if ($_SESSION["access"] == "granted") {
	//check if user is logged in
	//$server = mysql_connect($DB_ADDRESS, $DB_USER, $DB_PASS);
	if (!$newfile) {
		$query = "SELECT * FROM $table WHERE SYS_ID = '$sys_id';";
		error_log('Looking up record at: ' . $query);
		$result = mysqli_query($connection, $query) or die('{"records": [{"error": "' . mysqli_error($connection) . '"}]}');
	}
	//while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	if($rs = mysqli_fetch_array($result)) {
		//Sets if it exists in db
		$exists_in_db = true;
	}

	if ($exists_in_db) {
		//Run the UPDATE
		$result = mysqli_query($connection, $update);
		if (!$result) {
			error_log(mysqli_error($connection));
			die('{"records": [{"error": "' . mysqli_error($connection) . '"}]}');
		}
		
		error_log($update);
		echo '{"records": [{"updated": 1, "inserted": 0}]}';
	}

	else {
		//Run the INSERT
		$result = mysqli_query($connection, $insert) or die('{"records": [{"error": "' . mysqli_error($connection) . '"}]}');
		error_log($insert);
		echo '{"records": [{"updated": 0, "inserted": 1}]}';
	}

	//echo '{"records":[{"exists": "' . $exists_in_db . '"}]}';
	//mysqli_query($connection, )
	$connection->close();
}
?>