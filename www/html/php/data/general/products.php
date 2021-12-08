<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/util/mysql.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/util/respondjson.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (empty($_GET["id"])) { // No ID specified - fetch all products
        try {
            $db = MySQL::getInstance();
            $result = $db->executeQuery("SELECT * FROM Product;");
            respondJson($result);
        } catch (\Throwable $e) {
            http_response_code(500);
        }
    } else if (!is_numeric($_GET["id"])) {
        http_response_code(400);
        echo("Error: Invalid product ID.");
    } else { // Specific product ID specified - fetch specific product
        try {
            $db = MySQL::getInstance();
            $result = $db->executeQuery("SELECT * FROM Product WHERE id = ?;", $_GET["id"]);
            if ($result === "false") {
                http_response_code(404);
                echo("Error: Product not found.");
            } else {
                respondJson($result[0]);
            };
        } catch (\Throwable $e) {
            http_response_code(500);
        }
    }
} else {
    http_response_code(405);
}
?>