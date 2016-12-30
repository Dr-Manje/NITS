<?php

if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}

include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/user/districtsmodel.php');

$login_users = new usersmodel();
$dashboard = new dashmodel();
$districts = new districtsmodel();

$listregYear = $dashboard->ListRegYear();

$lstDistricts = $districts->listDistricts();

//list users
$loggedinuserid = $_SESSION['nasfam_userid'];
$lstUsers = $login_users->listUsersExceptLoggedInUser($loggedinuserid);

$lstUserTypes = $login_users->getUserTypes(); //list user types
//check users
$CheckUserTypes = $login_users->CheckUserTypes();
if($CheckUserTypes == 0){
    //create user types
    //create default user
    $CreateUserTypesDefault = $login_users->CreateUserTypesDefault();
    //echo 'zero';
}else{
    // do nothing
}

//add user
if(isset($_POST['adduser'])){
    $rowCount = count($_POST['users']);
    
    for($i=0;$i<$rowCount;$i++){
        $names = $_POST['names'][$i];
        $surname = $_POST['surname'][$i];
        $email = $_POST['email'][$i];
        $password = $_POST['password'][$i];
        $usertype = $_POST['usertype'][$i];
        $district = $_POST['district'][$i];
        
        $CheckUserExists = $login_users->CheckUserExists($email);//check if exists by email
        if($CheckUserExists == 1){//if exists
            //do nothing send notification that users email has already been taken
            //notification
        }else{ //if doesnt exist
            //check if regular or admin
            //notifiaction
            if($usertype == 1){ //if admin                
                $addUser = $login_users->addAdminUser($names,$surname,$email,$password,$usertype);
            }else{ //if regular 
                 $addUser = $login_users->addRegularUser($names,$surname,$email,$password,$usertype,$district);
            }                      
        } 
    }
    
    header("Location: users.php");
}

//update user
if(isset($_POST['updateuser'])){
    
    $email = $_POST['email1'];
    $firstname = $_POST['names1'];
    $lastname = $_POST['surname1'];
    $id = $_POST['userID'];
    
    $updateUser = $login_users->UpdateUser($email,$firstname,$lastname,$id);
    
    if($updateUser == 1){
        header("Location: users.php");
    }
}

//activate-deactivate user
if(isset($_GET['userstat'])){
    $userid = $_GET['userstat']; //user id
    $status = $_GET['stat']; //status
    
    if($status == 'ACTIVE'){
        echo 'deactivate user account';
        $newstatus = 'INACTIVE';
        $UpdateUserSatus = $login_users->UpdateUserSatus($userid,$newstatus);
        //notification
    }else{
        echo 'activate user account';
        $newstatus = 'ACTIVE';
        $UpdateUserSatus = $login_users->UpdateUserSatus($userid,$newstatus);
        //notification
    }
    header("Location: users.php");
}

//reset password
if(isset($_GET['passreset'])){
    $userid = $_GET['passreset']; //user id
    $RestetUserPassword = $login_users->RestetUserPassword($userid);
    //set notifiaction
    header("Location: users.php");
}