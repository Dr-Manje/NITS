<?php

if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}

//$_SESSION['schooladd']['status'] = 'INACTIVE';
        
include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/membersmodel.php');
include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/seasonsmodel.php');
$seasons = new seasonsmodel();
$common = new usersmodel();
$members = new membersmodel();
$login_users = new usersmodel();


$dashboard = new dashmodel();
$datetime_var = new DateTime();
$listregYear = $dashboard->ListAllRegYear();

// Dashboard ITEMS //

// END Dashboard ITEMS //

if(isset($_POST['Addregyear'])){
    
    $startdate = $_POST['startdate']; //start date
    $enddate = $_POST['enddate']; //end date
    $season = $_POST['seasonname'];
    
    //$regYear = date("Y-m-d H:i:s", $dateReg);
    //$regYear = date_format($dateReg, 'Y-m-d');
    $RegisterRegYear = $dashboard->RegisterRegYear($startdate,$enddate,$season);
    if($RegisterRegYear == 1){

        $regYear = $login_users->selectRegYear();
        $regID = $regYear[0][0];
        $regYear1 = $regYear[0][1];
        
        //System pre config -------------------------------------------------------
        //create default activity types
        $createDefaultActivityTypes = $login_users->createDefaultActivityTypes();

        //create activities
        //create type 1 activities
        $Getactivity1 = $login_users->getActivity1ID();
        $activity1 = $Getactivity1[0][0];
        $createActivities1 = $login_users->createActivities1($activity1);
        //create activity 1 details (regyear,activityid) 
        //get activity IDs

        //create type 2 activities
        $Getactivity2 = $login_users->getActivity2ID();
        $activity2 = $Getactivity2[0][0];
        $createActivities2 = $login_users->createActivities2($activity2);
        //create activity 2 details

        //create type 3 activities
        $Getactivity3 = $login_users->getActivity3ID();
        $activity3 = $Getactivity3[0][0];
        $createActivities3 = $login_users->createActivities3($activity3);
        //create activity 3 details

        //create type 4 activities
        $Getactivity4 = $login_users->getActivity4ID();
        $activity4 = $Getactivity4[0][0];
        $createActivities4 = $login_users->createActivities4($activity4);
        //create activity 4 details

        $SelectRegYear = $dashboard->ListRegYear();//get created default year
        $regYearID = $SelectRegYear[0][0];
        
        $createCodingRef = $login_users->createCodingRef();//create code ref
        
        $addDistrictCodesToReg = $login_users->addIPCCodesToReg();//insert districts into code register
        
        $createDefaultDistricts = $login_users->createDefaultIPCs(); //add districts
        
        $createRegyearDistricts = $login_users->createRegyearIPCs($regYearID); //add default district reg year data
        
        $addTreeCodesToReg = $login_users->addTreeCodesToReg();//insert trees into code register
        $createTreeCategories = $login_users->createTreeCategories(); //set tree types
        
        //create the target defaults
        $createDefaultTargets = $login_users->createDefaultTargets($regYearID); // create activity targets

        /* NOTE:
         * DEFAULT USER WILL BE CREATED. 
         * AFTER FIRST LOGIN, PROMPT DEFAULT USER TO UPDATE USER DETAILS, ALL FIELDS ARE MANDATORY.
         */

        // END System pre-config -------------------------------------------------------
        
        
        
        if($createDefaultTargets == 1){
            //echo 'created them defaults';
            $_SESSION['nasfam_regyearID'] = $regID;
            $_SESSION['nasfam_regyear'] = $regYear1;
            
            
            
            header("Location: dashboard.php");
        }else{
            $_SESSION['nasfam_regyearID'] = $regID;
            $_SESSION['nasfam_regyear'] = $regYear1;
            
            header("Location: dashboard.php");
        }
    }
}

if(isset($_POST['addYear'])){
    $rowCount = count($_POST['years']); //number of ipcs
   
    for($i=0;$i<$rowCount;$i++){
        $startdate = $_POST['startdate'][$i]; //start date
        $enddate = $_POST['enddate'][$i]; //end date
        $season = $_POST['seasonname'][$i]; //season name
        
        $startdate1 = date("Y", strtotime($startdate));
        $enddate1 = date("Y", strtotime($enddate));
        
        echo $startdate.' '.$enddate.'<br>';
        echo $startdate1.' '.$enddate1.'<br>';

        //make sure year doesnt already exists
        $CheckYearExist = $dashboard->CheckYearExist($startdate1,$enddate1);
        if($CheckYearExist >= 1){ //exists, notify user
            echo 'exists';
        }else{ //doesnt exist, create new reg year
//            echo 'doesnt exist';
            $RegisterYear = $dashboard->RegisterRegYear($startdate,$enddate,$season);
        
            $SelectRegYear = $dashboard->ListRegYear();//get created default year
            $regYearID = $SelectRegYear[0][0];
        
            $createNewRegyesarDistrictTargets = $login_users->NewRegyearDistrictTargets($regYearID); //add districts to year in reg district
        
            $createDefaultTargets = $login_users->createDefaultTargets($regYearID); //add activity targets
        }  
    }
    header("Location: regyears.php");
}

