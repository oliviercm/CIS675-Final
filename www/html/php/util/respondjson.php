<?php
function respondJson($response) {
    http_response_code(200);
    header("Content-Type: application/json");
    print_r(json_encode($response));
}
?>