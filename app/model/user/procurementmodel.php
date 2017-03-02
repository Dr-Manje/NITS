<?php

include_once ('../../config/config.php');

class procurementmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    function GetMemberMarketCenterID($id){
        $query = $this->link->query("select marketcenterid from marketcenter where fieldcode = '$id' ");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    //add none member
    function AddNoneMembers($GetMemberID,$date,$bag,$chalim,$cg7,$ovarieties,$gradeouts,$shells,$yearRegistered){
        $query = $this->link->prepare("INSERT INTO procurement (casualworker,date,bag,chalim,cg7,othervarieties,gradeouts,shell,regyear) VALUES (?,?,?,?,?,?,?,?,?)");        
        $values = array($GetMemberID,$date,$bag,$chalim,$cg7,$ovarieties,$gradeouts,$shells,$yearRegistered);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
}