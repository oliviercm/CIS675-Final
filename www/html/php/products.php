<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/mysql.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/respondjson.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    try {
        $db = MySQL::getInstance();
        $result = $db->executeQuery("SELECT * FROM Product");
        respondJson($result);
    } catch (\Throwable $e) {
        http_response_code(500);
    }
} else {
    http_response_code(405);
}
?>