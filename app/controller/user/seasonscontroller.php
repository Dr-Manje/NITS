<?php

if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}

include_once ('../../model/user/seasonsmodel.php');
include_once ('../../model/user/dashboardmodel.php');
include_once ('../../model/user/districtsmodel.php');
$dashboard = new dashmodel();
$seasons = new seasonsmodel();
$districts = new districtsmodel();

$lstDistricts = $districts->listDistricts(); //list districts
$lstWarehouses = $seasons->lstWarehouses();
$lstmarketcs = $seasons->lstMarketcs();
$lstIPCs = $seasons->lstIPCs(); //lstIPCs

if(isset($_GET['emkc'])){
    $marketcenter = $_GET['emkc']; //market center ID
    $season = $_GET['sidd']; //season id
    
    $MKCDetails = $seasons->MKCDetails($marketcenter);
    $mkcName = $MKCDetails[0][1]; //market center name
    $mkcode = $MKCDetails[0][2]; //market center name
    $mpa = $MKCDetails[0][3]; //market center procurement amount
    
    $Gacs = $seasons->ListMarketCenterGacs($marketcenter); //list all gacs in market center
}

if(isset($_POST['updatemkc'])){
    $market = $_POST['updatemkcid1']; //market
    $season = $_POST['updatemkcid2']; //season
    
    $newname = $_POST['editmkcname']; //market
    $newmpa = $_POST['editmpa']; //season
    
    $updateMKC = $seasons->updateMKC($newname,$newmpa,$market);
    if($updateMKC == 1){
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = 'Market Center Successfuly updated!';
        header("Location: editmkc.php?emkc=$market&sidd=$season");
        exit();
    }else{
        $_SESSION['notification']['title'] = 'FAILED!';
        $_SESSION['notification']['message'] = 'Failed to update Market Center!';
        header("Location: editmkc.php?emkc=$market&sidd=$season");
        exit();
    }  
}

if(isset($_POST['updatemkcgacs'])){
    $market = $_POST['updatemkcid3']; //market
    $season = $_POST['updatemkcid4']; //season
    
    $messagereport = '';
    $rowCount = count($_POST['gacs']);
    if($rowCount >= 1){
        foreach($_POST['gacs'] as $id){
            $names = $_POST["gacid"][$id];
            $gacs = $_POST["gacname"][$id];
            $deleteGacsMKC = $seasons->deleteGacsMKC($names);
            if($deleteGacsMKC == 1){
                $messagereport .= 'Successfully removed: '.$gacs.' Gac<br>';
            }else{
                $messagereport .= 'Failed to remove: '.$gacs.' Gac<br>';
            }   
        }
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = $messagereport;
        header("Location: editmkc.php?emkc=$market&sidd=$season");
        exit();
    }else{
        $_SESSION['notification']['title'] = 'FAILED!';
        $_SESSION['notification']['message'] = 'Please select gacs to remove from this market centre!';
        header("Location: editmkc.php?emkc=$market&sidd=$season");
        exit();
    } 
}

if(isset($_POST['addNewMKCgac'])){
    $market = $_POST['updatemkcid5']; //market
    $season = $_POST['updatemkcid6']; //season
    
    
    $fname = $_FILES['file']['name'];
    $chk_ext = explode(".", $fname);
    if(strtolower(end($chk_ext)) == "csv")
    {
        $filename = $_FILES['file']['tmp_name'];
        $handle = fopen($filename, "r");

        fgetcsv($handle, 1000, ","); //abandon the first record 
        while(($data = fgetcsv($handle, 1000, ",")) !== false)
        {               
            $getnames = $data[0];               
            $GacID = $seasons->GetGacDetailsClubCode($getnames); //get gac id  
            $checkMemberGacs = $seasons->checkMemberGacs($market,$GacID);//check if gac exists
            if($checkMemberGacs >= 1){
                //do thing
            }else{
                $addGacsToMarketCenter = $seasons->addGacsToMarketCenter($market,$GacID); 
            }
                           
        }
        fclose($handle);
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = 'Successfuly added!';
        header("Location: editmkc.php?emkc=$market&sidd=$season");
        exit();
    }else{
        $_SESSION['notification']['title'] = 'FAILED!';
        $_SESSION['notification']['message'] = 'Something went wrong! GACs failed to add. Please try again, if this problem persists, please contact your admin';
        header("Location: editmkc.php?emkc=$market&sidd=$season");
        exit();
    }
}

