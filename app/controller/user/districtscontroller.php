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

$listregYear = $dashboard->ListAllRegYear();

//list ipcs
$lstIPCs = $members->LstIPCs();

//list trees
$listTrees = $trees->listTrees();

//list villages
$listVillages = $districts->listVillages();

$listVillagesDistrict = $districts->listVillagesDistrict();


if(isset($_POST['SearchDistrictReg'])){ //search button clicked
    $regYear = $_POST['regyearDS'];

    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];

    $lstDistricts = $districts->listDistrictsYear();

    $i = 0;
    $IPCs = array();

    foreach($lstDistricts as $value){
        $districtid = $value['did'];
        $districtName = $value['dname'];
        $code = $value['code'];

        $listDistrictIPCs = $districts->listDistrictIPCs($districtid); //get number of ipcs
        $totalipcs = count($listDistrictIPCs);

        $ipc = array();
        array_push($ipc,$districtid);
        array_push($ipc,$districtName);
        array_push($ipc,$totalipcs);
        array_push($ipc,$code);

        array_push($IPCs,$ipc);
        $i++;
    }

}else{ //default display
    $regYear = $_SESSION['nasfam_regyearID']; //reg year id
    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
    
    

    $lstDistricts = $districts->listDistrictsYear();

    $i = 0;
    $IPCs = array();

    foreach($lstDistricts as $value){
        $districtid = $value['IPCid'];
        $districtName = $value['fieldname'];
        $code = $value['fieldcode'];

        $listDistrictIPCs = $districts->listDistrictIPCs($districtid); //get number of ipcs
        $totalipcs = count($listDistrictIPCs);
        
        $ipc = array();
        array_push($ipc,$districtid);
        array_push($ipc,$districtName);
        array_push($ipc,$totalipcs);
        array_push($ipc,$code);
        
        array_push($ipc,$regYear);

        array_push($IPCs,$ipc);
        $i++;
    }
}  

//ADD ASSOCIATION
if(isset($_POST['addAssociation'])){
    $idIPC = $_POST['AssociationIpc']; //ipc id
    $idDistrict = $_POST['districtID']; //district id
    
    $rowCount = count($_POST['assocs']); //number of ipcs
   
    for($i=0;$i<$rowCount;$i++){
        
        $assocsname = $_POST['assocsname'][$i];
        $assocscode = $_POST['assocscode'][$i];
        $addAssociation = $districts->addAssociation($assocsname,$assocscode,$idIPC);
    }
    
    header("Location: assdetails.php?assdid=$idIPC&did=$idDistrict");
}

//ADD villages
if(isset($_POST['addVillage'])){
     $rowCount = count($_POST['villages']); //number of ipcs
   
    for($i=0;$i<$rowCount;$i++){
        $item = '10';
        $getvillagename = $_POST['villagename'][$i];
        $getvillageheadman = $_POST['villageheadman'][$i];
        
        $villagename = strtoupper($getvillagename);
        $villageheadman = strtoupper($getvillageheadman);
        
        //get prefix for item
        $getPrefix = $districts->GetItemPrefix($item);
        $prefx = $getPrefix[0][2];
        
        $getItemCount = $districts->GetRecentItemCounter($item);   //get recent code number by item
            if($getItemCount == 0){
                echo 'no entries';
                $mcount = 1; //set first counter
                $newNumber = $prefx.''.$mcount; //set new item code              
                $addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item
            }else{
                echo 'entries exists';
                $mcount = $getItemCount += 1; //set count
                $newNumber = $prefx.''.$mcount; //set new item code
                $addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item                
            }
        
        
        $addVillage = $districts->addVillage($villagename,$villageheadman,$newNumber);
    }
    
    header("Location: districtsipcs.php");
}

if(isset($_POST['addVillageBulk'])){
    //upload file
    $fname = $_FILES['file']['name'];
    $chk_ext = explode(".", $fname);
   
    if(strtolower(end($chk_ext)) == "csv")
    {
        $filename = $_FILES['file']['tmp_name'];
        $handle = fopen($filename, "r");
    
        fgetcsv($handle, 1000, ","); //abandon the first record 
        while(($data = fgetcsv($handle, 1000, ",")) !== false)
        {            
            $item = '10';
            $getvillagename = $data[0];
            $getvillageheadman = $data[1];

            $villagename = strtoupper($getvillagename);
            $villageheadman = strtoupper($getvillageheadman);

            //get prefix for item
            $getPrefix = $districts->GetItemPrefix($item);
            $prefx = $getPrefix[0][2];
        
            $getItemCount = $districts->GetRecentItemCounter($item);   //get recent code number by item
            if($getItemCount == 0){
                $mcount = 1; //set first counter
                $newNumber = $prefx.''.$mcount; //set new item code              
                $addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item
            }else{
                $mcount = $getItemCount += 1; //set count
                $newNumber = $prefx.''.$mcount; //set new item code
                $addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item                
            }
            //execute the items
            $addVillage = $districts->addVillage($villagename,$villageheadman,$newNumber);
        }
        fclose($handle);  //close file handler
    }
    header("Location: districtsipcs.php");
}

