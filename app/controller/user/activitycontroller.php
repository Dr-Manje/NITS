<?php

//session_start();
if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}
        
include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/activitiesmodel.php');
include_once ('../../model/user/cropsmodel.php');
include_once ('../../model/user/membersmodel.php');
include_once ('../../model/user/treesmodel.php');
include_once ('../../model/user/targetsmodel.php');

$common = new usersmodel();
$dashboard = new dashmodel();
$activities = new activitiesmodel();
$crops = new cropsmodel();
$members = new membersmodel();
$trees = new treesmodel();
$targets = new targetsmodel();

$listTrees = $trees->listTrees(); //list trees

$datetime_var = new DateTime();

//list registration year
$listregYear = $dashboard->ListRegYear();

if(isset($_POST['SearchDistrictReg'])){
    $regYear = $_POST['regyearDS'];
    
    $lstMemberActivities = $activities->selectAllMembersRegYear($regYear);
        
        $i = 0;
        $lstMembers = array();
        foreach($lstMemberActivities as $value){
            $memberID = $value['mid']; //memberid
            $ipcName = $value['ipcname']; //ipc
            $gacName = $value['gacname']; //gac
            $clubName = $value['clubname']; //clubname
            $memberName = $value['membername']; //membername
            $gender = $value['gender']; //gender
            
            //Get member activities attendance data
            //Training Activities
            $checkActivity1 = $activities->checkMemberParticipation($memberID,1); //activity 1
            $checkActivity2 = $activities->checkMemberParticipation($memberID,2); //activity 1
            $checkActivity3 = $activities->checkMemberParticipation($memberID,3); //activity 1
            
            //community training activities
            $checkActivity4 = $activities->checkMemberParticipation($memberID,4); //activity 1
            $checkActivity5 = $activities->checkMemberParticipation($memberID,5); //activity 1
            $checkActivity6 = $activities->checkMemberParticipation($memberID,6); //activity 1
            $checkActivity7 = $activities->checkMemberParticipation($memberID,7); //activity 1
            $checkActivity8 = $activities->checkMemberParticipation($memberID,8); //activity 1
            $checkActivity9 = $activities->checkMemberParticipation($memberID,9); //activity 1
            $checkActivity10 = $activities->checkMemberParticipation($memberID,10); //activity 1
            $checkActivity11 = $activities->checkMemberParticipation($memberID,11); //activity 1
            $checkActivity12 = $activities->checkMemberParticipation($memberID,12); //activity 1
            
            //policy activities
            $checkActivity13 = $activities->checkMemberParticipation($memberID,13); //activity 1
            $checkActivity14 = $activities->checkMemberParticipation($memberID,14); //activity 1
            $checkActivity15 = $activities->checkMemberParticipation($memberID,15); //activity 1
            
            //farm services
            $checkActivity16 = $activities->checkMemberParticipation($memberID,16); //activity 1
            $checkActivity17 = $activities->checkMemberParticipation($memberID,17); //activity 1
            $checkActivity18 = $activities->checkMemberParticipation($memberID,18); //activity 1
            $checkActivity19 = $activities->checkMemberParticipation($memberID,19); //activity 1
            $checkActivity20 = $activities->checkMemberParticipation($memberID,20); //activity 1
            $checkActivity21 = $activities->checkMemberParticipation($memberID,21); //activity 1
            $checkActivity22 = $activities->checkMemberParticipation($memberID,22); //activity 1
            $checkActivity23 = $activities->checkMemberParticipation($memberID,23); //activity 1
            //$checkActivity24 = $activities->checkMemberParticipation($memberID,24); //activity 1
            $checkActivity24 = $activities->getMemberNumberOfTreesPlanted($memberID,23);
            
            $member = array();
            array_push($member,$ipcName); //1
            array_push($member,$gacName); //2
            array_push($member,$clubName); //3
            array_push($member,$memberName); //4
            array_push($member,$gender); //5
            array_push($member, $checkActivity1); //6
            array_push($member, $checkActivity2); //7
            array_push($member, $checkActivity3); //8
            //community training activities
            array_push($member, $checkActivity4); //6
            array_push($member, $checkActivity5); //7
            array_push($member, $checkActivity6); //8
            array_push($member, $checkActivity7); //6
            array_push($member, $checkActivity8); //7
            array_push($member, $checkActivity9); //8
            array_push($member, $checkActivity10); //6
            array_push($member, $checkActivity11); //7
            array_push($member, $checkActivity12); //8
            //policy activities
            array_push($member, $checkActivity13); //6
            array_push($member, $checkActivity14); //7
            array_push($member, $checkActivity15); //8
            
            //farm services
            array_push($member, $checkActivity16); //6
            array_push($member, $checkActivity17); //7
            array_push($member, $checkActivity18); //8
            array_push($member, $checkActivity19); //6
            array_push($member, $checkActivity20); //7
            array_push($member, $checkActivity21); //8
            array_push($member, $checkActivity22); //6
            array_push($member, $checkActivity23); //7
            array_push($member, $checkActivity24); //8
            
            
            array_push($lstMembers,$member);
            $i++;
        }
  
}else{ //default when serach not clicked
        $regYear = $_SESSION['nasfam_regyearID'];
        //list member activities
        $lstMemberActivities = $activities->selectAllMembersRegYear($regYear);
        
        $i = 0;
        $lstMembers = array();
        foreach($lstMemberActivities as $value){
            $memberID = $value['mid']; //memberid
            $ipcName = $value['ipcname']; //ipc
            $gacName = $value['gacname']; //gac
            $clubName = $value['clubname']; //clubname
            $memberName = $value['membername']; //membername
            $gender = $value['gender']; //gender
            
            //Get member activities attendance data
            //Training Activities
            $checkActivity1 = $activities->checkMemberParticipation($memberID,1); //activity 1
            $checkActivity2 = $activities->checkMemberParticipation($memberID,2); //activity 1
            $checkActivity3 = $activities->checkMemberParticipation($memberID,3); //activity 1
            
            //community training activities
            $checkActivity4 = $activities->checkMemberParticipation($memberID,4); //activity 1
            $checkActivity5 = $activities->checkMemberParticipation($memberID,5); //activity 1
            $checkActivity6 = $activities->checkMemberParticipation($memberID,6); //activity 1
            $checkActivity7 = $activities->checkMemberParticipation($memberID,7); //activity 1
            $checkActivity8 = $activities->checkMemberParticipation($memberID,8); //activity 1
            $checkActivity9 = $activities->checkMemberParticipation($memberID,9); //activity 1
            $checkActivity10 = $activities->checkMemberParticipation($memberID,10); //activity 1
            $checkActivity11 = $activities->checkMemberParticipation($memberID,11); //activity 1
            $checkActivity12 = $activities->checkMemberParticipation($memberID,12); //activity 1
            
            //policy activities
            $checkActivity13 = $activities->checkMemberParticipation($memberID,13); //activity 1
            $checkActivity14 = $activities->checkMemberParticipation($memberID,14); //activity 1
            $checkActivity15 = $activities->checkMemberParticipation($memberID,15); //activity 1
            
            //farm services
            $checkActivity16 = $activities->checkMemberParticipation($memberID,16); //activity 1
            $checkActivity17 = $activities->checkMemberParticipation($memberID,17); //activity 1
            $checkActivity18 = $activities->checkMemberParticipation($memberID,18); //activity 1
            $checkActivity19 = $activities->checkMemberParticipation($memberID,19); //activity 1
            $checkActivity20 = $activities->checkMemberParticipation($memberID,20); //activity 1
            $checkActivity21 = $activities->checkMemberParticipation($memberID,21); //activity 1
            $checkActivity22 = $activities->checkMemberParticipation($memberID,22); //activity 1
            $checkActivity23 = $activities->checkMemberParticipation($memberID,23); //activity 1
            //$checkActivity24 = $activities->checkMemberParticipation($memberID,24); //activity 1
            $checkActivity24 = $activities->getMemberNumberOfTreesPlanted($memberID,23);
            
            $member = array();
            array_push($member,$ipcName); //1
            array_push($member,$gacName); //2
            array_push($member,$clubName); //3
            array_push($member,$memberName); //4
            array_push($member,$gender); //5
            array_push($member, $checkActivity1); //6
            array_push($member, $checkActivity2); //7
            array_push($member, $checkActivity3); //8
            //community training activities
            array_push($member, $checkActivity4); //6
            array_push($member, $checkActivity5); //7
            array_push($member, $checkActivity6); //8
            array_push($member, $checkActivity7); //6
            array_push($member, $checkActivity8); //7
            array_push($member, $checkActivity9); //8
            array_push($member, $checkActivity10); //6
            array_push($member, $checkActivity11); //7
            array_push($member, $checkActivity12); //8
            //policy activities
            array_push($member, $checkActivity13); //6
            array_push($member, $checkActivity14); //7
            array_push($member, $checkActivity15); //8
            
            //farm services
            array_push($member, $checkActivity16); //6
            array_push($member, $checkActivity17); //7
            array_push($member, $checkActivity18); //8
            array_push($member, $checkActivity19); //6
            array_push($member, $checkActivity20); //7
            array_push($member, $checkActivity21); //8
            array_push($member, $checkActivity22); //6
            array_push($member, $checkActivity23); //7
            array_push($member, $checkActivity24); //8
            
            
            array_push($lstMembers,$member);
            $i++;
        }
}

