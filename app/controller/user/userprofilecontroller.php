<?php

if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}

include_once ('../../model/common/commonmodel.php');

$users = new usersmodel();

if(isset($_SESSION['nasfam_userid'])){
    $userID = $_SESSION['nasfam_userid'];
    
    //get user details
    $getuserprofile = $users->getuserprofile($userID);
    $fname = $getuserprofile[0][3]; //first name
    $lname = $getuserprofile[0][4]; //last name
    $email = $getuserprofile[0][1]; //email
    
    $districtID = $getuserprofile[0][7]; //district
    if($districtID == NULL){
        $districtName = 'HQ';
    }else{ //get district name
        $getuserdistrict = $users->getdistrict($districtID);
        $districtName = $getuserdistrict[0][2];
    }
    
    $password = $getuserprofile[0][2]; //password
    $status = $getuserprofile[0][5]; //status
}

if(isset($_POST['updateuser'])){
    //update user
    $fname = $_POST['fname']; //fname
    $lname = $_POST['lname']; //lname
    $email = $_POST['email']; //email
    $userID = $_SESSION['nasfam_userid']; //userid
    
    $updateUserDetails = $users->updateUserDetails($fname,$lname,$email,$userID);
    
}

if(isset($_POST['updateuserpass'])){
    $userID = $_SESSION['nasfam_userid']; //userid
    $newpass = $_POST['newpassword']; //new password
    $updateUserpass = $users->updateUserpass($newpass,$userID);
}