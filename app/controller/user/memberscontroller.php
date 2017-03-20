<?php
//session_start();
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

//list donors
$lstDonors = $districts->listDonors();


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

//member tree planting ---------------------------------------------------------------
//add tree planting to member
if(isset($_POST['AddTreePlanting'])){
   // echo 'Add trees planted hami!<br>';
    $memberID = $_POST['AddTreememberID']; //memberID
    $activityID = $_POST['ActivityID']; //activityID
    
    //memberprofile.php?Sid=1
    
    //echo 'Member ID: '.$memberID.'<br> Activity ID: '.$activityID;
    
    $rowCount = count($_POST['treeplantings']);
    
    echo 'number of items selected '.$rowCount.'<br><hr>';
    //check if tree planting has already been entered
    $gCheckifMemberPlantedTrees = $members->CheckifMemberPlantedTrees($memberID,$activityID);
    if($gCheckifMemberPlantedTrees == 0){
        echo 'no records found<br>';
        //add trees planted to member activities            
        $AddMemberNumber = $members->AddTreePlantingForMember($memberID,$activityID);
        
        //retrive current memberactivitiesID 
        $getRecentMemberActivities = $members->getRecentMemberActivities();
        $memberactivitiesID = $getRecentMemberActivities[0][0];
        
        
        for($i=0;$i<$rowCount;$i++){
        $treetype = $_POST['treetype'][$i]; //tree type
        $notrees = $_POST['numberoftrees'][$i]; //number of trees
        $remarks = $_POST['treeremarks'][$i]; //remarks
        
        //enter activity items
        $AddTreePlantingItemsForMember = $members->AddTreePlantingItemsForMember($memberactivitiesID,$treetype,$notrees,$remarks);
            if($AddTreePlantingItemsForMember == 1){
                echo 'All gravy';
            }else{
                echo 'zero';
            }
        }
       header("Location: memberprofile.php?Sid=$memberID ");
    }else{
        echo 'Records found<br>';
        //add trees planted to member activities            
        
        //retrive current memberactivitiesID 
        $getMemberActivities = $members->getMemberActivitiesID($memberID,$activityID);
        $memberactivitiesID = $getMemberActivities[0][0];
        
        echo 'Member Activities ID: '.$memberactivitiesID;
        
        for($i=0;$i<$rowCount;$i++){
        $treetype = $_POST['treetype'][$i]; //tree type
        $notrees = $_POST['numberoftrees'][$i]; //number of trees
        $remarks = $_POST['treeremarks'][$i]; //remarks
        
        //enter activity items
        $AddTreePlantingItemsForMember = $members->AddTreePlantingItemsForMember($memberactivitiesID,$treetype,$notrees,$remarks);
            if($AddTreePlantingItemsForMember == 1){
                echo 'All gravy';
            }else{
                echo 'zero';
            }
        }
        header("Location: memberprofile.php?Sid=$memberID ");
    }   
}

//edit tree planting details
if(isset($_POST['Updatetpmember'])){
    $memberID = $_POST['memberID'];//memberID
    $tpeditID = $_POST['tpeditID'];//cropeditID where clause
    
    //new data
    $edittreetype = $_POST['edittreetype'];//cropedit
    $viewnotrees = $_POST['viewnotrees'];//acreageedit
    $viewtreedetails = $_POST['viewtreedetails']; //viewtreedetails
    

    $UpdateMemberTP = $trees->UpdateMemberTP($tpeditID,$edittreetype,$viewnotrees,$viewtreedetails);
    header("Location: memberprofile.php?Sid=$memberID ");   
}

//delete tree planting details
if(isset($_POST['deletetpmember'])){
    $memberID = $_POST['memberID'];//memberID
    $tpdeleteID = $_POST['tmdeleteID'];//cropeditID where clause
    
    $DeleteMemberTP = $trees->DeleteMemberTP($tpdeleteID);
    if($DeleteMemberTP == 1){
        header("Location: memberprofile.php?Sid=$memberID ");
    }
}
//end member tree planting ---------------------------------------------------------------

