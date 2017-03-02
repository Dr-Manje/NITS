<?php

if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}
include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/user/casualworkermodel.php');
include_once ('../../model/common/commonmodel.php');

$dashboard = new dashmodel();
$cworker = new casualworkermodel();

$common = new usersmodel();
$listregYear = $dashboard->ListRegYear();

if(isset($_POST['SearchDistrictReg'])){
    $regYear = $_POST['regyearDS'];
    $lstworkers = $cworker->selectworkers($regYear);
    //get reg year display details
            $getRegYearDetails = $common->getRegYearDetails($regYear);
            $regYearName = $getRegYearDetails[0][1];
}else{
    $regYear = $_SESSION['nasfam_regyearID'];
    $lstworkers = $cworker->selectworkers($regYear);
    //get reg year display details
            $getRegYearDetails = $common->getRegYearDetails($regYear);
            $regYearName = $getRegYearDetails[0][1];
}


if($_POST['uploadBulkWorkers']){

    $fname = $_FILES['file']['name'];
    $yearRegistered = $_POST['regyearBulk'];
    $chk_ext = explode(".", $fname);
    
    if(strtolower(end($chk_ext)) == "csv")
    {
        $filename = $_FILES['file']['tmp_name'];
        $handle = fopen($filename, "r");
        
        fgetcsv($handle, 1000, ","); //abandon the first record 
        while(($data = fgetcsv($handle, 1000, ",")) !== false)
        {               
            $getnames = $data[0];
            $getlastname = $data[1];
            $names = strtoupper($getnames);
            $lastname = strtoupper($getlastname);
            $getgender = $data[2];
            $gender = strtoupper($getgender);            
            
            $getMemberNumber = $cworker->GetRecentMembernumberCounter(); //get recent number
            $districtPrfx = 'CWK';
            if($getMemberNumber == 0){
            //echo 'no members<br>';
            //get member prefix
            $Mcount = 1;
            $newMemberNumber = $districtPrfx.''.$Mcount;
//            echo 'new member number :'.$newMemberNumber.'<hr>'; 
            $AddMemberNumber = $cworker->AddCasualWorker($names,$lastname,$gender,$newMemberNumber,$yearRegistered);
            }else{
//                echo 'Members<br>';
                //$getMemberNumber1 = $members->GetRecentMemberCounter($district);
                $Mcount = $getMemberNumber += 1;
                $newMemberNumber = $districtPrfx.''.$Mcount;
//                echo 'member number :'.$newMemberNumber.'<hr>';
                //add member
                $AddMemberNumber = $cworker->AddCasualWorker($names,$lastname,$gender,$newMemberNumber,$yearRegistered);
            }
            
//            $addMember = $members->RegisterMemberInitial($names,$lastname,$gender,$yearRegistered,$dateofbirth,$hhsize,$newMemberNumber,$club,$district);
        }
        fclose($handle);
        header("Location: casualworkers.php");
    }
    else
    {
        echo 'Invalid file';
    } 
}