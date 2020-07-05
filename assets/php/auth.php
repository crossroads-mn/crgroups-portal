<?php 
require_once(__DIR__ . "/env.php");

$ca_file = $_SERVER['DOCUMENT_ROOT'] . "/ca-mysqlonazure.crt.pem";

$tmp = explode('.', $_SERVER['HTTP_HOST']);
$subdomain = current($tmp);

// Parse connection string
if ( !isset($MYSQL_CONN_STRING) || empty($MYSQL_CONN_STRING)) {
	$MYSQL_CONN_STRING = get_setting("MYSQL_CONN_STRING");
}

if (!isset($MYSQL_CONN_STRING)) {
	error_log("Unable to find MYSQL_CONN_STRING");
	die("Unable to find MYSQL_CONN_STRING");
}

$DB_ADDRESS = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $MYSQL_CONN_STRING);
$DB_SCHEMA = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $MYSQL_CONN_STRING);
$DB_USER = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $MYSQL_CONN_STRING);
$DB_PASS = preg_replace("/^.*Password=(.+?)$/", "\\1", $MYSQL_CONN_STRING);

$GLOBAL_DB_ADDRESS = $DB_ADDRESS;
$GLOBAL_DB_USER = $DB_USER;
$GLOBAL_DB_PASS = $DB_PASS;
$GLOBAL_DB_SCHEMA = $DB_SCHEMA;

$DB_CONN=mysqli_init();
mysqli_ssl_set($DB_CONN, NULL, NULL, $ca_file, NULL, NULL); 
mysqli_real_connect($DB_CONN, $DB_ADDRESS, $DB_USER, $DB_PASS, $DB_SCHEMA, 3306);

if ($DB_CONN->connect_errno != 0) {
	die(sprintf("Connection error %d : %s", $DB_CONN->connect_errno, $DB_CONN->connect_error));
}
?>