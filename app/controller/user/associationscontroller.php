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
include_once ('../../model/user/associationsmodel.php');

//$login_users = new usersmodel();
//$dashboard = new dashmodel();
$associations = new associationsmodel();

$datetime_var = new DateTime();

//list activities
$lstAssociations = $associations->listAssociations();

//add activity
if(isset($_POST['addassociation'])){
    $associationsName = $_POST['Aname'];
    $associationsDescription  = $_POST['Adesc'];  
    
    $addActivity = $associations->addAssociation($associationsName,$associationsDescription);
    
    if($addActivity == 1){
        header("Location: associations.php");
    }
}

//edit/update activity
if(isset($_POST['updateassociation'])){
    $associationsName = $_POST['Aname1'];
    $associationsDescription = $_POST['Adesc1'];
    $id = $_POST['associationID'];
    
   $updateactivity =  $associations->UpdateAssociation($associationsName,$associationsDescription,$id);
   
   if($updateactivity == 1){
       header("Location: associations.php");
   }
}