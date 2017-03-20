<?php

if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}
        
include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/seedsmodel.php');
include_once ('../../model/user/membersmodel.php');
include_once ('../../model/user/cropsmodel.php');

include_once ('../../model/user/seasonsmodel.php');

$seasons = new seasonsmodel();

$common = new usersmodel();
$dashboard = new dashmodel();
$seeds = new seedsmodel();
$members = new membersmodel();
$crops = new cropsmodel();

$datetime_var = new DateTime();

//list registration year
$listregYear = $dashboard->ListRegYear();

//list seeds
$lstSeeds = $seeds->listSeeds();

//list of members
$lstMembers = $members->listMembers();

//list all crops
$lstcrops = $crops->listCrops();



if(isset($_POST['SearchDistrictReg'])){
    $regYear = $_POST['regyearDS']; //reg year id
    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
    
    $lstSeedDistribution = $seeds->listSeedDistribution($regYear);
    
    $i = 0;
    $lstSeedDistro = array();
    
    foreach($lstSeedDistribution as $value){
        $SDID = $value['SDID']; //SDID
        $memberNumber = $value['memberNumber']; //member number
        $memberName = $value['memberName']; //member name
        $district = $value['district']; //district
        
        $seedname = $value['seedname']; //member name
        $acquiredseedkgs = $value['acquiredseedkgs']; //district
        $repaymode = $value['repaymentMode']; //district
        
        $status = $value['status']; //district
        $donor = $value['donor']; //donor
        
        if($repaymode == 'SEED'){
            //$SDID = $value['SDID'];
            //get seed amount
            $getSeedCropAmount = $seeds->getSeedCropAmount($SDID);
            $rapidKgs = $getSeedCropAmount[0][0];
            $repaymentType = 'SEED';
        }
        
        if($repaymode == 'CROP'){
          //$SDID = $value['SDID'];
            //get crop amount
            $getSeedCropAmount = $seeds->getSeedCropAmount($SDID);
            $rapidKgs = $getSeedCropAmount[0][1];
            $repaymentType = 'CROP';
        }
        
        if($repaymode == NULL){
            $rapidKgs = 0;
            $repaymentType = 'UNPAID';
        }
        
        $action = 'Action ting';
        
        $member = array();
        array_push($member,$memberNumber); //number
        array_push($member,$memberName); //name
        array_push($member,$district); //district
        
        array_push($member,$seedname); //seed acquired
        array_push($member,$acquiredseedkgs); //seed acquired amount
        
        array_push($member,$repaymentType); //seed acquired amount
        array_push($member,$rapidKgs); //seed acquired amount
        array_push($member,$status); //seed acquired amount
        
        array_push($member,$donor); //seed acquired amount
        
        array_push($lstSeedDistro,$member);
        
        $i++;
    }
    
    //summary
    //get seeds distributed
    $lstSeed = $seeds->lstDistributedSeed($regYear);
    $lstSummary = array();
//    
    foreach($lstSeed as $values){
        $member = array();
        $id = $values['acquiredseedID'];
        
        $crop = $seeds->getSeedByID($id);
        $female = $seeds->getGenderTotals($regYear,$id,'FEMALE');
        $male = $seeds->getGenderTotals($regYear,$id,'MALE');
        
        $getSeedTotals = $seeds->getSeedTotals($regYear,$id);
        $seeddistributed = $getSeedTotals[0][0];
        $seedrecovered = $getSeedTotals[0][1] + $getSeedTotals[0][2];

        $donor = $seeds->getSeedDonor($regYear,$id);
        $clubs = $seeds->getClubTotal($regYear,$id);
        
        $association = $seeds->getAssocSummary($regYear,$id);
        
        array_push($member,$crop); //crop
        array_push($member,$association); //association
        array_push($member,$clubs); //total clubs received
        array_push($member,$male); //male
        array_push($member,$female); //female
        array_push($member,$seeddistributed); //seeddistributed
        array_push($member,$seedrecovered); //seedrecovered
        array_push($member,$donor); //donor
        
        array_push($lstSummary,$member);
    }
    
}else{ //list seed distribution for current year
    $regYear = $_SESSION['nasfam_regyearID']; //reg year id
    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
    
    $lstSeedDistribution = $seeds->listSeedDistribution($regYear);
    
    $i = 0;
    $lstSeedDistro = array();
    
    foreach($lstSeedDistribution as $value){
        $SDID = $value['SDID']; //SDID
        $memberNumber = $value['memberNumber']; //member number
        $memberName = $value['memberName']; //member name
        $district = $value['district']; //district
        
        $seedname = $value['seedname']; //member name
        $acquiredseedkgs = $value['acquiredseedkgs']; //district
        $repaymode = $value['repaymentMode']; //district
        
        $status = $value['status']; //district
        $donor = $value['donor']; //donor
        
        if($repaymode == 'SEED'){
            //$SDID = $value['SDID'];
            //get seed amount
            $getSeedCropAmount = $seeds->getSeedCropAmount($SDID);
            $rapidKgs = $getSeedCropAmount[0][0];
            $repaymentType = 'SEED';
        }
        
        if($repaymode == 'CROP'){
          //$SDID = $value['SDID'];
            //get crop amount
            $getSeedCropAmount = $seeds->getSeedCropAmount($SDID);
            $rapidKgs = $getSeedCropAmount[0][1];
            $repaymentType = 'CROP';
        }
        
        if($repaymode == NULL){
            $rapidKgs = 0;
            $repaymentType = 'UNPAID';
        }
        
        $action = 'Action ting';
        
        $member = array();
        array_push($member,$memberNumber); //number
        array_push($member,$memberName); //name
        array_push($member,$district); //district
        
        array_push($member,$seedname); //seed acquired
        array_push($member,$acquiredseedkgs); //seed acquired amount
        
        array_push($member,$repaymentType); //seed acquired amount
        array_push($member,$rapidKgs); //seed acquired amount
        array_push($member,$status); //seed acquired amount
        
        array_push($member,$donor); //seed acquired amount
        
        array_push($lstSeedDistro,$member);
        
        $i++;
    }
    
    //summary
    //get seeds distributed
    $lstSeed = $seeds->lstDistributedSeed($regYear);
    $lstSummary = array();
//    
    foreach($lstSeed as $values){
        $member = array();
        $id = $values['acquiredseedID'];
        
        $crop = $seeds->getSeedByID($id);
        $female = $seeds->getGenderTotals($regYear,$id,'FEMALE');
        $male = $seeds->getGenderTotals($regYear,$id,'MALE');
        
        $getSeedTotals = $seeds->getSeedTotals($regYear,$id);
        $seeddistributed = $getSeedTotals[0][0];
        $seedrecovered = $getSeedTotals[0][1] + $getSeedTotals[0][2];

        $donor = $seeds->getSeedDonor($regYear,$id);
        $clubs = $seeds->getClubTotal($regYear,$id);
        
        $association = $seeds->getAssocSummary($regYear,$id);
        
        array_push($member,$crop); //crop
        array_push($member,$association); //association
        array_push($member,$clubs); //total clubs received
        array_push($member,$male); //male
        array_push($member,$female); //female
        array_push($member,$seeddistributed); //seeddistributed
        array_push($member,$seedrecovered); //seedrecovered
        array_push($member,$donor); //donor
        
        array_push($lstSummary,$member);
    }
}

