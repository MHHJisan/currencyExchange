<?php

// include 'connection.php';



// this method will return the exchange rate getting source and destinatin
// as parmeters
function getRate($source_currency, $destination_currency) {

    $dbuser = 'postgres';
        $dbpass = 'jisan';
        $dbhost = 'localhost';
        $dbname='exchangeRate';


$connect = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
var_dump($connect);
    echo "Bhola-bala";

        $query = "SELECT rate FROM exchange_rates 
                 WHERE source_currency = '$source_currency' 
                 AND destination_currency = '$destination_currency'";
        if($query){
            
        }
        
        $sql = $connect->query($query);
        if($sql){
            echo "SQL";
        }else {
            echo "NO SQL";
        }
        echo "TEST";
        $rate = $sql->all();
        
        if ($rate != false) {

            echo "bhai re bhai";
            $data = [
                'status'  => 405, 
                'message' => $requestMethod.' Method not found in getRate() method',
            ];
            header("HTTP/1.0 405 Method Not Found");
            echo json_encode($data);
        } else {
            echo "rate";
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
