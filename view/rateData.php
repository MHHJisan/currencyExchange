<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include './Model/getAmount.php';


$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "GET"){

    
    $src_currency = $_GET['source_currency'];
    echo $src_currency;
    $dest_currency = $_GET['destination_currency'];
    echo $dest_currency;
    $src_amount = $_GET['source_amount'];
    echo $src_amount;

    $amount = getDestAmount($src_currency, $dest_currency, $src_amount);
    
    // echo $amount[0];

    $data = [
        'status'  => 200,
        'message' => 'This is the exchange Rate for',
        'rate'    => $amount[0]
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