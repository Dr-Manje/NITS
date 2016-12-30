<?php
include_once ('../../config/config.php');

class cropsmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //delete member crop
    function deleteMemberCropMarketing($id){
        $query = $this->link->prepare("DELETE cropmarketing FROM cropmarketing WHERE cropmarketingID = '$id' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //update member crop marketing
    function UpdateMemberCropMarketing($cmeditID,$editcmcrop,$viewreceipt,$viewprice,$viewtotalprice){
        $query = $this->link->prepare("UPDATE cropmarketing SET  cropID = '$editcmcrop' "
                . ", receiptnumber = '$viewreceipt' "
                . ", price = '$viewprice' "
                . ", totalvalue = '$viewtotalprice' "
                . "  WHERE cropmarketingID = '$cmeditID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //list all livestock with selected
    function listCrops(){
        $query = $this->link->query("SELECT * FROM crops ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //check if member crop entry exists
    function CheckifMemberAlreadyHasCrop($member,$crop){
        $query = $this->link->query("select count(*) from membercrops where memberID = '$member' AND cropID = '$crop' LIMIT 1");           
        $result = $query->fetchColumn();       
        return $result;
    }    
    
    //add crop
    function addCrop($cropName,$cropCode){
        $query = $this->link->prepare("INSERT INTO crops (cropname,code) VALUES (?,?)");        
        $values = array($cropName,$cropCode);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update crop
    function UpdateCrop($cropName,$cropCode,$cropDesc,$cropID){
        $query = $this->link->prepare("UPDATE crops SET cropname = '$cropName',code = '$cropCode',cropdescription = '$cropDesc' WHERE cropID = '$cropID'");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //add crop
    function addMemberCrop($AddCropmemberID,$crop,$acreage){
        $query = $this->link->prepare("INSERT INTO membercrops (memberID,cropID,acreage) VALUES (?,?,?)");        
        $values = array($AddCropmemberID,$crop,$acreage);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update member crop
    function UpdateMemberCrop($AddCropmemberID,$crop,$acreage){
        $query = $this->link->prepare("UPDATE membercrops SET acreage = '$acreage' WHERE cropID = '$crop' AND memberID = '$AddCropmemberID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //update member crops 2
    function UpdateMemberCropfull($id,$acreage){
        $query = $this->link->prepare("UPDATE membercrops SET acreage = '$acreage'  WHERE cropinformationID = '$id' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //delete member crop
    function deleteMemberCrop($cropID){
        $query = $this->link->prepare("DELETE membercrops FROM membercrops WHERE cropinformationID = '$cropID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
        
    //CROP MARKETING --------------------------------------------
    //list all crop marketing for the current year
    function listCropMarketingCurrentYear(){
        $query = $this->link->query("SELECT CP.memberID as mID , C.cropname AS crop, CP.receiptnumber AS receipt, CP.price AS price, CP.totalprice AS totalprice, CP.cropmarketingID AS CPID, DATE_FORMAT( RY.regYear, '%Y' ) AS regYear
                                    FROM cropmarketing CP
                                    JOIN crops C ON C.cropID = CP.cropID
                                    JOIN registrationyear RY ON CP.regyearID = RY.regyearID
                                    ORDER BY RY.regYear DESC ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function listCropMarketingDistrictCurrentYear($regYear){
        $query = $this->link->query("SELECT CP.memberID as mID 
                                    , C.fieldname AS crop
                                    , CP.receiptnumber AS receipt
                                    , CP.price AS amount
                                    , CP.totalvalue AS price
                                    , CP.cropmarketingID AS CPID
                                    , CP.membershipStatus as mStatus 
                                    , CP.nonemembername as nonemember
                                    , D.fieldname as district
                                    , D.districtID as dID
                                    FROM cropmarketing CP
                                    JOIN crops C ON C.cropID = CP.cropID
                                    JOIN users U ON U.userID = CP.createdby
                                    JOIN districts D ON D.districtID = U.district
                                    WHERE CP.regYearID = '$regYear' ");
        $result = $query->fetchAll();
        return $result;
    }


    //check if member is registered in that year
    function CheckMemberRegistration($regYear,$member){
        $query = $this->link->query("SELECT COUNT(*) FROM memberyearreg WHERE yearregID = '$regYear' AND memberNumber = '$member' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //get crop marketing info for member
    function getCropMarketingMember($member){
        $query = $this->link->query("SELECT CP.memberID as mID, C.fieldname AS crop, CP.receiptnumber AS receipt, CP.price AS price
                                    , CP.totalvalue AS totalprice, CP.cropmarketingID AS CPID
                                    FROM cropmarketing CP
                                    JOIN crops C ON C.cropID = CP.cropID
                                    JOIN members M ON M.memberID = CP.memberID
                                    WHERE M.memberID = '$member' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get memberID
    function getMemberID($regYear,$member){
        $query = $this->link->query("SELECT memberID FROM memberyearreg WHERE yearregID = '$regYear' AND memberNumber = '$member' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get cropID
    function getCropID($code){
        $query = $this->link->query("SELECT cropID, fieldname "
                                    . "FROM crops WHERE fieldcode = '$code' LIMIT 1");
        $result = $query->fetchAll();
        return $result;
    }
    
    //add crop marketing for member
    function addMemberCropMarketing($member,$cropID,$receipt,$price,$totalPrice,$memberregyear,$createdby){
        $status = 1;
        $query = $this->link->prepare("INSERT INTO cropmarketing (memberID,cropID,receiptnumber,price,totalvalue,membershipStatus,regYearID,createdby) VALUES (?,?,?,?,?,?,?,?)");        
        $values = array($member,$cropID,$receipt,$price,$totalPrice,$status,$memberregyear,$createdby);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //add crop marketing for non-member
    function addNonMemberCropMarketing($crop,$receipt,$price,$totalvalue,$membership,$regYear,$createdby,$nonemembername){
        $query = $this->link->prepare("INSERT INTO cropmarketing (cropID,receiptnumber,price,totalvalue,membershipStatus,regYearID,createdby,nonemembername) VALUES (?,?,?,?,?,?,?,?)");        
        $values = array($crop,$receipt,$price,$totalvalue,$membership,$regYear,$createdby,$nonemembername);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //add crop marketing for non-member
    function addNonMemberCropMarketingFull($crop,$receipt,$price,$totalvalue,$membership,$regYear,$createdby,$memberID){
        $query = $this->link->prepare("INSERT INTO cropmarketing (cropID,receiptnumber,price,totalvalue,membershipStatus,regYearID,createdby,memberID) VALUES (?,?,?,?,?,?,?,?)");        
        $values = array($crop,$receipt,$price,$totalvalue,$membership,$regYear,$createdby,$memberID);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update crop marketing
    function UpdateMemberCPMember($viewcrop,$viewreceipt,$viewprice,$viewtotalvalue,$membership,$viewregyear,$memberID,$viewcpeditid){
        $query = $this->link->prepare("update cropmarketing
                                        set cropID = '$viewcrop'
                                        ,receiptnumber = '$viewreceipt'
                                        ,price = '$viewprice'
                                        ,totalvalue = '$viewtotalvalue'
                                        ,membershipStatus = '$membership'
                                        ,regYearID = '$viewregyear'
                                        ,memberID = '$memberID'
                                        WHERE cropmarketingID = '$viewcpeditid' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    function UpdateMemberCPNoneMember($viewcrop,$viewreceipt,$viewprice,$viewtotalvalue,$membership,$viewregyear,$viewnonemembername,$viewcpeditid){
        $query = $this->link->prepare("update cropmarketing
                                        set cropID = '$viewcrop'
                                        ,receiptnumber = '$viewreceipt'
                                        ,price = '$viewprice'
                                        ,totalprice = '$viewtotalvalue'
                                        ,membershipStatus = '$membership'
                                        ,regYearID = '$viewregyear'
                                        ,nonemembername = '$viewnonemembername'
                                        WHERE cropmarketingID = '$viewcpeditid' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //delete crop marketing
    function deleteCP($cropID){
        $query = $this->link->prepare("DELETE cropmarketing FROM cropmarketing WHERE cropmarketingID = '$cropID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
}