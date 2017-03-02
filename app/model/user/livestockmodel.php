<?php

include_once ('../../config/config.php');

class livestockmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //get cropID
    function getLivestockID($code){
        $query = $this->link->query("SELECT livestockID, fieldname "
                                    . "FROM livestock WHERE fieldcode = '$code' LIMIT 1");
        $result = $query->fetchAll();
        return $result;
    }
    
    //delete member crop
    function deleteMemberLivestock($id){
        $query = $this->link->prepare("DELETE memberlivestock FROM memberlivestock WHERE memberslivestockID = '$id' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
     //update member crops 2
    function UpdateMemberLivestockfull($id,$quantity){
        $query = $this->link->prepare("UPDATE memberlivestock SET qty = '$quantity'  WHERE memberslivestockID = '$id' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //check if member livestock entry exists
    function CheckifMemberAlreadyHasLivestock($member,$livestock){
        $query = $this->link->query("select count(*) from memberlivestock where memberID = '$member' AND livestockID = '$livestock' LIMIT 1");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    //add livestock member
    function addMemberLivestock($memberID, $livestock, $quantity){
        $query = $this->link->prepare("INSERT INTO memberlivestock (memberID,livestockID,qty) VALUES (?,?,?)");        
        $values = array($memberID, $livestock, $quantity);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update member livestock
    function UpdateMemberLivestock($memberID,$livestock,$quantity){
        $query = $this->link->prepare("UPDATE memberlivestock SET qty = '$quantity' WHERE livestockID = '$livestock' AND memberID = '$memberID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    
    //list all livestock with selected
    function listLivestock(){
        $query = $this->link->query("SELECT * FROM livestock ");
        $result = $query->fetchAll();
        return $result;
    }
   
    //add livestock
    function addLivestock($livestockname,$livestockcode){
        $query = $this->link->prepare("INSERT INTO livestock (livestockname,code) VALUES (?,?)");        
        $values = array($livestockname,$livestockcode);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update livestock
    function UpdateLivestock($LivestockName,$LivestockDesc,$LivestockID,$code){
        $query = $this->link->prepare("UPDATE livestock SET livestockname = '$LivestockName',livestockdescription = '$LivestockDesc', code = '$code' WHERE livestockID = '$LivestockID'");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //add member livestock
//    function addMemberLivestock($AddLivestockmemberID,$livestock,$qty){
//        $query = $this->link->prepare("INSERT INTO memberlivestock (memberID,livestockID,qty) VALUES (?,?,?)");        
//        $values = array($AddLivestockmemberID,$livestock,$qty);        
//        $query -> execute($values);        
//        $counts = $query->rowCount();
//        return $counts;        
//    }
    
}