// Add bulk member activity
if(isset($_POST['addMABulk'])){
    $fname = $_FILES['memberactivitiesFile']['name'];
    $regYear = $_POST['regyearBulk'];
    
    $chk_ext = explode(".", $fname);
    
    if(strtolower(end($chk_ext)) == "csv")
    {        
        $filename = $_FILES['memberactivitiesFile']['tmp_name'];
        $handle = fopen($filename, "r");
        
        fgetcsv($handle, 1000, ","); //abandon the first record 
        while(($data = fgetcsv($handle, 1000, ",")) !== false)
        {        
            //check if member or non member
            $memberNumber = $data[0];
            $activityCode = $data[1];
            
            $checkMemberExistence = $members->MemberExists($memberNumber);
            $memberID = $checkMemberExistence[0][6];
            
            echo 'MemberID: '.$memberID.'<br>';
            //echo $CheckMembership;
            if($memberID == NULL){
                //none member
                echo 'not Member<br><hr>';
            }else{
                //get member details
                echo 'Member<br><hr>';
                //check if member was registered in the selected year
                $CheckMemberRegistration = $crops->CheckMemberRegistration($regYear,$memberNumber);
                if($CheckMemberRegistration == 1){
                    //get member id where reg year and member number           
                    $getMemberID = $crops->getMemberID($regYear,$memberNumber);
                    $memberID1 = $getMemberID[0][0];
                    
                    //GET ACTIVITY FROM ACTIVITY CODE 
                    $getActivityID = $activities->getActivityID($activityCode);
                    $activityID = $getActivityID[0][0];
                    
                    
                    //CHECK IF MEMBER ACTIVITY EXISTS
                    $checkMemberActivity = $activities->CheckifMemberAlreadyHasActivity($memberID1,$activityID);
                    if($checkMemberActivity == 1){
                        //do not add, do nothing
                    }else{ //ENTER THE MEMBER ACTIVITY                      
                        $addMemberActivity = $activities->addMemberActivity($memberID1,$activityID); 
                    }
                    
                }else{
                    echo '<br>member is not registered in that year';
                }
            }
        }
        fclose($handle);
        header("Location: memberactivities.php");
    }
    else
    {
        echo 'Invalid file';
    }
}