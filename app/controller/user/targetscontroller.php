<?php

if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}
        
include_once ('../../model/user/targetsmodel.php');
include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/common/commonmodel.php');


$targets = new targetsmodel();
$dashboard = new dashmodel();
$common = new usersmodel();

$listregYear = $dashboard->ListAllRegYear();
//echo 'reg year id: '.$_SESSION['nasfam_regyearID'];
//allow user to select reg year to display
if(isset($_POST['regYear'])){
   //show details of registration year that user has requested 
}



//get targets for year  -------------------------------------
if(isset($_POST['SearchTargets'])){
    $regyear = $_POST['regyearDS'];
    
    //$regyearID = $_SESSION['regyearDS']; //reg year id for updating targets   
    
    $getRegYearDetails = $common->getRegYearDetails($regyear);
    $regYearName = $getRegYearDetails[0][1];
    
    
    //MemberTargetsModal
//    $GetTotalMemberTargets = $targets->TotalMemberTargets($regyear);
//    $TotalMembersTarget = $GetTotalMemberTargets[0][0];

    //DistrictsTargetsModal
    $lstDistrictsTargets = $targets->TotalDistrictsTargets($regyear);

    //TrainingTargetsModal
    $type1 = 1;
    $lstTrainingTargets = $targets->GetActivityTargets($regyear,$type1);

    //CDPTargetsModal
    $type2 = 2;
    $lstCDPTargets = $targets->GetActivityTargets($regyear,$type2);

    //PolicyTargetsModal
    $type3 = 3;
    $lstPolicyTargets = $targets->GetActivityTargets($regyear,$type3);

    //FarmTargetsModal
    $type4 = 4;
    $lstFarmTargets = $targets->GetActivityTargets($regyear,$type4);
}else{
    $regyear = $_SESSION['nasfam_regyearID'];
    
    //$regyearID = $_SESSION['nasfam_regyearID']; //reg year id for updating targets 
    
    $getRegYearDetails = $common->getRegYearDetails($regyear);
    $regYearName = $getRegYearDetails[0][1];
    
    //MemberTargetsModal
//    $GetTotalMemberTargets = $targets->TotalMemberTargets($regyear);
//    $TotalMembersTarget = $GetTotalMemberTargets[0][0];

    //DistrictsTargetsModal
    $lstDistrictsTargets = $targets->TotalDistrictsTargets($regyear);

    //TrainingTargetsModal
    $type1 = 1;
    $lstTrainingTargets = $targets->GetActivityTargets($regyear,$type1);

    //CDPTargetsModal
    $type2 = 2;
    $lstCDPTargets = $targets->GetActivityTargets($regyear,$type2);

    //PolicyTargetsModal
    $type3 = 3;
    $lstPolicyTargets = $targets->GetActivityTargets($regyear,$type3);

    //FarmTargetsModal
    $type4 = 4;
    $lstFarmTargets = $targets->GetActivityTargets($regyear,$type4);

}



//  update targets --------------------------------------------------

//update district targets
if(isset($_POST['UpdateDistrictTargets'])){
    $regyear1 = $_POST['regyear'];
    //echo '<br> reg year: '.$regyear1;
    $rowCount = count($_POST['districts']);
    echo 'reg year: '.$regyear1.'<br>';
    
    echo 'Number of items selected: '.$rowCount.'<br>';
    foreach($_POST['districts'] as $id){
        $districtID = $_POST['targetID'][$id];
        $target = $_POST['districttarget'][$id];
        $targetItem  = $_POST['targetItem'][$id];
        
       echo 'District ID: '.$districtID.' Target Item: '.$targetItem.' Target Amount: '.$target.'<hr>';
       //update district targets
       $UpdateDistrictTargets = $targets->UpdateDistrictTargets($target,$districtID);
    }
    header("Location: targets.php");
}

