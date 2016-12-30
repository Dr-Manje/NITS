<?php

include_once ('../../config/config.php');

class clubmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //list all activies
    function listClubs($id){
        $query = $this->link->query("SELECT C.fieldname as club, C.fieldcode as clubcode
                                    , G.fieldname as gac, G.fieldcode as gaccode
                                    , A.fieldname as assoc, A.fieldcode as assoccode
                                    , I.fieldname as ipcname, I.fieldcode as ipccode
                                    , DY.districtsregyearID as did   
                                    FROM clubs C
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    join districtsregyear DY ON DY.districtsregyearID = I.fieldref
                                    where DY.regyear = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
   
    //add activity
    function addClub($clubName,$clubDescription,$association){
        $query = $this->link->prepare("INSERT INTO clubs (clubName,clubDescription,association) VALUES (?,?,?)");        
        $values = array($clubName,$clubDescription,$association);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update activity
    function UpdateClub($clubName,$clubDescription,$association,$id){
        $query = $this->link->prepare("UPDATE clubs SET clubName = '$clubName'"
                                        . ",clubDescription = '$clubDescription'"
                                        . ",association = '$association' "
                                        . "WHERE clubsID = '$id'");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
}