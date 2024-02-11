<?php
use PHPUnit\Framework\TestCase;

include '../Model/getRate.php';
include '../Model/getAmount.php';
class SetRateTest extends TestCase{

    function getRate() {
        $test_get_Rate = getRate('USD', 'BDT');
        $this->assertEquals(109.65, $test_get_Rate);
    }

    function getDestAmount() {
        $test_get_Dest_Amount = getDestAmount('USD', 'BDT', 1000);
        $this->assertEquals(109650, $test_get_Dest_Amount[0]);
        $this->assertEquals(109.65, $test_get_Dest_Amount[1]);
    }

    function setRate();
}


?>