//update activity targets
if(isset($_POST['updateactivitytarget'])){
    echo 'update activity target<br>'; 
    $rowCount = count($_POST['districts']);
    
    foreach($_POST['districts'] as $id){
        $districtID = $_POST['targetID'][$id];
        $target = $_POST['districttarget'][$id];
        $targetItem  = $_POST['targetItem'][$id];
        
        echo 'Target ID: '.$districtID.' Target Item: '.$targetItem.' Target Amount: '.$target.'<hr>';
        $UpdateActivityTargets = $targets->UpdateActivityTargets($target,$districtID); //update activity targets for that category
    }
    header("Location: targets.php");
}

//TrainingTargetsModal
if(isset($_POST['UpdateTrainingTargets'])){
    $regyear2 = $_POST['regyear'];
    $FBTTarget = $_POST['FBTTarget'];
    $LTTarget = $_POST['LTTarget'];
    $ALTarget = $_POST['ALTarget'];
    
    $item1 = 'Farming Business Training'; $item2 = 'Leadership Training'; $item3 = 'Adult Literacy';
    
    $update12Targets = $targets->UpdateTargets($regyear2, $FBTTarget, $item1);//RUMPHI
    $update13Targets = $targets->UpdateTargets($regyear2, $LTTarget, $item2);//SOUTH MZIMBA
    $update14Targets = $targets->UpdateTargets($regyear2, $ALTarget, $item3);//Adult Literacy
    
    header("Location: targets.php");
}

//CDPTargetsModal
if(isset($_POST['UpdateCDPTargets'])){
    $regyear3 = $_POST['regyear'];
    $CDP1Target = $_POST['CDP1Target'];
    $CDP2Target = $_POST['CDP2Target'];
    $CDP3Target = $_POST['CDP3Target'];
    $CDP4Target = $_POST['CDP4Target'];
    $CDP5Target = $_POST['CDP5Target'];
    $CDP6Target = $_POST['CDP6Target'];
    $CDP7Target = $_POST['CDP7Target'];
    $CDP8Target = $_POST['CDP8Target'];
    $CDP9Target = $_POST['CDP9Target'];
    
    $item1 = 'Soya Utilization Training'; $item2 = 'Food Preservation & Preparation Training'; $item3 = 'Nutrition Training';
    $item4 = 'Leadership Roles'; $item5 = 'Gender & HIV/AIDS programs'; $item6 = 'Cookstove making Training';
    $item7 = 'Occupational Safety & Health Training'; $item8 = 'Child Labour Training'; $item9 = 'Field & Life Skills Training';
    
    $update1Targets = $targets->UpdateTargets($regyear3, $CDP1Target, $item1);//RUMPHI
    $update2Targets = $targets->UpdateTargets($regyear3, $CDP2Target, $item2);//SOUTH MZIMBA
    $update3Targets = $targets->UpdateTargets($regyear3, $CDP3Target, $item3);//Adult Literacy
    $update4Targets = $targets->UpdateTargets($regyear3, $CDP4Target, $item4);//RUMPHI
    $update5Targets = $targets->UpdateTargets($regyear3, $CDP5Target, $item5);//SOUTH MZIMBA
    $update6Targets = $targets->UpdateTargets($regyear3, $CDP6Target, $item6);//Adult Literacy
    $update7Targets = $targets->UpdateTargets($regyear3, $CDP7Target, $item7);//RUMPHI
    $update8Targets = $targets->UpdateTargets($regyear3, $CDP8Target, $item8);//SOUTH MZIMBA
    $update9Targets = $targets->UpdateTargets($regyear3, $CDP9Target, $item9);//Adult Literacy
    
    header("Location: targets.php");
}

//PolicyTargetsModal
if(isset($_POST['UpdatePolicyTargets'])){
    $regyear4 = $_POST['regyear'];
    $Policy1Target = $_POST['Policy1Target'];
    $Policy2Target = $_POST['Policy2Target'];
    $Policy3Target = $_POST['Policy3Target'];
    
    $item1 = 'Participate in Policy Dialogue Meetings'; $item2 = 'Participate in Extension Advocacy'; $item3 = 'Participate in CA Advocacy Campaigns';
    
    $update1Targets = $targets->UpdateTargets($regyear4, $Policy1Target, $item1);//RUMPHI
    $update2Targets = $targets->UpdateTargets($regyear4, $Policy2Target, $item2);//SOUTH MZIMBA
    $update3Targets = $targets->UpdateTargets($regyear4, $Policy3Target, $item3);//Adult Literacy
    
    header("Location: targets.php");
}

