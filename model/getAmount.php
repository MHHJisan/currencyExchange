<?php

include 'getRate.php';
// this method will returns an array of consisting rate & destination amount
echo "GET AMOUNT";
function getDestAmount($sourche_currency, $destination_currency, $source_amount) {
    
    //gets the exchange rate through getRate() function from getRate class/file;
    $rate = getRate($sourche_currency, $destination_currency);
    echo $rate;
    $destination_amount = $rate * $source_amount;
    $array["rate"] = $rate;
    $array["destination amount"] = $destination_amount;
    return $array;
}

?>
