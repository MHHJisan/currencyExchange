<?php
include_once 'GetRate.php';
// namespace Model;
// use Model\GetRate;
Class GetAmount {

    public $rate;
    public $destination_amount;
    

// this method will returns an array of consisting rate & destination amount
public function getDestAmount($source_currency, $destination_currency, $source_amount) {
    
    //gets the exchange rate through getRate() function from getRate class/file;
    // $rate = getRate($source_currency, $destination_currency);
    $getRate = new GetRate(); 
    $this->rate = $getRate->getRate($source_currency, $destination_currency);
    $this->destination_amount = $this->rate * $source_amount;
    // $array["rate"] = $this->rate;
    // $array["destination amount"] = $destination_amount;
    return array($this->rate, $this->destination_amount);
}

}

?>
