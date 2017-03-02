<?php

if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}

include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/user/casualworkermodel.php');
include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/warehousemodel.php');


$dashboard = new dashmodel();
$cworker = new casualworkermodel();
$warehouse = new warehousemodel();

$common = new usersmodel();
$listregYear = $dashboard->ListRegYear();

if(isset($_POST['SearchDistrictReg'])){
    $regYear = $_POST['regyearDS'];
    $lstworkers = $warehouse->selectwarehouse($regYear);
    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
    
    $data = $warehouse->selectwarehouse1($regYear);
    
    $i = 0;
    $TRs = array();
    foreach ($data as $value){
        $id = $value['id']; //tr number
        $cname = $value['cname']; //client
        $getdata = $warehouse->selectwarehouse2($id,$regYear);
        $bag = $getdata[0][0];
        $chalim = $getdata[0][1];
        $cg7 = $getdata[0][2];
        
        $ov = $getdata[0][3];
        $go = $getdata[0][4];
        $shell = $getdata[0][5];
        
        $total = $chalim + $cg7 + $ov + $go + $shell;
        
        $loss = $bag - $total;
        if($loss < 0){
            $notes = 'DISCREPANCY';
        }else{
            $notes = 'LOSS';
        }
        
        $action = '<a href=warehousedetails.php?id='.$id.'&ry='.$regYear.'>View More</a>';
        
        $tr = array();
        array_push($tr, $cname); //tr number
        
        array_push($tr, $bag); //tr number
        array_push($tr, $chalim); //tr number
        array_push($tr, $cg7); //tr number
        
        array_push($tr, $ov); //tr number
        array_push($tr, $go); //tr number
        array_push($tr, $shell); //tr number
        
        array_push($tr, $total); //tr number
        array_push($tr, $loss); //tr number
        
        array_push($tr, $notes); //tr number
        array_push($tr, $action); //tr number
        
        array_push($TRs, $tr);
        $i++;
    }
}else{
    $regYear = $_SESSION['nasfam_regyearID'];
    $lstworkers = $warehouse->selectwarehouse($regYear);
    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
    
    $data = $warehouse->selectwarehouse1($regYear);
    
    $i = 0;
    $TRs = array();
    foreach ($data as $value){
        $id = $value['id']; //tr number
        $cname = $value['cname']; //client
        $getdata = $warehouse->selectwarehouse2($id,$regYear);
        $bag = $getdata[0][0];
        $chalim = $getdata[0][1];
        $cg7 = $getdata[0][2];
        
        $ov = $getdata[0][3];
        $go = $getdata[0][4];
        $shell = $getdata[0][5];
        
        $total = $chalim + $cg7 + $ov + $go + $shell;
        
        $loss = $bag - $total;
        if($loss < 0){
            $notes = 'DISCREPANCY';
        }else{
            $notes = 'LOSS';
        }
        
        $action = '<a href=warehousedetails.php?id='.$id.'&ry='.$regYear.'>View More</a>';
        
        $tr = array();
        array_push($tr, $cname); //tr number
        
        array_push($tr, $bag); //tr number
        array_push($tr, $chalim); //tr number
        array_push($tr, $cg7); //tr number
        
        array_push($tr, $ov); //tr number
        array_push($tr, $go); //tr number
        array_push($tr, $shell); //tr number
        
        array_push($tr, $total); //tr number
        array_push($tr, $loss); //tr number
        
        array_push($tr, $notes); //tr number
        array_push($tr, $action); //tr number

        array_push($TRs, $tr);
        $i++;
    }
    
}

if($_POST['uploadBulkWarehouse']){
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
            $cwcode = $data[0];
            $getdate = $data[1];
            $date = date("Y-m-d H:i:s", strtotime($getdate));
            $bag = $data[2];
            $chalim = $data[3];
            $cg7 = $data[4];
            $ovarieties = $data[5];
            $gradeouts = $data[6];
            $shells = $data[7];
                     
            $GetMemberID = $warehouse->GetMemberID($cwcode); //get casual worker id

            $addMember = $warehouse->AddwareHouseData($GetMemberID,$date,$bag,$chalim,$cg7,$ovarieties,$gradeouts,$shells,$yearRegistered);
        }
        fclose($handle);
        header("Location: warehouse.php");
    }
    else
    {
        echo 'Invalid file';
    } 
}

if(Isset($_GET['id'])){
    $id = $_GET['id'];
    $ry = $_GET['ry'];
    
    $getRegYearDetails = $common->getRegYearDetails($ry);
    $regYearName = $getRegYearDetails[0][1];
    
    //get casual worker details
    $getworkerinfo = $cworker->getworkerinfo($id);
    $code = $getworkerinfo[0][0];
    $name = $getworkerinfo[0][1];
    $gender = $getworkerinfo[0][2];
    
    $data = $warehouse->selectwarehouse2($id,$ry);
    
    $i = 0;
    $TRs = array();
    foreach ($data as $value){
        $id = $value['datee']; //tr number
        $datee = $value['datee']; //tr number
        $bag = $value['bag']; //tr number
        $chalim = $value['chalim']; //tr number
        $cg7 = $value['cg7']; //tr number
        
        $ov = $value['ov']; //tr number
        $go = $value['go']; //tr number
        
        $shell = $value['shell']; //tr number
        
        $total = $chalim + $cg7 + $ov + $go + $shell;
        
        $loss = $bag - $total;
        if($loss < 0){
            $notes = 'DISCREPANCY';
        }else{
            $notes = 'LOSS';
        }
        
        $action = '<a href=>EDIT</a> | <a href=>REMOVE</a>';
        
        $tr = array();
        array_push($tr, $datee); //tr number
        
        array_push($tr, $bag); //tr number
        array_push($tr, $chalim); //tr number
        array_push($tr, $cg7); //tr number
        
        array_push($tr, $ov); //tr number
        array_push($tr, $go); //tr number
        array_push($tr, $shell); //tr number
        
        array_push($tr, $total); //tr number
        array_push($tr, $loss); //tr number
        
        array_push($tr, $notes); //tr number
        array_push($tr, $action); //tr number

        array_push($TRs, $tr);
        $i++;
    }
}