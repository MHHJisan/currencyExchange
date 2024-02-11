<?php
echo "hello";

include 'testFile.php';

include_once '../model/modelTest.php';
// include_once '../model/GetRate.php';


header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');




$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod === "GET"){
    // && isset($_GET['action'])
    // $action = $_GET['action'];
    $src_currency = $_GET['source_currency'];
    echo $src_currency;
    $dest_currency = $_GET['destination_currency'];
    echo $dest_currency;
    $rate = getRate($src_currency, $dest_currency);
    echo $rate;

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