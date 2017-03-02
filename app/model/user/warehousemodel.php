<?php

include_once ('../../config/config.php');

class warehousemodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //get recent number
    function GetMemberID($id){
        $query = $this->link->query("select casualworkersid from casualworkers where casualworkercode = '$id' ");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    //update register with new number
    function AddwareHouseData($GetMemberID,$date,$bag,$chalim,$cg7,$ovarieties,$gradeouts,$shells,$yearRegistered){
        $query = $this->link->prepare("INSERT INTO warehouse (casualworker,date,bag,chalim,cg7,othervarieties,gradeouts,shell,regyear) VALUES (?,?,?,?,?,?,?,?,?)");        
        $values = array($GetMemberID,$date,$bag,$chalim,$cg7,$ovarieties,$gradeouts,$shells,$yearRegistered);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //get recent memberactivites id
    function selectwarehouse($id){
        $query = $this->link->query("select concat(CW.names,' ',CW.lname) as cname, DATE_FORMAT(W.date,'%D %M %Y') as datee, W.bag, W.chalim, W.cg7, W.othervarieties, W.gradeouts, W.shell
                                    from warehouse W
                                    join casualworkers CW on CW.casualworkersid = W.casualworker
                                    where W.regyear = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get recent memberactivites id
    function selectwarehouse1($id){
        $query = $this->link->query("select distinct W.casualworker as id, concat(CW.names,' ',CW.lname) as cname
                                    from warehouse W
                                    join casualworkers CW on CW.casualworkersid = W.casualworker
                                    where W.regyear = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get recent memberactivites id
    function selectwarehouse2($id,$year){
        $query = $this->link->query("select DATE_FORMAT(W.date,'%D %M %Y') as datee, W.bag as bag, W.chalim as chalim, W.cg7 as cg7, W.othervarieties as ov, W.gradeouts as go, W.shell as shell, W.warehouseid as id
                                    from warehouse W
                                    where casualworker = '$id' and regYear = '$year' ");
        $result = $query->fetchAll();
        return $result;
    }
}

