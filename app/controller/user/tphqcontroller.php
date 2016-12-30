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
include_once ('../../model/user/districtsmodel.php');

$common = new usersmodel();
$trees = new treesmodel();
$dashboard = new dashmodel();
$activities = new activitiesmodel();
$members = new membersmodel();
$districts = new districtsmodel();

$listregYear = $dashboard->ListRegYear(); //list registration year

if(isset($_POST['SearchTPHQ'])){ //display button clicked
//    echo 'search';
    $regYear = $_POST['regyearTPHQ'];
    
    $listDistrictsWithTPDetails = $activities->listDistrictsWithTPDetails($regYear);
    
    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
    $i = 0;
    $TPs = array();
    
    foreach($listDistrictsWithTPDetails as $value){
        $districtid = $value['district'];
        
        $getDistrictDetails = $districts->getDistrictDetails($districtid);  //get district name
        $districtName = $getDistrictDetails[0][2];
        
        $getTPSumForTreeType1 = $activities->getTPSumForTreeType($regYear,$districtid,'1'); //get district Agroforestry 1
        if($getTPSumForTreeType1 == 'NULL'){
            $Get1 = 0;
        }else{
            $Get1 = $getTPSumForTreeType1[0][1];
        }
        
//        $GetAgroforestry = 'wtf';
        
        $getTPSumForTreeType2 = $activities->getTPSumForTreeType($regYear,$districtid,'2'); //get district Indigenous 2
        if($getTPSumForTreeType2 == 'NULL'){
            $GetIndigenous = 0;
        }else{
            $GetIndigenous = $getTPSumForTreeType2[0][1];
        }
        
        $getTPSumForTreeType3 = $activities->getTPSumForTreeType($regYear,$districtid,'3');//get district Exotic 3
        if($getTPSumForTreeType3 == 'NULL'){
            $GetExotics = 0;
        }else{
            $GetExotics = $getTPSumForTreeType3[0][1];
        }

        $getTPSumForTreeType4 = $activities->getTPSumForTreeType($regYear,$districtid,'4'); //get district Fruit 4
        if($getTPSumForTreeType4 == 'NULL'){
            $GetFruit = 0;
        }else{
            $GetFruit = $getTPSumForTreeType4[0][1];
        }
        
        
        $tp = array();
        array_push($tp,$districtName);
        array_push($tp,$Get1);
        array_push($tp,$GetIndigenous);
        array_push($tp,$GetExotics);
        array_push($tp,$GetFruit);
        //array_push($tp,$getAgroforestry);
        
        array_push($TPs,$tp);
        $i++;
    }
}else{ //default, display current year stats
    $regYear = $_SESSION['nasfam_regyearID'];
    $listDistrictsWithTPDetails = $activities->listDistrictsWithTPDetails($regYear);
    
    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
    
    $i = 0;
    $TPs = array();
    
    foreach($listDistrictsWithTPDetails as $value){
        $districtid = $value['district'];
        
        $getDistrictDetails = $districts->getDistrictDetails($districtid);  //get district name
        $districtName = $getDistrictDetails[0][2];
        
        $getTPSumForTreeType1 = $activities->getTPSumForTreeType($regYear,$districtid,'1'); //get district Agroforestry 1
        if($getTPSumForTreeType1 == 'NULL'){
            $Get1 = 0;
        }else{
            $Get1 = $getTPSumForTreeType1[0][1];
        }
        
//        $GetAgroforestry = 'wtf';
        
        $getTPSumForTreeType2 = $activities->getTPSumForTreeType($regYear,$districtid,'2'); //get district Indigenous 2
        if($getTPSumForTreeType2 == 'NULL'){
            $GetIndigenous = 0;
        }else{
            $GetIndigenous = $getTPSumForTreeType2[0][1];
        }
        
        $getTPSumForTreeType3 = $activities->getTPSumForTreeType($regYear,$districtid,'3');//get district Exotic 3
        if($getTPSumForTreeType3 == 'NULL'){
            $GetExotics = 0;
        }else{
            $GetExotics = $getTPSumForTreeType3[0][1];
        }

        $getTPSumForTreeType4 = $activities->getTPSumForTreeType($regYear,$districtid,'4'); //get district Fruit 4
        if($getTPSumForTreeType4 == 'NULL'){
            $GetFruit = 0;
        }else{
            $GetFruit = $getTPSumForTreeType4[0][1];
        }
        
        
        $tp = array();
        array_push($tp,$districtName);
        array_push($tp,$Get1);
        array_push($tp,$GetIndigenous);
        array_push($tp,$GetExotics);
        array_push($tp,$GetFruit);
        //array_push($tp,$getAgroforestry);
        
        array_push($TPs,$tp);
        $i++;
    }
}