//add district
if(isset($_POST['addDistrict'])){
    $rowCount = count($_POST['districts']);
    
    echo 'number of items selected '.$rowCount.'<br>';
    
    for($i=0;$i<$rowCount;$i++){
        $tname = $_POST['Dname'][$i];
        $tcode = $_POST['Dcode'][$i];
        $tprfx = $_POST['Dprfx'][$i];
               
        $checkDuplicateDistricts = $districts->checkDuplicateDistricts($tcode); //check duplicates
        if($checkDuplicateDistricts == 1){
            $duplicate = $tcode;
            $duplicate2 = $tname;
            $_SESSION['errormsg'] .= 'Duplicate Item '.$duplicate2.' code: '.$duplicate.'<br>';
        }else{
            $AddDistricte = $districts->addDistricts($tname,$tcode,$tprfx);//add ipc
        }
    }
    if(isset($_SESSION['errormsg'])){
       echo $_SESSION['errormsg'];
    }    
    header("Location: hq.php");
}

//add tree
if(isset($_POST['addTree'])){
    $rowCount = count($_POST['trees']);
    
    echo 'number of items selected '.$rowCount.'<br>';
    
    for($i=0;$i<$rowCount;$i++){
        $tname = $_POST['treesname'][$i];
        $tcode = $_POST['treescode'][$i];
               
        $checkDuplicateTrees = $trees->checkDuplicateTrees($tcode); //check duplicates
        if($checkDuplicateTrees == 1){
            $duplicate = $tcode;
            $duplicate2 = $tname;
            //$_SESSION['errormsg'] = '<strong>The IPCs entered had the following duplicate entries</strong><br>';
            $_SESSION['errormsg'] .= 'Duplicate Item '.$duplicate2.' code: '.$duplicate.'<br>';
        }else{
            $Addtree = $trees->addTrees($tname, $tcode);//add ipc
        }
    }
    if(isset($_SESSION['errormsg'])){
       echo $_SESSION['errormsg'];
    }    
    header("Location: hq.php");
}

// add ipc
if(isset($_POST['addIPC'])){
    $rowCount = count($_POST['ipcs']);
    
    echo 'number of items selected '.$rowCount.'<br>';
    
    for($i=0;$i<$rowCount;$i++){
        $ipcname = $_POST['ipcname'][$i];
        $ipccode = $_POST['ipccode'][$i];
               
        $checkDuplicateIPC = $members->checkDuplicateIPC($ipccode); //check duplicates
        if($checkDuplicateIPC == 1){
            $duplicate = $ipccode;
            $duplicate2 = $ipcname;
            //$_SESSION['errormsg'] = '<strong>The IPCs entered had the following duplicate entries</strong><br>';
            $_SESSION['errormsg'] .= 'Duplicate Item '.$duplicate2.' code: '.$duplicate.'<br>';
        }else{
            $Addipc = $members->Addipc($ipcname,$ipccode); //add ipc
        }
    }
    if(isset($_SESSION['errormsg'])){
       echo $_SESSION['errormsg'];
    }    
    header("Location: hq.php");
}

//Add individual Member
if(isset($_POST['addMember'])){
    $datetime_var = new DateTime();
    $dateCreated = date_format($datetime_var, 'Y-m-d H:i:s');
    //echo 'we are reworking this part bro';
    $yearRegistered = $_POST['regyear']; //district
    
    $userDistrict = $_SESSION['nasfam_userid'];
    $getUserDistrict = $common->getUserDistrict($userDistrict);
    $district = $getUserDistrict[0][1];
    $districtPrfx =  $getUserDistrict[0][2]; 
    
    $rowCount = count($_POST['members']);
    
    echo 'number of items selected '.$rowCount.'<br><hr>';
    
    for($i=0;$i<$rowCount;$i++){
        $names = $_POST['names'][$i];
        $lastname = $_POST['lastname'][$i];
        $gender = $_POST['gender'][$i];
        $dateofbirth = $_POST['dateofbirth'][$i];
        $hhsize = $_POST['hhsize'][$i];
        $club = $_POST['club'][$i];
        
        //get member number
        //get recent number
        $getMemberNumber = $members->GetRecentMembernumberCounter($district);
        
        if($getMemberNumber == 0){
            echo 'no members<br>';
                       //get member prefix
            $Mcount = 1;
            $newMemberNumber = $districtPrfx.''.$Mcount;
            echo 'new member number :'.$newMemberNumber.'<hr>'; 
            $AddMemberNumber = $members->AddMemberNumber($newMemberNumber,$district,$dateCreated,$Mcount);
        }else{
            echo 'Members<br>';
            $getMemberNumber1 = $members->GetRecentMemberCounter($district);
            $Mcount = $getMemberNumber1[0][0] + 1;
            $newMemberNumber = $districtPrfx.''.$Mcount;
            echo 'member number :'.$newMemberNumber.'<hr>';
            //add member
            $AddMemberNumber = $members->AddMemberNumber($newMemberNumber,$district,$dateCreated,$Mcount);
        }

        
        $addMember = $members->RegisterMemberInitial($names,$lastname,$gender,$yearRegistered,$dateofbirth,$hhsize,$newMemberNumber,$club,$district);
        if($addMember == 1){
        //get recent entered member
        $getMemberDetails = $members->RecentMemberDetails();
        $memberID = $getMemberDetails[0][0];
        $memberNumber1 = $getMemberDetails[0][1];
            
        $RegisterMemberToRegYear = $members->RegisterMemberToRegYear($yearRegistered,$memberID,$memberNumber1);
        if($RegisterMemberToRegYear == 1){
            header("Location: members.php"); 
        }
        }
//    
//    $randeecode = $login_users->generateRandomString();
//    $memberNumber = $randeecode;
//    
 
    }
}

