<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.inc.php';
include_once '../class/product.php';

$database = new Database();
$db = $database->getConnection();
$item = new Product($db);
$data = json_decode(file_get_contents("php://input"));
$item->name =$data->name;
$item->price =$data->price;
$item->details =$data->details;
$item->category =$data->category;

if($item->createProduct()){
    echo 'Product Created Successfully!';
}else{
    echo 'Product could not be created!';
}

?>