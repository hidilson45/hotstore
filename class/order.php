<?php
class Order{
    private $conn;
    private $db_table = 'orders';

    public $id;
    public $userId;
    public $cartQuantity;
    public $totalAmount;
    public $deliveryAddress;

    public function __construct($db){
        $this->conn = $db; 
    }

    public function getAllOrders(){
        $sqlQuery = "SELECT id, userId, cartQuantity, totalAmount, deliveryAddress FROM ". $this->db_table."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    public function getOrdersByUserId(){
        $sqlQuery = "SELECT id, userId, cartQuantity, totalAmount, deliveryAddress FROM ".$this->db_table. 
         " WHERE userId = ?";
    
         $stmt = $this->conn->prepare($sqlQuery);
         $stmt->bindParam(1, $this->userId);
         $stmt->execute();
    
         // Fetch all rows
         $dataRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
         $orders = array();
         foreach($dataRows as $dataRow) {
             $order = array(
                 'id' => $dataRow['id'],
                 'userId' => $dataRow['userId'],
                 'cartQuantity' => $dataRow['cartQuantity'],
                 'totalAmount' => $dataRow['totalAmount'],
                 'deliveryAddress' => $dataRow['deliveryAddress']
             );
             array_push($orders, $order);
         }
    
         return $orders;
    }
    
}

?>