//update village
if(isset($_POST['updateVillage'])){
    $id = $_POST['editvillageid']; //village id
    $getvn = $_POST['editvillagename']; //village name
    $getvh = $_POST['editviewhead']; //village headman
    
    //capitalize
    $vn = strtoupper($getvn);
    $vh = strtoupper($getvh);
    
    $updateVG = $districts->updateVG($vn,$vh,$id);
    if($updateVG == 1){
        header("Location: districtsipcs.php");
    }else{
        echo 'Something has gone wrong';
    }
}


//IPC CONFIG //////////////////////////////////////////////////////////////////
// GET IPC
if(isset($_GET['ipcdid'])){
    $id = $_GET['ipcdid'];
    
    $getDistrictDetails = $districts->getDistrictDetails($id);
    $districtID = $getDistrictDetails[0][0];
    $districtName = $getDistrictDetails[0][1];
    
    $listDistrictIPCs = $districts->listDistrictIPCs($id); //get list of ipcs
}

//GET ASSOCIATION
if(isset($_GET['assdid'])){
    $id = $_GET['assdid'];
    
    //get associations list
    $listIPCAssociations = $districts->listIPCAssociations($id);
    
    $getRealAssoc = $districts->getRealAssoc($id);
    $IPCname = $getRealAssoc[0][0];
    $IPCid = $getRealAssoc[0][2];
    $districtname = $getRealAssoc[0][1];
}

//GET GAC
if(isset($_GET['gacdid'])){
    $id = $_GET['gacdid']; //ipc id
    
    $listAssociationGacs = $districts->listAssociationGacs($id);
    
    $getRealGac = $districts->getRealGac($id);
    $assocname = $getRealGac[0][0];
    $ipcname = $getRealGac[0][1];
    $districtname = $getRealGac[0][2];
    
    $ipcref = $getRealGac[0][5];
    $assocref = $getRealGac[0][3];  
}

//GET CLUB
if(isset($_GET['clubdid'])){
    $id = $_GET['clubdid']; //club id
    
    $listGacClubs = $districts->listGacClubs($id);
    
    $getRealClubs = $districts->getRealClubs($id);    
    $districtname = $getRealClubs[0][2];
    $ipcname = $getRealClubs[0][1];
    $assocname = $getRealClubs[0][0];
    $gacname = $getRealClubs[0][4];
      
    $assocref = $getRealClubs[0][5];
    $assocref2 = $getRealClubs[0][6];
    $assocref3 = $getRealClubs[0][7];
}

//GET MEMBERS LIST
if(isset($_GET['membersdid'])){
    $id = $_GET['membersdid']; //club id
    
    $listClubMembers = $districts->listClubMembers($id);
    
    $getRealMembers = $districts->getRealMembers($id);
    $ipc = $getRealMembers[0][1]; //ipc
    $district = $getRealMembers[0][2];//district
    $association = $getRealMembers[0][0];//association
    $gac = $getRealMembers[0][3];//gac
    $club = $getRealMembers[0][4];//club
}

