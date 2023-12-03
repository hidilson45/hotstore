<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');

    include_once '../../config/database.inc.php';
    include_once '../../class/product.php';

    $database = new Database();
    $db = $database->getConnection();
    $items = new Product($db);
    $stmt = $items->getAllProducts();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){
        $productsArr = array();
        $productsArr['body'] = array();
        $productsArr['itemCount'] = $itemCount;

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "price" => $price,
                "details" => $details,
                "category" => $category,

            );
            array_push($productsArr['body'], $e);
        }
        echo json_encode($productsArr);
    }else{
        http_response_code(404);
        echo json_encode(array('message' => 'No Record Found!')
    );
    }
?>