<?php
use PHPUnit\Framework\TestCase;
use App\Model\Amount;
use App\Model\GetRate;

class SetRateTest extends TestCase
{
    public function testGetDestAmount()
    {
        // Mock the GetRate class
        $mockGetRate = $this->getMockBuilder('App\GetRate')
                            ->getMock();
        
        // Set up the mock return value for getRate() method
        $mockGetRate->expects($this->once())
                    ->method('getRate')
                    ->with('USD', 'EUR')
                    ->willReturn(0.93);

        // Create an instance of CurrencyConverter class
        $converter = new Amount();

        // Set the mock GetRate object to the private property of CurrencyConverter
        $reflection = new ReflectionClass($converter);
        $property = $reflection->getProperty('getRate');
        $property->setAccessible(true);
        $property->setValue($converter, $mockGetRate);

        // Call the method to be tested
        $result = $converter->getDestAmount('USD', 'EUR', 100);

        // Assert that the returned JSON string contains the expected values
        $expectedResult = '{"status":200,"message":"This is the exchange Rate for","rate":0.93,"destination amount":93}';
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetRate()
    {
        // Mock the Connection class
        $mockConnection = $this->getMockBuilder('App\Model\Connection')
                            ->getMock();
        
        // Set up the mock return value for getConnection() method
        $mockPdo = $this->getMockBuilder('PDO')
                        ->disableOriginalConstructor()
                        ->getMock();
        $mockConnection->expects($this->once())
                        ->method('getConnection')
                        ->willReturn($mockPdo);

        // Create an instance of CurrencyConverter class
        $converter = new GetRate();

        // Set the mock Connection object to the private property of CurrencyConverter
        $reflection = new ReflectionClass($converter);
        $property = $reflection->getProperty('connection');
        $property->setAccessible(true);
        $property->setValue($converter, $mockConnection);

        // Set up the mock query and fetch result for PDO object
        $mockPdoStatement = $this->getMockBuilder('PDOStatement')
                                ->getMock();
        $mockPdoStatement->expects($this->once())
                        ->method('fetch')
                        ->with(PDO::FETCH_ASSOC)
                        ->willReturn(false);
        $mockPdo->expects($this->once())
                ->method('query')
                ->with("SELECT rate FROM exchange_rates 
                        WHERE source_currency = 'USD' 
                        AND destination_currency = 'EUR'")
                ->willReturn($mockPdoStatement);

        // Call the method to be tested
        $result = $converter->getRate('USD', 'EUR');

        // Assert that the returned value is false
        $this->assertFalse($result);
    }
}
?>
