<?php
class Product {
    //connection
    private $conn;
    //Table
    private $db_table = "products";

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
    public function createProduct(){
        $sqlQuery = "INSERT INTO ". $this->db_table ." 
        SET 
                name = :name,
                price = :price,
                details = :details,
                category = :category";

        $stmt = $this->conn->prepare($sqlQuery);
        

        //Sanitaze the data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->details = htmlspecialchars(strip_tags($this->details));
        $this->category = htmlspecialchars(strip_tags($this->category));

        //Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':details', $this->details);
        $stmt->bindParam(':category', $this->category);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    //Read Single
    public function getSingleProduct(){
        $sqlQuery = "SELECT id, name, price,
         details, category FROM ".$this->db_table. 
         " WHERE id = ? LIMIT 0,1";

         $stmt = $this->conn->prepare($sqlQuery);
         $stmt->bindParam(1,$this->id);
         $stmt->execute();
         $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

         $this->name = $dataRow['name'];
         $this->price = $dataRow['price'];
         $this->details = $dataRow['details'];
         $this->category = $dataRow['category'];
         
    }
}
?>