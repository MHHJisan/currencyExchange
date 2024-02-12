<?php
include_once './Model/GetRate.php';
include_once './Model/GetAmount.php';
include_once './Model/SetRateAmount.php';

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


    public function testsetRate() {

        $dbuser = 'postgres';
        $dbpass = 'jisan';
        $dbhost = 'localhost';
        $dbname = 'exchangeRate';

        $connect = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

        // $test_setRate = new SetRateAmount();
        // $test_new_setRate = $test_setRate->setRateInsert('ABC','XYZ', 12345.456);

        // $query = "SELECT * FROM exchange_rates 
        //          WHERE source_currency = 'ABC' 
        //          AND destination_currency = 'XYZ' AND rate = 12345.456";
        
        // $sql = $connect->query($query);

        // $data = $sql->fetch(PDO::FETCH_ASSOC);

        // $this->assertEquals('ABC', $data['source_currency'], "Incorrect source currency");
        // $this->assertEquals('XYZ', $data['destination_currency'], "Incorrect destination currency");
        // $this->assertEquals(12345.456, $data['rate'], "Incorrect rate");

        // deleting the test data from the database
        $delete_query = "DELETE FROM exchange_rates WHERE source_currency = 'ABC' 
                          AND destination_currency = 'XYZ' AND rate = 12345.456";
        $delete_sql = $connect->query($delete_query);

        $query = "SELECT * FROM exchange_rates 
                 WHERE source_currency = 'USD' 
                 AND destination_currency = 'BDT' AND rate = 109.650";
        
        $sql = $connect->query($query);

        $data = $sql->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals('USD', $data['source_currency']);
        $this->assertEquals('BDT', $data['destination_currency']);
        $this->assertEquals(109.650, $data['rate']);

    }    
}


?>