//view season details
if(isset($_GET['sid'])){
    $id = $_GET['sid'];
    
    $getSeasonHeader = $seasons->SeasonDetails($id);
//    $lstMarketCenterList = $seasons->lstMarketCenterList();//select list of market centers
//    
//    //get purchases
//    $lstMC = array();
//    foreach($lstMarketCenterList as $value){
//        $mcid = $value['mcid']; //mcid
//        
//        $marketcenter = $value['marketcenter'];
//        $buyer = $value['buyer'];
//        $variety1 = 'CG7';
//        $getMarketVarietySummaryCG7 = $seasons->getMarketVarietySummary($id,$mcid,$variety1);
//        $CG7qty = $getMarketVarietySummaryCG7[0][0]; //qty
//        $CG7mwk = $getMarketVarietySummaryCG7[0][1]; //receipt total
//        
//        //get grade data
//        $getGradingData = $seasons->getGradingData($id,$mcid,$variety1);
//        $cg7G1 = $getGradingData[0][0];
//        $cg7G2 = $getGradingData[0][1];
//        $cg7G3 = $getGradingData[0][2];
//        $cg7G4 = $getGradingData[0][3];
//        $cg7G5 = $getGradingData[0][4];
//        
//        $memberinfo = array();
//        array_push($memberinfo, $marketcenter);
//        //array_push($memberinfo, $buyer);
//        //array_push($memberinfo, $variety1);
//        
//        array_push($memberinfo, $cg7G1);
//        array_push($memberinfo, $cg7G2);
//        array_push($memberinfo, $cg7G3);
//        array_push($memberinfo, $cg7G4);
//        array_push($memberinfo, $cg7G5);
//        array_push($memberinfo, $CG7qty);
//        array_push($memberinfo, $CG7mwk);
//        
//        $marketcenter2 = $value['marketcenter'];
//        $buyer2 = $value['buyer'];
//        $variety2 = 'CHALIM';
//        $getMarketVarietySummaryCHALIM = $seasons->getMarketVarietySummary($id,$mcid,$variety2);
//        $CHALIMqty = $getMarketVarietySummaryCHALIM[0][0]; //qty
//        $CHALIMmwk = $getMarketVarietySummaryCHALIM[0][1]; //receipt total
//        
//        //get grade data
//        $getGradingData2 = $seasons->getGradingData($id,$mcid,$variety2);
//        $ChalimG1 = $getGradingData2[0][0];
//        $ChalimG2 = $getGradingData2[0][1];
//        $ChalimG3 = $getGradingData2[0][2];
//        $ChalimG4 = $getGradingData2[0][3];
//        $ChalimG5 = $getGradingData2[0][4];
//        
//        array_push($memberinfo, $ChalimG1);
//        array_push($memberinfo, $ChalimG2);
//        array_push($memberinfo, $ChalimG3);
//        array_push($memberinfo, $ChalimG4);
//        array_push($memberinfo, $ChalimG5);
//        array_push($memberinfo, $CHALIMqty);
//        array_push($memberinfo, $CHALIMmwk);
//        
//        $qty = $CHALIMqty + $CG7qty; //total QTY
//        $receipt = $CHALIMmwk + $CG7mwk; //receipt total
//        
//        array_push($memberinfo, $receipt);
//        array_push($memberinfo, $qty);
//        
//        
//        array_push($lstMC, $memberinfo);
//        
//    }
//    
//    //buyer summary
//    $lstSeasonBuyers = $seasons->getSeasonBuyers($id);
//    $lstBuyersSummary = array();
//    foreach ($lstSeasonBuyers as $value){
//        $memberinfo = array();
//        $buyerID = $value['buyerid']; //buyer id
//        $buyer = $value['buyer']; // buyer
//        $marketcenter = $value['marketcenter']; // market center
//        $pDate = $value['pDate']; // date
//        
//        $SeasonBuyersQty = $seasons->getSeasonBuyersQty($id,$buyerID,$pDate); //get qty
//        $action = '<a rel="tooltip" title="View more Purchase details" class="btn btn-info btn-xs" href="buyerpurchasedetails.php?bpdid='.$id.'&bid='.$buyerID.'&did='.$pDate.'">View More</a> view full buyer summary';
//
//        array_push($memberinfo, $buyer);
//        array_push($memberinfo, $pDate);
//        array_push($memberinfo, $marketcenter);
//        array_push($memberinfo, $SeasonBuyersQty);
//        
//        array_push($memberinfo, $action);
//
//        array_push($lstBuyersSummary, $memberinfo);
//    }
//    
//    //purchases list
//    $lstPurchasesList = $seasons->lstPurchasesList($id);//select list of market centers
//    $lstPurchases = array();
//    foreach($lstPurchasesList as $value){
//        $memberinfo1 = array();
//
//        $purchaseid = $value['pid'];
//        $receipt = $value['receipt']; //receipt
//        $date = $value['pDate']; //date
//        $buyer = $value['buyer']; //buyer
//        $marketcenter = $value['marketcenter']; //market center
//        
//        array_push($memberinfo1, $receipt);
//        array_push($memberinfo1, $date);
//        array_push($memberinfo1, $buyer);
//        array_push($memberinfo1, $marketcenter);
//        
//        $membership = $value['farmerstatus']; //membership
//        if($membership == '1'){
//            //get member details
//            $memberid = $value['member']; //member
//            $MemberPurchaseDetails = $seasons->MemberPurchaseDetails($memberid);
//            $memberstatus = 'Member';
//            $membername = $MemberPurchaseDetails[0][0];//farmer
//            $membergender = $MemberPurchaseDetails[0][1];//gender
//            $memberclub = $MemberPurchaseDetails[0][2];//club
//            $membergac= $MemberPurchaseDetails[0][3];//gac
//            
//            $memberedit = $MemberPurchaseDetails[0][4];//gac
//        }else{
//            $memberstatus = 'None Member';
//            $membername = $value['farmer'];//farmer
//            $membergender = $value['gender'];//gender
//            $memberclub = 'N/A';//club
//            $membergac = 'N/A';//gac
//            
//            
//            $memberedit = $value['farmer'];
//        }
//
//        array_push($memberinfo1, $memberstatus);
//        array_push($memberinfo1, $membername);
//        array_push($memberinfo1, $membergender);
//        array_push($memberinfo1, $memberclub);      
//        array_push($memberinfo1, $membergac);
//                
//        $qty = $value['qty']; //qty
//        $type = $value['type']; //variety
//        $cum = $value['cum']; //cum
//        $price = $value['price']; //price
//        $mwk = $value['mwk']; //mwk
//        
//        $mkc = $value['mkc']; //mkc
//        $editDate = $value['editDate']; //editDate
//        
//        array_push($memberinfo1, $qty);
//        array_push($memberinfo1, $type);
//        array_push($memberinfo1, $cum);
//        array_push($memberinfo1, $price);      
//        array_push($memberinfo1, $mwk);
//        
//        $item = str_replace( ',', '', $qty );
//        $item2 = str_replace( ',', '', $cum );
//        $item3 = str_replace( ',', '', $price );
//        $item4 = str_replace( ',', '', $mwk );
//        $item5 = str_replace( ',', '', $type );
//        
//        $actiontime = '<button onclick="editPurchase('.$item.','.$item2.','.$item3.','.$item4.','.$receipt.',\''.$mkc.'\',\''.$editDate.'\',\''.$memberedit.'\','.$purchaseid.')" rel="tooltip" title="Edit/Update Purchase" class="btn btn-info btn-xs" ><i class="fa fa-edit"></i> EDIT</button> '
//                . '<button onclick="deletePurchase('.$purchaseid.','.$id.')" rel="tooltip" title="Delete Purchase" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i> DELETE</button>';
//        array_push($memberinfo1, $actiontime);
//        
//        
//        array_push($lstPurchases, $memberinfo1);
//        
//    }
//    
//    //sorting data
//    $lstSortingData = $seasons->lstSortingData($id);//select list of sorting data
//    $lstSorting = array();
//    foreach($lstSortingData as $value){
//        $memberinfo = array();
//        $cwid = $value['cwid']; //cwid
//        $cwname = $value['casualworker']; //cw name
//        $hsdate = $value['hsDate']; //date       
//        
//        array_push($memberinfo, $cwname);
//        array_push($memberinfo, $hsdate);
//        $variety = 'CG7';
//        
//        $getSortingSummaryData = $seasons->getSortingSummaryData($id,$cwid,$hsdate,$variety);
//        $cg7qty = $getSortingSummaryData[0][0];
//        $cg7gradeouts = $getSortingSummaryData[0][1];
//        $cg7shells = $getSortingSummaryData[0][2];
//        
//        $cg7G1 = $getSortingSummaryData[0][3];
//        $cg7G2 = $getSortingSummaryData[0][4];
//        $cg7G3 = $getSortingSummaryData[0][5];
//        $cg7G4 = $getSortingSummaryData[0][6];
//        $cg7G5 = $getSortingSummaryData[0][7];
//        
//        array_push($memberinfo, $cg7qty);
//        array_push($memberinfo, $cg7gradeouts);
//        array_push($memberinfo, $cg7shells);
//        
//        array_push($memberinfo, $cg7G1);
//        array_push($memberinfo, $cg7G2);
//        array_push($memberinfo, $cg7G3);
//        array_push($memberinfo, $cg7G4);
//        array_push($memberinfo, $cg7G5);
//        
//        $variety2 = 'CHALIM';
//        
//        $getChalim = $seasons->getSortingSummaryData($id,$cwid,$hsdate,$variety2);
//        $Chalimqty = $getChalim[0][0];
//        $Chalimgradeouts = $getChalim[0][1];
//        $Chalimshells = $getChalim[0][2];
//        
//        $ChalimG1 = $getChalim[0][3];
//        $ChalimG2 = $getChalim[0][4];
//        $ChalimG3 = $getChalim[0][5];
//        $ChalimG4 = $getChalim[0][6];
//        $ChalimG5 = $getChalim[0][7];
//        
//        array_push($memberinfo, $Chalimqty);
//        array_push($memberinfo, $Chalimgradeouts);
//        array_push($memberinfo, $Chalimshells);
//        
//        array_push($memberinfo, $ChalimG1);
//        array_push($memberinfo, $ChalimG2);
//        array_push($memberinfo, $ChalimG3);
//        array_push($memberinfo, $ChalimG4);
//        array_push($memberinfo, $ChalimG5);
//        
//        array_push($memberinfo, 'Action Time');
//        
//        array_push($lstSorting, $memberinfo);
//    }
    
    //marketcentersdata
    if($_SESSION['nasfam_usertype'] == '1'){
        $lstAllMarketCenterListData = $seasons->lstAllMarketCenterList();
    }else{
        $criteria = 'ACTIVE';
        $lstAllMarketCenterListData = $seasons->lstAllMarketCenterList1($criteria);
    }
    
    $lstAllMarketCenterList = array();
    foreach($lstAllMarketCenterListData as $value){
        $memberinfo = array();
        $cwid = $value['mcid']; //casual worker id
        $marketcenter = $value['marketcenter']; //casual worker name
        $code = $value['mkcode']; //code
        $mpa = $value['mpa']; //code
        $stat = $value['status']; //code
        
        $Gacs = $seasons->MarketCenterGacs($cwid);
        
        if($_SESSION['nasfam_usertype'] == '1'){
            if($value['status'] == 'INACTIVE'){
                $actiontime = '<a href="editmkc.php?emkc='.$cwid.'&sidd='.$id.'" rel="tooltip" title="Activate Market" class="btn btn-info btn-xs" ><i class="fa fa-edit"></i> EDIT</a> '
                . '<a href="seasondetails.php?demkc='.$cwid.'&sidd='.$id.'&mkcstatid='.$stat.'" rel="tooltip" title="Delete Casual Worker" class="btn btn-info btn-xs" ><i class="fa fa-play"></i> ACTIVATE</a>';
            }else{
               $actiontime = '<a href="editmkc.php?emkc='.$cwid.'&sidd='.$id.'" rel="tooltip" title="Deactivate Market" class="btn btn-info btn-xs" ><i class="fa fa-edit"></i> EDIT</a> '
                . '<a href="seasondetails.php?demkc='.$cwid.'&sidd='.$id.'&mkcstatid='.$stat.'" rel="tooltip" title="Delete Casual Worker" class="btn btn-warning btn-xs" ><i class="fa fa-pause"></i> DEACTIVE</a>'; 
            }
            
        
        }else{
            $actiontime = '';
        }
        
        
        array_push($memberinfo, $marketcenter);
        array_push($memberinfo, $code);
        array_push($memberinfo, $Gacs);
        array_push($memberinfo, $mpa);
        array_push($memberinfo, $stat);
        array_push($memberinfo, 'receipts Total');
        array_push($memberinfo, 'Balance');
        array_push($memberinfo, $actiontime);
        
        array_push($lstAllMarketCenterList, $memberinfo);
    }
    
    
    //buyers
    $lstBuyersData = $seasons->lstAllBuyersData($id); //select list of sorting data
    $lstBuyers = array();
    foreach($lstBuyersData as $value){
        $memberinfo = array();
        $bid = $value['bid'];
        $marketcenterid = $value['marketcenterid'];
        $name = $value['buyer']; array_push($memberinfo, $name);
        $bcode = $value['bcode']; array_push($memberinfo, $bcode);
        $gender = $value['gender']; array_push($memberinfo, $gender);
        $address = $value['address']; array_push($memberinfo, $address);
        $marketcenter = $value['marketcenter']; array_push($memberinfo, $marketcenter);
        
        array_push($memberinfo, 'receipt total'); //receipt total
        array_push($memberinfo, 'total kgs');
        $status = $value['status']; array_push($memberinfo, $status);
        
        if($_SESSION['nasfam_usertype'] == '1'){
            if($value['status'] == 'INACTIVE'){
                $actiontime = '<button onclick="editBuyerMKC('.$bid.')" rel="tooltip" title="Update Market Centre" class="btn btn-info btn-xs" ><i class="fa fa-edit"></i> EDIT</button> '
                . '<a href="seasondetails.php?actbuyer='.$bid.'&sidd='.$id.'&mkcstatid='.$status.'&mk='.$marketcenterid.'" rel="tooltip" title="Activate Buyer" class="btn btn-info btn-xs" ><i class="fa fa-play"></i> ACTIVATE</a>';
            }else{
               $actiontime = '<button onclick="editBuyerMKC('.$bid.')" rel="tooltip" title="Update Market Centre" class="btn btn-info btn-xs" ><i class="fa fa-edit"></i> EDIT</button> '
                . '<a href="seasondetails.php?actbuyer='.$bid.'&sidd='.$id.'&mkcstatid='.$status.'&mk='.$marketcenterid.'" rel="tooltip" title="Deactivate Buyer" class="btn btn-warning btn-xs" ><i class="fa fa-pause"></i> DEACTIVE</a>'; 
            }
        }else{
            $actiontime = '';
        }
        
        array_push($memberinfo, $actiontime);
        array_push($lstBuyers, $memberinfo);
    }
    
    //warehouse list
    $warehouseData = $seasons->lstAllWarehouse($id); //select list of sorting data
    $lstwarehouseData = array();
    foreach($warehouseData as $value){
        $memberinfo = array();
        $wid = $value['wid']; //ipcID
        
        //get association
        
        $warehouse = $value['wname']; //warehouse name
        $code = $value['wcode']; //code
        $ipc = $value['ipcname']; //ipc
        $status = $value['status']; //status
        
        //cg7
        //chalim
        //total
        //action time
        if($_SESSION['nasfam_usertype'] == '1'){
            if($value['status'] == 'INACTIVE'){
                $actiontime = '<button onclick="editWarehouseIPC('.$wid.')" rel="tooltip" title="Update IPC" class="btn btn-info btn-xs" ><i class="fa fa-edit"></i> EDIT IPC</button> '
                . '<a href="seasondetails.php?actwareh='.$wid.'&sidd='.$id.'&mkcstatid='.$status.'" rel="tooltip" title="Activate Warehouse" class="btn btn-info btn-xs" ><i class="fa fa-play"></i> ACTIVATE</a>';
            }else{
               $actiontime = '<button onclick="editWarehouseIPC('.$wid.')" rel="tooltip" title="Update IPC" class="btn btn-info btn-xs" ><i class="fa fa-edit"></i> EDIT IPC</button> '
                . '<a href="seasondetails.php?actwareh='.$wid.'&sidd='.$id.'&mkcstatid='.$status.'" rel="tooltip" title="Deactivate Warehouse" class="btn btn-warning btn-xs" ><i class="fa fa-pause"></i> DEACTIVE</a>'; 
            }
        }else{
            $actiontime = '';
        }
        
        array_push($memberinfo, $warehouse);
        array_push($memberinfo, $code);
        array_push($memberinfo, $ipc);
        
        array_push($memberinfo, $status);
        
        array_push($memberinfo, 'cg7');
        array_push($memberinfo, 'chalim');
        array_push($memberinfo, 'total');
        array_push($memberinfo, $actiontime);
        
        array_push($lstwarehouseData, $memberinfo);
    }
    
    //casual workers list
    $lstCasualWorkersData = $seasons->lstCasualWorkersData($id);//select list of sorting data
    $lstCasualWorkers = array();
    foreach($lstCasualWorkersData as $value){
        $memberinfo = array();
        $cwid = $value['cwid']; //casual worker id
        $casualworkers = $value['cwname']; //casual worker name
        $gender= $value['gender']; //gender
        $code = $value['cwcode']; //code
        $warehouse = $value['warehouse']; //warehouse
        $status = $value['status']; //status
        
        if($_SESSION['nasfam_usertype'] == '1'){
            if($value['status'] == 'INACTIVE'){
                $actiontime = '<button onclick="editWarehouseCW('.$cwid.')" rel="tooltip" title="Update IPC" class="btn btn-info btn-xs" ><i class="fa fa-edit"></i> EDIT Warehouse</button> '
                . '<a href="seasondetails.php?actcaswo='.$cwid.'&sidd='.$id.'&mkcstatid='.$status.'" rel="tooltip" title="Activate Casual Worker" class="btn btn-info btn-xs" ><i class="fa fa-play"></i> ACTIVATE</a>';
            }else{
               $actiontime = '<button onclick="editWarehouseCW('.$cwid.')" rel="tooltip" title="Update IPC" class="btn btn-info btn-xs" ><i class="fa fa-edit"></i> EDIT Warehouse</button> '
                . '<a href="seasondetails.php?actcaswo='.$cwid.'&sidd='.$id.'&mkcstatid='.$status.'" rel="tooltip" title="Deactivate Casual Worker" class="btn btn-warning btn-xs" ><i class="fa fa-pause"></i> DEACTIVE</a>'; 
            }
        }else{
            $actiontime = '';
        }
       
        array_push($memberinfo, $casualworkers);
        array_push($memberinfo, $code);
        array_push($memberinfo, $gender);
        array_push($memberinfo, $warehouse);
        
        array_push($memberinfo, $status); //status
        
        array_push($memberinfo, 'CG7'); //status
        array_push($memberinfo, 'CHALIM'); //status
        array_push($memberinfo, 'TOTAL'); //status
        
        array_push($memberinfo, $actiontime);
        
        array_push($lstCasualWorkers, $memberinfo);
    }
}

