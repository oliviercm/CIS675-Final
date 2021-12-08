<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/util/mysql.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/util/respondjson.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    try {
        $db = MySQL::getInstance();
        // Get total amount of purchases per customer for customers that have purchased at least 1 item (having)
        $result = $db->executeQuery("SELECT customerId, SUM(p.amount) as total FROM Purchase p GROUP BY customerId HAVING total > 0;");
        respondJson($result);
    } catch (\Throwable $e) {
        http_response_code(500);
    }
} else {
    http_response_code(405);
}
?>