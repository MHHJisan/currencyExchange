<?php
namespace App\Model;

require_once 'GetRate.php';

class Amount {
    // This method will return an array consisting rate & destination amount
    public function getDestAmount($source_currency, $destination_currency, $source_amount) {
        // Get the exchange rate through getRate() function from getRate class/file
        $getRate = new GetRate();
        $rate = $getRate->getRate($source_currency, $destination_currency);

        // Calculate the destination amount
        $destination_amount = $rate * $source_amount;

        $data = [
            'status'  => 200,
            'message' => 'This is the exchange Rate for',
            'rate'    => $rate,
            'destination amount' => $destination_amount
        ];
        return json_encode($data);
    }
}
?>