if(isset($_POST['addnewWarehouse'])){
    $seasonid = $_POST['seasonID']; //market center name season id
    
    $fname = $_FILES['file']['name'];
    $chk_ext = explode(".", $fname);
    if(strtolower(end($chk_ext)) == "csv")
    {
        $filename = $_FILES['file']['tmp_name'];
        $handle = fopen($filename, "r");

        fgetcsv($handle, 1000, ","); //abandon the first record 
        while(($data = fgetcsv($handle, 1000, ",")) !== false)
        {               
            $warehousecode = $data[0]; //market center         
            $names = strtoupper($data[1]); //name
            
            $prefx = 'WHS';
            $getItemCount = $seasons->GetRecentWarehouseCounter();
            if($getItemCount == 0){
                echo 'no entries';
                $mcount = 1; //set first counter
                $newNumber = $prefx.''.$mcount; //set new item code              
                //$addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item
            }else{
                echo 'entries exists';
                $mcount = $getItemCount += 1; //set count
                $newNumber = $prefx.''.$mcount; //set new item code
                //$addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item                
            }
            $addNewWarehouse = $seasons->addNewWarehouse($warehousecode,$names,$newNumber,$seasonid);               
        }
        fclose($handle);
        $_SESSION['notification']['title'] = 'SUCCESS!';
        $_SESSION['notification']['message'] = 'Successfuly added Warehouse!';
        header("Location: seasondetails.php?sid=$seasonid");
        exit();
    }else{
        $_SESSION['notification']['title'] = 'FAILED!';
        $_SESSION['notification']['message'] = 'Failed to add Warehouses! Please try again, if this problem persists, please contact your admin';
        header("Location: seasondetails.php?sid=$seasonid");
        exit();
    }
}

