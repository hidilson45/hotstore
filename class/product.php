<?php
class Product {
    //connection
    private $conn;
    //Table
    private $db_table = "Products";

    //Columns
    public $id;
    public $name;
    public $price;
    public $details;
    public $category;

    //DB connection
    public function __construct($db){
        $this->conn = $db;
    }

    //Get All
    public function getAllProducts(){
        $sqlQuery = "SELECT id, name, price, details, category FROM ". $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    //Create
}
?>