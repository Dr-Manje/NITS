<?php

    $db_name = 'nancy'; //database name
    $db_user = 'sa'; //database user
    $db_host = 'localhost'; //database host machine
    $db_pass = 'Manje@2014'; //database user password
    
    try
    {
        $dbo = new PDO("mysql:host=$db_host;dbname=$db_name",  $db_user, $db_pass);
        //return $this->db_conn;
    } catch (PDOException $ex) {
        print "Error! " . $e->getMessage() . "<br>";
        die();
    } 