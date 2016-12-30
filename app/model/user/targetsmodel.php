<?php

include_once ('../../config/config.php');

class targetsmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    function getSumOfMembersInActivity($activityID,$regyear,$gender){
        $query = $this->link->query("SELECT count(M.memberID)
                                    FROM members M 
                                    join clubs C on M.club = clubsID
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join memberactivities MA on MA.memberID = M.memberID
                                    where M.yearRegistered = '$regyear' 
                                    and MA.activitiesID = '$activityID'
                                    and M.gender = '$gender' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function getSumOfTPMembersInActivity($regyear,$gender){
        $query = $this->link->query("select sum(numberoftrees) as totaltrees 
                                    from treeplantingitems
                                    where 
                                    (SELECT MA.memberactivitiesID 
                                    from memberactivities MA 
                                    join members M on MA.memberID = M.memberID
                                    join clubs C on M.club = clubsID
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    join districtsregyear DY on DY.districtsregyearID = I.fieldref
                                    join districts D on D.districtID = DY.district
                                    join registrationyear RY on RY.regyearID = DY.regyear
                                    where MA.activitiesID = 23 and RY.regYearID = '$regyear' and M.gender = '$gender')");
        $result = $query->fetchColumn();
        if($result == NULL){
            return 0;
        }else{
            return $result;
        }
        
    }
    
    function getActivityID($code){
        $query = $this->link->query("SELECT activitiesID "
                                    . "FROM activities WHERE code = '$code' LIMIT 1");
        $result = $query->fetchAll();
        return $result;
    }
    
    //update district targets
    function UpdateActivityTargets($target,$targetID){
        $query = $this->link->query("UPDATE targets SET target = '$target' WHERE targetsID = '$targetID' ");
        if($query->execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    //update district targets
    function UpdateDistrictTargets($target,$districtID){
        $query = $this->link->query("UPDATE districtsregyear SET target = '$target' WHERE districtsregyearID = '$districtID' ");
        if($query->execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    //get targets for current year
    //MemberTargetsModal
    function TotalMemberTargets($regyear){
        $query = $this->link->query("SELECT target FROM targets WHERE category = 'Membership' AND regYear = '$regyear' ");
        $result = $query->fetchAll();        
        return $result;
    }
    
    function getTargetTotal($regyear,$gender){
        $query = $this->link->query("SELECT count(M.memberID) as members
                                    FROM members M 
                                    join clubs C on M.club = clubsID
                                    join gac G on G.GACid = C.fieldref
                                    join associations A on A.associationsID = G.fieldref
                                    join ipc I on I.IPCid = A.fieldref
                                    join districtsregyear DY on DY.districtsregyearID = I.fieldref
                                    join districts D on D.districtID = DY.district
                                    where DY.districtsregyearID = '$regyear' and M.gender = '$gender' ");
        $result = $query->fetchColumn();        
        return $result;
    }
    
    //DistrictsTargetsModal
    function TotalDistrictsTargets($regyear){
        $query = $this->link->query("select D.fieldname as district, RY.target as target, RY.districtsregyearID as did
                                    from districtsregyear RY
                                    join districts D on D.districtID = RY.district
                                    where RY.regyear = '$regyear' ");
        $result = $query->fetchAll();        
        return $result;
    }
    
    //TrainingTargetsModal
    function GetActivityTargets($regyear,$type){
        $query = $this->link->query("select A.activitiesname as item, T.target as target, T.targetsID as tid, A.code as acode
                                    from targets T
                                    join activities A on A.activitiesID = T.item
                                    where T.regYear = '$regyear' and A.activitytypeID = '$type' ");
        $result = $query->fetchAll();        
        return $result;
    }
    
    //get target for activity
    function GetActivityTarget($regyear,$activity){
        $query = $this->link->query("select A.activitiesname as item, T.target as target, T.targetsID as tid, A.code as acode, A.activitiesID as aid, AT.activitytypename as ActType
                                    from targets T
                                    join activities A on A.activitiesID = T.item
                                    join activitytype AT on AT.activitytypeID = A.activitytypeID
                                    where T.regYear = '$regyear' and A.activitiesID = '$activity' ");
        $result = $query->fetchAll();        
        return $result;
    }
    
    function listAllActivities($regyear){
        $query = $this->link->query("select A.activitiesname as item
                                    , T.target as target
                                    , T.targetsID as tid
                                    , A.code as acode
                                    , A.activitiesID as aid
                                    , AT.activitytypename as ActType
                                    from targets T
                                    join activities A on A.activitiesID = T.item
                                    join activitytype AT on AT.activitytypeID = A.activitytypeID
                                    where T.regYear = '$regyear' ");
        $result = $query->fetchAll();        
        return $result;
    }
    
    //  update targets --------------------------------------------------
    //MemberTargetsModal
    function UpdateTargets($regYear,$target,$item){
        $query = $this->link->query("UPDATE targets SET target = '$target' WHERE item = '$item' AND regYear = '$regYear' ");
        if($query->execute()){
            return 1;
        }else{
            return 0;
        }
    }

}

