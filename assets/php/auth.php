<?php 
	require_once(__DIR__ . "/env.php");

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

?>