<?php
include_once ('../../config/config.php');

class seedsmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //delete member distro
    function deleteMemberDistroRecord($id){
        $query = $this->link->prepare("DELETE seeddistribution FROM seeddistribution WHERE seeddistributionID = '$id' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    
    //make distro payment crop type
    function MemberDistroPaymentCrop($repaymentID,$payid,$repaymentquantity){
        $query = $this->link->prepare("UPDATE seeddistribution SET repaidcropID = '$payid'  "
                . ", repaidcropkgs = '$repaymentquantity' "
                . ", repaymentMode = 'CROP' "
                . ", status = 'PAID' "
                . "WHERE seeddistributionID = '$repaymentID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //make distro payment seed type
    function MemberDistroPaymentSeed($repaymentID,$payid,$repaymentquantity){
        $query = $this->link->prepare("UPDATE seeddistribution SET repaidseedID = '$payid'  "
                . ", repaidseedkgs = '$repaymentquantity' "
                . ", repaymentMode = 'SEED' "
                . ", status = 'PAID' "
                . "WHERE seeddistributionID = '$repaymentID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //update seed distro acquisition
    function UpdateMemberSeedDistroAcquisition($acquisitioneditID,$acquisitionamountedit){
        $query = $this->link->prepare("UPDATE seeddistribution SET acquiredseedkgs = '$acquisitionamountedit'  WHERE seeddistributionID = '$acquisitioneditID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //add single member seed distro 
    function addMemberSeedDistro($member,$seed,$seedkgs){
        $status = 'UNPAID';
        $query = $this->link->prepare("INSERT INTO seeddistribution (memberID,acquiredseedID,acquiredseedkgs,status) VALUES (?,?,?,?)");        
        $values = array($member,$seed,$seedkgs,$status);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    
    //list all seeds with selected
    function listSeeds(){
        $query = $this->link->query("SELECT * FROM seeds ");
        $result = $query->fetchAll();
        return $result;
    }
   
    //add seed
    function addSeed($seedName,$seedcode){
        $query = $this->link->prepare("INSERT INTO seeds (seedname,code) VALUES (?,?)");        
        $values = array($seedName,$seedcode);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update seed
    function UpdateSeed($seedname,$seeddesc,$seedID,$seedcode1){
        $query = $this->link->prepare("UPDATE seeds SET seedname = '$seedname',seeddescription = '$seeddesc', code = '$seedcode1' WHERE seedID = '$seedID'");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //SEED DISTRIBUTION --------------------------------------------
    //add SEED DISTRIBUTION for member
    function addSingleSeedDistribution($memberID,$seedAquired1,$SeedAcquiredAmount1){
        $status = 'UNPAID';
        $query = $this->link->prepare("INSERT INTO seeddistribution (memberID,acquiredseedID,acquiredseedkgs,status) VALUES (?,?,?,?)");        
        $values = array($memberID,$seedAquired1,$SeedAcquiredAmount1,$status);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //add SEED DISTRIBUTION for member with repayment amount SEED
    function addSingleSeedDistributionWithRepayment($regYear,$memberID,$seedAquired1,$SeedAcquiredAmount1,$seedOption1,$amountRepayment){
        $status = 'PAID';
        $paymentMode = 'SEED';
        $query = $this->link->prepare("INSERT INTO seeddistribution (regYearID,memberID,acquiredseedID,acquiredseedkgs,repaidseedID,repaidseedkgs,status,repaymentMode) VALUES (?,?,?,?,?,?,?,?)");        
        $values = array($regYear,$memberID,$seedAquired1,$SeedAcquiredAmount1,$seedOption1,$amountRepayment,$status,$paymentMode);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //add SEED DISTRIBUTION for member with repayment amount CROP
    function addSingleSeedDistributionWithRepaymentCrop($regYear,$memberID,$seedAquired1,$SeedAcquiredAmount1,$cropOption1,$amountRepayment){
        $status = 'PAID';
        $paymentMode = 'CROP';
        $query = $this->link->prepare("INSERT INTO seeddistribution (regYearID,memberID,acquiredseedID,acquiredseedkgs,repaidcropID,repaidcropkgs,status,repaymentMode) VALUES (?,?,?,?,?,?,?,?)");        
        $values = array($regYear,$memberID,$seedAquired1,$SeedAcquiredAmount1,$cropOption1,$amountRepayment,$status,$paymentMode);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //list seed distribution
    function listSeedDistribution($regYear){
        $query = $this->link->query("SELECT M.memberNumber as memberNumber
                                    , concat(M.names,' ', M.surname) as memberName
                                    , D.fieldname as district
                                    , S.fieldname as seedname
                                    , SD.acquiredseedkgs as acquiredseedkgs
                                    , SD.status as status
                                    , SD.seeddistributionID as SDID
                                    , SD.repaymentMode as repaymentMode
                                    , SD.status as status
                                    FROM seeddistribution SD
                                    JOIN members M ON m.memberID = SD.memberID
                                    JOIN seeds S ON S.seedID = SD.acquiredseedID
                                    join clubs C on M.club = clubsID
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    join districtsregyear DY on DY.districtsregyearID = I.fieldref
                                    join districts D on D.districtID = DY.district
                                    join registrationyear RY on RY.regyearID = DY.regyear
                                    where RY.regYearID = '$regYear' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list seed distribution
    function listMemberSeedDistribution($id){
        $query = $this->link->query("SELECT M.names as fname, M.surname as lname, M.memberNumber as memberNumber
                                    , S.fieldname as seedname, DATE_FORMAT(RY.regYear,'%M %Y') as regYear
                                    , SD.status as status, SD.acquiredseedkgs as acquiredseedkgs
                                    , SD.repaymentMode as repaymentMode, SD.seeddistributionID as SDID
                                    , SD.status as status
                                    FROM seeddistribution SD
                                    JOIN members M ON m.memberID = SD.memberID
                                    JOIN seeds S ON S.seedID = SD.acquiredseedID
                                    JOIN registrationyear RY ON RY.regyearID = M.yearRegistered
                                    WHERE M.memberID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get seed amount seed distribution
    function getSeedCropAmount($SDID){
        $query = $this->link->query("SELECT repaidseedkgs, repaidcropkgs
                                    FROM seeddistribution WHERE seeddistributionID = '$SDID' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get seedID
    function getSeedID($code){
        $query = $this->link->query("SELECT seedID "
                                    . "FROM seeds WHERE fieldcode = '$code' LIMIT 1");
        $result = $query->fetchAll();
        return $result;
    }
    
}