//Add Members in bulk
if(isset($_POST['uploadBulkMembers']))
{
    $datetime_var = new DateTime();
    $fname = $_FILES['file']['name'];
    $yearRegistered = $_POST['regyearBulk'];
    //echo $file;
    echo 'Upload file name: '.$fname.' <br>';
    $chk_ext = explode(".", $fname);
    
    $dateCreated = date_format($datetime_var, 'Y-m-d H:i:s');
    
    $userDistrict = $_SESSION['nasfam_userid'];
    $getUserDistrict = $common->getUserDistrict($userDistrict);
    $district = $getUserDistrict[0][1];
    $districtPrfx =  $getUserDistrict[0][2];
    
    if(strtolower(end($chk_ext)) == "csv")
    {
        $filename = $_FILES['file']['tmp_name'];
        $handle = fopen($filename, "r");
        
        fgetcsv($handle, 1000, ","); //abandon the first record 
        while(($data = fgetcsv($handle, 1000, ",")) !== false)
        {               
            $getnames = $data[0];
            $getlastname = $data[1];
            $names = strtoupper($getnames);
            $lastname = strtoupper($getlastname);
            $getgender = $data[2];
            $gender = strtoupper($getgender);            
            $dob = $data[3];
            $hhsize = $data[4];            
            $getclub = $data[5];
            
            $cropsales = $data[6]; //crop sales 6
            $osources = $data[7]; //other sources 7
            $gvc = $data[8]; //gvc 8
            $mwf = $data[9]; //mwf 9
            $ftype = strtoupper($data[22]); //ftype 22
            $rtype = strtoupper($data[23]); //rtype 23
            $wtype = strtoupper($data[24]); //wtype 24
                        
            //get club id
            $GetClubDetailsClubCode = $districts->GetClubDetailsClubCode($getclub);
            $club = $GetClubDetailsClubCode[0][0];
            $clubname = $GetClubDetailsClubCode[0][1];
            
            $dateofbirth = date("Y-m-d H:i:s", strtotime($dob));
            //get member number
            
            $getMemberNumber = $members->GetRecentMembernumberCounter($district); //get recent number
            
            if($getMemberNumber == 0){
            echo 'no members<br>';
            //get member prefix
            $Mcount = 1;
            $newMemberNumber = $districtPrfx.''.$Mcount;
            echo 'new member number :'.$newMemberNumber.'<hr>'; 
            $AddMemberNumber = $members->AddMemberNumber($newMemberNumber,$district,$dateCreated,$Mcount);
            }else{
                echo 'Members<br>';
                $getMemberNumber1 = $members->GetRecentMemberCounter($district);
                $Mcount = $getMemberNumber += 1;
                $newMemberNumber = $districtPrfx.''.$Mcount;
                echo 'member number :'.$newMemberNumber.'<hr>';
                //add member
                $AddMemberNumber = $members->AddMemberNumber($newMemberNumber,$district,$dateCreated,$Mcount);
            }
            
            $addMember = $members->RegisterMemberInitial($names,$lastname,$gender,$yearRegistered,$dateofbirth,$hhsize,$newMemberNumber,$club,$district,$cropsales,$osources,$gvc,$mwf,$ftype,$rtype,$wtype);
            if($addMember == 1){
            //get recent entered member
            $getMemberDetails = $members->RecentMemberDetails();
            $memberID = $getMemberDetails[0][0];
            $memberNumber1 = $getMemberDetails[0][1];

            $RegisterMemberToRegYear = $members->RegisterMemberToRegYear($yearRegistered,$memberID,$memberNumber1);
            
            //add crop details
            $crop1 = $data[10]; //get crop 1
            $crop1Acreage = $data[11];
            $getCrop1 = $crops->getCropID($crop1);
            $crop1id = $getCrop1[0][0];
            if($crop1id == NULL){ //if doesnt don't add
              
            }else{ //if crop exists add
                $addCropMembers = $crops->addMemberCrop($memberID, $crop1id, $crop1Acreage);
            }
            
            //get crop 2
            $crop2 = $data[12]; //get crop 1
            $crop2Acreage = $data[13];
            $getCrop2 = $crops->getCropID($crop2);
            $crop2id = $getCrop2[0][0];
            if($crop2id == NULL){ //if doesnt don't add
              
            }else{ //if crop exists add
                $addCropMembers = $crops->addMemberCrop($memberID, $crop2id, $crop2Acreage);
            }
            
            //get crop 3
            $crop3 = $data[14]; //get crop 1
            $crop3Acreage = $data[15];
            $getCrop3 = $crops->getCropID($crop3);
            $crop3id = $getCrop3[0][0];
            if($crop3id == NULL){ //if doesnt don't add
              
            }else{ //if crop exists add
                $addCropMembers = $crops->addMemberCrop($memberID, $crop3id, $crop3Acreage);
            }
            
            //add livestock details
            //livestock 1
            $lvt1 = $data[16]; //get crop 1
            $lvt1qty = $data[17];
            $getlvt1 = $livestock->getLivestockID($lvt1);
            $lvt1id = $getlvt1[0][0];
            if($lvt1id == NULL){ //if doesnt don't add
              
            }else{ //if crop exists add
                $addMemberLivestock = $livestock->addMemberLivestock($memberID, $lvt1id, $lvt1qty);
            }
            
            //livestock 2
            $lvt2 = $data[18]; //get crop 1
            $lvt2qty = $data[19];
            $getlvt2 = $livestock->getLivestockID($lvt2);
            $lvt2id = $getlvt2[0][0];
            if($lvt2id == NULL){ //if doesnt don't add
              
            }else{ //if crop exists add
                $addMemberLivestock = $livestock->addMemberLivestock($memberID, $lvt2id, $lvt2qty);
            }
            
            //livestock 3
            $lvt3 = $data[20]; //get crop 1
            $lvt3qty = $data[21];
            $getlvt3 = $livestock->getLivestockID($lvt3);
            $lvt3id = $getlvt3[0][0];
            if($lvt3id == NULL){ //if doesnt don't add
              
            }else{ //if crop exists add
                $addMemberLivestock = $livestock->addMemberLivestock($memberID, $lvt3id, $lvt3qty);
            }
            
            } 
        }
        fclose($handle);
        header("Location: members.php");
    }
    else
    {
        echo 'Invalid file';
    } 
}

