<?php

include_once ('../../config/config.php');

class associationsmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //list all activies
    function listAssociations(){
        $query = $this->link->query("SELECT *
                                    FROM associations ");
        $result = $query->fetchAll();
        return $result;
    }
   
    //add activity
    function addAssociation($associationsName,$associationsDescription){
        $query = $this->link->prepare("INSERT INTO associations (associationsName,associationsDescription) VALUES (?,?)");        
        $values = array($associationsName,$associationsDescription);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update activity
    function UpdateAssociation($associationsName,$associationsDescription,$id){
        $query = $this->link->prepare("UPDATE associations SET associationsName = '$associationsName'"
                                        . ",associationsDescription = '$associationsDescription'"
                                        . "WHERE associationsID = '$id'");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
}