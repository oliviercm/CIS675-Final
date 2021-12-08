<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/util/mysql.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/util/respondjson.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    try {
        $db = MySQL::getInstance();
        // Get count of employees per location (group by, count)
        $result = $db->executeQuery("SELECT l.sName as locationName, COUNT(*) as employeeCount
        FROM Employee as e 
        INNER JOIN WorksAt as wa 
        ON wa.employeeId = e.id
        INNER JOIN Location as l ON l.id = wa.locationId
        WHERE wa.endDate IS NULL
        GROUP BY wa.locationId;");
        respondJson($result);
    } catch (\Throwable $e) {
        http_response_code(500);
    }
} else {
    http_response_code(405);
}
?>