<?php
//error_reporting(0);
//session_start();
if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}
        
include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/cropsmodel.php');
include_once ('../../model/user/membersmodel.php');
include_once ('../../model/user/districtsmodel.php');

$common = new usersmodel();
$dashboard = new dashmodel();
$crops = new cropsmodel();
$members = new membersmodel();
$districts = new districtsmodel();

$datetime_var = new DateTime();

//list all crops
$lstcrops = $crops->listCrops();

//list registration year
$listregYear = $dashboard->ListRegYear();

//list of members
$lstMembers = $members->listMembers();

//list crop marketing for current year
//$lstCurrentYearCropMarketing = $crops->listCropMarketingCurrentYear();

//list district members of reg year listMembersDistrictRegYear($district,$regYear)
if(isset($_POST['SearchCMReg'])){
    //search button clicked
    $userDistrict = $_SESSION['nasfam_userid'];
//    $getUserDistrict = $common->getUserDistrict($userDistrict);
//    $district = $getUserDistrict[0][1];
    $regYear = $_POST['regyearCM'];
    
    //get list of crop merketing by district and of current year
    //$regYear = $_SESSION['nasfam_regyearID'];
    $listCropMarketingDistrictCurrentYear = $crops->listCropMarketingDistrictCurrentYear($regYear);
    
    $i = 0;
    $lstCropMarketing = array();
    
    foreach($listCropMarketingDistrictCurrentYear as $value){
        $district = $value['IPCname']; //district
        $CPID = $value['CPID']; //CPID
        
        $crop = $value['crop']; //crop
        $receipt = $value['receipt']; //receipt
        $amount = $value['amount']; //amount
        $price = $value['price']; //price
        $memberStatus = $value['mStatus'];
        if($memberStatus == '1'){
            $id = $value['mID'];
            $getMemberDetails = $members->MemberPersonalDetails($id);
            $memberName = $getMemberDetails[0][0].' '.$getMemberDetails[0][1];
            $memberNumber = $getMemberDetails[0][7];
            $action = '<a rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs" href=memberprofile.php?Sid='.$id.'><i class="fa fa-user"></i></a>'
                    . '<a onclick=editvis(this) rel="tooltip" title="Edit/Update Crop Marketing details" class="btn btn-info openModalLinkEditCPDetails btn-xs" data-viewcpeditid="'.$CPID.'" data-viewmembernumber="'.$memberNumber.'" data-viewnonemembername="'.$memberName.'" data-viewreceipt="'.$receipt.'" data-viewprice="'.$price.'" data-viewtotalvalue="'.$amount.'"><i class="fa fa-edit"></i></a>'
                    .'<a onclick=deletevis(this) rel="tooltip" title="Remove Crop Marketing details" class="btn btn-danger openModalLinkDeleteCPDetails btn-xs" 
                                  data-id="'.$CPID.'" >
                                    <i class="fa fa-trash"></i>
                                </a>';
        }else{
            $memberName = $value['nonemember'];
            $memberNumber = 'None Member';
            $action = '<a onclick=editvis(this) rel="tooltip" title="Edit/Update Crop Marketing details" class="btn btn-info openModalLinkEditCPDetails btn-xs" data-viewcpeditid="'.$CPID.'" data-viewmembernumber="'.$memberNumber.'" data-viewnonemembername="'.$memberName.'" data-viewreceipt="'.$receipt.'" data-viewprice="'.$price.'" data-viewtotalvalue="'.$amount.'"><i class="fa fa-edit"></i></a>'
                    .'<a onclick=deletevis(this) rel="tooltip" title="Remove Crop Marketing details" class="btn btn-danger openModalLinkDeleteCPDetails btn-xs" 
                                  data-id="'.$CPID.'" >
                                    <i class="fa fa-trash"></i>
                                </a>';
        }
        
        $member = array();
        array_push($member,$memberNumber); //number
        array_push($member,$memberName); //name
        array_push($member,$district); //district
        
        array_push($member,$crop); //crop       
        array_push($member,$receipt); //receipt
        array_push($member,$amount); //amount
        array_push($member,$price); //price
        
        array_push($member,$action); //action
        
        array_push($lstCropMarketing,$member);
        $i++;
    }
        
    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];

}else{
    //get list of crop merketing by district and of current year
    $regYear = $_SESSION['nasfam_regyearID'];
    $listCropMarketingDistrictCurrentYear = $crops->listCropMarketingDistrictCurrentYear($regYear);
    
    $i = 0;
    $lstCropMarketing = array();
    
    foreach($listCropMarketingDistrictCurrentYear as $value){
        $district = $value['IPCname']; //district
        $CPID = $value['CPID']; //CPID
        
        $crop = $value['crop']; //crop
        $receipt = $value['receipt']; //receipt
        $amount = $value['amount']; //amount
        $price = $value['price']; //price
        $memberStatus = $value['mStatus'];
        if($memberStatus == '1'){
            $id = $value['mID'];
            $getMemberDetails = $members->MemberPersonalDetails($id);
            $memberName = $getMemberDetails[0][0].' '.$getMemberDetails[0][1];
            $memberNumber = $getMemberDetails[0][7];
            $action = '<a rel="tooltip" title="View Profile" class="btn btn-info btn-simple btn-xs" href=memberprofile.php?Sid='.$id.'><i class="fa fa-user"></i></a>'
                    . '<a onclick=editvis(this) rel="tooltip" title="Edit/Update Crop Marketing details" class="btn btn-info openModalLinkEditCPDetails btn-xs" data-viewcpeditid="'.$CPID.'" data-viewmembernumber="'.$memberNumber.'" data-viewnonemembername="'.$memberName.'" data-viewreceipt="'.$receipt.'" data-viewprice="'.$price.'" data-viewtotalvalue="'.$amount.'"><i class="fa fa-edit"></i></a>'
                    .'<a onclick=deletevis(this) rel="tooltip" title="Remove Crop Marketing details" class="btn btn-danger openModalLinkDeleteCPDetails btn-xs" 
                                  data-id="'.$CPID.'" >
                                    <i class="fa fa-trash"></i>
                                </a>';
        }else{
            $memberName = $value['nonemember'];
            $memberNumber = 'None Member';
            $action = '<a onclick=editvis(this) rel="tooltip" title="Edit/Update Crop Marketing details" class="btn btn-info openModalLinkEditCPDetails btn-xs" data-viewcpeditid="'.$CPID.'" data-viewmembernumber="'.$memberNumber.'" data-viewnonemembername="'.$memberName.'" data-viewreceipt="'.$receipt.'" data-viewprice="'.$price.'" data-viewtotalvalue="'.$amount.'"><i class="fa fa-edit"></i></a>'
                    .'<a onclick=deletevis(this) rel="tooltip" title="Remove Crop Marketing details" class="btn btn-danger openModalLinkDeleteCPDetails btn-xs" 
                                  data-id="'.$CPID.'" >
                                    <i class="fa fa-trash"></i>
                                </a>';
        }
        
        $member = array();
        array_push($member,$memberNumber); //number
        array_push($member,$memberName); //name
        array_push($member,$district); //district
        
        array_push($member,$crop); //crop       
        array_push($member,$receipt); //receipt
        array_push($member,$amount); //amount
        array_push($member,$price); //price
        
        array_push($member,$action); //action
        
        array_push($lstCropMarketing,$member);
        $i++;
    }

    //get reg year display details
    $getRegYearDetails = $common->getRegYearDetails($regYear);
    $regYearName = $getRegYearDetails[0][1];
   
}


