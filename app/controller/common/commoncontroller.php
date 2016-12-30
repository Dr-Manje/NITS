<?php
session_start();

include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/user/districtsmodel.php');

$login_users = new usersmodel();
$dashboard = new dashmodel();
$districts = new districtsmodel();

$listregYear = $dashboard->ListRegYear();

$lstDistricts = $districts->listDistricts();

//list users
$lstUsers = $login_users->listUsers();

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

//login user
if(isset($_POST['loginuser'])){

    $email = $_POST['Email'];
    $password = $_POST['Password'];
                
        $auth_user = $login_users->LoginUser($email, $password);
        if($auth_user == 1){ //user pass and email are good
            //check if user is active or nah
            $getuserid = $login_users->GetUserInfo($email);
            $userstatus = $getuserid[0][6];
            
            
            if($userstatus == 'ACTIVE'){ //user is active
            $make_session = $login_users->GetUserInfo($email);
            print_r($make_session);
            foreach($make_session as $userSessions)
            {      
               //user ID
               $_SESSION['nasfam_userid'] = $userSessions['userID'];
               //username
               $_SESSION['nasfam_user_name'] = $userSessions['firstname'].' '.$userSessions['lastname'];  
               
                //get user type
                $_SESSION['nasfam_usertype'] = $userSessions['usertype'];
                
                //user district
                $_SESSION['nasfam_userdistrict'] = $userSessions['district'];

               
                if(isset($_SESSION['nasfam_userid'])){
                   //get reg year
                   //check if atleast 1 reg year exists
                   $checkregyear = $login_users->countRegYears();
                   //$checkresult = $checkregyear[0][0];
                   //$_SESSION['regyearID'] = '10';
                    if($checkregyear > 0){
                        $regYear = $login_users->selectRegYear();
                        $regID = $regYear[0][0];
                        $regYear1 = $regYear[0][1];

                        $_SESSION['nasfam_regyearID'] = $regID;
                        $_SESSION['nasfam_regyear'] = $regYear1;
                        
                        header("Location: ../user/dashboard.php");
                    }else{
                        //get latest reg year
                        $regYear = $login_users->selectRegYear();
                        $regID = $regYear[0][0];
                        $regYear1 = $regYear[0][1];

                        $_SESSION['nasfam_regyearID'] = $regID;
                        $_SESSION['nasfam_regyear'] = $regYear1;
                        header("Location: ../user/dashboard.php");
                   } 
               }               
            }
            }else{ //user is inactive
                $errorHead = "Inactive user";
                $errorMessage = "The user account is inactive. Please contact the admin";
            }
        
        
        
        }else{ //user pass and email are wrong
            $errorHead = "Invalid user";
            $errorMessage = "email or password are incorrect. If you have forgotten please contact the admin";
        }
   
        
        
//        else
//        {
//            $errorHead = "Invalid user";
//            $errorMessage = "email or password are incorrect. If you have forgotten please contact the admin";
//        }   
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
        }else{ //if doesnt exist
            //check if regular or admin
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