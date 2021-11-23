<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/mysql.php";

function respondJson($json) {
    http_response_code(200);
    header("Content-Type: application/json");
    print_r($json);
}

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    try {
        $db = new MySQL();
        $result = $db->getAllLocationsJson();
        respondJson($result);
    } catch (\Throwable $e) {
        http_response_code(500);
    }
} else {
    http_response_code(405);
}
?>