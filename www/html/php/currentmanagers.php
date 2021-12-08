<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/util/mysql.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/util/respondjson.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    try {
        $db = MySQL::getInstance();
        // Get employees who are also current managers (exist)
        $result = $db->executeQuery("SELECT *
        FROM Employee AS e
        WHERE EXISTS (SELECT 1 FROM Manager as m WHERE m.employeeId = e.id);");
        respondJson($result);
    } catch (\Throwable $e) {
        http_response_code(500);
    }
} else {
    http_response_code(405);
}
?>