//ADD IPC
if(isset($_POST['addIPC'])){
    $item = $_POST['codeitem']; //item
    
    echo 'item: '.$item.'<br>';
    
    //get prefix for item
    $getPrefix = $districts->GetItemPrefix($item);
    $prefx = $getPrefix[0][2];
    
    echo 'item: '.$prefx.'<br>';
    
    $rowCount = count($_POST['ipcs']); //number of ipcs

    for($i=0;$i<$rowCount;$i++){
        
        $getname = $_POST['ipcname'][$i]; //IPC name
        $itemname = strtoupper($getname);
        echo 'item original: '.$getname.'<br>';
        echo 'item in upper case: '.$itemname.'<br>';
        
        $getItemCount = $districts->GetRecentItemCounter($item);   //get recent code number by item
        echo 'item current counr: '.$getItemCount.'<br>';
        if($getItemCount == 0){
            echo 'no entries<br>';
            $mcount = 1; //set first counter
            $newNumber = $prefx.''.$mcount; //set new item code                
            $addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item
        }else{
            echo 'entries exist<br>';
            $mcount = $getItemCount += 1; //set count
            $newNumber = $prefx.''.$mcount; //set new item code
            echo 'new counter value: '.$mcount.' new code for new ipc '.$newNumber.'<br>';
            $addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item
        }
        
        switch($item){
            case "1":
                //district               
                $itemtable = 'districts';
                $updateCodeTable = $districts->InsertIntoItemB($itemtable,$itemname,$newNumber);
                //get reg year
                //get recent created district ID
                //insert into reg year
                break;
            case "2":
                //ipc
                echo 'add ipc into ipc table<br>';
                $refitem = $_POST['refitem']; // foreign key reference
                $itemtable = 'ipc';
                echo 'refernce item (District ID) '.$refitem.' Table '.$itemtable.'<br>';
                $updateCodeTable = $districts->InsertIntoItemA($itemtable,$itemname,$newNumber,$refitem);
                if($updateCodeTable == 1){
                    echo 'succesfully entered into IPC table<br><hr>';
                }else{
                    echo 'failed to enter into IPC table<br><hr>';
                }
                $ReturnPath = 'ipcdetails.php?ipcdid='.$refitem;
                break;
            case "3":
                //association
                $refitem = $_POST['refitem']; // foreign key reference
                $districtID = $_POST['districtID']; //district ID
                $itemtable = 'associations';
                $updateCodeTable = $districts->InsertIntoItemA($itemtable,$itemname,$newNumber,$refitem);
                $ReturnPath = 'assdetails.php?assdid='.$refitem.'&did='.$districtID;
                break;
            case "4":
                //gac
                $refitem = $_POST['refitem']; // foreign key reference
                $districtID = $_POST['districtID'];
                $itemtable = 'gac';
                $updateCodeTable = $districts->InsertIntoItemA($itemtable,$itemname,$newNumber,$refitem);
                $ReturnPath = 'gacdetails.php?gacdid='.$refitem.'&did='.$districtID;
                break;
            case "5":
                //club
                $refitem = $_POST['refitem']; // foreign key reference
                $itemtable = 'clubs';
                $updateCodeTable = $districts->InsertIntoItemA($itemtable,$itemname,$newNumber,$refitem);
                $ReturnPath = 'clubdetails.php?clubdid='.$refitem;
                break;
            case "6":
                //livestock

                $itemtable = 'livestock';
                $updateCodeTable = $districts->InsertIntoItemB($itemtable,$itemname,$newNumber);
                break;
            case "7":
                //crop
                $itemtable = 'crops';
                $updateCodeTable = $districts->InsertIntoItemB($itemtable,$itemname,$newNumber);
                break;
            case "8":
                //seed
                $itemtable = 'seeds';
                $updateCodeTable = $districts->InsertIntoItemB($itemtable,$itemname,$newNumber);
                break;
            case "9":
                //tree
                $itemtable = 'trees';
                $updateCodeTable = $districts->InsertIntoItemB($itemtable,$itemname,$newNumber);
                break;
            default:
                echo "charge is neither processing fee or disturbance fee!";
        }
    }
    header("Location: $ReturnPath");  
}

//ADD DISTRICT
if(isset($_POST['addNewDistrict'])){
    $item = $_POST['Ipcitem']; //item
    $regyear = $_POST['regyear']; //get reg year
    echo 'item: '.$item.'<br>';
    
    
    $getPrefix = $districts->GetItemPrefix($item); //get prefix for item
    $prefx = $getPrefix[0][2];
    
    echo 'item: '.$prefx.'<br>';
    
    $rowCount = count($_POST['ipcs']); //number of ipcs

    for($i=0;$i<$rowCount;$i++){
        
        $getname = $_POST['ipcname'][$i]; //IPC name
        $itemname = strtoupper($getname);
        echo 'item original: '.$getname.'<br>';
        echo 'item in upper case: '.$itemname.'<br>';
        
        $getItemCount = $districts->GetRecentItemCounter($item);   //get recent code number by item
        echo 'item current counr: '.$getItemCount.'<br>';
        if($getItemCount == 0){
            echo 'no entries<br>';
            $mcount = 1; //set first counter
            $newNumber = $prefx.''.$mcount; //set new item code                
            $addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item
        }else{
            echo 'entries exist<br>';
            $mcount = $getItemCount += 1; //set count
            $newNumber = $prefx.''.$mcount; //set new item code
            echo 'new counter value: '.$mcount.' new code for new ipc '.$newNumber.'<br>';
            $addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item
        }
        
        //district               
        $itemtable = 'IPC';
        $updateCodeTable = $districts->InsertIntoItemB($itemtable,$itemname,$newNumber);
        if($updateCodeTable == 1){
            echo 'IPC created successfuly';
        }else{
            echo 'Failed to create IPC';
        }
        
        //get recent created district ID
        //$RecentDistrictDetails = $districts->RecentDistrictDetails();
        //$districtID = $RecentDistrictDetails[0][0]; //recent district ID
        
       // $InsertDistrictReg = $districts->InsertDistrictReg($districtID,$regyear,$newNumber); //insert into district reg year with default target
    }
    header("Location: $ReturnPath");  
}

