<?php

if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}

include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/procurementmodel.php');

$dashboard = new dashmodel();
$common = new usersmodel();
$procurement = new procurementmodel();

$listregYear = $dashboard->ListRegYear();

if(isset($_POST['SearchDistrictReg'])){
    $regYear = $_POST['regyearDS'];
    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
}else{
    $regYear = $_SESSION['nasfam_regyearID'];
    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
}

if($_POST['uploadBulkProcurement']){
//    echo 'upload bulk procurement';
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
            $membertype = $data[0]; //member type
            $membernumber = $data[1];
            $getnames = $data[2];            
            $names = strtoupper($getnames);
            $getlname = $data[3];            
            $lname = strtoupper($getlname);
            $getgender = $data[4];            
            $gender = strtoupper($getgender);
            $receiptno = $data[5];
            
            $marketcode = $data[6];
            //get market center ID
            $MarketCenterID = $procurement->GetMemberMarketCenterID($marketcode);
            
            $moisture = $data[7];
            $qty = $data[8];
            $mwk = $data[9];
            
            
            if($membertype == 'member'){
                echo 'member <br>';
            }else{
                echo 'none member <br>';
                
            }
        }
        fclose($handle);
        //header("Location: procurement.php");
    }
    else
    {
        echo 'Invalid file';
    } 
}