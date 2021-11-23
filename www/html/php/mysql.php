<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/dotenv.php";

class NegativeStockException extends Exception {}

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
}
?>