<?php
function get_setting($key) {
    if (isset($_SERVER[$key])) {
        return $_SERVER[$key];
    }

    if (isset($_ENV[$key])) {
        return $_ENV[$key];
    }

    return null;
}

function is_set($key) {
    $value = get_setting($key);
    return ($value) ? true : false;
}
?>