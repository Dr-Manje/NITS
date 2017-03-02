<?php
include_once ('../../config/config.php');

class districtsmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //get club details with club code
    function GetVillagebyID($code){
        $query = $this->link->query("SELECT * FROM village where villageID = '$code' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get club details with club code
    function GetVillageDetailsClubCode($code){
        $query = $this->link->query("SELECT * FROM village where fieldcode = '$code' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get club details with club code
    function GetClubDetailsClubCode($code){
        $query = $this->link->query("SELECT * FROM clubs where fieldcode = '$code' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get district name then search for district in targets table
    function getDistrictRealDetails($district){
        $query = $this->link->query("select D.fieldname as dname, D.districtID as did 
                                    from districtsregyear DY
                                    join districts D on DY.district = D.districtID
                                    where DY.districtsregyearID = '$district' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get recent item count
    function GetItemByCode($item,$itemtable){
        $query = $this->link->query("select * from $itemtable where fieldcode = '$item' ");           
        $result = $query->fetchAll();       
        return $result;
    }
    
    function InsertDistrictReg($districtID,$regyear,$newNumber){
        $target = '0';
        $query = $this->link->prepare("INSERT INTO districtsregyear (district,regYear,fieldcode,target) VALUES (?,?,?,?)");        
        $values = array($districtID,$regyear,$newNumber,$target);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    function InsertIntoItemB($itemtable,$itemname,$newNumber){
        $query = $this->link->prepare("INSERT INTO $itemtable (fieldname,fieldcode) VALUES (?,?)");        
        $values = array($itemname,$newNumber);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    function RecentDistrictDetails(){
        $query = $this->link->query("select districtID from districts order by districtID desc limit 1");
        $result = $query->fetchAll();
        return $result;
    }
    
    //add item into code register
    function InsertIntoItemA1($itemtable,$itemname,$code){
        $query = $this->link->prepare("INSERT INTO $itemtable (fieldname,fieldcode) VALUES (?,?)");        
        $values = array($itemname,$code);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //add item into code register
    function InsertIntoItemA($itemtable,$itemname,$newNumber,$refitem){
        $status = 'ACTIVE';
        $query = $this->link->prepare("INSERT INTO $itemtable (fieldname,fieldcode,fieldref,status) VALUES (?,?,?,?)");        
        $values = array($itemname,$newNumber,$refitem,$status);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //add item into code register
    function addIntoCodeRegister($coderef,$counter,$code){
        $query = $this->link->prepare("INSERT INTO coderegister (coderef,counter,code) VALUES (?,?,?)");        
        $values = array($coderef,$counter,$code);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //get recent item count
    function GetItemPrefix($item){
        $query = $this->link->query("select * from codereference where coderefid = '$item' ");           
        $result = $query->fetchAll();       
        return $result;
    }
    
    
    //get recent item count
    function GetItemPrefix2($item){
        $query = $this->link->query("select * from codereference where item = '$item' ");           
        $result = $query->fetchAll();       
        return $result;
    }
    
    //get recent item count
    function GetRecentItemCounter($item){
        $query = $this->link->query("select count(*) from coderegister where coderef = '$item' ");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    //update village
    function updateVG($vn,$vh,$id){
        $query = $this->link->prepare("UPDATE village SET fieldname = '$vn' , villageHeadman = '$vh' where villageID = '$id' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    
    //add GAC
    function addVillage($VName,$VHM,$newNumber){
        $query = $this->link->prepare("INSERT INTO village (fieldname,villageHeadman,fieldcode) VALUES (?,?,?)");        
        $values = array($VName,$VHM,$newNumber);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //list all livestock with selected
    function listVillagesDistrict(){
        $query = $this->link->query("SELECT fieldname
                                    , villageHeadman
                                    , fieldcode                                     
                                    from village");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all livestock with selected
    function listVillages(){
        $query = $this->link->query("SELECT fieldname
                                    , villageHeadman
                                    , fieldcode 
                                    , concat('<a rel=\"tooltip\" title=\"Edit/Update Village details\" onclick=editv(this) data-editvillageid=\"',villageID,'\" data-editvillagename=\"',fieldname,'\" data-editviewhead=\"',villageHeadman,'\" class=\"btn btn-info btn-xs openEditIPCModal\">Edit</a>') as action 
                                    from village");
        $result = $query->fetchAll();
        return $result;
    }
    
    //add GAC
    function addClub($clubName,$clubCode,$GACid){
        $query = $this->link->prepare("INSERT INTO clubs (clubName,clubCode,GACid) VALUES (?,?,?)");        
        $values = array($clubName,$clubCode,$GACid);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }    
    
    //add GAC
    function addGac($gacname,$Assocgac){
        $query = $this->link->prepare("INSERT INTO gac (GAC_name,ass_code) VALUES (?,?)");        
        $values = array($gacname,$Assocgac);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //add IPC
    function addAssociation($Assocname,$Assoccode,$Associpc){
        $query = $this->link->prepare("INSERT INTO associations (associationsName,ass_code,IPCid) VALUES (?,?,?)");        
        $values = array($Assocname,$Assoccode,$Associpc);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //add IPC
    function addIPC($ipcDistrict,$ipcname,$ipccode){
        $query = $this->link->prepare("INSERT INTO ipc (district,IPC_name,IPC_code) VALUES (?,?,?)");        
        $values = array($ipcDistrict,$ipcname,$ipccode);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //list all livestock with selected
    function getMemberTotalsDistrict($assid){
        $query = $this->link->query("select count(M.memberID) as members 
                                    from members M
                                    JOIN clubs C on M.club = C.clubsID
                                    JOIN gac G on G.GACid = C.fieldref
                                    JOIN associations A ON A.associationsID = G.fieldref
                                    JOIN ipc I ON I.IPCid = A.fieldref
                                    JOIN districtsregyear DY ON DY.districtsregyearID = I.fieldref
                                    where DY.districtsregyearID = '$assid' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //list all livestock with selected
    function getCompleteMemberTotalsDistrict($id,$gender,$district){
        $query = $this->link->query("select count(memberID) as members 
                                    from members
                                    where yearRegistered = '$id' and Gender = '$gender' and district = '$district' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //list all livestock with selected
    function getClubTotalsDistrict($assid){
        $query = $this->link->query("select count(C.clubsID) as clubs 
                                    from clubs C
                                    JOIN gac G on G.GACid = C.fieldref
                                    JOIN associations A ON A.associationsID = G.fieldref
                                    JOIN ipc I ON I.IPCid = A.fieldref
                                    JOIN districtsregyear DY ON DY.districtsregyearID = I.fieldref
                                    where DY.districtsregyearID = '$assid' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //list all livestock with selected
    function getGacTotalsDistrict($id){
        $query = $this->link->query("select count(G.GACid) as gacs
                                    from gac G
                                    JOIN associations A ON A.associationsID = G.fieldref
                                    JOIN ipc I ON I.IPCid = A.fieldref
                                    JOIN districtsregyear DY ON DY.districtsregyearID = I.fieldref
                                    where DY.districtsregyearID = '$id' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //list all livestock with selected
    function getIpcsTotalsDistrict($id){
        $query = $this->link->query("select count(I.IPCid) as ipcs 
                                    from ipc I
                                    join districts DY on DY.districtID = I.fieldref 
                                    where DY.districtID = '$id' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //list all livestock with selected
    function getAssTotalsDistrict($id){
        $query = $this->link->query("select count(A.associationsID) as associations
                                    from associations A
                                    join IPC I on I.IPCid = A.fieldref
                                    join districtsregyear DY on DY.districtsregyearID = I.fieldref
                                    where DY.districtsregyearID = '$id' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //list all livestock with selected
    function listClubMembers($assid){
        $query = $this->link->query("select * from members where club = '$assid' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all livestock with selected
    function listGacClubs($assid){
        $query = $this->link->query("select * from clubs where fieldref = '$assid' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all livestock with selected
    function listAssociationGacs($assid){
        $query = $this->link->query("select * from gac where fieldref = '$assid' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all livestock with selected
    function listIPCAssociations($ipc){
        $query = $this->link->query("select * from associations where fieldref = '$ipc' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getRealAssoc($id){
        $query = $this->link->query("select I.fieldname as ipcname, I.fieldref as districtid, D.fieldname as district
                                    from associations A
                                    join ipc I on I.IPCid = A.fieldref
                                    JOIN districtsregyear DY ON DY.districtsregyearID = I.fieldref
                                    join districts D on D.districtID = DY.district
                                    where A.fieldref = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getRealGac($id){
        $query = $this->link->query("select A.fieldname as assocname, I.fieldname as ipcname, D.fieldname as districtname, DY.districtsregyearID as did, A.fieldref as assocref
                                    from gac G
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    JOIN districtsregyear DY ON DY.districtsregyearID = I.fieldref
                                    join districts D on D.districtID = DY.district
                                    where G.fieldref = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getRealClubs($id){
        $query = $this->link->query("select A.fieldname as assocname
                                    , I.fieldname as ipcname
                                    , D.fieldname as districtname
                                    , DY.districtsregyearID as did
                                    , A.fieldref as assocref
                                    , G.fieldname as gacname
                                    from clubs C
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    JOIN districtsregyear DY ON DY.districtsregyearID = I.fieldref
                                    join districts D on D.districtID = DY.district
                                    where C.fieldref = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getRealMembers($id){
        $query = $this->link->query("select A.fieldname as assocname
                                    , I.fieldname as ipcname
                                    , D.fieldname as districtname
                                    , DY.districtsregyearID as did
                                    , A.fieldref as assocref
                                    , G.fieldname as gacname
                                    , C.fieldname as clubname
                                    , G.fieldref as gacid
                                    from members M
                                    join clubs C on C.clubsID = club
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    JOIN districtsregyear DY ON DY.districtsregyearID = I.fieldref
                                    join districts D on D.districtID = DY.district
                                    where M.club = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all livestock with selected
    function listDistrictIPCs($district){
        $query = $this->link->query("select * from ipc where fieldref = '$district' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get district name then search for district in targets table
    function getIPCDetails1($district){
        $query = $this->link->query("select I.fieldname as ipcname, I.IPCid as ipcid
                                    from gac G
                                    JOIN associations A ON A.associationsID = G.fieldref
                                    JOIN ipc I ON I.IPCid = A.fieldref
                                    where G.GACid = '$district' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get district name then search for district in targets table
    function getDistrictDetails($district){
        $query = $this->link->query("SELECT * from districts where districtID = '$district' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get district name then search for district in targets table
    function getIPCDetails($id){
        $query = $this->link->query("SELECT * from associations where associationsID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    
    //get district name then search for district in targets table
    function getAssociationDetails($id){
        $query = $this->link->query("SELECT * from associations where associationsID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getAssocDetails($id){
        $query = $this->link->query("select DY.districtsregyearID as did 
                                    from associations A
                                    join ipc I on I.IPCid = A.fieldref
                                    join districtsregyear DY on DY.districtsregyearID = I.fieldref
                                    where A.fieldref = '$id'
                                    LIMIT 1 ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getGacsssDetails($id){
        $query = $this->link->query("select I.IPCid as assocID, DY.districtsregyearID as did
                                    from gac G
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    join districtsregyear DY on DY.districtsregyearID = I.fieldref
                                    where G.fieldref ='$id'
                                    LIMIT 1 ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getClubsssDetails($id){
        $query = $this->link->query("select I.IPCid as assocID, DY.districtsregyearID as did, A.associationsID as gacID
                                    from clubs C
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    join districtsregyear DY on DY.districtsregyearID = I.fieldref
                                    where C.fieldref = '$id'
                                    LIMIT 1 ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all livestock with selected
    function listDistricts(){
        $query = $this->link->query("SELECT * FROM districts ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all livestock with selected
    function listDistrictsYear($regYear){
        $query = $this->link->query("select DY.districtsregyearID as did, D.fieldname as dname, DY.fieldcode as code  
                                    from districtsregyear DY
                                    join districts D ON DY.district = D.districtID
                                    where DY.regyear = '$regYear' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //check for duplicate Districts code
    function checkDuplicateDistricts($code){
        $query = $this->link->query("SELECT COUNT(*) FROM districts WHERE districtCode = '$code' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //add Districts
    function addDistricts($dName,$dCode,$dPfx){
        $query = $this->link->prepare("INSERT INTO districts (districtName,districtCode,districtPrefix) VALUES (?,?,?)");        
        $values = array($dName,$dCode,$dPfx);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update Districts
    function UpdateDistricts($dName,$dCode,$dPfx,$dID){
        $query = $this->link->prepare("UPDATE districts SET districtName = '$dName',districtCode = '$dCode',districtPrefix = '$dPfx' WHERE districtID = '$dID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    function UpdateIPCName($updatetable,$itemname,$fieldID,$updateid){
        $query = $this->link->prepare("UPDATE $updatetable set fieldname = '$itemname' where $fieldID = '$updateid' ");
        if($query->execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    
    
}