<?php
include_once '../Model/GetAmount.php';

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');


$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "GET"){

    
    $src_currency = $_GET['source_currency'];
    $dest_currency = $_GET['destination_currency'];
    $src_amount = $_GET['source_amount'];

    $getAmount = new GetAmount();
    $dest_amount = $getAmount->getDestAmount($src_currency, $dest_currency, $src_amount);
    

    $data = [
        'status'  => 200,
        'message' => 'This is the exchange Rate for',
        'rate'    => $dest_amount[0],
        'destination amount' => $dest_amount[1]
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