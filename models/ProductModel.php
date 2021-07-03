<?php


namespace SimplePHPFramework\models;

require __DIR__ . "/../vendor/autoload.php";

use SimplePHPFramework\kernel\Database;

class ProductModel
{
    private object $conn;
    public function __construct()
    {
        $this->conn = new Database();
    }

    public function getProducts()
    {
        $this->conn->query("SELECT * FROM products");
        $this->conn->execute();
        $products = $this->conn->fetchAllAsObject();
        return $products;
    }
}
