<?php

include_once 'GetRate.php';

Class GetAmount {

    public $rate;
    

// this method will returns an array of consisting rate & destination amount
public function getDestAmount($source_currency, $destination_currency, $source_amount) {
    
    //gets the exchange rate through getRate() function from getRate class/file;
    // $rate = getRate($source_currency, $destination_currency);
    $getRate = new GetRate(); 
    $this->rate = $getRate->getRate($source_currency, $destination_currency);
    $destination_amount = $this->rate * $source_amount;
    echo $destination_amount;
    // $array["rate"] = $this->rate;
    // $array["destination amount"] = $destination_amount;
    return $this->rate;
}

}

?>
