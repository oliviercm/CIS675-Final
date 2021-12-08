<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/util/dotenv.php";

class NotEnoughStockException extends Exception {}

class MySQL {
    protected $conn;

    private function __construct() {
        $host = getenv("MYSQL_HOST");
        $database = getenv("MYSQL_DATABASE");
        $port = getenv("MYSQL_PORT");
        $username = getenv("MYSQL_USERNAME");
        $password = getenv("MYSQL_PASSWORD");

        $this->conn = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    
    public static function getInstance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new MySQL();
        }
        return $instance;
    }
    
    public function executeQuery($query, ...$args) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($args);
            $result = $stmt->fetchAll();
            return $result;
        } catch (\Throwable $e) {
            throw $e;
        }
    }
    
    public function query($query) {
        try {
            $this->conn->query($query);
            return true;
        } catch (\Throwable $e) {
            throw $e;
        }
    }
    
    public function purchaseProduct($args) {
        try {
            $this->conn->beginTransaction();
            
            $currentStockStmt = $this->conn->prepare("SELECT SUM(i.amount) as currentProductStock FROM Inventory i WHERE i.productId = :productId;");
            $currentStockStmt->execute([
                "productId" => $args["productId"],
            ]);
            $currentStock = $currentStockStmt->fetch()["currentProductStock"];
            
            if (is_numeric($currentStock)) {
                $currentStock = $currentStock;
            } else {
                throw new Exception("Product does not exist in inventory.");
            }
            
            if ($currentStock <= 0 || $currentStock < $args["quantity"]) {
                throw new NotEnoughStockException("Not enough available stock.");
            }
            
            $remainingStockToRemove = $args["quantity"];
            while ($remainingStockToRemove > 0) {
                $inventoryStmt = $this->conn->prepare("SELECT * FROM Inventory WHERE productId=:productId AND amount > 0 LIMIT 1;");
                $inventoryStmt->execute([
                    "productId" => $args["productId"],
                ]);
                $inventory = $inventoryStmt->fetch();
                $stockToRemove = min($inventory["amount"], $remainingStockToRemove);
                $updateStockStmt = $this->conn->prepare("UPDATE Inventory SET amount=amount-:stockDecrement WHERE locationId=:locationId AND productId=:productId;");
                $updateStockStmt->execute([
                    "locationId" => $inventory["locationId"],
                    "productId" => $inventory["productId"],
                    "stockDecrement" => $stockToRemove,
                ]);
                $remainingStockToRemove = $remainingStockToRemove - $stockToRemove;
            }
            
            $purchaseStmt = $this->conn->prepare("INSERT INTO Purchase (customerId, productId, amount) VALUES (:customerId, :productId, :amount);");
            $purchaseStmt->execute([
                "customerId" => $args["customerId"],
                "productId" => $args["productId"],
                "amount" => $args["quantity"],
            ]);
            
            $this->conn->commit();
        } catch (\Throwable $e) {
            $this->conn->rollBack();
            throw($e);
        }
    }
}
?>