<?php
require_once(__DIR__ . "/env.php");

function log_message(...$params) {
    if (is_set('LOG_VERBOSE'))
    {
        error_log(...$params);
    }
}
?>