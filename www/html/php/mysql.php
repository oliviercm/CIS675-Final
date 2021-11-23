<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/dotenv.php";

class NegativeStockException extends Exception {}

class MySQL {
    protected $conn;

    public function __construct() {
        $host = getenv("MYSQL_HOST");
        $database = getenv("MYSQL_DATABASE");
        $port = getenv("MYSQL_PORT");
        $username = getenv("MYSQL_USERNAME");
        $password = getenv("MYSQL_PASSWORD");

        $this->conn = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    
    public function getAllEmployees() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM Employee");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (\Throwable $e) {
            throw $e;
        }
    }
    
    public function getAllEmployeesJson() {
        try {
            $result = $this->getAllEmployees();
            return json_encode($result);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
    
    public function getAllCustomers() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM Customer");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (\Throwable $e) {
            throw $e;
        }
    }
    
    public function getAllCustomersJson() {
        try {
            $result = $this->getAllCustomers();
            return json_encode($result);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
?>