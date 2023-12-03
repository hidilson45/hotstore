<?php
class Database{
    private $host = 'localhost';
    private $database = 'hotstore';
    private $username = 'root';
    private $password = '';
    
    public $conn;

    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=".$this->host .";dbname=".$this->database, $this->username, $this->password);
            $this->conn->exec("set names utf8");

        }catch(PDOException $e){
            echo "Database could not be connected: ", $e->getMessage();
        }
        return $this->conn;
    }
}
?>
