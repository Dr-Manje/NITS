<?php

include_once ('../../config/config.php');

class seasonsmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //total amount spent
    function memberPartipation($season,$gender){
        $query = $this->link->query("select distinct(P.member) as member, M.gender 
                                    from purchases P 
                                    join members M on M.memberID = P.member
                                    where P.season = '$season' 
                                    and P.farmerstatus = 1 
                                    and M.gender = '$gender' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //total amount spent
    function nonememberPartipation($season,$gender){
        $query = $this->link->query("select count(*) as cnt from purchases where season = '$season' and farmerstatus = 0 and gender = '$gender' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //total amount spent
    function totalAmountSpent($season){
        $query = $this->link->query("select sum(mwk) as totalspent from purchases where season = '$season' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //second report
    function seasonSecondReport($season,$variety){
        $query = $this->link->query("select sum(P.qty) as qty 
                                    from purchases P
                                    join buyers B on B.buyersid = P.buyer
                                    join marketcenter MC on MC.marketcenterid = B.marketcenter
                                    where MC.marketcenterid = '$season' and P.type = '$variety' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //first report
    function seasonfirstReport($season){
        $query = $this->link->query("select sum(P.qty) as qty, sum(P.mwk) as receipttotal 
                                    from purchases P
                                    join buyers B on B.buyersid = P.buyer
                                    join marketcenter MC on MC.marketcenterid = B.marketcenter
                                    where MC.marketcenterid = '$season' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function seasonMarketCenters($season){
        $query = $this->link->query("SELECT * 
                                    FROM marketcenter
                                    where regYear = '$season' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //dashboard items
    //total districts,ipcs,gacs,clubs
    function countDistricts($table){
        $query = $this->link->query("SELECT count(*) as cnt FROM $table ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //add new dispatch trip
    function addNewDispatchTrip($date,$departure,$destination,$cg7,$chalim,$confirmed,$confirmedby,$confirmeddate,$status,$notes,$season){
        $query = $this->link->prepare("INSERT INTO dispatch (dispatchdate,dispatchdeparture,dispatchdestination,cg7,chalim,confirmed,confirmedby,confirmeddate,status,notes,season) VALUES (?,?,?,?,?,?,?,?,?,?,?)");        
        $values = array($date,$departure,$destination,$cg7,$chalim,$confirmed,$confirmedby,$confirmeddate,$status,$notes,$season);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    function getDispatchLocation($code){
        $query = $this->link->query("SELECT dispatchbuyersid
                                    FROM dispatchlocations
                                    WHERE fieldcode = '$code' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //update donors
    function updateDonorsDetails($viewfieldname,$viewcontacts,$id){
        $query = $this->link->prepare("update donors set fieldname = '$viewfieldname', contacts = '$viewcontacts'
                                        where donorsid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    //update dispatch location details
    function updateDispatchLocationDetails($viewfieldname,$viewlocation,$viewcontacts,$id){
        $query = $this->link->prepare("update dispatchlocations set fieldname = '$viewfieldname', location = '$viewlocation', contacts = '$viewcontacts'
                                        where dispatchbuyersid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    //update dispatch
    function UpdateDispatch($did,$dispatchdate,$departure,$destination,$cg7,$chalim,$confirmed,$confirmedby,$confirmeddate,$status,$notes){
        $query = $this->link->prepare("UPDATE dispatch SET dispatchdate = '$dispatchdate',dispatchdeparture = '$departure',dispatchdestination = '$destination' "
                . ",cg7 = '$cg7',chalim = '$chalim',confirmed = '$confirmed' "
                . ",confirmedby = '$confirmedby',confirmeddate = '$confirmeddate',status = '$status',notes = '$notes' "
                . "WHERE dispatchid = '$did' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //update donor status
    function UpdateDonorSatus($id,$status){
        $query = $this->link->prepare("UPDATE donors SET status = '$status' WHERE donorsid = '$id' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //update dispatch location
    function UpdateDispatchLocationSatus($id,$status){
        $query = $this->link->prepare("UPDATE dispatchlocations SET status = '$status' WHERE dispatchbuyersid = '$id' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    function getDonorDetails($code){
        $query = $this->link->query("select * from donors where fieldcode = '$code' ");           
        $result = $query->fetchAll();       
        return $result;
    }
    
    function ListDonors(){
        $query = $this->link->query("select * from donors ");           
        $result = $query->fetchAll();       
        return $result;
    }
    
    //list dispatch locations
    function ListDispatchLocations(){
        $query = $this->link->query("select * from dispatchlocations ");           
        $result = $query->fetchAll();       
        return $result;
    }
    
    //count dispatch locations
    function CountDispatchLocations(){
        $query = $this->link->query("select count(*) from dispatchlocations ");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    //count donor
    function CountDonors(){
        $query = $this->link->query("select count(*) from donors ");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    //add donors
    function addNewDonors($name,$contact,$newNumber){
        $query = $this->link->prepare("INSERT INTO donors (fieldname,contacts,fieldcode,status) VALUES (?,?,?,?)");        
        $values = array($name,$contact,$newNumber,'ACTIVE');        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    
    //add new dispatch location
    function addNewDispatchLocation($name,$location,$contact,$newNumber){
        $query = $this->link->prepare("INSERT INTO dispatchlocations (fieldname,location,contacts,fieldcode,status) VALUES (?,?,?,?,?)");        
        $values = array($name,$location,$contact,$newNumber,'ACTIVE');        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    function getWarehouseDetails($id){
        $query = $this->link->query("SELECT *
                                    FROM warehouse
                                    where warehouseid = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function addGradingData($date,$warehouse,$seasonid,$variety,$grade,$qty){
        $query = $this->link->prepare("insert into grading (warehouse,date,season,variety,grade,quantity)
                                        SELECT warehouseid,'$date','$seasonid','$variety','$grade','$qty' FROM warehouse where fieldcode = '$warehouse' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function addNewWarehouse($ipc,$names,$newNumber,$seasonid){
        $query = $this->link->prepare("insert into warehouse (IPC,fieldname,fieldcode,regyear,status)
                                        SELECT IPCid,'$names','$newNumber','$seasonid','INACTIVE' FROM ipc where fieldcode = '$ipc' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function addNewBuyer($mkc,$names,$lastname,$gender,$contacts,$season,$buyercode){
        $query = $this->link->prepare("insert into buyers (marketcenter,names,lastname,gender,address,status,season,buyercode)
                                        select marketcenterid,'$names','$lastname','$gender','$contacts','INACTIVE','$season','$buyercode' "
                                    . "from marketcenter where fieldcode = '$mkc' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function deactivateBuyers($status,$id){
        $query = $this->link->prepare("update buyers set status = '$status'
                                        where marketcenter = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function activateCasualWorker($status,$id){
        $query = $this->link->prepare("update casualworkers set status = '$status'
                                        where casualworkersid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function activateWHS($status,$id){
        $query = $this->link->prepare("update warehouse set status = '$status'
                                        where warehouseid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function activateBuyer($status,$id){
        $query = $this->link->prepare("update buyers set status = '$status'
                                        where buyersid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function updateCWwhs($whs,$id){
        $query = $this->link->prepare("update casualworkers set warehouse = '$whs' where casualworkersid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function updateIPCwhs($ipc,$id){
        $query = $this->link->prepare("update warehouse set IPC = '$ipc' where warehouseid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function updateMKCsBuyer($mkc,$id){
        $query = $this->link->prepare("update buyers set marketcenter = '$mkc', status = 'INACTIVE' where buyersid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function updateMKCStat($status,$id){
        $query = $this->link->prepare("update marketcenter set status = '$status'
                                        where marketcenterid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function deleteGacsMKC($id){
        $query = $this->link->prepare("delete marketcentermembers from marketcentermembers where marketcentermembersid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function MKCDetails($id){
        $query = $this->link->query("SELECT MC.marketcenterid as mcid
                                    , MC.fieldname as marketcenter
                                    , MC.fieldcode as mkcode 
                                    , MC.mpa as mpa
                                    FROM marketcenter MC
                                    where MC.marketcenterid = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function updateMKC($newname,$mpa,$id){
        $query = $this->link->prepare("update marketcenter set fieldname = '$newname', mpa = '$mpa'
                                        where marketcenterid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    //update purchase MKC
    function editpurchaseMKC($mkc,$purchaseid){
        $query = $this->link->prepare("update purchases set buyer = (select buyersid from buyers where marketcenter = 
                                        (select marketcenterid from marketcenter
                                        where fieldcode = '$mkc') and status = 'ACTIVE')
                                        where purchasesid = '$purchaseid' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function editpurchaseF($farmername,$gender,$purchaseid){
        $query = $this->link->prepare("update purchases set farmer = '$farmername', gender = '$gender', farmerstatus = '0' where purchasesid = '$purchaseid' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function editpurchaseFM($farmername,$purchaseid){
        $query = $this->link->prepare("update purchases set member = (SELECT memberID from members where membernumber = '$farmername'), farmerstatus = '1' where purchasesid = '$purchaseid' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function checkPurchaseReceipt($receipt,$id){
        $query = $this->link->query("select count(purchasesid) as count from purchases where receipt = '$receipt' and purchasesid <> '$id' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function editpurchaseRD($receipt,$date,$purchaseid){
        $query = $this->link->prepare("update purchases set receipt = '$receipt', date = '$date' where purchasesid = '$purchaseid' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function editpurchaseRDetails($varietytype,$qty,$price,$mwk,$purchaseid){
        $query = $this->link->prepare("update purchases set type = '$varietytype', qty = '$qty', price = '$price', mwk = '$mwk' where purchasesid = '$purchaseid' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function lstWarehouses(){
        $query = $this->link->query("SELECT * FROM warehouse ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function lstMarketcs(){
        $query = $this->link->query("SELECT * FROM marketcenter ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function lstIPCs(){
        $query = $this->link->query("SELECT * FROM ipc ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get all casual workers
    function lstAllBuyersData($id){
        $query = $this->link->query("SELECT B.buyersid as bid
                                    , concat(B.names,' ',B.lastname) as buyer
                                    , B.gender as gender
                                    , B.address as address
                                    , B.status as status
                                    , B.buyercode as bcode
                                    , MC.fieldname as marketcenter
                                    , B.marketcenter as marketcenterid
                                    FROM buyers B
                                    join marketcenter MC on MC.marketcenterid = B.marketcenter
                                    where B.season = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //update buyer details
    function updateWarehouseName($editWarehouseNameID,$warehouseName){
        $query = $this->link->prepare("UPDATE warehouse set fieldname = '$warehouseName' "
                                    . "WHERE warehouseid = '$editWarehouseNameID' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    //update buyer details
    function deleteSortdata($id){
        $query = $this->link->prepare("DELETE handsorting from handsorting WHERE handsortingid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    //update buyer details
    function deleteDispatchData($id){
        $query = $this->link->prepare("DELETE dispatch from dispatch WHERE dispatchid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    //delete grading data
    function deleteGradingdata($id){
        $query = $this->link->prepare("DELETE grading from grading WHERE gradingid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    //update buyer details
    function updateCasualWorkerD($CWID,$viewfname,$viewlname,$viewgender){
        $query = $this->link->prepare("UPDATE casualworkers set names = '$viewfname', lname = '$viewlname', gender = '$viewgender'"
                                    . "WHERE casualworkersid = '$CWID' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    



    //update grading data
    function updateGradingdata($id,$viewquantity,$viewgrade,$viewvariety,$newdate){
        $query = $this->link->prepare("UPDATE grading set quantity = '$viewquantity', grade = '$viewgrade', variety = '$viewvariety'"
                                    . ", date = '$newdate' "
                                    . "WHERE gradingid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    //update buyer details
    function updateSortdata($CWsortingID,$viewvariety,$newdate,$viewqty,$viewgradeouts,$viewshells){
        $query = $this->link->prepare("UPDATE handsorting set variety = '$viewvariety', date = '$newdate', qty = '$viewqty'"
                                    . ", gradeouts = '$viewgradeouts', shells = '$viewshells' "
                                    . "WHERE handsortingid = '$CWsortingID' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    //update buyer details
    function updateBuyerDetails($fname,$lname,$gender,$contact,$BuyerID){
        $query = $this->link->prepare("UPDATE buyers set names = '$fname', lastname = '$lname', gender = '$gender', address = '$contact' WHERE buyersid = '$BuyerID' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function getBuyerSummary($id){
        $query = $this->link->query("SELECT sum(mwk) as mwk, sum(qty) as qty 
                                    FROM purchases
                                    where buyer = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get casual worker header
    function getCasualWorkerHeader($id){
        $query = $this->link->query("SELECT CW.casualworkersid as cwid
                                    , CW.names as fname
                                    , CW.lname as lname
                                    , CW.casualworkercode as cwcode, CW.gender as gender
                                    , W.fieldname as warehouse , CW.status as status
                                    , CW.season as season
                                    , W.fieldcode as whscode
                                    FROM casualworkers CW
                                    JOIN warehouse W on CW.warehouse = W.warehouseid
                                    where CW.casualworkersid = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get buyer header details
    function getBuyerHeader($id){
        $query = $this->link->query("SELECT B.buyersid as bid
                                    ,B.names as fname
                                    ,B.lastname as lastname
                                    ,B.gender as gender
                                    ,B.address as address
                                    ,B.status as status
                                    ,B.buyercode as buyercode
                                    ,M.fieldname as marketcentre
                                    ,B.season as season
                                    ,S.season as seasonname
                                    ,M.mpa as mpa 
                                    FROM buyers B
                                    join marketcenter M on M.marketcenterid = B.marketcenter
                                    join registrationyear S on S.regyearID = B.season
                                    where B.buyersid = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get buyer purchase details
    
    //number of casual workers in a warehouse
    function NoCasualWorkersInWHS($id){
        $query = $this->link->query("SELECT count(*) as cnt
                                    FROM casualworkers CW
                                    JOIN warehouse W on CW.warehouse = W.warehouseid
                                    where W.warehouseid = '$id' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function qtyVarietyInWarehouse($id,$season,$variety){
        $query = $this->link->query("select sum(H.qty) as qty
                                    from handsorting H
                                    join casualworkers CW on CW.casualworkersid = H.casualworker
                                    JOIN warehouse W on CW.warehouse = W.warehouseid
                                    where W.warehouseid = '$id' and H.season = '$season' and H.variety = '$variety' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    
    function lstAllWarehouse($id){
        $query = $this->link->query("SELECT distinct(W.warehouseid) as wid, W.fieldname as wname, W.fieldcode as wcode
                                    , W.status as status, I.fieldname as ipcname, I.IPCid as ipcid
                                    FROM warehouse W
                                    join ipc I on I.IPCid = W.IPC
                                    where W.regYear = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getAssoc($id){
        $query = $this->link->query("SELECT distinct(W.warehouseid) as wid, W.fieldname as wname, W.fieldcode as wcode
                                    , W.status as status, I.fieldname as ipcname, I.IPCid as ipcid
                                    FROM warehouse W
                                    join ipc I on I.IPCid = W.IPC
                                    where W.regYear = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get all casual workers
    function lstCasualWorkersData($id){
        $query = $this->link->query("SELECT CW.casualworkersid as cwid, concat(CW.names,' ',CW.lname) as cwname
                                    , CW.casualworkercode as cwcode, CW.gender as gender
                                    , W.fieldname as warehouse , CW.status as status
                                    FROM casualworkers CW
                                    JOIN warehouse W on CW.warehouse = W.warehouseid
                                    where CW.season = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getGradingDataWarehouse($whsID,$id){
        $query = $this->link->query("select gradingid
                                    ,DATE_FORMAT(date,'%d-%m-%Y') as pDate
                                    ,DATE_FORMAT(date,'%d-%m-%Y') as eDate
                                    ,variety
                                    ,grade
                                    ,quantity
                                    from grading 
                                    where warehouse = '$whsID' and season = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getGradingVarietyGradingData($variety,$grade,$whsID,$id){
        $query = $this->link->query("select sum(quantity) as qty from grading "
                                . "where variety = '$variety' and grade = '$grade' and warehouse = '$whsID' and season = '$id' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function getDispatchList($id){
        $query = $this->link->query("SELECT DATE_FORMAT(D.dispatchdate,'%d-%m-%Y') as departuredate
                                    ,DD.fieldname as departure
                                    ,DL.fieldname as destination
                                    ,D.cg7 as cg7
                                    ,D.chalim as chalim
                                    ,D.confirmed as confirmed
                                    ,D.confirmedby as confirmedby
                                    ,DATE_FORMAT(D.confirmeddate,'%d-%m-%Y') as confirmeddate
                                    ,D.status as status
                                    ,D.notes as notes
                                    ,D.dispatchid as did 
                                    ,D.season as season
                                    FROM dispatch D
                                    JOIN dispatchlocations DD ON DD.dispatchbuyersid = D.dispatchdeparture
                                    JOIN dispatchlocations DL ON DL.dispatchbuyersid = D.dispatchdestination
                                    WHERE D.season = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getGradingWarehouse(){
        $query = $this->link->query("select distinct G.warehouse as whsid, W.fieldname as whs from grading G join warehouse W on W.warehouseid = G.warehouse ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getHandsortingSummary($id,$variety){
        $query = $this->link->query("select sum(qty) as qty,sum(gradeouts) as gradeouts,sum(shells) as shells 
                                    from handsorting
                                    where casualworker = '$id' and variety = '$variety' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //buyer purchase details
    function GetBuyerPurchaseDetails($season,$buyer,$date){
        $query = $this->link->query("SELECT P.type as type, P.qty as qty, P.cum as cum, P.price as price, P.mwk as mwk
                                    , concat(B.names,' ',B.lastname) as buyer, B.gender as gender, MC.fieldname as marketcenter
                                    ,P.season as season, P.receipt as receipt
                                    FROM purchases P
                                    join buyers B on P.buyer = B.buyersid
                                    join marketcenter MC on B.marketcenter = MC.marketcenterid
                                    where P.season = '$season' and P.buyer = '$buyer' and DATE_FORMAT(P.date,'%D %M %Y') = '$date' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function lstSortingData($id){
        $query = $this->link->query("SELECT distinct HS.casualworker as cwid
                                    , concat(CW.names,' ',CW.lname) as casualworker
                                    , DATE_FORMAT(HS.date,'%D %M %Y') as hsDate
                                    FROM handsorting HS
                                    join casualworkers CW on HS.casualworker = CW.casualworkersid
                                    where HS.season = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getSortingSummaryData($season,$cw,$date,$variety){
        $query = $this->link->query("select sum(qty) as qty,sum(gradeouts) as gradeouts,sum(shells) as shells
                                    ,sum(grade1) as g1,sum(grade2) as g2,sum(grade3) as g3
                                    ,sum(grade4) as g4,sum(grade5) as g5
                                    from handsorting 
                                    where season = '$season' and casualworker = '$cw' and DATE_FORMAT(date,'%D %M %Y') = '$date' and variety = '$variety' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getSeasonBuyersQty($season,$buyer,$date){
        $query = $this->link->query("SELECT sum(P.qty) as qty
                                    FROM purchases P
                                    join buyers B on P.buyer = B.buyersid
                                    join marketcenter MC on B.marketcenter = MC.marketcenterid
                                    where P.season = '$season' and P.buyer = '$buyer' and DATE_FORMAT(P.date,'%D %M %Y') = '$date' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function getSeasonBuyers($id){
        $query = $this->link->query("SELECT distinct P.buyer as buyerid
                                    ,concat(B.names,' ',B.lastname) as buyer
                                    ,MC.fieldname as marketcenter
                                    ,DATE_FORMAT(P.date,'%D %M %Y') as pDate
                                    FROM purchases P
                                    join buyers B on P.buyer = B.buyersid
                                    join marketcenter MC on B.marketcenter = MC.marketcenterid
                                    where P.season = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get member details
    function MemberPurchaseDetails($id){
        $query = $this->link->query("SELECT concat(M.names,' ',M.surname) as membername
                                    ,M.gender as gender
                                    ,C.fieldname as clubname
                                    , G.fieldname as gacname
                                    ,M.memberNumber as mnumber
                                    FROM members M 
                                    join clubs C on M.club = clubsID
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    join districtsregyear DY on DY.districtsregyearID = I.fieldref
                                    join districts D on D.districtID = DY.district
                                    join registrationyear RY on RY.regyearID = DY.regyear
                                    where M.memberID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function lstPurchasesList($id){
        $query = $this->link->query("SELECT P.purchasesid as pid
                                    ,P.receipt as receipt
                                    ,DATE_FORMAT(P.date,'%D %M %Y') as pDate
                                    ,P.buyer
                                    ,P.farmer as farmer
                                    ,P.gender as gender
                                    ,P.farmerstatus as farmerstatus
                                    ,P.type as type
                                    ,P.qty as qty
                                    ,P.cum as cum
                                    ,P.price as price
                                    ,P.mwk as mwk
                                    ,P.season as season
                                    ,concat(B.names,' ',B.lastname) as buyer
                                    ,MC.fieldname as marketcenter
                                    ,P.member as member
                                    ,P.type as nutvariety
                                    ,MC.fieldcode as mkc
                                    ,DATE_FORMAT(P.date,'%d-%m-%Y') as editDate
                                    FROM purchases P
                                    join buyers B on P.buyer = B.buyersid
                                    join marketcenter MC on B.marketcenter = MC.marketcenterid
                                    where P.season = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function lstPurchasesListByBuyer($id){
        $query = $this->link->query("SELECT P.purchasesid as pid
                                    ,P.receipt as receipt
                                    ,DATE_FORMAT(P.date,'%d/%m/%Y') as pDate
                                    ,P.farmer as farmer
                                    ,P.gender as gender
                                    ,P.farmerstatus as farmerstatus
                                    ,P.type as type
                                    ,P.qty as qty
                                    ,P.price as price
                                    ,P.mwk as mwk
                                    ,P.member as member
                                    FROM purchases P
                                    join buyers B on P.buyer = B.buyersid
                                    join marketcenter MC on B.marketcenter = MC.marketcenterid
                                    where B.buyersid = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function CWsortingDetails($id){
        $query = $this->link->query("select handsortingid as id
                                    ,DATE_FORMAT(date,'%D %M %Y') as pDate
                                    ,DATE_FORMAT(date,'%d-%m-%Y') as editDate
                                    ,variety as variety
                                    ,qty as qty
                                    ,gradeouts as gradeouts
                                    ,shells as shells
                                    from handsorting
                                    where casualworker = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //select list of market centers
    function lstMarketCenterList(){
        $query = $this->link->query("SELECT MC.marketcenterid as mcid, MC.fieldname as marketcenter, MC.fieldcode as mkcode 
                                    FROM marketcenter MC ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //select list of market centers
    function lstAllMarketCenterList(){
        $query = $this->link->query("SELECT MC.marketcenterid as mcid
                                    , MC.fieldname as marketcenter
                                    , MC.fieldcode as mkcode
                                    , MC.mpa as mpa
                                    , MC.status as status
                                    FROM marketcenter MC ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list market cenyer receipt total
    function lstAllMarketCenterReceiptTotal($id){
        $query = $this->link->query("SELECT sum(P.mwk) as mwk
                                    FROM purchases P
                                    join buyers B on P.buyer = B.buyersid
                                    join marketcenter MC on B.marketcenter = MC.marketcenterid
                                    where MC.marketcenterid = '$id' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function lstAllMarketCenterList1($criteria){
        $query = $this->link->query("SELECT MC.marketcenterid as mcid
                                    , MC.fieldname as marketcenter
                                    , MC.fieldcode as mkcode
                                    , MC.mpa as mpa
                                    , MC.status as status
                                    FROM marketcenter MC
                                    where MC.status = '$criteria' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //count all gacs in market center
    function MarketCenterGacs($id){
        $query = $this->link->query("SELECT count(marketcentermembersid) as count 
                                    FROM marketcentermembers 
                                    where marketcenterid = '$id' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function ListMarketCenterGacs($id){
        $query = $this->link->query("SELECT G.GACid as gacid, G.fieldname as gacname, MC.marketcentermembersid as mid 
                                    FROM marketcentermembers MC
                                    join gac G on MC.gacid = G.GACid
                                    where MC.marketcenterid = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get grading data
    function getGradingData($season,$mcid,$variety){
        $query = $this->link->query("select sum(HS.grade1) as g1
                                    ,sum(HS.grade2) as g2
                                    ,sum(HS.grade3) as g3
                                    ,sum(HS.grade4) as g4
                                    ,sum(HS.grade5) as g5
                                    from handsorting HS
                                    join casualworkers CW on CW.casualworkersid = HS.casualworker
                                    join warehouse W on CW.warehouse = W.warehouseid
                                    where HS.variety = '$variety' and HS.season = '$season' and W.marketcenter = '$mcid' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //select list of market centers
    function getMarketVarietySummary($season,$mcid,$variety){
        $query = $this->link->query("SELECT sum(P.qty) as qty, sum(P.mwk) as mwk
                                    FROM purchases P
                                    join buyers B on P.buyer = B.buyersid
                                    join marketcenter MC on B.marketcenter = MC.marketcenterid
                                    where P.season = '$season'
                                    and MC.marketcenterid = '$mcid'
                                    and P.type = '$variety' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    
    function SeasonDetails($id){
        $query = $this->link->query("SELECT regyearID,DATE_FORMAT(startDate,'%D %M %Y') as startDate
                                    ,DATE_FORMAT(endDate,'%D %M %Y') as endDate
                                    , season as regYear, status
                                    , ifnull(procurementAmount, 0) as procurement
                                    ,DATE_FORMAT(startDate,'%y-%m-%d') as startDate1
                                    ,DATE_FORMAT(endDate,'%y-%m-%d') as endDate1
                                    FROM registrationyear
                                    WHERE regyearID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function buyersCount(){
        $query = $this->link->query("select count(*) from buyers ");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    function GetRecentItemCounter(){
        $query = $this->link->query("select count(*) from marketcenter ");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    function GetRecentWarehouseCounter(){
        $query = $this->link->query("select count(*) from warehouse ");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    function GetBuyersID($code,$seasonid){
        $query = $this->link->query("select B.buyersid as bid
                                    from buyers B
                                    join marketcenter MC on B.marketcenter = MC.marketcenterid
                                    where MC.fieldcode = '$code' and B.season = '$seasonid' and B.status = 'ACTIVE' ");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    function GetCasualWorkersCounter(){
        $query = $this->link->query("select count(*) from casualworkers ");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    //add none farmer purchase
    function addNoneMemberPurchase($receipt,$date,$buyer,$farmer,$gender,$farmerstatus,$type,$qty,$price,$mwk,$season){
        $query = $this->link->prepare("INSERT INTO purchases (receipt,date,buyer,farmer,gender,farmerstatus,type,qty,price,mwk,season) VALUES (?,?,?,?,?,?,?,?,?,?,?)");        
        $values = array($receipt,$date,$buyer,$farmer,$gender,$farmerstatus,$type,$qty,$price,$mwk,$season);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //remove purchase
    function removePurchase($id){
        $query = $this->link->prepare("DELETE purchases FROM purchases WHERE purchasesid = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    //add member purchase
    function addMemberPurchase($receipt,$date,$buyer,$farmerstatus,$type,$qty,$price,$mwk,$season,$member){
        $query = $this->link->prepare("INSERT INTO purchases (member,receipt,date,buyer,farmerstatus,type,qty,price,mwk,season)
                                    SELECT memberID,'$receipt','$date','$buyer','$farmerstatus','$type','$qty','$price','$mwk','$season' "
                                    . "from members where membernumber = '$member' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function addWarehouse($regyear,$fieldname,$fieldcode,$marketcenter){
        $query = $this->link->prepare("INSERT INTO warehouse (regyear,fieldname,fieldcode,marketcenter) VALUES (?,?,?,?)");        
        $values = array($regyear,$fieldname,$fieldcode,$marketcenter);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    function addCasualworker($whs,$names,$lname,$gender,$newNumber2,$season){
        $query = $this->link->prepare("insert into casualworkers (warehouse,names,lname,gender,season,casualworkercode,status)
                                        select warehouseid,'$names','$lname','$gender','$season','$newNumber2','ACTIVE' from warehouse where fieldcode = '$whs' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }   
    }
    
    function addMarketCenter($marketcentername,$mpa,$marketcentercode,$regyear){
        $query = $this->link->prepare("INSERT INTO marketcenter (fieldname,fieldcode,regyear,mpa,status) VALUES (?,?,?,?,?)");        
        $values = array($marketcentername,$marketcentercode,$regyear,$mpa,'ACTIVE');        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    function RecentMarketCenterDetails(){
        $query = $this->link->query("SELECT marketcenterid FROM marketcenter order by marketcenterid desc limit 1");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function RecentWarehouseDetails(){
        $query = $this->link->query("SELECT warehouseid FROM warehouse order by warehouseid desc limit 1");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //get gac id
    function GetGacDetailsClubCode($code){
        $query = $this->link->query("SELECT GACid FROM gac where fieldcode = '$code' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function checkMemberGacs($marketcenter,$gac){
        $query = $this->link->query("SELECT count(*) as cnt FROM marketcentermembers where gacid = '$gac' and marketcenterid = '$marketcenter' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function addGacsToMarketCenter($marketcenter,$gac){
        $query = $this->link->prepare("INSERT INTO marketcentermembers (marketcenterid,gacid) VALUES (?,?)");        
        $values = array($marketcenter,$gac);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    function addBuyerToMarketCenter($names,$lastname,$gender,$address,$marketcenter,$seasonid){
        $query = $this->link->prepare("INSERT INTO buyers (names,lastname,gender,address,marketcenter,status,season) VALUES (?,?,?,?,?,?,?)");        
        $values = array($names,$lastname,$gender,$address,$marketcenter,'ACTIVE',$seasonid);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    function addSorting($casualworker,$date,$qty,$variety,$gradeouts,$shells,$season){
        $query = $this->link->prepare("insert into handsorting (casualworker,date,qty,variety,gradeouts,shells,season)
                                        SELECT casualworkersid
                                        ,'$date','$qty','$variety','$gradeouts','$shells','$season' "
                                        . "from casualworkers where casualworkercode = '$casualworker' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
}

