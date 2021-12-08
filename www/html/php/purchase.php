<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/util/mysql.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/util/respondjson.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    try {
        if (strcasecmp($_SERVER["CONTENT_TYPE"], "application/json") !== 0) {
            http_response_code(415);
            return;
        }
        
        $requestBody = json_decode(file_get_contents("php://input"), true);
        
        if (empty($requestBody["productId"]) || empty($requestBody["quantity"])) {
            http_response_code(400);
            echo("Missing fields.");
            return;
        }
        
        $db = MySQL::getInstance();
        $db->purchaseProduct($requestBody);

        echo("Purchase successful.");
    } catch(NotEnoughStockException $e) {
        http_response_code(422);
        echo("Error: Not enough stock.");
    } catch (\Throwable $e) {
        http_response_code(500);
    }
} else {
    http_response_code(405);
}
?>