<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../config/database.inc.php';
require_once '../../class/order.php';

$database = new Database();
$db = $database->getConnection();
$items = new Order($db);
$items->userId = isset($_GET['userId']) ? $_GET['userId'] : die();

$orders = $items->getOrdersByUserId();

if(!empty($orders)){
    http_response_code(200);
    echo json_encode($orders);
}else{
    http_response_code(404);
    echo json_encode("No record of orders Found");
}
?>
