<?php
require_once(__DIR__ . "/assets/php/env.php");
if (is_set('DEVELOPMENT')) {
    require_once(__DIR__ . '/assets/php/auth.php');

    $eventinfo = array();

    $query = "SELECT GUID, TITLE, DATE_OF_EVENT, START_TIME, END_TIME, LOCATION, DESCRIPTION, OWNER, CONTACT_EMAIL, COST, REGISTRATION_LINK, CHILDCARE_LINK, CATEGORY FROM EVENTS LIMIT 1";
    $event = mysqli_query($DB_CONN, $query) or die('{"records": [{"error": "' . mysqli_error($DB_CONN) . '"}]}');

    while($rs = mysqli_fetch_assoc($event)) {
        array_push($eventinfo, $rs);
    } 

    echo json_encode($eventinfo);


    $groupinfo = array();

    $query = "SELECT SYS_ID, TITLE, TARGET_AUDIENCE, MEET_DAY, MEET_TIME_START, DURATION, LEADER, PHONE_NUMBER, EMAIL, LOCATION, CAMPUS, GROUP_LINK, GROUP_TYPE, CARE_PROVIDED, COST, ACTIVE, TRIM(DESCRIPTION) as DESCRIPTION FROM SMALL_GROUPS LIMIT 1";
    $group = mysqli_query($DB_CONN, $query) or die('{"records": [{"error": "' . mysqli_error($DB_CONN) . '"}]}');
    

    while($rs = mysqli_fetch_assoc($group)) {
        array_push($groupinfo, $rs);
    } 

    echo json_encode($groupinfo);
}
else
{
    http_response_code(404);
}
?> 