if(isset($_POST['editWarehouseCW'])){
    $cw = $_POST['editWarehouseCWID']; //casual worker
    $seasonID = $_POST['seasonID']; //season
    $whs = $_POST['whss']; //warehouse
    
    $updateIPCwhs = $seasons->updateCWwhs($whs,$cw);
    if($updateIPCwhs == 1){
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = 'Casual Worker updated succesfully!';
        header("Location: seasondetails.php?sid=$seasonID");
        exit();
    }else{
        $_SESSION['notification']['title'] = 'FAILED!';
        $_SESSION['notification']['message'] = 'Something went wrong! Casual Worker failed to update. Please try again, if this problem persists, please contact your admin!';
        header("Location: seasondetails.php?sid=$seasonID");
        exit();
    }
}

if(isset($_POST['editWarehouseIPC'])){
    $whs = $_POST['editWarehouseIPCID']; //buyer id
    $seasonID = $_POST['seasonID']; //season
    $ipc = $_POST['ipcss']; //season
    
    $updateIPCwhs = $seasons->updateIPCwhs($ipc,$whs);
    if($updateIPCwhs == 1){
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = 'Warehouse updated succesfully!';
        header("Location: seasondetails.php?sid=$seasonID");
        exit();
    }else{
        $_SESSION['notification']['title'] = 'FAILED!';
        $_SESSION['notification']['message'] = 'Something went wrong! Warehouse failed to update. Please try again, if this problem persists, please contact your admin!';
        header("Location: seasondetails.php?sid=$seasonID");
        exit();
    }   
}

