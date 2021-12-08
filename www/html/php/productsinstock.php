<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/mysql.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/respondjson.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    try {
        $db = MySQL::getInstance();
        // Create view for products in stock
        // Note: Normally this view would be created once, and ahead of time.
        $db->query("CREATE OR REPLACE VIEW productsInStock AS
        SELECT i.productId as productId, p.name as productName, p.price as productPrice, SUM(i.amount) as totalAvailable FROM test.Inventory as i
        INNER JOIN Product as p ON p.id = i.productId GROUP BY i.productId HAVING totalAvailable > 0;");
        // Select from created view
        $result = $db->executeQuery("SELECT * FROM productsInStock;");
        respondJson($result);
    } catch (\Throwable $e) {
        http_response_code(500);
        echo($e);
    }
} else {
    http_response_code(405);
}
?>