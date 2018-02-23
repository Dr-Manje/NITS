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
    function UpdateMemberSeedDistroAcquisition($acquisitioneditID,$acquisitionamountedit,$donoredit){
        $query = $this->link->prepare("UPDATE seeddistribution SET acquiredseedkgs = '$acquisitionamountedit', donor = '$donoredit'  WHERE seeddistributionID = '$acquisitioneditID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //add single member seed distro 
    function addMemberSeedDistro($member,$seed,$seedkgs,$donor,$season){
        $status = 'UNPAID';
        $query = $this->link->prepare("INSERT INTO seeddistribution (memberID,acquiredseedID,acquiredseedkgs,status,donor,regYearID) VALUES (?,?,?,?,?,?)");        
        $values = array($member,$seed,$seedkgs,$status,$donor,$season);        
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
    function addSingleSeedDistribution($regYear,$memberID,$seedAquired1,$SeedAcquiredAmount1,$donorID){
        $status = 'UNPAID';
        $query = $this->link->prepare("INSERT INTO seeddistribution (regYearID,memberID,acquiredseedID,acquiredseedkgs,status,donor) VALUES (?,?,?,?,?,?)");        
        $values = array($regYear,$memberID,$seedAquired1,$SeedAcquiredAmount1,$status,$donorID);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //add SEED DISTRIBUTION for member with repayment amount SEED
    function addSingleSeedDistributionWithRepayment($regYear,$memberID,$seedAquired1,$SeedAcquiredAmount1,$seedOption1,$amountRepayment,$donorID){
        $status = 'PAID';
        $paymentMode = 'SEED';
        $query = $this->link->prepare("INSERT INTO seeddistribution (regYearID,memberID,acquiredseedID,acquiredseedkgs,repaidseedID,repaidseedkgs,status,repaymentMode,donor) VALUES (?,?,?,?,?,?,?,?,?)");        
        $values = array($regYear,$memberID,$seedAquired1,$SeedAcquiredAmount1,$seedOption1,$amountRepayment,$status,$paymentMode,$donorID);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //add SEED DISTRIBUTION for member with repayment amount CROP
    function addSingleSeedDistributionWithRepaymentCrop($regYear,$memberID,$seedAquired1,$SeedAcquiredAmount1,$cropOption1,$amountRepayment,$donorID){
        $status = 'PAID';
        $paymentMode = 'CROP';
        $query = $this->link->prepare("INSERT INTO seeddistribution (regYearID,memberID,acquiredseedID,acquiredseedkgs,repaidcropID,repaidcropkgs,status,repaymentMode,donor) VALUES (?,?,?,?,?,?,?,?,?)");        
        $values = array($regYear,$memberID,$seedAquired1,$SeedAcquiredAmount1,$cropOption1,$amountRepayment,$status,$paymentMode,$donorID);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //select 
    function lstDistributedSeed($regYear){
        $query = $this->link->query("select distinct acquiredseedID from seeddistribution where regYearID = '$regYear' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getSeedByID($cropID){
        $query = $this->link->query("select fieldname from seeds where seedID = '$cropID' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function getGenderTotals($year,$seed,$gender){
        $query = $this->link->query("select count(distinct M.memberID) as cnt
                                    from seeddistribution SD
                                    join members M on M.memberID = SD.memberID
                                    where SD.regYearID = '$year' 
                                    and SD.acquiredseedID = '$seed'
                                    and M.gender = '$gender' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function getClubTotal($year,$seed){
        $query = $this->link->query("select count(distinct C.clubsID) as cnt1
                                    from seeddistribution SD
                                    join members M on M.memberID = SD.memberID
                                    join clubs C on C.clubsID = M.club
                                    where SD.regYearID = '$year' 
                                    and SD.acquiredseedID = '$seed' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function getAssocSummary($year,$seed){
        $query = $this->link->query("select A.fieldname as namess
                                    from seeddistribution SD
                                    join members M on M.memberID = SD.memberID
                                    join clubs C on C.clubsID = M.club
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    where SD.regYearID = '$year' 
                                    and SD.acquiredseedID = '$seed' limit 1 ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function getSeedTotals($year,$seed){
        $query = $this->link->query("select sum(SD.acquiredseedkgs) as seedgiven, sum(SD.repaidcropkgs) as cropgotten, sum(SD.repaidseedkgs) as seedgotten
                                    from seeddistribution SD
                                    join members M on M.memberID = SD.memberID
                                    where SD.regYearID = '$year' 
                                    and SD.acquiredseedID = '$seed' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getSeedDonor($year,$seed){
        $query = $this->link->query("select D.fieldname as donor
                                    from seeddistribution SD
                                    join members M on M.memberID = SD.memberID
                                    join donors D on D.donorsid = SD.donor
                                    where SD.regYearID = '$year' 
                                    and SD.acquiredseedID = '$seed' limit 1 ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //list seed distribution
    function listSeedDistribution($regYear){
        $query = $this->link->query("SELECT M.memberNumber as memberNumber
                                    , concat(M.names,' ', M.surname) as memberName
                                    , I.fieldname as ipcname
                                    , S.fieldname as seedname
                                    , SD.acquiredseedkgs as acquiredseedkgs
                                    , SD.status as status
                                    , SD.seeddistributionID as SDID
                                    , SD.repaymentMode as repaymentMode
                                    , SD.status as status
                                    , DR.fieldname as donor
                                    FROM seeddistribution SD
                                    JOIN members M ON m.memberID = SD.memberID
                                    JOIN seeds S ON S.seedID = SD.acquiredseedID
                                    join clubs C on M.club = clubsID
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join districts D on D.districtID = A.fieldref
                                    join ipc I on I.IPCid = D.fieldref
                                    join registrationyear RY on RY.regyearID = SD.regYearID
                                    join donors DR on DR.donorsid = SD.donor
                                    where RY.regYearID = '$regYear' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list seed distribution
    function listMemberSeedDistribution($id){
        $query = $this->link->query("SELECT M.names as fname, M.surname as lname, M.memberNumber as memberNumber
                                    , S.fieldname as seedname, DATE_FORMAT(RY.season,'%M %Y') as regYear
                                    , SD.status as status, SD.acquiredseedkgs as acquiredseedkgs
                                    , SD.repaymentMode as repaymentMode, SD.seeddistributionID as SDID
                                    , SD.status as status
                                    , D.fieldname as donor
                                    FROM seeddistribution SD
                                    JOIN members M ON m.memberID = SD.memberID
                                    JOIN seeds S ON S.seedID = SD.acquiredseedID
                                    JOIN registrationyear RY ON RY.regyearID = M.yearRegistered
                                    JOIN donors D on D.donorsid = SD.donor
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