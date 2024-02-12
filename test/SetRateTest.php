<?php
include_once './Model/GetRate.php';
include_once './Model/GetAmount.php';

use PHPUnit\Framework\TestCase;
class SetRateTest extends TestCase{

    
    public function testgetRate() {

        $get_rate = new GetRate();
        $test_get_Rate = $get_rate->getRate('USD', 'BDT');
        $this->assertEquals(109.65, $test_get_Rate);
        
    }

    function testgetDestAmount() {

        $get_Dst_Amount = new GetAmount();
        $test_get_Dest_Amount = $get_Dst_Amount->getDestAmount('USD', 'BDT', 1000);
        $this->assertEquals(109.65, $test_get_Dest_Amount[0]);
        $this->assertEquals(109650, $test_get_Dest_Amount[1]);
    }

    
}


?>