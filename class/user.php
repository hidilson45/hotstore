<?php
class User{
    private $conn;
    private $db_table = 'users';

    public $id;
    public $firstname;
    public $lastname;
    public $mobile;
    public $email;
    public $password;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAllUsers(){
        $sqlQuery = "SELECT id, firstname, lastname, mobile, email, password FROM ".$this->db_table."";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
}

?>