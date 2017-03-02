<?php

include_once ('../../config/config.php');

class marketcentermodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //get recent number
    function GetRecentMembernumberCounter(){
        $query = $this->link->query("select count(marketcenterid) as cnt from marketcenter ");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    function AddMarketCenter($names,$code,$yearRegistered){
        $query = $this->link->prepare("INSERT INTO marketcenter (fieldname,fieldcode,regyear) VALUES (?,?,?)");        
        $values = array($names,$code,$yearRegistered);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    function lstMarketcenters(){
        $query = $this->link->query("select fieldname,fieldcode from marketcenter  ");
        $result = $query->fetchAll();
        return $result;
    }
}