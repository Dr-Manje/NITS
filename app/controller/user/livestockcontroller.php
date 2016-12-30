<?php
//session_start();
if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}
        
//include_once ('../../model/user/dashboardmodel.php');
//include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/livestockmodel.php');
include_once ('../../model/user/districtsmodel.php');

//$login_users = new usersmodel();
//$dashboard = new dashmodel();
$livestock = new livestockmodel();
$districts = new districtsmodel();

$datetime_var = new DateTime();

//list all livestock
$lstLivestock = $livestock->listLivestock();

// add new Livestock
if(isset($_POST['addLivestock'])){  
    $rowCount = count($_POST['livestocks']); //number of ipcs
   
    for($i=0;$i<$rowCount;$i++){
        
        $livestockname = $_POST['livestockname'][$i];
        $livestockcode = $_POST['livestockcode'][$i];
        $addLivestock = $livestock->addLivestock($livestockname,$livestockcode);
    }
    
    header("Location: farmproduce.php");

}

//update livestock
if(isset($_POST['updateLivestock'])){
    $LivestockID = $_POST['livestockID'];
    $LivestockName = $_POST['livestocknam1'];
    $LivestockDesc = $_POST['livestockdesc1'];
    $code = $_POST['code1'];
    
    $updateLivestock = $livestock->UpdateLivestock($LivestockName,$LivestockDesc,$LivestockID,$code);
    
    if($updateLivestock == 1){
        header("Location: livestock.php");
    }
}

//add farm produce
if(isset($_POST['addFarmProduceBulk'])){
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
            //$Referenceitem = $data[0];
            //$GetItemByCode = $districts->GetItemByCode($Referenceitem,$itemtableref);
            //$refitem = $GetItemByCode[0][0];
            
            $getitem = $data[0];
            $item1 = strtoupper($getitem);
            $getname = $data[1];
            $itemname = strtoupper($getname);
            
            //get prefix for item
            $getPrefix = $districts->GetItemPrefix2($item1);
            $prefx = $getPrefix[0][2];
            $item  = $getPrefix[0][0];
            
            switch($prefx){
                case "LVT":
                    //set the return path
                    $table = 'livestock';
                    break;
                case "CRP":
                    //set the return path
                    $table = 'crops'; 
                    break;
                case "SED":
                    //set the return path
                    $table = 'seeds'; 
                    break;
                case "TRE":
                    //set the return path
                    $table = 'trees';                   
                    break;
                default:
                    echo "something has gone wrong!<br>";
            }

            $getItemCount = $districts->GetRecentItemCounter($item);   //get recent code number by item
            echo 'Item count: '.$getItemCount.'<br>';
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
            $updateCodeTable = $districts->InsertIntoItemA1($table,$itemname,$newNumber);
        }
        fclose($handle);  //close file handler
    }
    header("Location: farmproduce.php"); 
}

//update farm produce
if(isset($_POST['updateFarmProduceitem'])){
    $code = $_POST['viewcode']; //code
    $editid = $_POST['editid']; //item id editid
    $getviewname = $_POST['viewname']; //new item name viewname
    $viewname = strtoupper($getviewname);
    switch($code){
        case "1":
            $table = 'livestock';
            $idHeader = 'livestockID';
            break;
        case "2":
            $table = 'crops';
            $idHeader = 'cropID';
            break;
        case "3":
            $table = 'seeds';
            $idHeader = 'seedID';
            break;
        case "4":
            $table = 'trees';
            $idHeader = 'treesid';
            break;
        default:
            echo "something has gone wrong!<br>";
    }
    
    //update farm produce
    $updateFP = $districts->UpdateIPCName($table,$viewname,$idHeader,$editid);  
    header("Location: farmproduce.php");
}