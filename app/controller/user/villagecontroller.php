<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}
        
//include_once ('../../model/user/dashboardmodel.php');
//include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/villagemodel.php');

//$login_users = new usersmodel();
//$dashboard = new dashmodel();
$village = new villagemodel();

$datetime_var = new DateTime();

//list activities
$lstVillages = $village->listVillages();

//add activity
if(isset($_POST['addvillage'])){
    $villageName = $_POST['village'];
    $villageHeadman = $_POST['villagehm'];
    
    $addVillage = $village->addVillage($villageName,$villageHeadman);
    if($addVillage == 1){
        header("Location: villages.php");
    }
}

//edit/update activity
if(isset($_POST['updateVillage'])){
    $id = $_POST['villageID'];
    $villageName = $_POST['village1'];
    $villageHeadman = $_POST['villagehm1'];
    
    $updateVillage = $village->UpdateVillage($villageName,$villageHeadman,$id);
    if($updateVillage == 1){
        header("Location: villages.php");
    }
}