//add seed distribution bulk
if(isset($_POST['addSDBulk'])){
    $fname = $_FILES['seeddistributionFile']['name'];
    $regYear = $_POST['regyearBulk'];
    
    $chk_ext = explode(".", $fname);
    
    if(strtolower(end($chk_ext)) == "csv")
    {        
        $filename = $_FILES['seeddistributionFile']['tmp_name'];
        $handle = fopen($filename, "r");
        
        fgetcsv($handle, 1000, ","); //abandon the first record 
        while(($data = fgetcsv($handle, 1000, ",")) !== false)
        {        
            //check if member or non member
            $memberNumber = $data[0];
            $seedCode = $data[1];
            $acquiredseedamount1 = $data[2];
            //check amount of seed
            if($acquiredseedamount1 > 200){
                $acquiredseedamount = 200;
            }else{
                $acquiredseedamount = $acquiredseedamount1;
            }
            
            $repayment = $data[3];
            $repaidseedcode = $data[4];
            $repaidseedamount1 = $data[5];
            
            //check amount of seed
            if($repaidseedamount1 > 200){
                $repaidseedamount = 200;
            }else{
                $repaidseedamount = $repaidseedamount1;
            }
            
            $repaidcropcode = $data[6];
            $repaidcropamount1 = $data[7];
            
            //check amount of seed
            if($repaidcropamount1 > 200){
                $repaidcropamount = 200;
            }else{
                $repaidcropamount = $repaidcropamount1;
            }
            
            //get donor id
            $donor = $data[8];
            $getDonorDetails = $seasons->getDonorDetails($donor);
            $donorID = $getDonorDetails[0][0];
            
            $checkMemberExistence = $members->MemberExists($memberNumber);
            $CheckMembership = $checkMemberExistence[0][6];
            //echo $CheckMembership;
            if($CheckMembership == NULL){
                //none member
            }else{
                //get member details
                //check if member was registered in the selected year
                $CheckMemberRegistration = $crops->CheckMemberRegistration($regYear,$memberNumber);
                if($CheckMemberRegistration == 1){
                    //get member id where reg year and member number           
                    $getMemberID = $crops->getMemberID($regYear,$memberNumber);
                    $memberID = $getMemberID[0][0];
                    
                    //GET SEED CODE FOR 
                    $getSeedCode = $seeds->getSeedID($seedCode);
                    $acquiredseedID = $getSeedCode[0][0];

                    //check repayment type
                    switch ($repayment) {
                        case "none":
                            echo 'No repayment<br>'; 
                            //GET SEED CODE
                            $addSingleSeedDistribution = $seeds->addSingleSeedDistribution($regYear,$memberID,$acquiredseedID,$acquiredseedamount,$donorID);   
                            break;
                        case "seed":
                            echo 'seed repayment<br>';
                            $getSeedCode = $seeds->getSeedID($repaidseedcode);
                            $seedID2 = $getSeedCode[0][0];
                            echo 'Seed ID: '.$seedID2.'<br>';
                            $addSingleSeedDistribution = $seeds->addSingleSeedDistributionWithRepayment($regYear,$memberID,$acquiredseedID,$acquiredseedamount,$seedID2,$repaidseedamount,$donorID);
                            break;
                        case "crop":
                            echo 'crop repayment<br>';
                            $getCropID = $crops->getCropID($repaidcropcode);
                            $cropID = $getCropID[0][0];
                            echo 'Crop ID: '.$cropID.'<br>';
                            $addSingleSeedDistribution = $seeds->addSingleSeedDistributionWithRepaymentCrop($regYear,$memberID,$acquiredseedID,$acquiredseedamount,$cropID,$repaidcropamount,$donorID);
                            break;
                        default:
                            echo "charge is neither processing fee or disturbance fee!";
                    }
                }else{
                    echo '<br>member is not registered in that year';
                }
            }
        }
        fclose($handle);
        header("Location: seeddistribution.php");
    }
    else
    {
        echo 'Invalid file';
    }
}