//get member details
if(Isset($_GET['Sid'])){
    $id = $_GET['Sid'];
    
    //get member season

    //list seeds
    $lstSeeds = $seeds->listSeeds();
    
    //list villages
    $lstVillages = $members->listVillages();
    
    //list clubs
    $lstClubs = $members->listClubs();
    
    //get member profile personal details
    $personalDetails = $members->MemberPersonalDetails($id);
    $memberProfID = $personalDetails[0][6];
    $memberregyear = $personalDetails[0][8];

    //get general info
    //IPC data
    $IPCdata = $members->MemberIPCDetails($id);
    $Mdistrict = $IPCdata[0][4]; //district
    $Mipc = $IPCdata[0][3];//IPC
    $Massoc = $IPCdata[0][2];//association
    $Mgac = $IPCdata[0][1];//gac
    $Mclub = $IPCdata[0][0];//club
    $MclubCode = $IPCdata[0][5]; //club code
    $season = $IPCdata[0][6]; //season
    //$generalInfo = $members->MemberGeneralInfo($id);
    
    $ta = $personalDetails[0][10];
    $tcc = $personalDetails[0][11];
    
    //village info
    $villageInfo = $members->MemberVillageInfo($id);
    if(empty($villageInfo)){
        $villageName = 'N/A';
        $villagehead = 'N/A';
        $villagecode = 'N/A';
    }else{
       $villageName = $villageInfo[0][0];
        $villagehead = $villageInfo[0][1];
        $villagecode = $villageInfo[0][2]; 
    }
    
    
    //get annual info and food security
    $AnnualAndFoodInfo = $members->MemberAnnualAndFoodInfo($id);
    
    //type of house
    
    //get member crop info
    $memberCropInfo = $members->MemberCropDetails($id);
    $NoCrops = count($memberCropInfo);
    
    //select crop list
    $lstcrops = $crops->listCrops();
    
    //get member livestock info
    $memberLivestock = $members->MemberLivestockDetails($id);
    $NoLivestock = count($memberLivestock);
    
    //select livestock list
    $lstLivestock = $livestock->listLivestock();
    
    //get member seed distribution info
    $lstMemberSeedsDistribution = $seeds->listMemberSeedDistribution($id);
    
    //get member crop marketing info
    $lstcropsMarketing = $crops->getCropMarketingMember($id);
    
    //get member activities info
    $memberActivities = $members->MemberActivitiesDetails($id);
    
    //select activities list
    $lstActivities = $activities->listActivities();
    
    //list tree planting info
    $listMemberTreePlantingItems = $activities->listMemberTreePlantingItems($id);
    
    
    
}