//href="seasondetails.php?actcaswo='.$cwid.'&sidd='.$id.'&mkcstatid='.$status.'"
if(isset($_GET['actcaswo'])){
    $casualworker = $_GET['actcaswo']; //buyer id
    $season = $_GET['sidd']; //season id
    $status = $_GET['mkcstatid']; //status
    
    if($status == 'ACTIVE'){
        echo 'ACTIVE';
        $newstatus = 'INACTIVE';
        $activateBuyer = $seasons->activateCasualWorker($newstatus,$casualworker);
        
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = 'Casual Worker Successfuly deactivated!';
        header("Location: seasondetails.php?sid=$season");
        exit();
    }else{
        $newstatus = 'ACTIVE';
        $activateBuyer = $seasons->activateCasualWorker($newstatus,$casualworker);
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = 'Casual Worker Successfuly activated!';
        header("Location: seasondetails.php?sid=$season");
        exit(); 
    }
}

//seasondetails.php?actwareh='.$wid.'&sidd='.$id.'&mkcstatid='.$status.
if(isset($_GET['actwareh'])){
    $warehouse = $_GET['actwareh']; //buyer id
    $season = $_GET['sidd']; //season id
    $status = $_GET['mkcstatid']; //status
    
    if($status == 'ACTIVE'){
        echo 'ACTIVE';
        $newstatus = 'INACTIVE';
        $activateBuyer = $seasons->activateWHS($newstatus,$warehouse);
        
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = 'Warehouse Successfuly deactivated!';
        header("Location: seasondetails.php?sid=$season");
        exit();
    }else{
        $newstatus = 'ACTIVE';
        $activateBuyer = $seasons->activateWHS($newstatus,$warehouse);
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = 'Warehouse Successfuly activated!';
        header("Location: seasondetails.php?sid=$season");
        exit(); 
    }
}

if(isset($_GET['actbuyer'])){
    $buyer = $_GET['actbuyer']; //buyer id
    $season = $_GET['sidd']; //season id
    $status = $_GET['mkcstatid']; //status
    $marketcentre = $_GET['mk']; //mk
    
    echo $buyer.' '.$season.' '.$status.'<br>';
    if($status == 'ACTIVE'){
        echo 'ACTIVE';
        $newstatus = 'INACTIVE';
        $activateBuyer = $seasons->activateBuyer($newstatus,$buyer);
        
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = 'Buyer Successfuly deactivated!';
        header("Location: seasondetails.php?sid=$season");
        exit();
    }else{
        $newstatus = 'ACTIVE';
        $deactivateBuyers = $seasons->deactivateBuyers('INACTIVE',$marketcentre); //deactivate all other buyers
        if($deactivateBuyers == 1){
            $activateBuyer = $seasons->activateBuyer($newstatus,$buyer);
            $_SESSION['notification']['title'] = 'PASSED!';
            $_SESSION['notification']['message'] = 'Buyer Successfuly activated!';
            header("Location: seasondetails.php?sid=$season");
            exit();
        }else{
            
        }
        
        
        
    }
}

if(isset($_POST['editMKCBuyers'])){
    $buyerid = $_POST['editMKCBuyersID']; //buyer id
    $seasonID = $_POST['seasonID']; //season
    $marketcs = $_POST['marketcs']; //season
    
    $updateMKCStat = $seasons->updateMKCsBuyer($marketcs,$buyerid);
    if($updateMKCStat == 1){
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = 'Market Centre update succesfully!';
        header("Location: seasondetails.php?sid=$seasonID");
        exit();
    }else{
        $_SESSION['notification']['title'] = 'FAILED!';
        $_SESSION['notification']['message'] = 'Something went wrong! Market Centre failed to update. Please try again, if this problem persists, please contact your admin!';
        header("Location: seasondetails.php?sid=$seasonID");
        exit();
    }   
}

