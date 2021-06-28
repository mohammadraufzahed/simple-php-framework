<?php


namespace SimplePHPFramework\kernel;

use PDO;
use PDOException;
use PDOStatement;

define("DB_HOST", "localhost");
define("DB_USER", "phpmvc");
define("DB_PASS", "phpmvc");
define("DB_NAME", "phpmvc");

class Database
{
    private PDO|null $conn;
    private PDOStatement|null $stmt;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query(string $query): void
    {
        $this->stmt = $this->conn->prepare($query);
    }

    public function execute(): void
    {
        $this->stmt->execute();
    }

    public function bind(string $param, mixed $value, int $type)
    {
        $this->stmt->bindParam($param, $value, $type);
    }

    public function fetchAsObject(): object
    {
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function fetchAsAssoc(): array
    {
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function fetchAllAsObject(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function fetchAllAsAssoc(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowEffected(): int
    {
        return $this->stmt->rowCount();
    }
    
    public function __destruct()
    {
        $this->conn = null;
        $this->stmt = null;
    }

}

$db = new Database();