//update member details
//update personal info
if(isset($_POST['updatePersonalInfo'])){
    $memberID = $_POST['memberID'];
    $viewfname = $_POST['viewfname'];
    $viewlname = $_POST['viewlname'];
    $editgender = $_POST['editgender'];
    $dob = $_POST['viewdob'];
    $viewhh = $_POST['viewhh'];
    $viewgvh = $_POST['viewgvh'];
    
    $viewdob = date("Y-m-d H:i:s", strtotime($dob));
    
    $update = $members->UpdatePersonalInfo($memberID,$viewfname,$viewlname,$editgender,$viewdob,$viewhh,$viewgvh);
    if($update == 1){
        header("Location: memberprofile.php?Sid=$memberID ");
        echo 'DONE';
    }else{
        echo 'Something Went wrong';
    }
}

//update general info
if(isset($_POST['updateGeneralInfo'])){
    $memberID = $_POST['GeneralInfomemberID'];
    $getviewta = $_POST['viewta'];
    $viewtcc = $_POST['viewtcc'];
    $viewvillage = $_POST['viewvillage'];
    $viewclub = $_POST['viewclub'];
    
    $viewta = strtoupper($getviewta);
    //$viewtcc = strtoupper($getviewtcc);
    
    //get club id with club code
    $GetClubDetailsClubCode = $districts->GetClubDetailsClubCode($viewclub);
    $clubid = $GetClubDetailsClubCode[0][0];  
    echo 'member id: '.$memberID.'<br>';
    echo 'club id: '.$clubid.'<br>';
    
    //get village id with village code
    $GetVillageDetailsClubCode = $districts->GetVillageDetailsClubCode($viewvillage);
    $villageid = $GetVillageDetailsClubCode[0][0];
    echo 'village id: '.$villageid.'<br>';
    
    //update club
    $updateClub = $members->UpdateMemberClub($memberID,$clubid);
    if($updateClub == 1){
        echo 'club update success<br>';
        //enter village details
        //update club
        $updateVillage = $members->UpdateMemberVillage($memberID,$villageid);
        if($updateVillage == 1){
            echo 'village update success';
            //update TCC and TA
            $update = $members->UpdateGeneralInfo($memberID,$viewta,$viewtcc);
            if($update == 1){
                header("Location: memberprofile.php?Sid=$memberID ");
            }else{
                echo 'something went wrong';
                header("Location: memberprofile.php?Sid=$memberID ");
            }
        }else{ //update failed
            echo 'village update failed';
            header("Location: memberprofile.php?Sid=$memberID ");
        }
    }else{ //update failed
        echo 'club update failed<br>';
        header("Location: memberprofile.php?Sid=$memberID ");
    }
}

//update annual income
if(isset($_POST['updateAnnualIncome'])){
    $memberID = $_POST['AnnualIncomememberID'];
    $viewcropsale = $_POST['viewcropsale'];
    $viewsources = $_POST['viewsources'];
    
    $update = $members->UpdateAnnualInfo($memberID,$viewcropsale,$viewsources);
    if($update == 1){
        header("Location: memberprofile.php?Sid=$memberID ");
    }
}

//update food security
if(isset($_POST['updateFoodSecurity'])){
    $memberID = $_POST['FoodSecuritymemberID'];
    $viewmonths = $_POST['viewmonths'];
    $viewmechanism = $_POST['viewmechanism'];    
    
    $update = $members->UpdateFoodSecurityInfo($memberID,$viewmonths,$viewmechanism);
    if($update == 1){
        header("Location: memberprofile.php?Sid=$memberID ");
    } 
}