if(isset($_GET['demkc'])){
    $market = $_GET['demkc']; //market
    $season = $_GET['sidd']; //season
    $status = $_GET['mkcstatid']; //season
    
    echo $market.' '.$season.' '.$status.'<br>';
    
    if($status == 'ACTIVE'){
        echo 'ACTIVE';
        $newstatus = 'INACTIVE';
        $updateMKCStat = $seasons->updateMKCStat($newstatus,$market);
        
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = 'Market Centre Successfuly deactivated!';
        header("Location: seasondetails.php?sid=$season");
        exit();
    }else{
        $newstatus = 'ACTIVE';
        $updateMKCStat = $seasons->updateMKCStat($newstatus,$market);
        
        $_SESSION['notification']['title'] = 'PASSED!';
        $_SESSION['notification']['message'] = 'Market Centre Successfuly activated!';
        header("Location: seasondetails.php?sid=$season");
        exit();
    }  
}

//update season header
if(isset($_POST['updateseasonheader'])){
    echo 'update season';
    
    $id = $_POST['seasonID']; //season id
    $season = $_POST['editseason'];//season name
    $start = $_POST['editstartdate'];//start date
    $end = $_POST['editenddate'];//end date
    $procurement = $_POST['editprocurement'];//procurement
    
    $startdate1 = date("Y", strtotime($start));
    $enddate1 = date("Y", strtotime($end));
    $CheckYearExist = $dashboard->CheckYearExist1($startdate1,$enddate1,$id);
        if($CheckYearExist >= 1){ //exists, notify user
            echo 'exists';
            $_SESSION['notification']['title'] = 'FAILED!';
            $_SESSION['notification']['message'] = 'Season between those dates already exists!';
            header("Location: seasondetails.php?sid=$id");
            exit();
        }else{ //doesnt exist, create new reg year
            echo 'doesnt exist';
            $updateseason = $dashboard->updateseason($start,$end,$season,$procurement,$id);
            $_SESSION['notification']['title'] = 'PASSED!';
            $_SESSION['notification']['message'] = 'Season Successfuly updated!';
            header("Location: seasondetails.php?sid=$id");
            exit();
        }
        
}


if(isset($_POST['addnewBuyers'])){
    $seasonid = $_POST['seasonID']; //market center name season id
    
    
    $fname = $_FILES['file']['name'];
    $chk_ext = explode(".", $fname);
    if(strtolower(end($chk_ext)) == "csv")
    {
        $filename = $_FILES['file']['tmp_name'];
        $handle = fopen($filename, "r");

        fgetcsv($handle, 1000, ","); //abandon the first record 
        while(($data = fgetcsv($handle, 1000, ",")) !== false)
        {               
            $mkcode = $data[0]; //market center         
            $names = strtoupper($data[1]); //name
            $lnames = strtoupper($data[2]);//last name
            $gender = strtoupper($data[3]); //gender
            $contacts = $data[4]; //contacts
            
            $prefx = 'BYR';
            $getItemCount = $seasons->buyersCount();
            if($getItemCount == 0){
                echo 'no entries';
                $mcount = 1; //set first counter
                $newNumber = $prefx.''.$mcount; //set new item code              
                //$addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item
            }else{
                echo 'entries exists';
                $mcount = $getItemCount += 1; //set count
                $newNumber = $prefx.''.$mcount; //set new item code
                //$addIntoCodeRegister = $districts->addIntoCodeRegister($item,$mcount,$newNumber); //add entry into code register for item                
            }

            $addNewBuyer = $seasons->addNewBuyer($mkcode,$names,$lnames,$gender,$contacts,$seasonid,$newNumber);               
        }
        fclose($handle);
        $_SESSION['notification']['title'] = 'SUCCESS!';
        $_SESSION['notification']['message'] = 'Successfuly added buyers!';
        header("Location: seasondetails.php?sid=$seasonid");
        exit();
    }else{
        $_SESSION['notification']['title'] = 'FAILED!';
        $_SESSION['notification']['message'] = 'Failed to add buyers! Please try again, if this problem persists, please contact your admin';
        header("Location: seasondetails.php?sid=$seasonid");
        exit();
    }
    

}


//add market center
if(isset($_POST['addNewMarketCenter'])){
    //Add market center
    $marketcentername = $_POST['marketcentername']; //market center name
    $mpa = $_POST['mpa']; //mpa
    $seasonid = $_POST['seasonID']; //market center name season id
    
    $prefx = 'MKC';
    $getItemCount = $seasons->GetRecentItemCounter();
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
    
    $addMarketCenter = $seasons->addMarketCenter($marketcentername,$mpa,$newNumber,$seasonid);
    if($addMarketCenter == 1){

        $NewMarketCenterID = $seasons->RecentMarketCenterDetails(); //get market center ID
        
        $fname = $_FILES['file']['name'];
        $chk_ext = explode(".", $fname);
        if(strtolower(end($chk_ext)) == "csv")
        {
            $filename = $_FILES['file']['tmp_name'];
            $handle = fopen($filename, "r");

            fgetcsv($handle, 1000, ","); //abandon the first record 
            while(($data = fgetcsv($handle, 1000, ",")) !== false)
            {               
                $getnames = $data[0];               
                $GacID = $seasons->GetGacDetailsClubCode($getnames); //get gac id             
                $addGacsToMarketCenter = $seasons->addGacsToMarketCenter($NewMarketCenterID,$GacID);                
            }
            fclose($handle);
            $_SESSION['notification']['title'] = 'SUCCESS!';
            $_SESSION['notification']['message'] = 'Successfuly added!';
            header("Location: seasondetails.php?sid=$seasonid");
            exit();
        }else{
            $_SESSION['notification']['title'] = 'FAILED!';
            $_SESSION['notification']['message'] = 'Something went wrong! Market Center has been added, but GACs failed to add. Please try again, if this problem persists, please contact your admin';
            header("Location: seasondetails.php?sid=$seasonid");
            exit();
        }
        
    }else{
        $_SESSION['notification']['title'] = 'FAILED!';
        $_SESSION['notification']['message'] = 'Something went wrong! Market Center failed to add. Please try again, if this problem persists, please contact your admin';
        header("Location: seasondetails.php?sid=$seasonid");
        exit();
    }
}

