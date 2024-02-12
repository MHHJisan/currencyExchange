<?php
use PHPUnit\Framework\TestCase;

include '../Model/GetRate.php';
include '../Model/GetAmount.php';
class SetRateTest extends TestCase{

    function getRate() {

        $get_rate = new GetRate();
        $test_get_Rate = $get_rate->getRate('USD', 'BDT');
        $this->assertEquals(109.65, $test_get_Rate);
    }

    function getDestAmount() {

        $get_Dst_Amount = new GetAmount();
        $test_get_Dest_Amount = $get_Dst_Amount->getDestAmount('USD', 'BDT', 1000);
        $this->assertEquals(109650, $test_get_Dest_Amount);
        // $this->assertEquals(109.65, $test_get_Dest_Amount[1]);
    }

    // function setRate();
}


?>