<?php

//session_start();
if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}
        
include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/user/districtsmodel.php');
include_once ('../../model/user/clubmodel.php');




$dashboard = new dashmodel();
$listregYear = $dashboard->FullListRegYear();

$districts = new districtsmodel();
$clubs = new clubmodel();

$datetime_var = new DateTime();

if(isset($_POST['SearchDistrictReg'])){
    $regYear = $_POST['regyearDS'];
    $listClubs = $clubs->listClubs($regYear);
}else{
    $regYear = $_SESSION['nasfam_regyearID'];    
    $listClubs = $clubs->listClubs($regYear);
}