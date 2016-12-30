<?php

include_once ('../../config/config.php');

class membersmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //check if member exists
    function FetchMemberDetailsMemberNumberYear($memberNumber,$regyear){
        $query = $this->link->query("SELECT memberID FROM members  WHERE memberNumber = '$memberNumber' AND yearRegistered = '$regyear' LIMIT 1");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get member activity details ID
    function getMemberActivitiesID($member,$treesActivity){
        $query = $this->link->query("SELECT memberactivitiesID FROM memberactivities where activitiesID = '$treesActivity' AND memberID = '$member' LIMIT 1");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get recent memberactivites id
    function getRecentMemberActivities(){
        $query = $this->link->query("SELECT memberactivitiesID FROM memberactivities order by memberactivitiesID desc limit 1");
        $result = $query->fetchAll();
        return $result;
    }
    
   
    function CheckifMemberPlantedTrees($member,$treesActivity){
        $query = $this->link->query("SELECT count(activitiesID) FROM memberactivities where activitiesID = '$treesActivity' AND memberID = '$member' LIMIT 1");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    //enter tree planting activities for member
    function AddTreePlantingForMember($memberID,$activityID){
        $query = $this->link->prepare("INSERT INTO memberactivities (memberID,activitiesID) VALUES (?,?)");        
        $values = array($memberID,$activityID);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //enter tree planting activities items for member
    function AddTreePlantingItemsForMember($memberactivityID,$tree,$notrees,$remarks){
        $query = $this->link->prepare("INSERT INTO treeplantingitems (memberactivityid,treetype,numberoftrees,treedetails) VALUES (?,?,?,?)");        
        $values = array($memberactivityID,$tree,$notrees,$remarks);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //generate members number
    //get recent number
    function GetRecentMembernumberCounter($district){
        $query = $this->link->query("SELECT count(counter) FROM membernumberregister where district = '$district' ORDER BY memberNumber DESC LIMIT 1");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    //get membernumber counter
    function GetRecentMemberCounter($district){
        $query = $this->link->query("SELECT counter FROM membernumberregister where district = '$district' ORDER BY memberNumber DESC LIMIT 1");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    //update register with new number
    function AddMemberNumber($Mnumber,$district,$dateCreated,$counter){
        $query = $this->link->prepare("INSERT INTO membernumberregister (memberNumber,district,datecreated,counter) VALUES (?,?,?,?)");        
        $values = array($Mnumber,$district,$dateCreated,$counter);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //check for duplicate IPC code
    function checkDuplicateIPC($code){
        $query = $this->link->query("SELECT COUNT(*) FROM ipc WHERE IPC_code = '$code' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //add ipc
    function Addipc($name,$code){
        $query = $this->link->prepare("INSERT INTO ipc (IPC_name,IPC_code) VALUES (?,?)");        
        $values = array($name,$code);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //list IPCs
    function LstIPCs(){
        $query = $this->link->query("SELECT * FROM ipc ");
        $result = $query->fetchAll();
        return $result;        
    }
    
    //list Clubs
    function LstClubs(){
        $query = $this->link->query("SELECT * FROM clubs ");
        $result = $query->fetchAll();
        return $result;        
    }
    
    //add association
    //add gac
    //add club
    
    //list all villages
    function listVillages(){
        $query = $this->link->query("SELECT * FROM village ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all clubs
    function listClubs(){
        $query = $this->link->query("SELECT * FROM clubs ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all memebers with selected
    function listAllMembersForYear($regyear){
        $query = $this->link->query("SELECT M.memberNumber, concat(M.names, ' ', M.surname) as membername
                                    , M.gender
                                    , C.fieldname as clubname
                                    , G.fieldname as gacname
                                    , A.fieldname as assocname
                                    , I.fieldname as ipcname
                                    , D.fieldname as districtname
                                    , concat('<a class=btn-info href=memberprofile.php?Sid=',M.memberID,'>View Profile','</a>') as action
                                    FROM members M
                                    join clubs C on M.club = clubsID
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    join districtsregyear DY on DY.districtsregyearID = I.fieldref
                                    join districts D on D.districtID = DY.district
                                    where yearRegistered = '$regyear' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all memebers with selected
    function listMembers(){
        $query = $this->link->query("SELECT * FROM members ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all memebers with selected
    function listMembersDistrict($district){
        $query = $this->link->query("SELECT * FROM members where district = '$district' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list members in district with specific reg year
    function listMembersDistrictRegYear($district,$regYear){
        $query = $this->link->query("SELECT M.memberNumber, concat(M.names, ' ', M.surname) as membername
                                    , M.gender
                                    , C.fieldname as clubname
                                    , G.fieldname as gacname
                                    , A.fieldname as assocname
                                    , concat('<a class=btn-info href=memberprofile.php?Sid=',M.memberID,'>View Profile','</a>') as action
                                    FROM members M
                                    join clubs C on M.club = clubsID
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    where district = '$district' AND yearRegistered = '$regYear' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list members in district with specific reg year dashboard male
    function listMembersDistrictRegYearMales($district,$regYear){
        $query = $this->link->query("SELECT count(*) FROM members where district = '$district' AND yearRegistered = '$regYear' AND gender = 'MALE' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list members in district with specific reg year dashboard male
    function listMembersDistrictRegYearFemales($district,$regYear){
        $query = $this->link->query("SELECT count(*) FROM members where district = '$district' AND yearRegistered = '$regYear' AND gender = 'FEMALE' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    
    //list members in district with specific reg year dashboard male
    function listMembersAllRegYearMales($regYear){
        $query = $this->link->query("SELECT count(*) FROM members where yearRegistered = '$regYear' AND gender = 'MALE' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list members in district with specific reg year dashboard male
    function listMembersAllRegYearFemales($regYear){
        $query = $this->link->query("SELECT count(*) FROM members where yearRegistered = '$regYear' AND gender = 'FEMALE' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get target value for district for that year
    //get district name then search for district in targets table
    function getDistrictDetails($district){
        $query = $this->link->query("SELECT * from districts where districtID = '$district' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get target amount
    function getItemTargetForYear($district,$year){
        $query = $this->link->query("select target from districtsregyear where regYear = '$year' and district = '$district' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //get target amount
    function getMemberTargetForYear($year){
        $query = $this->link->query("select sum(target) from districtsregyear where regYear = '$year' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all memebers with selected
    function listDistinctMembers(){
        $query = $this->link->query("SELECT * FROM members ");
        $result = $query->fetchAll();
        return $result;
    }
   
    //add member individual initial details
    function RegisterMemberInitial($names,$lastname,$gender,$yearRegistered,$dateofbirth,$hhsize,$Mcount,$club,$district){
        $status = 'ACTIVE';
        $query = $this->link->prepare("INSERT INTO members (names,surname,gender,yearRegistered,dob,hhSize,memberNumber,club,district,status) VALUES (?,?,?,?,?,?,?,?,?,?)");        
        $values = array($names,$lastname,$gender,$yearRegistered,$dateofbirth,$hhsize,$Mcount,$club,$district,$status);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //add member individual initial details
    function RegisterMembersBulk($names,$surname,$gender,$yearRegistered,$hhSize,$memberNumber){
        $query = $this->link->prepare("INSERT INTO members (names,surname,gender,yearRegistered,hhSize,memberNumber) VALUES (?,?,?,?,?,?)");        
        $values = array($names,$surname,$gender,$yearRegistered,$hhSize,$memberNumber);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //get recent inserted member details
    function RecentMemberDetails(){
        $query = $this->link->query("SELECT memberID, memberNumber FROM members order by memberID desc limit 1");
        $result = $query->fetchAll();
        return $result;
    }
    
    //register member to registration year
    function RegisterMemberToRegYear($yearregID,$memberID,$memberNumber){
        $query = $this->link->prepare("INSERT INTO memberyearreg (yearregID,memberID,memberNumber) VALUES (?,?,?)");        
        $values = array($yearregID,$memberID,$memberNumber);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //check if member exists
    function MemberExists($memberNumber){
        $query = $this->link->query("SELECT M.names as fnames, M.surname as surname, M.gender as gender, M.hhSize as hh, M.gvh as gvh "
                                    . ",DATE_FORMAT(M.dob,'%D %M %Y') as dob1, M.memberID as memberID, M.memberNumber as memberNumber "
                                    . "FROM members M WHERE M.memberNumber = '$memberNumber' LIMIT 1");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get member personal Info
    function MemberPersonalDetails($id){
        $query = $this->link->query("SELECT M.names as fnames, M.surname as surname, M.gender as gender, M.hhSize as hh, M.gvh as gvh "
                                    . ",DATE_FORMAT(M.dob,'%D %M %Y') as dob1, M.memberID as memberID, M.memberNumber as memberNumber "
                                    . ", M.yearRegistered as regYear, M.dob as dob2, M.ta as ta , M.tccregno as tcc "
                                    . "FROM members M WHERE M.memberID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get member IPC Info
    function MemberIPCDetails($id){
        $query = $this->link->query("SELECT C.fieldname as clubname
                                    , G.fieldname as gacname
                                    , A.fieldname as assocname
                                    , I.fieldname as ipcname
                                    , D.fieldname as districtname
                                    , C.fieldcode as clubcode
                                    , RY.season as season
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
    
    //get member general information
    function MemberGeneralInfo($id){
        $query = $this->link->query("SELECT M.club as club
                                    FROM members M
                                    WHERE M.memberID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get member village info
    function MemberVillageInfo($id){
        $query = $this->link->query("SELECT V.fieldname as vname, V.villageHeadman as Vheadman, V.fieldcode as vcode
                                    FROM members M
                                    JOIN village V ON M.village = V.villageID
                                    WHERE M.memberID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get member club info
    function MemberClubInfo($id){
        $query = $this->link->query("SELECT C.clubName as clubname, A.associationsName as associationName
                                    FROM members M
                                    JOIN clubs C ON C.clubsID = M.clubname
                                    JOIN associations A ON C.association = A.associationsID
                                    WHERE M.memberID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get member crop info
    function MemberCropDetails($id){
        $query = $this->link->query("SELECT C.fieldname as cropname, MC.acreage as acres, MC.cropinformationID as mcID  
                                    FROM membercrops MC
                                    JOIN crops C on C.cropID = MC.cropID
                                    JOIN members M on M.memberID = MC.memberID
                                    WHERE M.memberID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get annual info and food security
    function MemberAnnualAndFoodInfo($id){
        $query = $this->link->query("SELECT cropsales, othersources, nomonthswithfood, copingmechanism 
                                    FROM members
                                    WHERE memberID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    
    //get member livestock info
    function MemberLivestockDetails($id){
        $query = $this->link->query("SELECT L.fieldname as livestockname, ML.qty as qty, ML.memberslivestockID as mlivestockID  
                                    FROM memberlivestock ML
                                    JOIN livestock L on L.livestockID = ML.livestockID
                                    JOIN members M on M.memberID = ML.memberID
                                    WHERE M.memberID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get member seed distribution info
    
    //get member crop marketing info
    
    //get member activities info
    function MemberActivitiesDetails($id){
        $query = $this->link->query("SELECT A.activitiesname AS activitiesname, AT.activitytypename AS activitytypename, MA.memberactivitiesID AS memberactivitiesID
                                    FROM memberactivities MA
                                    JOIN activities A ON A.activitiesID = MA.activitiesID
                                    JOIN activitytype AT ON A.activitytypeID = AT.activitytypeID
                                    JOIN members M ON M.memberID = MA.memberID
                                    WHERE M.memberID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //update member details
    //update personal info
    function UpdatePersonalInfo($memberID,$viewfname,$viewlname,$editgender,$viewdob,$viewhh,$viewgvh){
        $query = $this->link->prepare("UPDATE members SET names = '$viewfname',surname = '$viewlname', gender = '$editgender'"
                . ", dob = '$viewdob',hhSize = '$viewhh', gvh = '$viewgvh' WHERE memberID = '$memberID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //update General info
    function UpdateGeneralInfo($memberID,$viewta,$viewtcc){
        $query = $this->link->prepare("UPDATE members SET ta = '$viewta', tccregno = '$viewtcc' WHERE memberID = '$memberID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //update member club
    function UpdateMemberClub($memberID,$club){
        $query = $this->link->prepare("UPDATE members SET club = '$club' WHERE memberID = '$memberID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //update member village
    function UpdateMemberVillage($memberID,$viewvillage){
        $query = $this->link->prepare("UPDATE members SET village = '$viewvillage' WHERE memberID = '$memberID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //update annual income
    function UpdateAnnualInfo($memberID,$viewcropsale,$viewsources){
        $query = $this->link->prepare("UPDATE members SET cropsales = '$viewcropsale', othersources = '$viewsources' WHERE memberID = '$memberID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //update food security
    function UpdateFoodSecurityInfo($memberID,$viewmonths,$viewmechanism){
        $query = $this->link->prepare("UPDATE members SET nomonthswithfood = '$viewmonths', copingmechanism = '$viewmechanism' WHERE memberID = '$memberID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //check member count
    function checkMemberCount($district){
        $query = $this->link->query("SELECT id, memberCounter
                                    FROM membernumberreg
                                    WHERE district = '$district' "
                                    . " ORDER BY id DESC LIMIT 1 ");
        $result = $query->fetchAll();
        return $result;
    }
}