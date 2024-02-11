<?php

// include_once '../Model/modelTest.php';
include_once '../Model/getRate.php';


header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');




$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "GET"){

    $src_currency = $_GET['source_currency'];
    $dest_currency = $_GET['destination_currency'];
    $rate = getRate($src_currency, $dest_currency);

    $data = [
        'status'  => 200,
        'message' => 'This is the exchange Rate for',
        'rate'    => $rate
    ];
    header("HTTP/1.0 200 OK");
    echo json_encode($data);
}else{
    $data = [
        'status'  => 405, 
        'message' => $requestMethod.' Method not found',
    ];
    header("HTTP/1.0 405 Not Found");
    echo json_encode($data);
}
?>