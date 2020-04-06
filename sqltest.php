<?php
    include 'auth.php';

    $conn = mysqli_connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_SCHEMA);
    $query = "SELECT SYS_ID, TITLE, TARGET_AUDIENCE, MEET_DAY, MEET_TIME_START, DURATION, LEADER, PHONE_NUMBER, EMAIL, LOCATION, CAMPUS, GROUP_LINK, GROUP_TYPE, CARE_PROVIDED, COST, ACTIVE, TRIM(DESCRIPTION) as DESCRIPTION FROM SMALL_GROUPS LIMIT 1";
    $result = mysqli_query($conn, $query) or die('{"records": [{"error": "' . mysqli_error($connection) . '"}]}');
    
    $info = array();

    while($rs = mysqli_fetch_assoc($result)) {
        //array_push($info, $rs);
        array_push($info, $rs);
    } 

    echo json_encode($info);
?> 