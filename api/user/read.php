<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../../config/database.inc.php';
include_once '../../class/user.php';

$database = new Database();
$db = $database->getConnection();

$items = new User($db);
$stmt = $items->getAllusers();
$itemCount = $stmt->rowCount();

echo json_encode($itemCount);
if($itemCount > 0){
    $usersArr = array();
    $usersArr['body'] = array();
    $usersArr['itemCount'] = $itemCount;

    while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
        extract($row);

        $e = array(
            "id" => $id,
            "firstname" => $name,
            "lastname" => $lastname,
            "mobile" => $mobile,
            "email" => $email,
            "password" => $password
        );
        array_push($usersArr['body'], $e);

    }
    echo json_encode($usersArr);

}else{
    http_response_code(404);
    echo json_encode(array('message' => 'Not Found'));
}
?>