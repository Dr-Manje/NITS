<?php

include_once ('../../config/config.php');

class seasonsmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
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
    
    function editpurchaseRDetails($varietytype,$qty,$cum,$price,$mwk,$purchaseid){
        $query = $this->link->prepare("update purchases set type = '$varietytype', qty = '$qty', cum = '$cum', price = '$price', mwk = '$mwk' where purchasesid = '$purchaseid' ");
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
    
    function addSorting($casualworker,$date,$qty,$variety,$gradeouts,$shells,$grade1,$grade2,$grade3,$grade4,$grade5,$season){
        $query = $this->link->prepare("insert into handsorting (casualworker,date,qty,variety,gradeouts,shells,grade1,grade2,grade3,grade4,grade5,season)
                                        SELECT casualworkersid
                                        ,'$date','$qty','$variety','$gradeouts','$shells','$grade1','$grade2','$grade3','$grade4','$grade5','$season' "
                                        . "from casualworkers where casualworkercode = '$casualworker' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
}

