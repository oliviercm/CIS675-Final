<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/mysql.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/respondjson.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    try {
        $db = MySQL::getInstance();
        // Get products from locations ID 1,2,3 that are exclusive to those locations (in, having)
        $result = $db->executeQuery("SELECT i.productId as productId, SUM(i.amount) as totalAmount, p.name as productName
        FROM Inventory i
        INNER JOIN Product p ON i.productId = p.id
        WHERE i.locationId IN ('1', '2', '3')
        GROUP BY i.productId HAVING productId NOT IN (SELECT i2.productId FROM Inventory i2 WHERE i2.locationId NOT IN ('1', '2', '3'));");
        respondJson($result);
    } catch (\Throwable $e) {
        http_response_code(500);
    }
} else {
    http_response_code(405);
}
?>