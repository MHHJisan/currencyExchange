<?php

        $dbuser = 'postgres';
        $dbpass = 'jisan';
        $dbhost = 'localhost';
        $dbname = 'exchangeRate';

        try {
            $connect = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            if($connect){
                echo "Alhamdulillah";
            }
        }catch (PDOException $e) {
            echo "Error : " . $e->getMessage() . "<br/>";
            die();
        }
        

?>