if(isset($_POST['addIPCItemsBulk111'])){    
    $item = $_POST['Ipcitem']; //ipc item
   
    switch($item){
        case "2":
            //ipc
            $itemtable = 'ipc';
            $itemtableref = 'districtsregyear';
            break;
        case "3":
            //association
            $itemtable = 'associations';
            $itemtableref = 'ipc';
            break;
        case "4":
            //gac
            $itemtable = 'gac';
            $itemtableref = 'associations';
            break;
        case "5":
            //club
            $itemtable = 'clubs';
            $itemtableref = 'gac';
            break;               
        default:
            echo "something has gone wrong!<br>";
    }
    
    echo 'Item: '.$item.'<br>';
    
    //upload file
    $fname = $_FILES['file']['name'];
    $chk_ext = explode(".", $fname);
   
    if(strtolower(end($chk_ext)) == "csv")
    {
        $filename = $_FILES['file']['tmp_name'];
        $handle = fopen($filename, "r");
    
        fgetcsv($handle, 1000, ","); //abandon the first record 
        while(($data = fgetcsv($handle, 1000, ",")) !== false)
        {            
            //get item fieldref by code
            $Referenceitem = $data[0];
            $GetItemByCode = $districts->GetItemByCode($Referenceitem,$itemtableref);
            $refitem = $GetItemByCode[0][0];

            $getname = $data[1];
            $itemname = strtoupper($getname);
            
            echo 'Reference code: '.$Referenceitem.'<br>';
            echo 'Reference table: '.$itemtableref.'<br>';
            echo 'Reference item: '.$refitem.'<br>';
            echo 'Item Name: '.$itemname.'<br>';
            
            //get prefix for item
            $getPrefix = $districts->GetItemPrefix($item);
            $prefx = $getPrefix[0][2];
            
            echo 'Prefix: '.$prefx.'<br>';

            $getItemCount = $districts->GetRecentItemCounter($item);   //get recent code number by item
            if($getItemCount == 0){
                $mcount = 1; //set first counter
                $newNumber = $prefx.''.$mcount; //set new item code  
                echo 'Count: '.$mcount.'<br> New number: '.$newNumber.'<br>';             
                $addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item
            }else{
                $mcount = $getItemCount += 1; //set count
                $newNumber = $prefx.''.$mcount; //set new item code
                echo 'Count: '.$mcount.'<br> New number: '.$newNumber.'<br>';
                $addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item                
            }
            $updateCodeTable = $districts->InsertIntoItemA($itemtable,$itemname,$newNumber,$refitem);
            if($updateCodeTable == 1){
                echo 'succesfully entered added<br><hr>';
            }else{
                echo 'failed to add<br><hr>';
            }
        }
        fclose($handle);  //close file handler
    }
    header("Location: districtsipcs.php");      
}