//FarmTargetsModal
if(isset($_POST['UpdateFarmTargets'])){
    $regyear5 = $_POST['regyear'];
    $Farm1Target = $_POST['Farm1Target'];
    $Farm2Target = $_POST['Farm2Target'];
    $Farm3Target = $_POST['Farm3Target'];
    $Farm4Target = $_POST['Farm4Target'];
    $Farm5Target = $_POST['Farm5Target'];
    $Farm6Target = $_POST['Farm6Target'];
    $Farm7Target = $_POST['Farm7Target'];
    $Farm8Target = $_POST['Farm8Target'];
    $Farm9Target = $_POST['Farm9Target'];
    
    $item1 = 'CSA Participant'; $item2 = 'Attended Field Day'; $item3 = 'AFO training';
    $item4 = 'FT training'; $item5 = 'Goat beneficiary'; $item6 = 'Winter cropping/ Irrigation farming';
    $item7 = 'Utilising Chitetezo Mbaula'; $item8 = 'Tree Planting'; $item9 = 'No of trees planted';
    
    $update1Targets = $targets->UpdateTargets($regyear5, $Farm1Target, $item1);//RUMPHI
    $update2Targets = $targets->UpdateTargets($regyear5, $Farm2Target, $item2);//SOUTH MZIMBA
    $update3Targets = $targets->UpdateTargets($regyear5, $Farm3Target, $item3);//Adult Literacy
    $update4Targets = $targets->UpdateTargets($regyear5, $Farm4Target, $item4);//RUMPHI
    $update5Targets = $targets->UpdateTargets($regyear5, $Farm5Target, $item5);//SOUTH MZIMBA
    $update6Targets = $targets->UpdateTargets($regyear5, $Farm6Target, $item6);//Adult Literacy
    $update7Targets = $targets->UpdateTargets($regyear5, $Farm7Target, $item7);//RUMPHI
    $update8Targets = $targets->UpdateTargets($regyear5, $Farm8Target, $item8);//SOUTH MZIMBA
    $update9Targets = $targets->UpdateTargets($regyear5, $Farm9Target, $item9);//Adult Literacy
    
    header("Location: targets.php");
}


//add single
if(isset($_POST['addTPDSingle1212'])){
    $regYear = $_POST['regyear']; //Get Reg Year
    
    $rowCount = count($_POST['members']);
    for($i=0;$i<$rowCount;$i++){
        $membernumber = $_POST['membernumber'][$i]; //membernumber[]
        $tree = $_POST['tree'][$i]; //tree[]
        $nooftrees = $_POST['nooftrees'][$i]; //nooftrees[]
        
        //get member id with membernumber and regyear
        $getMemberDetails = $members->FetchMemberDetailsMemberNumberYear($membernumber,$regYear);
        $memberID = $getMemberDetails[0][0];
        
        $activityID = 23;
        //check if member has been added to tree planting activity
        $CheckifMemberAlreadyHasActivity = $activities->CheckifMemberAlreadyHasActivity($memberID,$activityID);
        if($CheckifMemberAlreadyHasActivity == 1){ //if he/she has been added, proceed to add tree items

            //get tree planting activities ID
            $getTPID = $activities->getTPID($memberID,$activityID);
            $memberactivityID = $getTPID[0][0];
            
            $AddTreePlantingItemsForMember = $activities->AddTreePlantingItemsForMember($memberactivityID,$tree,$nooftrees);            
        }else{ //if not added, add to activities table
            $AddTreePlantingForMember = $activities->AddTreePlantingForMember($memberID,$activityID); //add member to tree planting
                       
            $getTPID = $activities->getTPID($memberID,$activityID); //get tree planting activities ID
            $memberactivityID = $getTPID[0][0];
            
            $AddTreePlantingItemsForMember = $activities->AddTreePlantingItemsForMember($memberactivityID,$tree,$nooftrees);
        }
    }
    header("Location: treeplantingDistrict.php");
}