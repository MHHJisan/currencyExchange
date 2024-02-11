<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include './model/setRate.php';


$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "POST"){
    
    $input = json_decode(file_get_contents("php://input"), true);
    echo json_encode($input['name']);

    $data = [
        'status'  => 200,
        'message' => 'This is the exchange Rate for',
    ];
    header("HTTP/1.0 200 OK");
    echo json_encode($data);
}else{
    $data = [
        'status'  => 405, 
        'message' => $requestMethod.' Method not allowed',
    ];
    header("HTTP/1.0 405 Not Found");
    echo json_encode($data);
}
?>