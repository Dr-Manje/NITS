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

//list district members of reg year listMembersDistrictRegYear($district,$regYear)
if(isset($_POST['SearchDistrictReg'])){ //search button clicked
        $regYear = $_POST['regyearDS'];
        //get reg year display details
        $getRegYearDetails = $common->getRegYearDetails($regYear);
        $regYearName = $getRegYearDetails[0][1];
        $data = $members->listMembershipByRegYear($regYear);
        
        $lstMembership = array();
        foreach($data as $value){
            $mid = $value['mid'];
            
            // general information
            $ipcname = $value['ipcname']; //ipc
            $districtname = $value['districtname']; //district
            $ta = $value['ta']; //ta
            $gacname = $value['gacname']; //gac 
            $villageID = $value['village']; //get village          
            $getVillage = $districts->GetVillagebyID($villageID); //get village
            $villageName = $getVillage[0][1]; //village name
            $villageHeadman = $getVillage[0][2]; //village head man   
            $assocname = $value['assocname']; //association
            $clubname = $value['clubname']; //club name
            $tccreg = $value['tccregno']; //tcc reg
            
            // member details
            $membername = $value['membername']; //member name
            $gender = $value['gender']; //gender
            $dob = $value['dob']; //year of birth
            $age = $value['age']; //age
            $hhsize = $value['hh']; //hh size
            
            //crops grown
            //select member of crops grown
            $getMembercrops = $members->GetmemberCropDetails($mid);
            $crop1 = $getMembercrops[0][0];
            $crop1Acreage = $getMembercrops[0][1];
            $crop2 = $getMembercrops[1][0];
            $crop2Acreage = $getMembercrops[1][1];
            $crop3 = $getMembercrops[2][0];
            $crop3Acreage = $getMembercrops[2][1];
            
            $gvc = $value['gvc'];//GVC
            
            $rtype = $value['rtype']; //year of birth
            $wtype = $value['wtype']; //age
            $ftype = $value['ftype']; //hh size
            
            $cropsales = $value['cropsales']; //age
            $othersources = $value['othersources']; //hh size
            
            $nwf = $value['nwf']; //age
            $cm = $value['cm']; //hh size
            
            //get livestock
            $getMemberlvts = $members->GetmemberLivestockDetails($mid);
            $lvt1 = $getMemberlvts[0][0];
            $lvt1qty = $getMemberlvts[0][1];
            $lvt2 = $getMemberlvts[1][0];
            $lvt2qty = $getMemberlvts[1][1];
            $lvt3 = $getMemberlvts[2][0];
            $lvt3qty = $getMemberlvts[2][1];
            
            $memberinfo = array();
            array_push($memberinfo, $ipcname);
            array_push($memberinfo, $districtname);
            array_push($memberinfo, $ta);
            array_push($memberinfo, $gacname);
            array_push($memberinfo, $villageName);
            array_push($memberinfo, $villageHeadman);
            array_push($memberinfo, $assocname);
            array_push($memberinfo, $clubname);
            array_push($memberinfo, $tccreg);
            
            array_push($memberinfo, $membername);
            array_push($memberinfo, $gender);
            array_push($memberinfo, $dob);
            array_push($memberinfo, $age);
            array_push($memberinfo, $hhsize);
            
            array_push($memberinfo, $crop1);
            array_push($memberinfo, $crop1Acreage);
            array_push($memberinfo, $crop2);
            array_push($memberinfo, $crop2Acreage);
            array_push($memberinfo, $crop3);
            array_push($memberinfo, $crop3Acreage); 
                    
            array_push($memberinfo, $gvc);
            
            array_push($memberinfo, $rtype);
            array_push($memberinfo, $wtype);
            array_push($memberinfo, $ftype);
            
            array_push($memberinfo, $cropsales);
            array_push($memberinfo, $othersources);
            
            array_push($memberinfo, $lvt1);
            array_push($memberinfo, $lvt1qty);
            array_push($memberinfo, $lvt2);
            array_push($memberinfo, $lvt2qty);
            array_push($memberinfo, $lvt3);
            array_push($memberinfo, $lvt3qty);
            
            array_push($memberinfo, $nwf);
            array_push($memberinfo, $cm);
            
            array_push($lstMembership, $memberinfo);
        }

    }else{
        $regYear = $_SESSION['nasfam_regyearID']; 
        
        //get reg year display details
        $getRegYearDetails = $common->getRegYearDetails($regYear);
        $regYearName = $getRegYearDetails[0][1];
            
        $data = $members->listMembershipByRegYear($regYear);
        
        $lstMembership = array();
        foreach($data as $value){
            $mid = $value['mid'];
            
            // general information
            $ipcname = $value['ipcname']; //ipc
            $districtname = $value['districtname']; //district
            $ta = $value['ta']; //ta
            $gacname = $value['gacname']; //gac 
            $villageID = $value['village']; //get village          
            $getVillage = $districts->GetVillagebyID($villageID); //get village
            $villageName = $getVillage[0][1]; //village name
            $villageHeadman = $getVillage[0][2]; //village head man   
            $assocname = $value['assocname']; //association
            $clubname = $value['clubname']; //club name
            $tccreg = $value['tccregno']; //tcc reg
            
            // member details
            $membername = $value['membername']; //member name
            $gender = $value['gender']; //gender
            $dob = $value['dob']; //year of birth
            $age = $value['age']; //age
            $hhsize = $value['hh']; //hh size
            
            //crops grown
            //select member of crops grown
            $getMembercrops = $members->GetmemberCropDetails($mid);
            $crop1 = $getMembercrops[0][0];
            $crop1Acreage = $getMembercrops[0][1];
            $crop2 = $getMembercrops[1][0];
            $crop2Acreage = $getMembercrops[1][1];
            $crop3 = $getMembercrops[2][0];
            $crop3Acreage = $getMembercrops[2][1];
            
            $gvc = $value['gvc'];//GVC
            
            $rtype = $value['rtype']; //year of birth
            $wtype = $value['wtype']; //age
            $ftype = $value['ftype']; //hh size
            
            $cropsales = $value['cropsales']; //age
            $othersources = $value['othersources']; //hh size
            
            $nwf = $value['nwf']; //age
            $cm = $value['cm']; //hh size
            
            //get livestock
            $getMemberlvts = $members->GetmemberLivestockDetails($mid);
            $lvt1 = $getMemberlvts[0][0];
            $lvt1qty = $getMemberlvts[0][1];
            $lvt2 = $getMemberlvts[1][0];
            $lvt2qty = $getMemberlvts[1][1];
            $lvt3 = $getMemberlvts[2][0];
            $lvt3qty = $getMemberlvts[2][1];
            
            $memberinfo = array();
            array_push($memberinfo, $ipcname);
            array_push($memberinfo, $districtname);
            array_push($memberinfo, $ta);
            array_push($memberinfo, $gacname);
            array_push($memberinfo, $villageName);
            array_push($memberinfo, $villageHeadman);
            array_push($memberinfo, $assocname);
            array_push($memberinfo, $clubname);
            array_push($memberinfo, $tccreg);
            
            array_push($memberinfo, $membername);
            array_push($memberinfo, $gender);
            array_push($memberinfo, $dob);
            array_push($memberinfo, $age);
            array_push($memberinfo, $hhsize);
            
            array_push($memberinfo, $crop1);
            array_push($memberinfo, $crop1Acreage);
            array_push($memberinfo, $crop2);
            array_push($memberinfo, $crop2Acreage);
            array_push($memberinfo, $crop3);
            array_push($memberinfo, $crop3Acreage); 
                    
            array_push($memberinfo, $gvc);
            
            array_push($memberinfo, $rtype);
            array_push($memberinfo, $wtype);
            array_push($memberinfo, $ftype);
            
            array_push($memberinfo, $cropsales);
            array_push($memberinfo, $othersources);
            
            array_push($memberinfo, $lvt1);
            array_push($memberinfo, $lvt1qty);
            array_push($memberinfo, $lvt2);
            array_push($memberinfo, $lvt2qty);
            array_push($memberinfo, $lvt3);
            array_push($memberinfo, $lvt3qty);
            
            array_push($memberinfo, $nwf);
            array_push($memberinfo, $cm);
            
            array_push($lstMembership, $memberinfo);
        }
}