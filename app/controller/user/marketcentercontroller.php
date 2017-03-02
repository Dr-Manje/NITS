<?php

if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}

include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/user/casualworkermodel.php');
include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/warehousemodel.php');
include_once ('../../model/user/marketcentermodel.php');


$dashboard = new dashmodel();
$cworker = new casualworkermodel();
$warehouse = new warehousemodel();

$marketcenter = new marketcentermodel();

$common = new usersmodel();
$listregYear = $dashboard->ListRegYear();

$lstMarketcenters = $marketcenter->lstMarketcenters();

if($_POST['uploadBulkMarketCenters']){

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
            $names = strtoupper($getnames);
            
            $getMemberNumber = $marketcenter->GetRecentMembernumberCounter(); //get recent number
            $districtPrfx = 'MKC';
            if($getMemberNumber == 0){
            //echo 'no members<br>';
            //get member prefix
            $Mcount = 1;
            $newMemberNumber = $districtPrfx.''.$Mcount;
//            echo 'new member number :'.$newMemberNumber.'<hr>'; 
            $AddMemberNumber = $marketcenter->AddMarketCenter($names,$newMemberNumber,$yearRegistered);
            }else{
//                echo 'Members<br>';
                //$getMemberNumber1 = $members->GetRecentMemberCounter($district);
                $Mcount = $getMemberNumber += 1;
                $newMemberNumber = $districtPrfx.''.$Mcount;
//                echo 'member number :'.$newMemberNumber.'<hr>';
                //add member
                $AddMemberNumber = $marketcenter->AddMarketCenter($names,$newMemberNumber,$yearRegistered);
            }
        }
        fclose($handle);
        header("Location: marketcenter.php");
    }
    else
    {
        echo 'Invalid file';
    } 
}