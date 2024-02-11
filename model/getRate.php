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


        $query = "SELECT rate FROM exchange_rates 
                 WHERE source_currency = '$source_currency' 
                 AND destination_currency = '$destination_currency'";
        
        $sql = $connect->query($query);
        
        // $rate = $sql->all();
        $rate = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($rate != false) {

            
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
