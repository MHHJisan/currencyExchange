<?php
namespace App\Model;

require_once 'connection.php';

class CurrencyConverter {
    private $connection;

    public function __construct() {
        $this->connection = new Connection();
        $this->connection->connect();
    }

    // Manually set the conversion rates, default exchange rates are set 
    public function setDefaultRates() {
        $store_array = array("USD"=>1.0, "AED"=>3.67, "AUD"=>1.53,
                             "BDT"=>109.65, "CAD"=>1.35, "CHF"=>0.87,
                             "CNY"=>7.18, "EUR"=>0.93, "FJD"=>2.24,
                             "GBP"=>0.79, "HKD"=>7.82, "INR"=>83.01,
                             "JPY"=>149.33, "KWD"=>0.31, "QAR"=>3.64);

        $connect = $this->connection->getConnection();

        // Array iteration for key-value starts
        foreach($store_array as $key=>$value) {
            // Array iteration for [i] key to the last key starts 
            foreach($store_array as $i_key=>$i_value) {
                if($i_key !== $key) {
                    // Storing the rate for source to destination. Ex: USD to AED
                    $s2Drate =  $i_value / $value;
                    $query = "INSERT INTO exchange_rates (source_currency, destination_currency, rate)
                              VALUES ('$key', '$i_key', '$s2Drate')";
                    $connect->query($query);
                    // Storing the rate for destination to source. Ex: AED to USD   
                    $d2Srate = $value / $i_value;
                    $query = "INSERT INTO exchange_rates (source_currency, destination_currency, rate)
                              VALUES ('$i_key', '$key', '$d2Srate')";
                    $connect->query($query);
                }
            }
        }
    }

    // Set custom exchange rate for a source and destination
    public function setCustomRate($source_Currency, $destination_Currency, $rate) {
        $connect = $this->connection->getConnection();

        // Check whether source-destination-rate is already exist there and same
        $query = "SELECT * FROM exchange_rates WHERE 
            source_currency = '$source_Currency' AND 
            destination_currency = '$destination_Currency'
            AND rate = '$rate'";
        $sql = $connect->query($query);

        if($sql->rowCount() > 0) {
            $data = [
                'status'  => 200, 
                'message' => 'All the values are already there.',
            ];
            header("HTTP/1.0 405 Method Not Allowed");
            echo json_encode($data);
        } else {
            // Check source-destination is already there or not, just to change the rates
            $query = "SELECT * FROM exchange_rates WHERE 
                source_currency = '$source_Currency' AND 
                destination_currency = '$destination_Currency'";
            $sql = $connect->query($query);

            if($sql->rowCount() > 0) {
                // As source-destination is already there, updates the rate
                $query = "UPDATE exchange_rates SET rate = '$rate' 
                WHERE source_currency = '$source_Currency' 
                AND destination_currency = '$destination_Currency'";
                $connect->query($query);
            } else {
                // Insert a new combination with the exchange rate
                $query = "INSERT INTO exchange_rates (source_currency, destination_currency, rate)
                         VALUES ('$source_Currency', '$destination_Currency', '$rate')";
                $connect->query($query);
            }
        }
    }
}
?>
