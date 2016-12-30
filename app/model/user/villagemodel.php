<?php

include_once ('../../config/config.php');

class villagemodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //list all activies
    function listVillages(){
        $query = $this->link->query("SELECT *
                                    FROM village ");
        $result = $query->fetchAll();
        return $result;
    }
   
    //add activity
    function addVillage($villageName,$villageHeadman){
        $query = $this->link->prepare("INSERT INTO village (villageName,villageHeadman) VALUES (?,?)");        
        $values = array($villageName,$villageHeadman);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update activity
    function UpdateVillage($villageName,$villageHeadman,$id){
        $query = $this->link->prepare("UPDATE village SET villageName = '$villageName'"
                                        . ",villageHeadman = '$villageHeadman'"
                                        . "WHERE villageID = '$id' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
}