//update house info
if(isset($_POST['updateHouseInfo'])){
    $memberID = $_POST['HouseInfomemberID'];
    $rtype = $_POST['rtype'];
    $wtype = $_POST['wtype'];
    $ftype = $_POST['ftype'];
    
    $update = $members->UpdateHouseInfo($memberID,$rtype,$wtype,$ftype);
    if($update == 1){
        header("Location: memberprofile.php?Sid=$memberID ");
    }
}

//member profile crops ---------------------------------------------------------------
//add crops to member
if(isset($_POST['AddCropmember'])){
    
    $memberID = $_POST['AddCropID']; //memberID
   
    $rowCount = count($_POST['crops']);
    
    for($i=0;$i<$rowCount;$i++){
        $crop = $_POST['crop'][$i]; //tree type
        $acreage = $_POST['acreage'][$i]; //number of trees
       
        //check if entry exists
        $gCheckif = $crops->CheckifMemberAlreadyHasCrop($memberID,$crop);
        if($gCheckif == 0){
            $addCropMembers = $crops->addMemberCrop($memberID, $crop, $acreage);
        }else{
            $UpdateMemberCrop = $crops->UpdateMemberCrop($memberID,$crop,$acreage);
        }
    }
       header("Location: memberprofile.php?Sid=$memberID ");

    
}

//update crop member
if(isset($_POST['UpdateCropmember'])){
    $memberID = $_POST['memberID'];//memberID
    $cropeditID = $_POST['cropeditID'];//cropeditID where clause
    
    //new data
    //$cropedit = $_POST['cropedit'];//cropedit
    $acreageedit = $_POST['acreageedit'];//acreageedit
    
    //echo 'Update crop members: <br>';
    //echo 'Crop id: '.$cropedit.' <br> Acreage: '.$acreageedit.'<br> Member ID: '.$memberID.'<br> where :'.$cropeditID;
    

        $UpdateMemberCropfull = $crops->UpdateMemberCropfull($cropeditID,$acreageedit);
        header("Location: memberprofile.php?Sid=$memberID ");   
}

if(isset($_POST['deleteCropmember'])){
    $memberID = $_POST['memberID'];//memberID
    $cropdeleteID = $_POST['cropdeleteID'];//cropeditID where clause
    
    $deleteMemberCrop = $crops->deleteMemberCrop($cropdeleteID);
    if($deleteMemberCrop == 1){
        header("Location: memberprofile.php?Sid=$memberID ");
    }
}

//END member profile crops ---------------------------------------------------------------

//member profile Livestock ---------------------------------------------------------------
//add livestock to member
if(isset($_POST['AddLivestockmember'])){
    
    $memberID = $_POST['AddLivestockID']; //memberID
   
    $rowCount = count($_POST['livestocks']);
    
    for($i=0;$i<$rowCount;$i++){
        $livestock1 = $_POST['livestock'][$i]; //tree type
        $quantity = $_POST['quantity'][$i]; //number of trees
       
        //check if entry exists
        $gCheckif = $livestock->CheckifMemberAlreadyHasLivestock($memberID, $livestock1);
        if($gCheckif == 0){
            $addMemberLivestock = $livestock->addMemberLivestock($memberID, $livestock1, $quantity);
        }else{
            $UpdateMemberLivestock = $livestock->UpdateMemberLivestock($memberID,$livestock1,$quantity);
        }
    }
       header("Location: memberprofile.php?Sid=$memberID ");

    
}

//update livestock member
if(isset($_POST['UpdateLivestockmember'])){
    $memberID = $_POST['memberID'];//memberID
    $livestockeditID = $_POST['livestockeditID'];//cropeditID where clause
    
    //new data
    //$cropedit = $_POST['cropedit'];//cropedit
    $Quantityedit = $_POST['Quantityedit'];//acreageedit livestockeditID
    
    $UpdateMemberLivestockfull = $livestock->UpdateMemberLivestockfull($livestockeditID,$Quantityedit);
    header("Location: memberprofile.php?Sid=$memberID ");   
}

//delete member livestock
if(isset($_POST['deleteLivestockmember'])){
    $memberID = $_POST['memberID'];//memberID
    $id = $_POST['livestockdeleteID'];//cropeditID where clause
    
    $deleteMemberLivestock = $livestock->deleteMemberLivestock($id);
    if($deleteMemberLivestock == 1){
        header("Location: memberprofile.php?Sid=$memberID ");
    }
}

//END member profile Livestock ---------------------------------------------------------------


