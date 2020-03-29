<?php

//if(isset($_SESSION['access'])) {
//	if ($_SESSION["access"] == "granted") {

		//kill the user session, forcing them to log back in!
		session_start();
		session_unset();
	    session_destroy();
	    session_write_close();
	    echo "Logout";
	    header("Location: /index.php");
//	}
//}
?>