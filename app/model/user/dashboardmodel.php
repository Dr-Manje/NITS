<?php

include_once ('../../config/config.php');

class dashmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //schools registered
    function CheckYearExist($startdate,$enddate){
        $query = $this->link->query("SELECT count(*) FROM registrationyear where DATE_FORMAT(startDate,'%Y') = '$startdate' and DATE_FORMAT(endDate,'%Y') = '$enddate' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function CheckYearExist1($startdate,$enddate,$id){
        $query = $this->link->query("SELECT count(*) FROM registrationyear "
                . "where DATE_FORMAT(startDate,'%Y') = '$startdate' "
                . "and DATE_FORMAT(endDate,'%Y') = '$enddate'  "
                . "and regyearID <> '$id' ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    function RegisterYear($startdate,$enddate,$season){
        $status = 'INACTIVE';
        $query = $this->link->prepare("INSERT INTO registrationyear (regYear,status) VALUES (?,?)");        
        $values = array($startdate,$enddate,$season,$status);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    function updateseason($startdate,$enddate,$season,$pro,$id){
        $query = $this->link->prepare("UPDATE registrationyear "
                                    . "set startDate = '$startdate',endDate = '$enddate',season = '$season',procurementAmount = '$pro' "
                                    . "where  regyearID = '$id' ");
        if($query->execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function RegisterRegYear($startdate,$enddate,$season){
        $status = 'ACTIVE';
        $query = $this->link->prepare("INSERT INTO registrationyear (startDate,endDate,status,season) VALUES (?,?,?,?)");        
        $values = array($startdate,$enddate,$status,$season);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    function GetRegYear($Yearid){
        $query = $this->link->query("SELECT regyearID ,DATE_FORMAT(regYear,'%M %Y') as regYear, status
                                    FROM registrationyear WHERE regyearID = '$Yearid' ");
        $result = $query->fetchAll();
        return $result;        
    }
    
    function ListAllRegYear(){
        $query = $this->link->query("SELECT regyearID,DATE_FORMAT(startDate,'%D %M %Y') as startDate,DATE_FORMAT(endDate,'%D %M %Y') as endDate, season as regYear, status
                                    FROM registrationyear
                                    order by regyearID ASC ");
        $result = $query->fetchAll();
        return $result;        
    }
    
    function FullListRegYear(){
        $query = $this->link->query("SELECT regyearID ,season as regYear, status
                                    FROM registrationyear
                                    order by regyearID DESC");
        $result = $query->fetchAll();
        return $result;        
    }
    
     function ListRegYear(){
        $query = $this->link->query("SELECT regyearID ,season as regYear, status
                                    FROM registrationyear
                                    order by regyearID DESC ");
        $result = $query->fetchAll();
        return $result;        
    }
    
    function SelectRegYear($id){
        $query = $this->link->query("SELECT regyearID ,DATE_FORMAT(regYear,'%M %Y') as regYear, status
                                    FROM registrationyear
                                    Where regyearID = '$id' ");
        $result = $query->fetchAll();
        return $result;        
    }
    
    //DASHBOARD ITEMS ------------------------------------------ //
    //schools registered
    function TotalSchoolsRegistered(){
        $query = $this->link->query("SELECT count(*) FROM school ");
        //$result = $query->fetchAll();
        $result = $query->fetchColumn();
        return $result;
    }
    
    //schools active
    function TotalSchoolsActive(){
        $query = $this->link->query("SELECT count(*) FROM school WHERE status = 'ACTIVE' ");
        //$result = $query->fetchAll();
        $result = $query->fetchColumn();
        return $result;
    }
    
    //admins registered
    function TotalAdminsRegistered(){
        $query = $this->link->query("SELECT count(*) FROM users WHERE roleID = '2' ");
        //$result = $query->fetchAll();
        $result = $query->fetchColumn();
        return $result;
    }
    
    //admins active
    function TotalAdminsActive(){
        $query = $this->link->query("SELECT count(*) FROM users WHERE roleID = '2' AND status = 'ACTIVE' ");
        //$result = $query->fetchAll();
        $result = $query->fetchColumn();
        return $result;
    }
    //END DASHBOARD ITEMS ------------------------------------------ //
    
    //Random number generator
    function generateRandomString($length = 9) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    return $randomString;
    }
    
    function LoginUser($username,$password){
        $query = $this->link->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $rowcount = $query->rowCount();
        return $rowcount;
    }
    
    function GetUserInfo($username){
        $query = $this->link->query("SELECT * FROM users WHERE username = '$username'");
        $rowcount = $query->rowCount();
        if($rowcount == 1){
            $result = $query->fetchAll();
            return $result;
        }
        else
        {
            return $rowcount;
        }
    }
    
    //Register school
    function RegisterSchool($schoolname,$level,$logo,$country,$region,$city,$mailaddress,$physicaladdress,$web,$email,$tel_1,$tel_2,$facebook,$twitter,$instagram,$status,$createdBy,$dateCreated){        
        $query = $this->link->prepare("INSERT INTO school (schoolname,levelID,logo,country,region,city,mailaddress,physicaladdress,website,email,tel_1,tel_2,facebook,twitter,instagram,status,createdby,datecreated) "
                . "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");        
        $values = array($schoolname,$level,$logo,$country,$region,$city,$mailaddress,$physicaladdress,$web,$email,$tel_1,$tel_2,$facebook,$twitter,$instagram,$status,$createdBy,$dateCreated);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //Register admin
    function RegisterAdmin($names,$surname,$photo,$email){
//        $names = 'Emmanuel';
//        $surname = 'Namanja';
        $query = $this->link->prepare("INSERT INTO members (Names,surName,photo,email) "
                . "VALUES (?,?,?,?)");        
        $values = array($names,$surname,$photo,$email);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //Create user with Role as 2
    function RegisterAdminUser($email,$password,$memberID){
        $roleID = '2';
        $query = $this->link->prepare("INSERT INTO users (email,password,memberID,roleID) "
                . "VALUES (?,?,?,?)");        
        $values = array($email,$password,$memberID,$roleID);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //Create user with school in schooladmin table
    function RegisterAdminSchoolUser($school,$userID){        
        $query = $this->link->prepare("INSERT INTO schooladmin (schoolID,userID) "
                . "VALUES (?,?)");        
        $values = array($school,$userID);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //get last inserted member
    function GetRecentMember(){
        $query = $this->link->query("SELECT *
                                    FROM members
                                    ORDER BY memberID DESC
                                    LIMIT 1 ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get last inserted user
    function GetRecentuser(){
        $query = $this->link->query("SELECT *
                                    FROM users
                                    ORDER BY userID DESC
                                    LIMIT 1 ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list school levels
    function listSchoolLevels(){
        $query = $this->link->query("SELECT * FROM educationlevels ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all schools
    function listSchools(){
        $query = $this->link->query("SELECT * FROM school ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all Admins
    function listAdmins(){
        $query = $this->link->query("SELECT distinct userID as id FROM schooladmin ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all Admins
    function GetAdminSchool($id){
        $query = $this->link->query("SELECT S.schoolname as schoolname
                                    FROM schooladmin SA
                                    JOIN school S ON SA.schoolID = S.schoolID
                                    WHERE SA.userID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getAdminDetails($id){
        $query = $this->link->query("SELECT M.Names AS fname, M.surName AS surnames, U.status AS userstatus, M.mobilenumber AS telephone, M.email AS email, U.userID AS Uid
                                    FROM Members M
                                    JOIN users U ON U.memberID = M.memberID
                                    WHERE U.userID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //Total schools assigned to admin
    function TotalSchoolsAssignedToAdmin($id){
        $query = $this->link->query("SELECT count(*) FROM schooladmin WHERE userID = '$id' ");
        //$result = $query->fetchAll();
        $result = $query->fetchColumn();
        return $result;
    }
    
    //select school details
    function IndSchools($id){
        $query = $this->link->query("SELECT S . * , E.levelName AS level
                                    FROM school S
                                    JOIN educationlevels E ON S.levelID = E.levelID
                                    WHERE S.schoolID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //select school admins details
    function IndSchoolAdmins($id){
        $query = $this->link->query("SELECT M.Names as fname, M.surName as surname, M.mobilenumber as mobilenumber, M.email as email, U.status as status, U.userID as userID, U.password as password
                                    FROM schooladmin SA
                                    JOIN users U ON U.userID = SA.userID
                                    JOIN members M ON M.memberID = U.memberID
                                    WHERE SA.schoolID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    
    
    //select school admin details
    function IndSchoolsAdmin($id){
        $query = $this->link->query("SELECT * 
                                    FROM users U
                                    JOIN members M ON M.memberID = U.memberID
                                    WHERE U.userID = '$id' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //select school 
    function IndSchools1($school){
        $query = $this->link->query("SELECT S . * , E.levelName AS level
                                    FROM school S
                                    JOIN educationlevels E ON S.levelID = E.levelID 
                                    WHERE S.schoolID = '$school' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //activate/deactivate school
    function activateDeactivateSchool($schoolStatus,$schoolID){
        $query = $this->link->prepare("UPDATE school SET status = '$schoolStatus' WHERE schoolID = '$schoolID'");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //assign school
    function assignUpdateSchool($adminID1,$Aschool){
        $query = $this->link->prepare("UPDATE school SET status = '$Aschool' WHERE schoolID = '$adminID1'");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    function assignNewSchool($Aschool,$adminID1){
        $query = $this->link->prepare("INSERT INTO schooladmin (schoolID,userID) "
                . "VALUES (?,?)");        
        $values = array($Aschool,$adminID1);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;         
    }
    
    function CheckAssignment($adminID1,$Aschool){
        $query = $this->link->query("SELECT count(*) FROM schooladmin WHERE schoolID = '$Aschool' AND userID = '$adminID1' ");
        //$result = $query->fetchAll();
        $result = $query->fetchColumn();
        return $result;
    }
    
    
}


//$schools = new dashmodel();
//$regAdmin = $schools->RegisterAdmin();