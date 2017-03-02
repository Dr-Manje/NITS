<?php

include_once ('../../config/config.php');

class activitiesmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    function checktreeActivities($memberactivityID,$tree){
        $query = $this->link->query("SELECT count(*) from treeplantingitems where memberactivityid = '$memberactivityID' and treetype = '$tree' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function getnotreeActivities($memberactivityID,$tree){
        $query = $this->link->query("SELECT * from treeplantingitems where memberactivityid = '$memberactivityID' and treetype = '$tree' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getTreeDetails($treecode){
        $query = $this->link->query("SELECT * FROM trees WHERE fieldcode = '$treecode' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    
    function getTPSumForTreeType($year,$district,$tree){
        $query = $this->link->query("select T.fieldname as tree
                                    , sum(TPI.numberoftrees) as notrees
                                    from treeplantingitems TPI
                                    JOIN trees T ON T.treesid = TPI.treetype
                                    JOIN memberactivities MA ON MA.memberactivitiesID = TPI.memberactivityid
                                    JOIN members M ON M.memberID = MA.memberID
                                    WHERE M.yearRegistered = '$year' and M.district = '$district' and T.treesid = '$tree' ");
        $result = $query->fetchAll();
        return $result;
    }


    //get activity details
    function listDistrictsWithTPDetails($year){
        $query = $this->link->query("select distinct district from members WHERE yearRegistered = '$year' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //enter tree planting activities items for member
    function UpdateTreePlantingItemsForMember($memberactivityID,$tree,$notrees){
        $query = $this->link->prepare("UPDATE treeplantingitems SET numberoftrees = '$notrees' WHERE treetype = '$tree' AND memberactivityid = '$memberactivityID' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    
    //enter tree planting activities items for member
    function AddTreePlantingItemsForMember($memberactivityID,$tree,$notrees){
        $query = $this->link->prepare("INSERT INTO treeplantingitems (memberactivityid,treetype,numberoftrees) VALUES (?,?,?)");        
        $values = array($memberactivityID,$tree,$notrees);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //get activity details
    function getTPID($member,$activity){
        $query = $this->link->query("select * from memberactivities where memberID = '$member' AND activitiesID = '$activity' LIMIT 1");
        $result = $query->fetchAll();
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
    
    // TREE PLANTING //////////////////////////////////////////////////////////
    //get tree planting district for year
    function getTPDList($regyear){
        $query = $this->link->query("select distinct(M.memberID) as mid
                                    , M.memberNumber as mnum
                                    , concat(M.names,' ', M.surname) as membername
                                    , M.gender as gender
                                    , D.fieldname as district
                                    , MA.memberactivitiesID as actID
                                    from treeplantingitems TPI
                                    JOIN trees T ON T.treesid = TPI.treetype
                                    JOIN memberactivities MA ON MA.memberactivitiesID = TPI.memberactivityid
                                    JOIN members M ON M.memberID = MA.memberID
                                    join clubs C on M.club = clubsID
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    join districtsregyear DY on DY.districtsregyearID = I.fieldref
                                    join districts D on D.districtID = DY.district
                                    join registrationyear RY on RY.regyearID = DY.regyear
                                    WHERE M.yearRegistered = '$regyear' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function TotalTreesPlantedMember($maid,$treetype){
        $query = $this->link->query("select sum(numberoftrees) as notrees 
                                    from treeplantingitems 
                                    where memberactivityID = '$maid' and treetype = '$treetype' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //check if member activity is tree planting
    function CheckIfIsTreePlantingActivity($id){
        $query = $this->link->query("SELECT activitiesID from memberactivities  where memberactivitiesID = '$id' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //delete all member activities
    function deleteMemberTreePlanting($memberID){
        $query = $this->link->prepare("DELETE treeplantingitems FROM treeplantingitems WHERE memberactivityid = '$memberID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        } 
    }
    
    //delete member crop
    function deleteMemberActivityy($id){
        $query = $this->link->prepare("DELETE memberactivities FROM memberactivities WHERE memberactivitiesID = '$id' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //add crop
    function addMemberActivities($memberID,$activityID){
        $query = $this->link->prepare("INSERT INTO memberactivities (memberID,activitiesID) VALUES (?,?)");        
        $values = array($memberID,$activityID);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //check if member activity entry exists
    function CheckifMemberAlreadyHasActivity($memberID,$activityID){
        $query = $this->link->query("select count(*) from memberactivities where memberID = '$memberID' AND activitiesID = '$activityID' LIMIT 1");           
        $result = $query->fetchColumn();       
        return $result;
    }
    
    //get activity details
    function getActDetails($id,$regyearAssign){
        $query = $this->link->query("SELECT headOfActivity 
                                    FROM activitydetails
                                    WHERE activityID = '$id' AND regYear = '$regyearAssign'");
        $result = $query->fetchAll();
        return $result;
    }
    
    //check if entry exists
    function CheckIfhoaExists($activityid,$regid){
        $query = $this->link->query("SELECT COUNT(*)
                                    FROM activitydetails
                                    WHERE activityID = '$activityid' AND regYear = '$regid' ");          
        $counts = $query->fetchColumn();
        if($counts == 1)
        {  
            $result = 1;
        }
        else
        {
            $result = 0;
        }
        return $result;        
    }
    
    
    //doesnt exist, insert new
    function addhoa($activityid,$regid,$hoa){
        $query = $this->link->prepare("INSERT INTO activitydetails (activityID,regYear,headOfActivity) VALUES (?,?,?)");        
        $values = array($activityid,$regid,$hoa);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //exists, update
    function Updatehoa($activityid,$regid,$hoa){
        $query = $this->link->prepare("UPDATE activitydetails SET headOfActivity = '$hoa' WHERE activityID = '$activityid' AND regYear = '$regid' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //list all livestock with selected
    function listActivityType(){
        $query = $this->link->query("SELECT *
                                    FROM activitytype ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all activies
    function listActivities(){
        $query = $this->link->query("SELECT A.activitiesname as actName
                                    , A.activitiesdescription as Adesc
                                    , A.activitiesID as Aid
                                    , T.activitytypename as ActType
                                    , A.code as code
                                    FROM activities A
                                    JOIN activitytype T ON A.activitytypeID = T.activitytypeID ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list tree planting items for member
    function listMemberTreePlantingItems($id){
        $query = $this->link->query("SELECT TI.numberoftrees as notrees, T.fieldname as treename
                                    , TI.treeplantingitemsid as tid, TI.treedetails as treedetails
                                    FROM treeplantingitems TI
                                    JOIN memberactivities MA ON MA.memberactivitiesID = TI.memberactivityid
                                    JOIN trees T ON T.treesid = TI.treetype
                                    where MA.memberID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
   
    //add activity
    function addActivity($Aname,$aDesc,$aID,$code){
        $query = $this->link->prepare("INSERT INTO activities (activitiesname,activitiesdescription,activitytypeID,code) VALUES (?,?,?,?)");        
        $values = array($Aname,$aDesc,$aID,$code);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update activity
    function UpdateActivity($Aname,$aDesc,$aID,$id,$code){
        $query = $this->link->prepare("UPDATE activities SET activitiesname = '$Aname',activitiesdescription = '$aDesc',activitytypeID = '$aID', code = '$code' WHERE activitiesID = '$id'");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //add crop
    function addMemberActivity($memberID,$activityID){
        $query = $this->link->prepare("INSERT INTO memberactivities (memberID,activitiesID) VALUES (?,?)");        
        $values = array($memberID,$activityID);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update member activity
    function updateMemberActivity($memberID,$activityID,$status){
        $query = $this->link->prepare("UPDATE memberactivities SET involved = '$status' WHERE memberID = '$memberID' AND activitiesID = '$activityID' ");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //get cropID
    function getActivityID($code){
        $query = $this->link->query("SELECT activitiesID "
                                    . "FROM activities WHERE code = '$code' LIMIT 1");
        $result = $query->fetchAll();
        return $result;
    }
    
    //View member activities
    //select members
    function selectDistMembers(){
        $query = $this->link->query("SELECT distinct(memberID) as memberID "
                                    . "FROM memberactivities ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function selectAllMembersRegYear($regYear){
        $query = $this->link->query("SELECT distinct(M.memberID) as mid
                                    , I.fieldname as ipcname
                                    , G.fieldname as gacname
                                    , C.fieldname as clubname
                                    , concat(M.names, ' ', M.surname) as membername 
                                    , M.gender as gender
                                    , M.memberNumber as membernumber
                                    FROM members M 
                                    join clubs C on M.club = clubsID
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    join memberactivities MA on MA.memberID = M.memberID
                                    where M.yearRegistered = '$regYear' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function checkMemberParticipation($memberid,$activity){
        $query = $this->link->query("SELECT count(*) from memberactivities where activitiesID = '$activity' and memberID = '$memberid' ");
        $result = $query->fetchColumn();
        if($result == 1){
            $userattendance = 'YES';
        }else{
            $userattendance = 'NO';
        }
        return $userattendance;
    }
    
    function getMemberNumberOfTreesPlanted($memberid){
        $query = $this->link->query("select sum(TI.numberoftrees) as totaltrees 
                                    from treeplantingitems TI
                                    JOIN memberactivities MA ON MA.memberactivitiesID = TI.memberactivityid
                                    where MA.memberID = '$memberid' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //select activities carried out by member
    function selectActivitiesForMembers($Memberid){
        $query = $this->link->query("SELECT distinct(SELECT MA.involved as involved 
                                    FROM memberactivities MA
                                    JOIN activities A ON A.activitiesID = MA.activitiesID
                                    WHERE A.code = 1 AND MA.memberID = '$Memberid') as code1
                                    ,(SELECT MA.involved as involved 
                                    FROM memberactivities MA
                                    JOIN activities A ON A.activitiesID = MA.activitiesID
                                    WHERE A.code = 2 AND MA.memberID = '$Memberid') as code2
                                    ,(SELECT MA.involved as involved 
                                    FROM memberactivities MA
                                    JOIN activities A ON A.activitiesID = MA.activitiesID
                                    WHERE A.code = 3 AND MA.memberID = '$Memberid') as code3
                                    FROM memberactivities MA
                                    JOIN activities A ON A.activitiesID = MA.activitiesID
                                    WHERE MA.memberID = '$Memberid' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //autoComplete
    function MemberAutocomplete($keyword){
        $sql = ("SELECT M.names as fname, M.surname as lname, M.memberNumber as memberNo, DATE_FORMAT(R.regYear,'%M %Y') as regYear
                , M.memberID as memberID, M.yearRegistered as regYearID
                FROM members M
                JOIN registrationyear R ON R.regyearID = M.yearRegistered 
                WHERE M.memberNumber LIKE (:keyword) ");
        $query = $this->link->prepare($sql);
        $query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    
    //check if activity for member already inserted
    function CheckMemberActivity($member,$activity){
        $query = $this->link->query("SELECT count(*) FROM memberactivities WHERE memberID = '$member' AND activitiesID = '$activity'");
        $rowcount = $query->fetchColumn();
        return $rowcount;
    }
    
}