//add crop
if(isset($_POST['addCrops'])){
    $rowCount = count($_POST['crops']); //number of ipcs
   
    for($i=0;$i<$rowCount;$i++){
        
        $cropName = $_POST['cropname'][$i];
        $cropCode = $_POST['cropcode'][$i];
        $addCrop = $crops->addCrop($cropName,$cropCode);
    }
    
    header("Location: farmproduce.php");
}

//update crop
if(isset($_POST['updateCrop'])){
    $cropID = $_POST['cropID'];
    $cropCode = $_POST['cropcode1'];
    $cropName = $_POST['cropnam1'];
    $cropDesc = $_POST['cropdesc1'];
    
    $updateCrops = $crops->UpdateCrop($cropName,$cropCode,$cropDesc,$cropID);
    
    if($updateCrops == 1){
        header("Location: crops.php");
    }
}

//crop marketing --------------------------------
//single entry
if(isset($_POST['addCPSingle'])){
    $regYear = $_POST['regyear']; //Get Reg Year
    $createdby = $_SESSION['nasfam_userid'];//user id

    
    $rowCount = count($_POST['members']);
    for($i=0;$i<$rowCount;$i++){
        $member = $_POST['membertype'][$i]; //member selection
        $crop = $_POST['crop'][$i];//crop
        $receipt = $_POST['receipt'][$i];//receipt
        $price = $_POST['price'][$i];//amount kgs
        $totalvalue = $_POST['totalvalue'][$i];//total price
        if($member == 'Member'){
            echo 'member<br>';
            $membership = 1; //membership status = 0
            $memberNumber = $_POST['membernumber'][$i]; //member number
            //select memberID where regyear and membernumber
            $getMemberDetails = $members->FetchMemberDetailsMemberNumberYear($memberNumber,$regYear);
            $memberID = $getMemberDetails[0][0];
            $addNonMemberCropMarketingFull = $crops->addNonMemberCropMarketingFull($crop,$receipt,$price,$totalvalue,$membership,$regYear,$createdby,$memberID);
        }else{
            echo 'none member<br>';
            $membership = 0; //membership status = 0
            $nonemembername = $_POST['nonemembername'][$i]; //none member name
            $addNonMemberCropMarketing = $crops->addNonMemberCropMarketing($crop,$receipt,$price,$totalvalue,$membership,$regYear,$createdby,$nonemembername); 
        }
    }
    header("Location: cropmarketing.php");
}

