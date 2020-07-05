<?php
require_once(__DIR__ . "/assets/php/env.php");
if (is_set('DEVELOPMENT')) {
    phpinfo();
}
else {
    http_response_code(404);
}
?>