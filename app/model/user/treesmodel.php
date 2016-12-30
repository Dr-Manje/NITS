<?php
include_once ('../../config/config.php');

class treesmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //delete tree planting entry
    function DeleteMemberTP($tpdeleteID){
        $query = $this->link->prepare("DELETE treeplantingitems FROM treeplantingitems WHERE treeplantingitemsid = '$tpdeleteID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    
    //update member crop marketing
    function UpdateMemberTP($tpeditID,$edittreetype,$viewnotrees,$viewtreedetails){
        $query = $this->link->prepare("UPDATE treeplantingitems SET  treetype = '$edittreetype' "
                . ", numberoftrees = '$viewnotrees' , treedetails = '$viewtreedetails' "
                . "  WHERE treeplantingitemsid = '$tpeditID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //list all livestock with selected
    function listTrees(){
        $query = $this->link->query("SELECT * FROM trees ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //check for duplicate IPC code
    function checkDuplicateTrees($code){
        $query = $this->link->query("SELECT COUNT(*) FROM trees WHERE treescode = '$code' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //add crop
    function addTrees($tName,$tCode){
        $query = $this->link->prepare("INSERT INTO trees (treeName,treescode) VALUES (?,?)");        
        $values = array($tName,$tCode);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update crop
    function UpdateTrees($tName,$tCode,$tID){
        $query = $this->link->prepare("UPDATE trees SET treeName = '$tName',treescode = '$tCode' WHERE treesid = '$tID'");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
}