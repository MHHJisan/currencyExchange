<?php

public class Connect {

    public $dbuser = 'postgres';
    public $dbpass = 'jisan';
    public $dbhost = 'localhost';
    public $dbname = 'exchangeRate';

    public $connect;

    public function __construct() {
        
        try {
            $connect = new PDO("pgsql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
            if($connect){
                echo "SubhanAllah";
            }
        }catch (PDOException $e) {
            echo "Error : " . $e->getMessage() . "<br/>";
            die();
        }

    }

}
        
?>