//add purchase
if(isset($_POST['addPurchase'])){
    $seasonid = $_POST['seasonID']; //market center name season id
 
    $fname = $_FILES['file']['name'];
        $chk_ext = explode(".", $fname);
        if(strtolower(end($chk_ext)) == "csv")
        {
            $filename = $_FILES['file']['tmp_name'];
            $handle = fopen($filename, "r");

            fgetcsv($handle, 1000, ","); //abandon the first record 
            while(($data = fgetcsv($handle, 1000, ",")) !== false)
            {               
                $receipt = $data[0]; //receipt
                $date = $data[1]; //date
                
                $gender = strtoupper($data[3]); //gender
                $member = $data[4]; //member status
                $type = $data[5]; //type
                $qty = $data[6]; //qty
                //$cum = $data[7]; //cum
                $price = $data[7]; //price
                $mwk = $data[8]; //mkw
                $market = $data[9]; //market center
                
                $buyerID = $seasons->GetBuyersID($market,$seasonid); //get buyer id
                
                if($member == 'member'){//none member purchase
                    $farmer = $data[2]; //farmer
                    $farmerstatus = '1';
                    $addMemberPurchase = $seasons->addMemberPurchase($receipt,$date,$buyerID,$farmerstatus,$type,$qty,$price,$mwk,$seasonid,$farmer);
                }else{ //member purchase  
                    $farmer = strtoupper($data[2]); //farmer
                    $farmerstatus = '0';
                    $addNoneMemberPurchase = $seasons->addNoneMemberPurchase($receipt,$date,$buyerID,$farmer,$gender,$farmerstatus,$type,$qty,$price,$mwk,$seasonid);
                }

                
            }
            fclose($handle);
            $_SESSION['notification']['title'] = 'SUCCESS!';
            $_SESSION['notification']['message'] = 'Successfuly added!';
            header("Location: seasondetails.php?sid=$seasonid");
            exit();
        }else{
            $_SESSION['notification']['title'] = 'FAILED!';
            $_SESSION['notification']['message'] = 'Please ensure that the file uploaded is in CSV format and inline with the template provided';
            header("Location: seasondetails.php?sid=$seasonid");
            exit();
        }
}

//delete purchase
if(isset($_GET['delPID'])){
    $pid = $_GET['delPID']; //purchase id to be deleted
    $sid = $_GET['sid']; //season id
    
    $removePurchase = $seasons->removePurchase($pid); //delete purchase
    if($removePurchase == 1){
        $_SESSION['notification']['title'] = 'SUCCESS!';
        $_SESSION['notification']['message'] = 'Successfuly Removed Purchase!';
        header("Location: seasondetails.php?sid=$sid");
        exit();
    }else{
        $_SESSION['notification']['title'] = 'FAILED!';
        $_SESSION['notification']['message'] = 'Failed to remove the purchase, please try again';
        header("Location: seasondetails.php?sid=$sid");
        exit();
    } 
}

//add sorting
if(isset($_POST['addSorting'])){
    $seasonid = $_POST['seasonID']; //market center name season id
    
    $fname1 = $_FILES['file']['name'];
    $chk_ext1 = explode(".", $fname1);
    if(strtolower(end($chk_ext1)) == "csv")
    {
        $filename1 = $_FILES['file']['tmp_name'];
        $handle1 = fopen($filename1, "r");

        fgetcsv($handle1, 1000, ","); //abandon the first record 
        while(($data1 = fgetcsv($handle1, 1000, ",")) !== false)
        {
            $casualworker = $data1[0]; //casual worker code
            $date = $data1[1]; //date
            $qty = $data1[2]; //qty
            $variety = $data1[3];//variety
            $gradeouts = $data1[4];//gradeouts
            $shells = $data1[5];//shells
            $grade1 = $data1[6];//warehouse code
            $grade2 = $data1[7];//grade1
            $grade3 = $data1[8];//garde2
            $grade4 = $data1[9];//grade3
            $grade5 = $data1[10];//grade4
           

            $addSorting = $seasons->addSorting($casualworker,$date,$qty,$variety,$gradeouts,$shells,$grade1,$grade2,$grade3,$grade4,$grade5,$seasonid);
                        
        }
        fclose($handle1);
        $_SESSION['notification']['title'] = 'SUCCESS!';
        $_SESSION['notification']['message'] = 'Sorting Data Successfuly added!';
        header("Location: seasondetails.php?sid=$seasonid");
        exit();
    }else{
        $_SESSION['notification']['title'] = 'FAILED!';
        $_SESSION['notification']['message'] = 'Please make sure that the file uploaded is a CSV file and make sure you have used the correct template';
        header("Location: seasondetails.php?sid=$seasonid");
        exit();
    }
}

//view buyer details
if(isset($_GET['bpdid'])){
    $mcid = $_GET['bpdid']; //mcid
    $buyer = $_GET['bid']; //buyer
    $date = $_GET['did']; //date
    
    $BuyerPurchaseDetails = $seasons->GetBuyerPurchaseDetails($mcid,$buyer,$date);
    
    $buyerName = $BuyerPurchaseDetails[0][5]; //buyer
    $marketcenter = $BuyerPurchaseDetails[0][7];//market center
    
}

//add warehouse

//add buyer 