//member profile SEED DISTRIBUTION ---------------------------------------------------------------
//add SEED DISTRIBUTION to member
if(isset($_POST['AddSeedDistributionmember'])){
    
    $memberID = $_POST['AddSeedDistributionID']; //memberID   
    $rowCount = count($_POST['seeddees']);
    

    for($i=0;$i<$rowCount;$i++){
        $seedsdee = $_POST['seedsdee'][$i]; //tree type
        $seedskgs = $_POST['seedskgs'][$i]; //number of trees
        $donor = $_POST['donor'][$i]; //number of trees
       
        //check if entry exists
        $addMemberSeedDistro = $seeds->addMemberSeedDistro($memberID,$seedsdee,$seedskgs,$donor);
    }
    header("Location: memberprofile.php?Sid=$memberID ");
}

//update SEED DISTRIBUTION acquistion update
if(isset($_POST['Updateacquisitionmember'])){
    $memberID = $_POST['memberID'];//memberID
    $acquisitioneditID = $_POST['acquisitioneditID'];//cropeditID where clause
    
    
    //new data
    //$cropedit = $_POST['cropedit'];//cropedit
    $acquisitionamountedit = $_POST['acquisitionamountedit'];//acreageedit livestockeditID
    $donoredit = $_POST['donoredit']; //donoredit
    
    $UpdateMemberSeedDistroAcquisition = $seeds->UpdateMemberSeedDistroAcquisition($acquisitioneditID,$acquisitionamountedit,$donoredit);
    header("Location: memberprofile.php?Sid=$memberID ");   
}

if(isset($_POST['repaymentmember'])){

    $memberID = $_POST['memberID'];//memberID
    $repaymentID = $_POST['repaymentID'];//cropeditID where clause
    $repaymode = $_POST['repaymode'];//repay mode
    $repaymentquantity = $_POST['repaymentquantity'];//repaymentquantity
    
    if($repaymode == 'seedmode'){
        //pay seed
        $payid = $_POST['seedpay'];//repay mode
        $MemberDistroPayment = $seeds->MemberDistroPaymentSeed($repaymentID,$payid,$repaymentquantity);
        header("Location: memberprofile.php?Sid=$memberID "); 
    }else{
        //pay crop
        $payid = $_POST['croppay'];//repay mode 
        $MemberDistroPayment = $seeds->MemberDistroPaymentCrop($repaymentID,$payid,$repaymentquantity);
        header("Location: memberprofile.php?Sid=$memberID "); 
    }   
}


//repayment distro edit
if(isset($_POST['repaymenteditmember'])){
    $memberID = $_POST['memberID'];//memberID
    $repaymentID2 = $_POST['repaymentID2'];//cropeditID where clause
    $repaymode1 = $_POST['repaymode1'];//repay mode
    $viewpaidamount = $_POST['viewpaidamount'];//repaymentquantity
    
    if($repaymode1 == 'seedmode1'){
        //pay seed
        $payid = $_POST['seedpay1'];//repay mode
        $MemberDistroPayment = $seeds->MemberDistroPaymentSeed($repaymentID2,$payid,$viewpaidamount);
        header("Location: memberprofile.php?Sid=$memberID "); 
    }else{
        //pay crop
        $payid = $_POST['croppay1'];//repay mode 
        $MemberDistroPayment = $seeds->MemberDistroPaymentCrop($repaymentID2,$payid,$viewpaidamount);
        header("Location: memberprofile.php?Sid=$memberID "); 
    }   
}


//delete SEED DISTRIBUTION livestock
if(isset($_POST['discarddistromember'])){
    //echo 'delete distro';
    $memberID = $_POST['memberID'];//memberID
    $id = $_POST['discarddistroID'];//cropeditID where clause
    
    $deleteMemberDistroRecord = $seeds->deleteMemberDistroRecord($id);
    if($deleteMemberDistroRecord == 1){
        header("Location: memberprofile.php?Sid=$memberID ");
    }
}

//END member profile Livestock ---------------------------------------------------------------


//member profile Crop Marketing ---------------------------------------------------------------
//add Crop Marketing to member
if(isset($_POST['AddCropMarketingmember'])){
    $memberID = $_POST['AddCropMarketingmemberID']; //memberID
   
    $memberregyear = $_POST['AddCropMarketingmemberregyear']; //member reg year AddCropMarketingmemberregyear
    $createdby = $_SESSION['nasfam_userid'];//user id
    
    $rowCount = count($_POST['cropmarketings']);
    
    for($i=0;$i<$rowCount;$i++){
        $crop4marketing = $_POST['crop4marketing'][$i]; //tree type
        $Receipt = $_POST['Receipt'][$i]; //number of trees
        $Price = $_POST['Price'][$i]; //tree type
        $TotalPrice = $_POST['TotalPrice'][$i]; //number of trees
       
       $add = $crops->addMemberCropMarketing($memberID,$crop4marketing,$Receipt,$Price,$TotalPrice,$memberregyear,$createdby);
    }
       header("Location: memberprofile.php?Sid=$memberID ");
       
}