//Bulk entry
if(isset($_POST['addCPBulk'])){
    $fname = $_FILES['CropMarketingfile']['name'];
    $regYear = $_POST['regyearBulk']; //reg year
    $createdby = $_SESSION['nasfam_userid'];//user id
    
    echo 'Upload file name: '.$fname.' <br>';
    
    $chk_ext = explode(".", $fname);
    
    if(strtolower(end($chk_ext)) == "csv")
    {
        echo 'valid file<br>';
        $filename = $_FILES['CropMarketingfile']['tmp_name'];
        $handle = fopen($filename, "r");
        
        fgetcsv($handle, 1000, ","); //abandon the first record 
        while(($data = fgetcsv($handle, 1000, ",")) !== false)
        {        
            //check if member or non member
            $membertype = $data[0]; //membertype
            $memberNumber = $data[1]; //membernumber
            $nonemembername = $data[2]; //membername
            $cropcode = $data[3]; //crop code
            $receipt = $data[4]; //receipt
            $price = $data[5]; //price
            $totalvalue = $data[6]; //total value
            
            
            //check membertype
            
            if($membertype == 'member'){//if membertype is member
            echo 'member<br>';
            $membership = 1; //membership status = 0
            //$memberNumber = $_POST['membernumber'][$i]; //member number
            //select memberID where regyear and membernumber
            $getCropID = $crops->getCropID($cropcode);
            $crop = $getCropID[0][0];
            $cropName = $getCropID[0][1];
            
            $getMemberDetails = $members->FetchMemberDetailsMemberNumberYear($memberNumber,$regYear);
            $memberID = $getMemberDetails[0][0];
            $addNonMemberCropMarketingFull = $crops->addNonMemberCropMarketingFull($crop,$receipt,$price,$totalvalue,$membership,$regYear,$createdby,$memberID);
            }else{
                echo 'none member<br>';
                $membership = 0; //membership status = 0
                //$nonemembername = $_POST['nonemembername'][$i]; //none member name
                $getCropID = $crops->getCropID($cropcode);
                $crop = $getCropID[0][0];
                $cropName = $getCropID[0][1];
            
                $addNonMemberCropMarketing = $crops->addNonMemberCropMarketing($crop,$receipt,$price,$totalvalue,$membership,$regYear,$createdby,$nonemembername); 
            }
        }
        fclose($handle);
        echo "<br>Succssfully Imported";
        header("Location: cropmarketing.php");
    }
    else
    {
        echo 'Invalid file';
    } 
}

//update crop marketing
if(isset($_POST['UpdateCP'])){
    
    $viewregyear = $_POST['viewregyear']; //    viewregyear
    $viewmembertype = $_POST['viewmembertype'];//    viewmembertype
    $viewcpeditid = $_POST['viewcpeditid'];//    viewcpeditid
    $viewmembernumber = $_POST['viewmembernumber'];//    viewmembernumber
    $viewnonemembername = $_POST['viewnonemembername'];//    viewnonemembername
    
    $viewcrop = $_POST['viewcrop'];//    viewcrop
    $viewreceipt = $_POST['viewreceipt'];//    viewreceipt
    $viewprice = $_POST['viewprice'];//    viewprice
    $viewtotalvalue = $_POST['viewtotalvalue'];//    viewtotalvalue
//    echo 'update crop marketing'.$viewmembertype.'<br>';
//    
//    
//    echo 'reg year: '.$viewregyear.'<br>';
//    echo 'member type: '.$viewmembertype.'<br>';
//    echo 'update id: '.$viewcpeditid.'<br>';
//    echo 'member name: '.$viewnonemembername.'<br>';
//    
//    echo 'crop id: '.$viewcrop.'<br>';
//    echo 'reciept: '.$viewreceipt.'<br>';
//    echo 'price: '.$viewprice.'<br>';
//    echo 'total value: '.$viewtotalvalue.'<br>';
    
    
    //check if member type or nah
    if($viewmembertype == 'Member'){ //is member
        $membership = 1;
        $getMemberDetails = $members->FetchMemberDetailsMemberNumberYear($viewmembernumber,$viewregyear);
        $memberID = $getMemberDetails[0][0];
        $UpdateMemberCPMember = $crops->UpdateMemberCPMember($viewcrop,$viewreceipt,$viewprice,$viewtotalvalue,$membership,$viewregyear,$memberID,$viewcpeditid);
    
        //echo 'Member';
    }else{ //is not member
        $membership = 0;
        //echo 'none member';
        $addNonMemberCropMarketing = $crops->UpdateMemberCPNoneMember($viewcrop,$viewreceipt,$viewprice,$viewtotalvalue,$membership,$viewregyear,$viewnonemembername,$viewcpeditid);
    }
    header("Location: cropmarketing.php");
}

if(isset($_POST['deleteCP'])){
    $DeleteCPid = $_POST['DeleteCPid'];//cropeditID where clause
    
    $deleteCP = $crops->deleteCP($DeleteCPid);
    if($deleteCP == 1){
        header("Location: cropmarketing.php");
    }
}