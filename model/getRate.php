<?php

include 'connection.php';


// this method will return the exchange rate getting source and destinatin
// as parmeters
function getRate($source_currency, $destination_currency) {

    echo "IN index page";
    echo $source_currency;
    echo $destination_currency;

        $query = "SELECT rate FROM exchange_rates 
                 WHERE source_currency = '$source_currency' 
                 AND destination_currency = '$destination_currency'";
        if($query){
            echo "QUERY";
        }
        $sql = $connect->query($query);
        if($sql){
            echo "SQL";
        }else {
            echo "NO SQL";
        }
        echo "TEST";
        $rate = $sql->fetch_assoc();
        echo $rate[0];
        echo $rate;
        if ($rate !== false) {
            $data = [
                'status'  => 405, 
                'message' => $requestMethod.' Method not found in getRate() method',
            ];
            header("HTTP/1.0 405 Method Not Found");
            echo json_encode($data);
        } else {
            $data = [
                'status'  => 405, 
                'message' => $requestMethod.' Rate not found',
            ];
            header("HTTP/1.0 Rate Not Found");
            echo json_encode($data);
        }
        return $rate;
    
} 


?>

