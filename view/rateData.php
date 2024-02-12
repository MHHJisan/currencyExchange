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

    echo $src_amount;
    $getAmount = new GetAmount();
    $amount = $getAmount->getDestAmount($src_currency, $dest_currency, $src_amount);
    var_dump($amount);
    echo $amount;
    
    // echo $amount[0];

    $data = [
        'status'  => 200,
        'message' => 'This is the exchange Rate for',
        'rate'    => $amount["rate"]
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