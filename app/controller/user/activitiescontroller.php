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

//list activity categories
$lstActivityType = $activities->listActivityType();

//search based on selected year
if(isset($_POST['SearchTypeActivityDetails'])){
    //echo 'display reg years';
    $id = $_POST['regyear'];
    //set reg year
    $lstRegYear1 = $dashboard->SelectRegYear($id);
    $regyearAssign = $id;
    $regyearName = $lstRegYear1[0][1];
    $listregYear = $dashboard->ListRegYear();
    
    $lstActivities = $targets->listAllActivities($regyearAssign); //list activities
    
}else{
    //set default year
    $lstRegYear = $dashboard->ListRegYear();
    $regyearAssign = $_SESSION['nasfam_regyearID'];
    $regyearName = $lstRegYear[0][1];
    $listregYear = $dashboard->ListRegYear();
    
    
    $lstActivities = $targets->listAllActivities($regyearAssign); //list activities
    
   
  
    
}



//update/insert activity details for activity in selected reg year
if(isset($_POST['updatehoa'])){
    $regyearid = $_POST['regyear']; //regyear id
    $activityid = $_POST['id']; //activity id
    $hoa = $_POST['hoa']; //hoa
   
    //check if entry exists
    $chekhoa = $activities->CheckIfhoaExists($activityid,$regyearid);
//    echo $chekhoa;
    if($chekhoa == 1){
        //exists, update
        $Updatehoa = $activities->Updatehoa($activityid,$regyearid,$hoa);
    }else{
        //doesnt exist, insert new
        $addhoa = $activities->addhoa($activityid,$regyearid,$hoa);
    }
    
    
}

//add activity
if(isset($_POST['addactivity'])){
    $Aname = $_POST['activity1'];
    $aDesc  = $_POST['activitydesc1'];  
    $aID = $_POST['category'];
    $code = $_POST['code'];
    
    $addActivity = $activities->addActivity($Aname,$aDesc,$aID,$code);
    
    if($addActivity == 1){
        header("Location: activities.php");
    }
}

//edit/update activity
if(isset($_POST['updateactivity'])){
    $Aname = $_POST['activity11'];
    $aDesc = $_POST['activitydesc11'];
    $aID = $_POST['category1'];
    $id = $_POST['activityID'];
    $code = $_POST['code1'];
    
   $updateactivity =  $activities->UpdateActivity($Aname,$aDesc,$aID,$id,$code);
   
   if($updateactivity == 1){
       header("Location: activities.php");
   }
}

// Member Activities ---------------------
// Add single member activity
if(isset($_POST['addMASingle'])){
    $rowCount = count($_POST['activities']);
    $memberID = $_POST['memberIDS'];
    
    for($i=0;$i<$rowCount;$i++){
        $activity = $_POST['activity'][$i];
        $status = $_POST['status'][$i];
        
        //check if entry exists in member activities table
        $CheckMemberActivities = $activities->CheckMemberActivity($memberID,$activity);       
        if($CheckMemberActivities == 1){//if exists -> update
            $update = $activities->updateMemberActivity($memberID,$activity,$status);
        }else{//if does not exist -> insert new
            $add = $activities->addMemberActivity($memberID,$activity,$status);
        }
        
    }
    header("Location: memberactivities.php");
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

                    //ENTER THE MEMBER ACTIVITY
                    $addMemberActivity = $activities->addMemberActivity($memberID1,$activityID);
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

if(isset($_POST['keyword'])){
    $keyword = '%'.$_POST['keyword'].'%';
    
    $getMemberList = $activities->MemberAutocomplete($keyword);
    
    foreach($getMemberList as $value){
     // put in bold the written text
    $country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $value['memberNo'].' '.$value['regYear'].' '.$value['fname'].' '.$value['lname']);
    
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $value['fname']).'\',\''.str_replace("'", "\'", $value['lname']).'\',\''.str_replace("'", "\'", $value['memberNo']).'\',\''.str_replace("'", "\'", $value['regYear']).'\',\''.str_replace("'", "\'", $value['memberID']).'\',\''.str_replace("'", "\'", $value['regYearID']).'\')">'.$country_name.'</li>';
    }
    
}
