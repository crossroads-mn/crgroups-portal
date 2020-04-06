<?php 
	$tmp = explode('.', $_SERVER['HTTP_HOST']);
	$subdomain = current($tmp);

	// Parse connection string
	if ( !isset($MYSQL_CONN_STRING) || empty($MYSQL_CONN_STRING)) {
		if ( isset($_SERVER["MYSQL_CONN_STRING"]) && !empty($_SERVER["MYSQL_CONN_STRING"]) ) {
			$MYSQL_CONN_STRING = $_SERVER["MYSQL_CONN_STRING"];
		}
		else if ( isset($_ENV["MYSQL_CONN_STRING"]) && !empty($_ENV["MYSQL_CONN_STRING"]) ) {
			$MYSQL_CONN_STRING = $_ENV["MYSQL_CONN_STRING"];
		}	
	}

	if (!isset($MYSQL_CONN_STRING)) {
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