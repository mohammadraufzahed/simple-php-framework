<?php


namespace SimplePHPFramework\kernel;

use PDO;
use PDOException;
use PDOStatement;

define("DB_HOST", "localhost");
define("DB_USER", "product_crud");
define("DB_PASS", "09351515982");
define("DB_NAME", "product_crud");

class Database
{
    private PDO|null $conn;
    private PDOStatement|null $stmt;

    public function __construct()
    {
        # Creating the connection to the database
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        try {
            $this->conn = new PDO($dsn, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /** Prepare the query statement
     * @param string $query
     * @return void
     * */
    public function query(string $query): void
    {
        $this->stmt = $this->conn->prepare($query);
    }

    /**
     * Execute the statement
     * @return void
     */
    public function execute(): void
    {
        $this->stmt->execute();
    }

    /**
     * Bind the data to the statement
     * @param string $param
     * @param mixed $value
     * @param int $type
     */
    public function bind(string $param, mixed $value, int $type)
    {
        $this->stmt->bindParam($param, $value, $type);
    }

    /**
     * Fetch the result as an object
     * @return object
     */
    public function fetchAsObject(): object
    {
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Fetch the result as an Assoc Array
     * @return array
     */
    public function fetchAsAssoc(): array
    {
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch the results as an array of object
     * @return array
     */
    public function fetchAllAsObject(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Fetch the results as an Assoc array
     * @return array
     */
    public function fetchAllAsAssoc(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Return the number of the effected rows
     */
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
