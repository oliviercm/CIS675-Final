<?php

function respondJson($json) {
    http_response_code(200);
    header("Content-Type: application/json");
    print_r($json);
}

?>