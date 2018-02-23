<?php
//session_start();
if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}

include_once ('../../model/user/treesmodel.php');
include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/user/activitiesmodel.php');
include_once ('../../model/user/membersmodel.php');

$common = new usersmodel();
$trees = new treesmodel();
$dashboard = new dashmodel();
$activities = new activitiesmodel();
$members = new membersmodel();

$listregYear = $dashboard->ListRegYear(); //list registration year
$listTrees = $trees->listTrees(); //list trees

// TREE PLANTING DISTRICT /////////////////////////////////////////////////////////////////
//list
if(isset($_POST['SearchTPD'])){
    $userDistrict = $_SESSION['nasfam_userid'];
    $getUserDistrict = $common->getUserDistrict($userDistrict);
    $district = $getUserDistrict[0][1];
    $regYear = $_POST['regyearTPD'];
    
    $listTPD = $activities->getTPDList($regYear);
    
    $i = 0;
    $lstTreeplanting = array();
    foreach($listTPD as $value){
        $memberID = $value['mid']; //member id
        $memberNumber = $value['mnum']; //member number
        $memberName = $value['membername']; //member name
        $district = $value['ipcname']; //district
        $maid = $value['actID']; //actID
        
        //get number of trees planted
        $TotalTreesPlantedMember = $activities->TotalTreesPlantedMember($maid);
        $getagro = $TotalTreesPlantedMember[0][0]; //agro
        $getindi = $TotalTreesPlantedMember[0][1]; //indi
        $getexo = $TotalTreesPlantedMember[0][2]; //exo
        $getfruit = $TotalTreesPlantedMember[0][3]; //fruit
        
        if($getagro == NULL){
           $agro = 0; 
        }else{
          $agro = $TotalTreesPlantedMember[0][0]; //agro  
        }
        
        if($getindi == NULL){
           $indi = 0; 
        }else{
          $indi = $TotalTreesPlantedMember[0][1]; //indi  
        }
        
        if($getexo == NULL){
           $exo = 0; 
        }else{
          $exo = $TotalTreesPlantedMember[0][2]; //exo 
        }
        
        if($getfruit == NULL){
           $fruit = 0; 
        }else{
          $fruit = $TotalTreesPlantedMember[0][3]; //fruit 
        }
        
        $total = $agro + $exo + $fruit + $indi;
        
        $member = array();
        array_push($member,$memberNumber); //number
        array_push($member,$memberName); //name
        array_push($member,$district); //district
        
        array_push($member,$agro); //agro        
        array_push($member,$exo); //exotic
        array_push($member,$fruit); //fruit
        array_push($member,$indi); //indi
        
        array_push($member,$total); //total
        
        array_push($lstTreeplanting,$member); //1
        
        $i++;
    }
    
    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
    
}else{ //default display
    //get user district
    //$userDistrict = $_SESSION['nasfam_userid'];
    //$getUserDistrict = $common->getUserDistrict($userDistrict);
    //$district = $getUserDistrict[0][1];
    
    $regYear = $_SESSION['nasfam_regyearID'];
   
    $listTPD = $activities->getTPDList($regYear);
    
    $i = 0;
    $lstTreeplanting = array();
    foreach($listTPD as $value){
        $memberID = $value['mid']; //member id
        $memberNumber = $value['mnum']; //member number
        $memberName = $value['membername']; //member name
        $district = $value['ipcname']; //district
        $maid = $value['actID']; //actID
        
        //get number of trees planted
       // $getagro = $activities->TotalTreesPlantedMember($maid,$treetype);
        $getagro = $activities->TotalTreesPlantedMember($maid,1); //agro
        $getindi = $activities->TotalTreesPlantedMember($maid,2); //indi
        $getexo = $activities->TotalTreesPlantedMember($maid,3); //exo
        $getfruit = $activities->TotalTreesPlantedMember($maid,4); //fruit
        
        if($getagro == NULL){
           $agro = 0; 
        }else{
          $agro = $getagro; //agro  
        }
        
        if($getindi == NULL){
           $indi = 0; 
        }else{
          $indi = $getindi; //indi  
        }
        
        if($getexo == NULL){
           $exo = 0; 
        }else{
          $exo = $getexo; //exo 
        }
        
        if($getfruit == NULL){
           $fruit = 0; 
        }else{
          $fruit = $getfruit; //fruit 
        }
        
        $total = $agro + $exo + $fruit + $indi;
        
        $member = array();
        array_push($member,$memberNumber); //number
        array_push($member,$memberName); //name
        array_push($member,$district); //district
        
        array_push($member,$agro); //agro        
        array_push($member,$exo); //exotic
        array_push($member,$fruit); //fruit
        array_push($member,$indi); //indi
        
        array_push($member,$total); //total
        
        array_push($lstTreeplanting,$member); //1
        
        $i++;
    }

    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
}

if(isset($_POST['UploadTP'])){
    $fname = $_FILES['file']['name']; //file upload
    $regYear = $_POST['regyearBulk']; //year registered
    
    $chk_ext = explode(".", $fname);
    if(strtolower(end($chk_ext)) == "csv")
    {
        $filename = $_FILES['file']['tmp_name'];
        $handle = fopen($filename, "r");
        
        fgetcsv($handle, 1000, ","); //abandon the first record 
        while(($data = fgetcsv($handle, 1000, ",")) !== false)
        { 
            $memberno = $data[0]; //member number
            $treecode = $data[1]; // tree code
            $nooftrees = $data[2]; // no of trees
            
            //get member id with membernumber and regyear
            $getMemberDetails = $members->FetchMemberDetailsMemberNumberYear($memberno,$regYear);
            $memberID = $getMemberDetails[0][0]; //member id
            
            $activityID = 23;
            
            //get tree ID
            $getTreeCode = $activities->getTreeDetails($treecode);
            $tree = $getTreeCode[0][0];
            
            //check if member has been added to tree planting activity
            $CheckifMemberAlreadyHasActivity = $activities->CheckifMemberAlreadyHasActivity($memberID,$activityID);
            if($CheckifMemberAlreadyHasActivity == 1){ //if he/she has been added, proceed to add tree items

                //get tree planting activities ID
                $getTPID = $activities->getTPID($memberID,$activityID);
                $memberactivityID = $getTPID[0][0];
            
                //check if tree item already exists
                $checkTrees = $activities->checktreeActivities($memberactivityID,$tree);
                
                if($checkTrees == 0){
                    echo 'no duplicates found <br>';
                    $AddTreePlantingItemsForMember = $activities->AddTreePlantingItemsForMember($memberactivityID,$tree,$nooftrees);
                }else{
                    echo 'duplicates found <br>';
                    //get number of trees planted
                    $getnotreeActivities = $activities->getnotreeActivities($memberactivityID,$tree);
                    $currenttrees = $getnotreeActivities[0][3];
                    $nooftreesnew = $currenttrees + $nooftrees;
                    $AddTreePlantingItemsForMember = $activities->UpdateTreePlantingItemsForMember($memberactivityID,$tree,$nooftreesnew);
                }
                
            }else{ //if not added, add to activities table
                $AddTreePlantingForMember = $activities->AddTreePlantingForMember($memberID,$activityID); //add member to tree planting

                $getTPID = $activities->getTPID($memberID,$activityID); //get tree planting activities ID
                $memberactivityID = $getTPID[0][0];

                $AddTreePlantingItemsForMember = $activities->AddTreePlantingItemsForMember($memberactivityID,$tree,$nooftrees);
            }  
        }
        fclose($handle);
        header("Location: treeplantingDistrict.php ");
    }else
    {
        echo 'Invalid file';
    }
}

//update
//remove