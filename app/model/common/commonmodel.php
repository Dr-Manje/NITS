<?php

include_once ('../../config/config.php');

class usersmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //update activity
    function RestetUserPassword($userid){
        $query = $this->link->prepare("UPDATE users SET password = 'nasfam@2017' WHERE userID = '$userid'");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //update activity
    function UpdateUserSatus($userid,$status){
        $query = $this->link->prepare("UPDATE users SET status = '$status' WHERE userID = '$userid'");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //check if user exists
    function CheckUserExists($email){
        $query = $this->link->query("SELECT COUNT(*) FROM users WHERE email = '$email' ");
        $result = $query->fetchColumn();
        return $result;        
    }
    
    //get regyear details
    function getUserTypes(){
        $query1 = $this->link->query("select usertypesid,usertype from usertypes");
        $result = $query1->fetchAll();
        return $result;
    }
    
    //check if users have been set by checking user types
    function CheckUserTypes(){
        $query = $this->link->query("SELECT COUNT(*) FROM usertypes ");
        $result = $query->fetchColumn();
        return $result;
    }
    
    //add admin user
    function CreateUserTypesDefault(){
        $query = $this->link->prepare("insert into usertypes (usertype) values ('Admin'),('Regular'),('HQ Admin') ");
        $query -> execute(); //insert usertypes        
        $query1 = $this->link->prepare("insert into users (firstname,lastname,email,password,status,usertype) "
                . "values ('admin','admin','admin@nasfam.org','pass','ACTIVE',1) ");
        $query1 -> execute(); //insert default admin user
        $counts = $query->rowCount();
        return $counts;
    }
    
    //get regyear details
    function getRegYearDetails($id){
        $query1 = $this->link->query("SELECT regyearID, DATE_FORMAT(regYear,'%M %Y') as regYear
                                    FROM registrationyear
                                    WHERE regyearID = '$id' limit 1");
        $result = $query1->fetchAll();
        return $result;
    }
    
    //generate random code
    function generateRandomString($length = 9) {
    $characters = '123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    return $randomString;
    }
    
    //select individual user
    function SelectIndUser($param){
        foreach ($param as $key => $value)
        {
            $query = $this->link->query("SELECT TOP 1 COUNT (*)
                                        FROM users
                                        WHERE $key = '$value'");          
        }
        $counts = $query->fetchColumn();
        if($counts == 1)
        {
            $query1 = $this->link->query("SELECT TOP 1 *
                                        FROM users
                                        WHERE $key = '$value'");  
            $result = $query1->fetchAll();
        }
        else
        {
            $result = $counts;
        }
        return $result;        
    }
    
    function Removeuser($id){
        $query = $this->link->prepare("UPDATE users SET status = 'ACTIVE' WHERE user_id = '$id'");
        
        //$values = array($firstname,$lastname,$username,$password,$status,$usergroup);       
        //$query -> execute($values);
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }
        //$counts = $query->rowCount();
        //return $counts;      
    }
    
    function LoginUser($email,$password){
        $query = $this->link->query("SELECT COUNT(*) FROM users WHERE email = '$email' AND password = '$password'");
        $result = $query->fetchColumn();
        return $result;        
    }
    
    function GetUserInfo($email){
        $query1 = $this->link->query("select firstname, lastname, userID, usertype, district, email, status, password
                                    from users 
                                    WHERE email = '$email'");
        $result = $query1->fetchAll();
        return $result;
    }
    
    function countRegYears(){
        $query = $this->link->query("SELECT COUNT(regyearID) FROM registrationyear ");
        $result = $query->fetchColumn();
        return $result;        
    }
    
    function selectRegYear(){
        $query1 = $this->link->query("SELECT regyearID, DATE_FORMAT(regYear,'%Y') as regYear
                                    FROM registrationyear
                                    order by DATE_FORMAT(regYear,'%Y') desc limit 1");
        $result = $query1->fetchAll();
        return $result;
    }
    
    function TotalUsers(){
        $query = $this->link->query("SELECT COUNT(*) FROM users")->fetchColumn();
        return $query;
    }
    
    function listUsersExceptLoggedInUser($userid){
        $query = $this->link->query("select U.userID as userID, U.email as email, U.password as password
                                    , U.firstname as firstname, U.lastname as lastname, U.status as status
                                    ,UT.usertype as usertype, U.district as district
                                    from users U
                                    JOIN usertypes UT ON UT.usertypesid = U.usertype where userID <> '$userid' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all activies
    function listUsers(){
        $query = $this->link->query("select U.userID as userID, U.email as email, U.password as password
                                    , U.firstname as firstname, U.lastname as lastname, U.status as status
                                    ,UT.usertype as usertype, U.district as district
                                    from users U
                                    JOIN usertypes UT ON UT.usertypesid = U.usertype ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getUserDistrict($districtid){
        $query = $this->link->query("select D.fieldname as dname, D.districtID as did, D.fieldcode as prfx
                                    from districts D
                                    join users U ON U.district = D.districtID
                                    where U.userID =  '$districtid' ");
        $result = $query->fetchAll();
        return $result;
    }
   
    //add admin user
    function addAdminUser($names,$surname,$email,$password,$usertype){
        $status = 'ACTIVE';
        $query = $this->link->prepare("INSERT INTO users (firstname,lastname,email,password,usertype,status) VALUES (?,?,?,?,?,?) ");
        $values = array($names,$surname,$email,$password,$usertype,$status);
        $query -> execute($values);
        $counts = $query->rowCount();
        return $counts;
    }
    
    //add Regular user
    function addRegularUser($names,$surname,$email,$password,$usertype,$district){
        $status = 'ACTIVE';
        $query = $this->link->prepare("INSERT INTO users (firstname,lastname,email,password,usertype,district,status) VALUES (?,?,?,?,?,?,?) ");
        $values = array($names,$surname,$email,$password,$usertype,$district,$status);
        $query -> execute($values);
        $counts = $query->rowCount();
        return $counts;
    }
    
    //add activity
    function addUser($email,$password,$firstname,$lastname,$status){
        $query = $this->link->prepare("INSERT INTO users (email, password, firstname, lastname, status) VALUES (?,?,?,?,?)");        
        $values = array($email,$password,$firstname,$lastname,$status);        
        $query -> execute($values);        
        $counts = $query->rowCount();
        return $counts;        
    }
    
    //update activity
    function UpdateUser($email,$firstname,$lastname,$id){
        $query = $this->link->prepare("UPDATE users SET email = '$email'"
                                        . ",firstname = '$firstname' "
                                        . ",lastname = '$lastname'"
                                        . "WHERE userID = '$id'");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //create district targest for new regyear
    function NewRegyearDistrictTargets($regyear){
        $query = $this->link->prepare("insert into districtsregyear (district,target,regyear)
                                        select districtID,'0','$regyear' from districts");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }
    }
    
    //add default targets
    function createDefaultTargets($regyear){
        $query = $this->link->prepare("INSERT INTO targets (item,target,regYear) select activitiesID,'0','$regyear' from activities ");        
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    function createDefaultActivityTypes(){
        $query = $this->link->prepare("INSERT INTO activitytype (activitytypename,code) VALUES "
                . "('TRAINING UNIT','1'),"
                . "('COMMUNITY DEVELOPMENT PROGRAMS','2'),"
                . "('POLICY ACTIVITIES','3'),"
                . "('FARM SERVICES UNIT','4')");        
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //get activity type 1 ID
    function getActivity1ID(){
        $query1 = $this->link->query("SELECT activitytypeID
                                    FROM activitytype
                                    WHERE code = '1' limit 1");
        $result = $query1->fetchAll();
        return $result;
    }
    
    //get activity type 2 ID
    function getActivity2ID(){
        $query1 = $this->link->query("SELECT activitytypeID
                                    FROM activitytype
                                    WHERE code = '2' limit 1");
        $result = $query1->fetchAll();
        return $result;
    }
    
    //get activity type 3 ID
    function getActivity3ID(){
        $query1 = $this->link->query("SELECT activitytypeID
                                    FROM activitytype
                                    WHERE code = '3' limit 1");
        $result = $query1->fetchAll();
        return $result;
    }
    
    //get activity type 4 ID
    function getActivity4ID(){
        $query1 = $this->link->query("SELECT activitytypeID
                                    FROM activitytype
                                    WHERE code = '4' limit 1");
        $result = $query1->fetchAll();
        return $result;
    }
    
    //create activities for type 1
    function createActivities1($type){
        $query = $this->link->prepare("INSERT INTO activities (activitiesname,code,activitytypeID) VALUES "
                . "('FARMING BUSINESS TRAINING','1','$type'),"
                . "('LEADERSHIP TRAINING','2','$type'),"
                . "('ADULT LITERACY','3','$type')");        
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //create activities for type 2
    function createActivities2($type){
        $query = $this->link->prepare("INSERT INTO activities (activitiesname,code,activitytypeID) VALUES "
                . "('SOYA UTILIZATION TRAINING','4','$type'),"
                . "('FOOD PRESERVATION AND PREPARATION','5','$type'),"
                . "('NUTRITION TRAINING','6','$type'),"
                . "('LEADERSHIP ROLES','7','$type'),"
                . "('GENDER AND HIV/AIDS PROGRAMS','8','$type'),"
                . "('COOKSTOVE MAKING TRAINING','9','$type'),"
                . "('OCCUPATIONAL SAFETY AND HEALTH TRAINING','10','$type'),"
                . "('CHILD LABOUR TRAINING','11','$type'),"
                . "('FIELD AND LIFE SKILLS TRAINING','12','$type')");        
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //create activities for type 3
    function createActivities3($type){
        $query = $this->link->prepare("INSERT INTO activities (activitiesname,code,activitytypeID) VALUES "
                . "('PARTICIPATE IN POLICY DIALOGUE MEETINGS','13','$type'),"
                . "('PARTICIPATE IN EXTENSION ADVOCACY','14','$type'),"
                . "('PARTICIPATE IN CA ADVOCACY CAMPAIGNS','15','$type')");        
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //create activities for type 4
    function createActivities4($type){
        $query = $this->link->prepare("INSERT INTO activities (activitiesname,code,activitytypeID) VALUES "
                    . "('CSA PARTICIPANT','16','$type'),"
                    . "('ATTENDED FIELD DAY','17','$type'),"
                    . "('AFO TRAINING','18','$type'),"
                    . "('FT TRAINING','19','$type'),"
                    . "('GOAT BENEFICIARY','20','$type'),"
                    . "('WINTER CROPPING/IRRIGATION FARMING','21','$type'),"
                    . "('UTILISING CHITETEZO MBAULA','22','$type'),"
                    . "('TREE PLANTING','23','$type'),"
                    . "('NO OF TREES PLANTED','24','$type')");    
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //create code ref
    function addDistrictCodesToReg(){
        $query = $this->link->prepare("INSERT INTO coderegister (coderef,counter,code) VALUES "
                    . "('1','1','DST1'),"
                    . "('1','2','DST2'),"
                    . "('1','3','DST3'),"
                    . "('1','4','DST4'),"
                    . "('1','5','DST5'),"
                    . "('1','6','DST6'),"
                    . "('1','7','DST7'),"
                    . "('1','8','DST8'),"
                    . "('1','9','DST9'),"
                    . "('1','10','DST10'),"
                    . "('1','11','DST11'),"
                    . "('1','12','DST12'),"
                    . "('1','13','DST13'),"
                    . "('1','14','DST14')");    
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    
    
    //create code ref
    function createCodingRef(){
        $query = $this->link->prepare("INSERT INTO codereference (item,prefix) VALUES "
                    . "('DISTRICT','DST'),"
                    . "('IPC','IPC'),"
                    . "('ASSOCIATION','ASC'),"
                    . "('GAC','GAC'),"
                    . "('CLUB','CLB'),"
                    . "('LIVESTOCK','LVT'),"
                    . "('CROP','CRP'),"
                    . "('SEED','SED'),"
                    . "('TREE','TRE'),"
                    . "('VILLAGE','VGE')");    
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //create districts
    function createDefaultDistricts(){
        $query = $this->link->prepare("INSERT INTO districts (fieldname,fieldcode) VALUES "
                    . "('BALAKA','DST1'),"
                    . "('KARONGA','DST2'),"
                    . "('KASUNGU','DST3'),"
                    . "('LILONGWE NORTH','DST4'),"
                    . "('LILONGWE SOUTH','DST5'),"
                    . "('MCHINJI','DST6'),"
                    . "('MULANJE','DST7'),"
                    . "('NAMWERA','DST8'),"
                    . "('NKHOTAKOTA','DST9'),"
                    . "('NTCHEU','DST10'),"
                    . "('NTCHISI','DST11'),"
                    . "('RUMPHI','DST12'),"
                    . "('SOUTH MZIMBA','DST13'),"
                    . "('ZOMBA','DST14')");    
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    function createRegyearDistricts($regyear){
        $query = $this->link->prepare("INSERT INTO districtsregyear (regyear,district,target,fieldcode) VALUES "
                    . "('$regyear','1','0','DST1'),"
                    . "('$regyear','2','0','DST2'),"
                    . "('$regyear','3','0','DST3'),"
                    . "('$regyear','4','0','DST4'),"
                    . "('$regyear','5','0','DST5'),"
                    . "('$regyear','6','0','DST6'),"
                    . "('$regyear','7','0','DST7'),"
                    . "('$regyear','8','0','DST8'),"
                    . "('$regyear','9','0','DST9'),"
                    . "('$regyear','10','0','DST10'),"
                    . "('$regyear','11','0','DST11'),"
                    . "('$regyear','12','0','DST12'),"
                    . "('$regyear','13','0','DST13'),"
                    . "('$regyear','14','0','DST14')");    
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    function addTreeCodesToReg(){
        $query = $this->link->prepare("INSERT INTO coderegister (coderef,counter,code) VALUES "
                    . "('9','1','TRE1'),"
                    . "('9','2','TRE2'),"
                    . "('9','3','TRE3'),"
                    . "('9','4','TRE4')");    
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //create user setup
    function createTreeCategories(){
        $query = $this->link->prepare("INSERT INTO trees (fieldname,fieldcode) VALUES "
                    . "('Agroforestry','TRE1'),"
                    . "('Indigenous','TRE2'),"
                    . "('Exotic','TRE3'),"
                    . "('Fruit','TRE4')");    
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }  
}