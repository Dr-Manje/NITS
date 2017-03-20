<?php

class dbConnection{
    protected $db_conn;
    //public $db_name = 'sms_v1'; //database name
    public $db_name = 'nancys'; //database name
    public $db_user = 'sa'; //database user
    public $db_host = 'localhost'; //database host machine
    public $db_pass = 'Manje@2014'; //database user password
    //public $db_port = '8089'; //database user password

    function connect(){
        
        $db_name = 'nancy'; //database name
        $db_user = 'sa'; //database user
        $db_host = 'localhost'; //database host machine
        $db_pass = 'Manje@2014'; //database user password
        try
        {
            $this->db_conn = new PDO("mysql:host=$db_host;dbname=$db_name",  $db_user, $db_pass);
            return $this->db_conn;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }        
    }
}