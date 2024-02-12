<?php

// include 'connection.php';
// namespace Model;
// include_once 'Connect.php';

Class GetRate {

    public $rate;

// this method will return the exchange rate getting source and destinatin
// as parmeters
public function getRate($source_currency, $destination_currency) {

    $dbuser = 'postgres';
        $dbpass = 'jisan';
        $dbhost = 'localhost';
        $dbname='exchangeRate';


        $connect = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        // $connect = new Connect();
        $query = "SELECT rate FROM exchange_rates 
                 WHERE source_currency = '$source_currency' 
                 AND destination_currency = '$destination_currency'";
        
        $sql = $connect->query($query);
        
        // $rate = $sql->all();
        $data = $sql->fetch(PDO::FETCH_ASSOC);

        $this->rate = $data['rate'];
        
        if ($this->rate != false) {
            
        } else {
            $data = [
                'status'  => 405, 
                'message' => $requestMethod.' Rate not found',
            ];
            header("HTTP/1.0 Rate Not Found");
            echo json_encode($data);
        }

        return $this->rate;
    
} 
}

?>
