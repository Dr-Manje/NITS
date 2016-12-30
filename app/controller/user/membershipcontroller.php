<?php

if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}
        
include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/membersmodel.php');
include_once ('../../model/user/cropsmodel.php');
include_once ('../../model/user/livestockmodel.php');
include_once ('../../model/user/activitiesmodel.php');
include_once ('../../model/user/seedsmodel.php');
include_once ('../../model/user/treesmodel.php');
include_once ('../../model/user/districtsmodel.php');

$login_users = new usersmodel();
$dashboard = new dashmodel();
$members = new membersmodel();
$crops = new cropsmodel();
$livestock = new livestockmodel();
$activities = new activitiesmodel();
$seeds = new seedsmodel();
$trees = new treesmodel();
$districts = new districtsmodel();

$common = new usersmodel();

$datetime_var = new DateTime();

$listregYear = $dashboard->ListRegYear();

//list ipcs
$lstIPCs = $members->LstIPCs();

//list clubs
$lstclubs = $members->LstClubs();

//list trees
$listTrees = $trees->listTrees();

//list districts
$lstDistricts = $districts->listDistricts();

//list district members of reg year listMembersDistrictRegYear($district,$regYear)
if(isset($_POST['SearchDistrictReg'])){ //search button clicked
    //echo 'Search button clicked <br>';
    $regYear = $_POST['regyearDS'];
    //echo 'Reg year ID: '.$regYear;
    
    //list members default
        if($_SESSION['nasfam_usertype'] == '1'){
            //$regYear = $_SESSION['nasfam_regyearID'];
            $lstMembers = $members->listAllMembersForYear($regYear); 
            
            //get reg year display details
            $getRegYearDetails = $common->getRegYearDetails($regYear);
            $regYearName = $getRegYearDetails[0][1];
//            
            $countMales = $members->listMembersAllRegYearMales($regYear);
            $tMales = $countMales[0][0];
            $countFemales = $members->listMembersAllRegYearFemales($regYear);
            $tFemales = $countFemales[0][0];
//
            $tmembers = $tMales + $tFemales;
//            
            //get target amount for district for that year
            $getItemTargetForYear = $members->getMemberTargetForYear($regYear);
            $membetTarget = $getItemTargetForYear[0][0];
        }else{
            $userDistrict = $_SESSION['nasfam_userid'];
            $getUserDistrict = $common->getUserDistrict($userDistrict);
            $district = $getUserDistrict[0][1];

            //$regYear = $_SESSION['nasfam_regyearID'];
            $lstMembers = $members->listMembersDistrictRegYear($district,$regYear);
            
            //get reg year display details
            $getRegYearDetails = $common->getRegYearDetails($regYear);
            $regYearName = $getRegYearDetails[0][1];

            $countMales = $members->listMembersDistrictRegYearMales($district,$regYear); //females
            $tMales = $countMales[0][0];
            $countFemales = $members->listMembersDistrictRegYearFemales($district,$regYear); //males
            $tFemales = $countFemales[0][0];

            $tmembers = $tMales + $tFemales;

            //get district name
            $getDistrictDetails = $members->getDistrictDetails($district);
            $districtName = $getDistrictDetails[0][2];

            //get target amount for district for that year
            $getItemTargetForYear = $members->getItemTargetForYear($district,$regYear);
            $membetTarget = $getItemTargetForYear;
        }

    }else{
        //list members default
        if($_SESSION['nasfam_usertype'] == '1'){
            $regYear = $_SESSION['nasfam_regyearID'];
            $lstMembers = $members->listAllMembersForYear($regYear); 
            
            //get reg year display details
            $getRegYearDetails = $common->getRegYearDetails($regYear);
            $regYearName = $getRegYearDetails[0][1];
//            
            $countMales = $members->listMembersAllRegYearMales($regYear);
            $tMales = $countMales[0][0];
            $countFemales = $members->listMembersAllRegYearFemales($regYear);
            $tFemales = $countFemales[0][0];
//
            $tmembers = $tMales + $tFemales;
//            
            //get target amount for district for that year
            $getItemTargetForYear = $members->getMemberTargetForYear($regYear);
            $membetTarget = $getItemTargetForYear[0][0];
        }else{
            $userDistrict = $_SESSION['nasfam_userid'];
            $getUserDistrict = $common->getUserDistrict($userDistrict);
            $district = $getUserDistrict[0][1];

            $regYear = $_SESSION['nasfam_regyearID'];
            $lstMembers = $members->listMembersDistrictRegYear($district,$regYear);
            
            //get reg year display details
            $getRegYearDetails = $common->getRegYearDetails($regYear);
            $regYearName = $getRegYearDetails[0][1];

            $countMales = $members->listMembersDistrictRegYearMales($district,$regYear); //females
            $tMales = $countMales[0][0];
            $countFemales = $members->listMembersDistrictRegYearFemales($district,$regYear); //males
            $tFemales = $countFemales[0][0];

            $tmembers = $tMales + $tFemales;

            //get district name
            $getDistrictDetails = $members->getDistrictDetails($district);
            $districtName = $getDistrictDetails[0][2];

            //get target amount for district for that year
            $getItemTargetForYear = $members->getItemTargetForYear($district,$regYear);
            $membetTarget = $getItemTargetForYear;
        }
}