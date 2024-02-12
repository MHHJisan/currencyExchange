<?php
include 'connection.php';
class SetRateAmount{

//manually set the conversion rates, default exchange rates are set
//can do it through any third party API calling also 

public function setRate(){
    $store_array = array("USD"=>1.0, "AED"=>3.67, "AUD"=>1.53,
                         "BDT"=>109.65, "CAD"=>1.35, "CHF"=>0.87,
                         "CNY"=>7.18, "EUR"=>0.93, "FJD"=>2.24,
                         "GBP"=>0.79, "HKD"=>7.82, "INR"=>83.01,
                         "JPY"=>149.33, "KWD"=>0.31, "QAR"=>3.64);

    //to iterate inside the key-value iteratin loop
    //from the current key to the last key
    $countries = count($store_array);

    /*storing the keys in an array to check whether values for these 
    keys have already stored or not, if stored then goes to the next 
    key without storing the value, otherwise insert the values*/

    $array_keys = array_keys($store_array);
    
    /*it keep track for counts for key-value loop iteration
    with this value in the inside loop it start from the next values*/
    $count = 0;

    //array iteration for key-value starts
    foreach($store_array as $key=>$value){

        //array iteration for [i] key to the last key starts 
        for($i =0; $i<$countries; $i++){ 
            
            /* checking if it's the same value like $key = USA and 
             $array_keys[$i] = USA, then both the source and destination is 
            same, so it ignore operation for thie value in the loop and move forward */
            if( $array_keys[$i] === $key ){
        
            }else{

                /* now for the inside loop it start to insert only from 
                the current key to the last key, and through this logic ignores
                all the earlier key-values */
                if($i > $count){

                    //storing the rate for source to destination. ex - USD to AED
                    $s2Drate =  $store_array["$array_keys[$i]"]/$store_array["$key"];
                    
    
                        $query = "INSERT INTO exchange_rates (source_currency, destination_currency, rate)
                                  VALUES ('$key', '$array_keys[$i]', '$s2Drate')";
                        $sql = $connect->query($query);

                    //storing the rate for destination to source. ex - AED to USD   
                    $d2Srate = $store_array["$key"]/$store_array["$array_keys[$i]"];
                    

                    $query = "INSERT INTO exchange_rates (source_currency, destination_currency, rate)
                              VALUES ('$array_keys[$i]', '$key', '$d2Srate')";
                    $sql = $connect->query($query);
                    
                }else{
                    // echo "try something";
                }
                
            }
            
        }
        $count++;
    }
}

/* this function shuuld be called when one wants to change
the current exchange rate for a source & destination which is already there
or 
wants to insert a new exchange for new source-destination combination */
public function setRateInsert($source_Currency, $destination_Currency, $rate){


    //check whether source-destination-rate is already exist there and same
    $query = "SELECT * FROM exchange_rates WHERE 
        source_currency = '$source_Currency' AND 
        destination_currency = '$destination_Currency'
        AND rate = '$rate'";

    $sql = $connect->query($query);

    if($sql){
        $data = [
            'status'  => 200, 
            'message' => $requestMethod.' all the values are there already.',
        ];
        header("HTTP/1.0 405 Method Not Found");
        echo json_encode($data);
    }else{

        //check source-destination is already ther or not,
        //just to change the rates
        $query = "SELECT * FROM exchange_rates WHERE 
        source_currency = '$source_Currency' AND 
        destination_currency = '$destination_Currency'";

        $sql = $connect->query($query);

        if($sql){

            //as source-destination is already there, updates the rate
            $query = "UPDATE exchange_rates SET rate = '$rate' 
            WHERE source_currency = '$source_Currency' 
            AND destination_currency = '$destination_Currency'";
            $sql = $connect->query($query);

        }else{

            //as exchange rate for source-destination combination isn't there
            /* it insert a new combination with the exchange rate. 
            and
            there could be alread a combination of destination-source in the database
            but, that won't bother this operation, this insertion will 
            still happen in such condition, 
            ex - there could be a combination for USA-BDT , but no BDT-USA
            so, a new BDT-USA combination will be inserted with rate */
            $query = "INSERT INTO exchange_rates (source_currency, destination_currency, rate)
                     VALUES ('$source_Currency', '$destination_Currency', '$rate')";
            $sql = $connect->query($query);
        }
    }
    
}

}


?>