if(isset($_POST['SearchDistrictReg'])){
    $regYear = $_POST['regyearDS'];
    //$regYear = $_SESSION['nasfam_regyearID'];
            //membership ----------------------------------------
    $lstMembers = $members->listAllMembersForYear($regYear);
    $tMales = $members->listMembersAllRegYearMales($regYear);
    //$tMales = $countMales[0][0];
    $tFemales = $members->listMembersAllRegYearFemales($regYear);
    //$tFemales = $countFemales[0][0];
    $tmembers = $tMales + $tFemales;
    
    //get target amount for district for that year
    $getItemTargetForYear = $members->getMemberTargetForYear($regYear);
    $membetTarget = $getItemTargetForYear[0][0];
    if($tmembers > 0){
        $Getmalepercentage = $tMales/$tmembers * 100;
         $Getfemalepercentage = $tFemales/$tmembers * 100;
         $malepercentage = round($Getmalepercentage);
         $femalepercentage = round($Getfemalepercentage);
         if($membetTarget > 0){
            $Getachievement = $tmembers / $membetTarget * 100;
             $achievement = round($Getachievement); 
         }else{
           $achievement = 0;  
         }
     }else{
        $malepercentage = 0;
         $femalepercentage = 0; 
         $achievement = 0;  
     }
    
    //districts IPCs ----------------------------------------------------
    $districts = $seasons->countDistricts('districts');//districts
    $ipcs = $seasons->countDistricts('ipc'); //ipcs
    $gacs = $seasons->countDistricts('gac'); //gacs
    $clubs = $seasons->countDistricts('clubs'); //clubs
    
    //shelling participation
    //none members
    $nonemembermale = $seasons->nonememberPartipation($regYear,'MALE'); //male
    $nonememberfemale = $seasons->nonememberPartipation($regYear,'FEMALE');//female
    $nonemembers = $nonememberfemale + $nonemembermale; //total none members
    
    //members
    $membermale = $seasons->memberPartipation($regYear,'MALE');
    $countMales = count($membermale);
    $memberfemale = $seasons->memberPartipation($regYear,'FEMALE');
    $countFemales = count($memberfemale);
    $members = $countMales + $countFemales;
    
    $participation = $members + $nonemembers;
    
    //shelling total summary
    $getSeasonHeader = $seasons->SeasonDetails($regYear);
    $procurement = $getSeasonHeader[0][5];
    $totalAmountSpent = $seasons->totalAmountSpent($regYear);
    $balancee = $procurement - $totalAmountSpent;

    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
}else{
    $regYear = $_SESSION['nasfam_regyearID'];
    //season --------------------------------------------
    
    //membership ----------------------------------------
    $lstMembers = $members->listAllMembersForYear($regYear);
    $tMales = $members->listMembersAllRegYearMales($regYear);

    $tFemales = $members->listMembersAllRegYearFemales($regYear);
    
    $tmembers = $tMales + $tFemales;
    
    //get target amount for district for that year
    $getItemTargetForYear = $members->getMemberTargetForYear($regYear);
    $membetTarget = $getItemTargetForYear[0][0];
    if($tmembers > 0){
        $Getmalepercentage = $tMales/$tmembers * 100;
         $Getfemalepercentage = $tFemales/$tmembers * 100;
         $malepercentage = round($Getmalepercentage);
         $femalepercentage = round($Getfemalepercentage);
         if($membetTarget > 0){
            $Getachievement = $tmembers / $membetTarget * 100;
             $achievement = round($Getachievement); 
         }else{
           $achievement = 0;  
         }
     }else{
        $malepercentage = 0;
         $femalepercentage = 0; 
         $achievement = 0;  
     }
    
    //districts IPCs ----------------------------------------------------
    $districts = $seasons->countDistricts('districts');//districts
    $ipcs = $seasons->countDistricts('ipc'); //ipcs
    $gacs = $seasons->countDistricts('gac'); //gacs
    $clubs = $seasons->countDistricts('clubs'); //clubs
    
    //shelling participation
    //none members
    $nonemembermale = $seasons->nonememberPartipation($regYear,'MALE'); //male
    $nonememberfemale = $seasons->nonememberPartipation($regYear,'FEMALE');//female
    $nonemembers = $nonememberfemale + $nonemembermale; //total none members
    
    //members
    $membermale = $seasons->memberPartipation($regYear,'MALE');
    $countMales = count($membermale);
    $memberfemale = $seasons->memberPartipation($regYear,'FEMALE');
    $countFemales = count($memberfemale);
    $members = $countMales + $countFemales;
    
    $participation = $members + $nonemembers;
    
    //shelling total summary
    $getSeasonHeader = $seasons->SeasonDetails($regYear);
    $procurement = $getSeasonHeader[0][5];
    $totalAmountSpent = $seasons->totalAmountSpent($regYear);
    $balancee = $procurement - $totalAmountSpent;

    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
    
    
}