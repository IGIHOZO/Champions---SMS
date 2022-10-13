<?php
session_start();
//====================================================================================================== CONNECTION
    $dbname = 'seveeen_sms';
    $user = 'root';
    $pass = '';

    // $dbname = 'eguracom_sms';
    // $user = 'eguracom';
    // $pass = 'Kigali123@';
    

    $con = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);

class DbConnect
{
    private $host='localhost';
    private $dbName = 'seveeen_sms';
    private $user = 'root';
    private $pass = '';
    public $conn;
    
    // private $host='localhost';
    // private $dbName = 'eguracom_sms';
    // private $user = 'eguracom';
    // private $pass = 'Kigali123@';
    // public $conn;


    public function connect()
    {
        try {
         $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName, $this->user, $this->pass);
         return $conn;
        } catch (PDOException $e) {
            echo "Database Error ".$e->getMessage();
            return null;
        }
    }
}












?>