//update Crop Marketing member
if(isset($_POST['Updatecmmember'])){
    $memberID = $_POST['memberID'];//memberID
    $cmeditID = $_POST['cmeditID'];//cropeditID where clause
    
    //new data
    $editcmcrop = $_POST['editcmcrop'];//cropedit
    $viewreceipt = $_POST['viewreceipt'];//acreageedit livestockeditID
    $viewprice = $_POST['viewprice'];//cropedit
    $viewtotalprice = $_POST['viewtotalprice'];//acreageedit livestockeditID
     
    $UpdateMemberLivestockfull = $crops->UpdateMemberCropMarketing($cmeditID,$editcmcrop,$viewreceipt,$viewprice,$viewtotalprice);
    header("Location: memberprofile.php?Sid=$memberID ");   
}

//delete Crop Marketing livestock
if(isset($_POST['deletecmmember'])){
    $memberID = $_POST['memberID'];//memberID
    $id = $_POST['cmdeleteID'];//cropeditID where clause
    
    $deleteMemberCropMarketing = $crops->deleteMemberCropMarketing($id);
    if($deleteMemberCropMarketing == 1){
        header("Location: memberprofile.php?Sid=$memberID ");
    }
}

//END member profile Crop Marketing ---------------------------------------------------------------

//member profile ACTIVITIES ---------------------------------------------------------------
//add ACTIVITIES to member
if(isset($_POST['AddActivitiesmember'])){
    $memberID = $_POST['AddActivitiesmemberID']; //memberID
   
    $rowCount = count($_POST['activities']);
    //check if activity record already exists
    
    //if exists add
    //else do dont add, send notification
    for($i=0;$i<$rowCount;$i++){
        $activity = $_POST['activity'][$i]; //tree type
       $checkif = $activities->CheckifMemberAlreadyHasActivity($memberID,$activity);
       if($checkif == 0){
           $addMemberActivities = $activities->addMemberActivities($memberID,$activity);
       }else{
           
       }
       
    }
       header("Location: memberprofile.php?Sid=$memberID ");
       
}

//delete ACTIVITIES livestock
if(isset($_POST['deleteActivitymember'])){
    echo 'delete activities<br>';
    
    $memberID = $_POST['memberID'];//memberID
    $id = $_POST['ActivitydeleteID'];//cropeditID where clause
    
    //echo $id;
    //check if activity is Tree Planting
    $CheckID = $activities->CheckIfIsTreePlantingActivity($id);
    echo 'check id: '.$CheckID.'<br>';
    if($CheckID == 23){        
        $deleteAllTreesPlanted = $activities->deleteMemberTreePlanting($memberID); //delete tree planting
        if($deleteAllTreesPlanted == 1){
            echo 'deleted';
            $deleteMemberActivityy = $activities->deleteMemberActivityy($id);
            header("Location: memberprofile.php?Sid=$memberID ");
        }else{
            echo 'something went wrong';
        }
    }else{
            $deleteMemberActivityy = $activities->deleteMemberActivityy($id);
        if($deleteMemberActivityy == 1){
            header("Location: memberprofile.php?Sid=$memberID ");
        }
    }
   

}

//END member profile ACTIVITIES ---------------------------------------------------------------

//add member numbers
if(isset($_POST['addmembernumbers'])){
    
    $district = $_POST['District'];
    $noMembers = $_POST['numberOfMembers'];
    
    
    
    
    echo 'add these member numbers '.$noMembers.' of the district '.$district.'<br>';
    for($i=0;$i<$noMembers;$i++){
        //get recent number under that district
        $memberCount = $members->checkMemberCount($district);
        //$currentMemberNO = $memberCount[0][0];
        if(empty($memberCount)){
//            $newMemberNumber = 1;
//            $memberNumber = $district.''.$newMemberNumber;
//            echo 'Member Number: '.$memberNumber.'<br>';
            echo 'nothing<br>';
        }else{
//            $newMemberNumber = $currentMemberNO + 1;
//            $memberNumber = $district.''.$newMemberNumber;
//            echo 'Member Number: '.$memberNumber.'<br>';
            echo 'something';
        }
        
        
    }
}