if(isset($_POST['addIPCItemsBulk'])){
    $item = $_POST['Ipcitem']; //ipc item
    $returnpathid = $_POST['returnpathid']; //return path ID
    $ipcpage = $_POST['ipcpage']; //page user is on
    
    switch($ipcpage){
        case "districtsipcs":
            //set the return path
            $ReturnPath = 'districtsipcs.php';
            break;
        case "ipcdetails":
            //set the return path
            $ReturnPath = 'ipcdetails.php?ipcdid='.$returnpathid;
            break;
        case "assdetails":
            //set the return path
            $ReturnPath = 'assdetails.php?assdid='.$returnpathid;
            break;
        case "gacdetails":
            //set the return path
            $ReturnPath = 'gacdetails.php?gacdid='.$returnpathid;
            break;
        default:
            echo "something has gone wrong!<br>";
    }
    
    
    switch($item){
        case "2":
            //ipc
            $itemtable = 'districts';
            $itemtableref = 'IPC';
            break;
        case "3":
            //association
            $itemtable = 'associations';
            $itemtableref = 'districts';
            break;
        case "4":
            //gac
            $itemtable = 'gac';
            $itemtableref = 'associations';
            break;
        case "5":
            //club
            $itemtable = 'clubs';
            $itemtableref = 'gac';
            break;               
        default:
            echo "something has gone wrong!<br>";
    }
    
    //upload file
    $fname = $_FILES['file']['name'];
    $chk_ext = explode(".", $fname);
   
    if(strtolower(end($chk_ext)) == "csv")
    {
        $filename = $_FILES['file']['tmp_name'];
        $handle = fopen($filename, "r");
    
        fgetcsv($handle, 1000, ","); //abandon the first record 
        while(($data = fgetcsv($handle, 1000, ",")) !== false)
        {            
            //get item fieldref by code
            $Referenceitem = $data[0];
            $GetItemByCode = $districts->GetItemByCode($Referenceitem,$itemtableref);
            $refitem = $GetItemByCode[0][0];

            $getname = $data[1];
            $itemname = strtoupper($getname);
            
            //get prefix for item
            $getPrefix = $districts->GetItemPrefix($item);
            $prefx = $getPrefix[0][2];

            $getItemCount = $districts->GetRecentItemCounter($item);   //get recent code number by item
            if($getItemCount == 0){
                $mcount = 1; //set first counter
                $newNumber = $prefx.''.$mcount; //set new item code              
                $addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item
            }else{
                $mcount = $getItemCount += 1; //set count
                $newNumber = $prefx.''.$mcount; //set new item code
                $addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item                
            }
            //execute the items
            $updateCodeTable = $districts->InsertIntoItemA($itemtable,$itemname,$newNumber,$refitem);
//            if($updateCodeTable == 1){
//                echo 'all good';
//            }else{
//                echo 'something went wrong';
//            }
        }
        fclose($handle);  //close file handler
    }
    
    header("Location: $ReturnPath"); 
}

if(isset($_POST['updateIPCItem'])){
    $editid = $_POST['editid']; // item ID
    $editviewitem = $_POST['editviewitem']; // item code
    $getname = $_POST['editviewname']; // item name
    
    $editviewname = strtoupper($getname); //CAPITALIZE THE NAME
    
    $returnpathid = $_POST['returnpathid']; //return path ID
    $ipcpage = $_POST['ipcpage']; //page user is on
    
    switch($ipcpage){
        case "districtsipcs":
            //set the return path
            $ReturnPath = 'districtsipcs.php';
            break;
        case "ipcdetails":
            //set the return path
            $ReturnPath = 'ipcdetails.php?ipcdid='.$returnpathid;
            break;
        case "assdetails":
            //set the return path
            $ReturnPath = 'assdetails.php?assdid='.$returnpathid;
            break;
        case "gacdetails":
            //set the return path
            $ReturnPath = 'gacdetails.php?gacdid='.$returnpathid;
            break;
        case "clubdetails":
            //set the return path
            $ReturnPath = 'clubdetails.php?clubdid='.$returnpathid;
            break;
        default:
            //echo "something has gone wrong!<br>";
            $ReturnPath = 'districtsipcs.php';
    }
    
    switch($editviewitem){
        case "2":
            //district
            $itemtable = 'districts';
            $fieldID = 'districtID';
            //get district ID
            //$getDistrictID = $districts->getDistrictRealDetails($editid);
            //$updateID = $getDistrictID[0][1];
            $updateID = $editid;
            break;
        case "1":
            //ipc
            $itemtable = 'ipc';
            $fieldID = 'IPCid';
            $updateID = $editid;
            break;
        case "3":
            //association
            $itemtable = 'associations';
            $fieldID = 'associationsID';
            $updateID = $editid;
            break;
        case "4":
            //gac
            $itemtable = 'gac';
            $fieldID = 'GACid';
            $updateID = $editid;
            break;
        case "5":
            //club
            $itemtable = 'clubs';
            $fieldID = 'clubsID';
            $updateID = $editid;
            break;               
        default:
            echo "something has gone wrong!<br>";
    }
    
    //update item and return to viewing page
    $ipcitemUpdate = $districts->UpdateIPCName($itemtable,$editviewname,$fieldID,$updateID);
    header("Location: $ReturnPath ");
}





