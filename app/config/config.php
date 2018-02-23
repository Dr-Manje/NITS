<?php

class dbConnection{
    protected $db_conn;

    public $db_name = 'nancy'; //database name
    public $db_user = 'root'; //database user
    public $db_host = 'localhost'; //database host machine
    public $db_pass = 'admin'; //database user password

    function connect(){
        
        $db_name = 'nancy'; //database name
        $db_user = 'root'; //database user
        $db_host = 'localhost'; //database host machine
        $db_pass = ''; //database user password
        try
        {
            $this->db_conn = new PDO("mysql:host=$db_host;dbname=$db_name",  $db_user, $db_pass);
            return $this->db_conn;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }        
    }
}