//add casual workers
if(isset($_POST['addCasualWorkers'])){
    $seasonid = $_POST['seasonID']; //market center name season id

    $fname1 = $_FILES['file']['name'];
    $chk_ext1 = explode(".", $fname1);
    if(strtolower(end($chk_ext1)) == "csv")
    {
        $filename1 = $_FILES['file']['tmp_name'];
        $handle1 = fopen($filename1, "r");

        fgetcsv($handle1, 1000, ","); //abandon the first record 
        while(($data1 = fgetcsv($handle1, 1000, ",")) !== false)
        {
            //count casual workers
            $GetCasualWorkersCounter = $seasons->GetCasualWorkersCounter();
            $prefx2 = 'CWK';
            if($GetCasualWorkersCounter == 0){
                echo 'no entries';
                $mcount2 = 1; //set first counter
                $newNumber2 = $prefx2.''.$mcount2; //set new item code              
                //$addIntoCodeRegister2 = $districts->addIntoCodeRegister($item,$mcount2,$newNumber2); //add entry into code register for item
            }else{
                echo 'entries exists';
                $mcount2 = $GetCasualWorkersCounter += 1; //set count
                $newNumber2 = $prefx2.''.$mcount2; //set new item code
                //$addIntoCodeRegister2 = $districts->addIntoCodeRegister($item,$mcount2,$newNumber2); //add entry into code register for item                
            }

            $whs = $data1[0];
            $names = strtoupper($data1[1]);
            $lname = strtoupper($data1[2]);
            $gender = strtoupper($data1[3]);

            $addCasualworker = $seasons->addCasualworker($whs,$names,$lname,$gender,$newNumber2,$seasonid);               
        }
        fclose($handle1);
        $_SESSION['notification']['title'] = 'SUCCESS!';
        $_SESSION['notification']['message'] = 'Casual Workers Successfuly added!';
        header("Location: seasondetails.php?sid=$seasonid");
        exit();
    }else{
        $_SESSION['notification']['title'] = 'FAILED!';
        $_SESSION['notification']['message'] = 'Something went wrong! Warehouse Casual Workers failed to add. Please try again, if this problem persist, please contact your admin';
        header("Location: seasondetails.php?sid=$seasonid");
        exit();
    }
}

//update purchase nuts details
if(isset($_POST['editpurchase'])){
    $seasonid = $_POST['seasonID']; //market center name season id
    $editpurchaseid = $_POST['editpurchaseid']; //purchase id
    
    $edittype = $_POST['editpurchase'];

    switch($edittype){
        case "editpurchaseMKC";
            $mkc = $_POST['mkc'];
            $editpurchaseMKC = $seasons->editpurchaseMKC($mkc,$editpurchaseid);
            if($editpurchaseMKC == 1){
                $_SESSION['notification']['title'] = 'SUCCESS!';
                $_SESSION['notification']['message'] = 'Purchase updated successfully';
                header("Location: seasondetails.php?sid=$seasonid");
                exit();
            }else{
                $_SESSION['notification']['title'] = 'FAILED!';
                $_SESSION['notification']['message'] = 'Something went wrong! Purchase updated failed. Please try again, if this problem persist, please contact your admin';
                header("Location: seasondetails.php?sid=$seasonid");
                exit();
            }            
            break;
        case "editpurchaseF";
            $farmer = $_POST['editfarmertype'];
            if($farmer == 'none'){
                $farmername = strtoupper($_POST['editfarmername']); //editfarmer
                $gender = $_POST['farmergender']; //gender
                $editpurchaseF = $seasons->editpurchaseF($farmername,$gender,$editpurchaseid);
                if($editpurchaseF == 1){
                    $_SESSION['notification']['title'] = 'SUCCESS!';
                    $_SESSION['notification']['message'] = 'Purchase updated successfully';
                    header("Location: seasondetails.php?sid=$seasonid");
                    exit();
                }else{
                    $_SESSION['notification']['title'] = 'FAILED!';
                    $_SESSION['notification']['message'] = 'Something went wrong! Purchase updated failed. Please try again, if this problem persist, please contact your admin';
                    header("Location: seasondetails.php?sid=$seasonid");
                    exit();
                }
            }else{
                $mnumber = $_POST['mnumber']; //mnumber
                $editpurchaseFM = $seasons->editpurchaseFM($mnumber,$editpurchaseid);
                if($editpurchaseFM == 1){
                    $_SESSION['notification']['title'] = 'SUCCESS!';
                    $_SESSION['notification']['message'] = 'Purchase updated successfully';
                    header("Location: seasondetails.php?sid=$seasonid");
                    exit();
                }else{
                    $_SESSION['notification']['title'] = 'FAILED!';
                    $_SESSION['notification']['message'] = 'Something went wrong! Purchase updated failed. Please try again, if this problem persist, please contact your admin';
                    header("Location: seasondetails.php?sid=$seasonid");
                    exit();
                }
            }
            break;
        case "editpurchaseR";
            $receipt = $_POST['receipt']; //receipt number
            //$rdate = $_POST['rdate']; //date
            $a = explode('-',$_POST['rdate']); //date requested 
            $rdate = $a[2].'-'.$a[1].'-'.$a[0];
    
            $checkPurchaseReceipt = $seasons->checkPurchaseReceipt($receipt,$editpurchaseid); //check if receipt number not already in the system
            if($checkPurchaseReceipt >= 1){
                $_SESSION['notification']['title'] = 'FAILED!';
                $_SESSION['notification']['message'] = 'That Receipt number is already being used';
                header("Location: seasondetails.php?sid=$seasonid");
                exit();
            }else{
                $editpurchaseRD = $seasons->editpurchaseRD($receipt,$rdate,$editpurchaseid);
                if($editpurchaseRD >= 1){
                    $_SESSION['notification']['title'] = 'SUCCESS!';
                    $_SESSION['notification']['message'] = 'Purchase updated successfully';
                    header("Location: seasondetails.php?sid=$seasonid");
                    exit();
                }else{
                    $_SESSION['notification']['title'] = 'FAILED!';
                    $_SESSION['notification']['message'] = 'Something went wrong! Purchase updated failed. Please try again, if this problem persist, please contact your admin';
                    header("Location: seasondetails.php?sid=$seasonid");
                    exit();
                }
                
            }
            
            break;
        case "editpurchaseRD";
            $varietytype = $_POST['varietytype']; //varietytype
            $qty = $_POST['qty']; //qty
            $cum = $_POST['cum']; //cum
            $price = $_POST['price']; //price
            $mwk = $_POST['mwk']; //mwk
            $editpurchaseRDetails = $seasons->editpurchaseRDetails($varietytype,$qty,$cum,$price,$mwk,$editpurchaseid);
            if($editpurchaseRDetails >= 1){
                    $_SESSION['notification']['title'] = 'SUCCESS!';
                    $_SESSION['notification']['message'] = 'Purchase updated successfully';
                    header("Location: seasondetails.php?sid=$seasonid");
                    exit();
                }else{
                    $_SESSION['notification']['title'] = 'FAILED!';
                    $_SESSION['notification']['message'] = 'Something went wrong! Purchase updated failed. Please try again, if this problem persist, please contact your admin';
                    header("Location: seasondetails.php?sid=$seasonid");
                    exit();
                }
            break;
    }
    
    
    
}

//update casual worker details