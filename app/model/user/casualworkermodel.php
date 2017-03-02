<?php

include_once ('../../config/config.php');

class casualworkermodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //get recent number
    function GetRecentMembernumberCounter(){
        $query = $this->link->query("select count(casualworkersid) as cnt from casualworkers ");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    //update register with new number
    function AddCasualWorker($names,$lastname,$gender,$newMemberNumber,$yearRegistered){
        $query = $this->link->prepare("INSERT INTO casualworkers (names,lname,gender,casualworkercode,regyear) VALUES (?,?,?,?,?)");        
        $values = array($names,$lastname,$gender,$newMemberNumber,$yearRegistered);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //get recent memberactivites id
    function selectworkers($id){
        $query = $this->link->query("SELECT casualworkercode, concat(names,' ',lname) as workername, gender FROM casualworkers WHERE regyear = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getworkerinfo($id){
        $query = $this->link->query("SELECT casualworkercode, concat(names,' ',lname) as workername, gender FROM casualworkers WHERE casualworkersid = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
}

