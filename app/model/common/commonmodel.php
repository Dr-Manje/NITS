<?php

include_once ('../../config/config.php');

class usersmodel{
    public $link;
    
    function __construct(){
        $db_connection = new dbConnection();
        $this->link = $db_connection->connect();
        return $this->link;
    }
    
    //get user details
    function getdistrict($userID){
        $query = $this->link->query("select * from districts where districtID = '$userID' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    
    function getUserIpc($userID){
        $query = $this->link->query("select * from IPC where IPCid = '$userID' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //get user details
    function getuserprofile($userID){
        $query = $this->link->query("select * from users where userID = '$userID' ");
        $result = $query->fetchAll();
        return $result;
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
    
    function updateUserpass($pass,$userid){
        $query = $this->link->prepare("UPDATE users SET password = '$pass' where userID = '$userid' ");
        if($query -> execute()){
            return 1;
        }else{
            return 0;
        }
    }
    
    function updateUserDetails($fname,$lname,$email,$userid){
        $query = $this->link->prepare("UPDATE users SET firstname = '$fname' , lastname = '$lname' , email = '$email' where userID = '$userid' ");
        if($query -> execute()){
            return 1;
        }else{
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
        $query1 = $this->link->query("SELECT regyearID, season as regYear
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
        $query1 = $this->link->query("select firstname, lastname, userID, usertype, IPC, email, status, password
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
        $query1 = $this->link->query("SELECT regyearID, season as regYear
                                    FROM registrationyear
                                    order by DATE_FORMAT(startDate,'%Y') desc limit 1");
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
                                    ,UT.usertype as usertype, U.IPC as IPC
                                    from users U
                                    JOIN usertypes UT ON UT.usertypesid = U.usertype where userID <> '$userid' ");
        $result = $query->fetchAll();
        return $result;
    }
    
    //list all activies
    function listUsers(){
        $query = $this->link->query("select U.userID as userID, U.email as email, U.password as password
                                    , U.firstname as firstname, U.lastname as lastname, U.status as status
                                    ,UT.usertype as usertype, U.IPC as IPC
                                    from users U
                                    JOIN usertypes UT ON UT.usertypesid = U.usertype ");
        $result = $query->fetchAll();
        return $result;
    }
    
    function getUserDistrict($districtid){
        $query = $this->link->query("select I.fieldname as dname, I.IPCid as did, I.fieldcode as prfx
                                    from IPC I
                                    join users U ON U.IPC = I.IPCid
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
    function addRegularUser($names,$surname,$email,$password,$usertype,$ipc){
        $status = 'ACTIVE';
        $query = $this->link->prepare("INSERT INTO users (firstname,lastname,email,password,usertype,IPC,status) VALUES (?,?,?,?,?,?,?) ");
        $values = array($names,$surname,$email,$password,$usertype,$ipc,$status);
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
        $query = $this->link->prepare("insert into districtsregyear (district,target,regyear,fieldcode)
                                        select districtID,'0','$regyear',fieldcode from districts");
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
        $query = $this->link->prepare("INSERT INTO activitytype (activitytypeID,activitytypename,code) VALUES "
                . "(1,'TRAINING UNIT','1'),"
                . "(2,'COMMUNITY DEVELOPMENT PROGRAMS','2'),"
                . "(3,'POLICY ACTIVITIES','3'),"
                . "(4,'FARM SERVICES UNIT','4')");        
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
        $query = $this->link->prepare("INSERT INTO activities (activitiesID,activitiesname,code,activitytypeID) VALUES "
                . "(1,'FARMING BUSINESS TRAINING','1','$type'),"
                . "(2,'LEADERSHIP TRAINING','2','$type'),"
                . "(3,'ADULT LITERACY','3','$type')");        
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //create activities for type 2
    function createActivities2($type){
        $query = $this->link->prepare("INSERT INTO activities (activitiesID,activitiesname,code,activitytypeID) VALUES "
                . "(4,'SOYA UTILIZATION TRAINING','4','$type'),"
                . "(5,'FOOD PRESERVATION AND PREPARATION','5','$type'),"
                . "(6,'NUTRITION TRAINING','6','$type'),"
                . "(7,'LEADERSHIP ROLES','7','$type'),"
                . "(8,'GENDER AND HIV/AIDS PROGRAMS','8','$type'),"
                . "(9,'COOKSTOVE MAKING TRAINING','9','$type'),"
                . "(10,'OCCUPATIONAL SAFETY AND HEALTH TRAINING','10','$type'),"
                . "(11,'CHILD LABOUR TRAINING','11','$type'),"
                . "(12,'FIELD AND LIFE SKILLS TRAINING','12','$type')");        
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //create activities for type 3
    function createActivities3($type){
        $query = $this->link->prepare("INSERT INTO activities (activitiesID,activitiesname,code,activitytypeID) VALUES "
                . "(13,'PARTICIPATE IN POLICY DIALOGUE MEETINGS','13','$type'),"
                . "(14,'PARTICIPATE IN EXTENSION ADVOCACY','14','$type'),"
                . "(15,'PARTICIPATE IN CA ADVOCACY CAMPAIGNS','15','$type')");        
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //create activities for type 4
    function createActivities4($type){
        $query = $this->link->prepare("INSERT INTO activities (activitiesID,activitiesname,code,activitytypeID) VALUES "
                    . "(16,'CSA PARTICIPANT','16','$type'),"
                    . "(17,'ATTENDED FIELD DAY','17','$type'),"
                    . "(18,'AFO TRAINING','18','$type'),"
                    . "(19,'FT TRAINING','19','$type'),"
                    . "(20,'GOAT BENEFICIARY','20','$type'),"
                    . "(21,'WINTER CROPPING/IRRIGATION FARMING','21','$type'),"
                    . "(22,'UTILISING CHITETEZO MBAULA','22','$type'),"
                    . "(23,'TREE PLANTING','23','$type'),"
                    . "(24,'NO OF TREES PLANTED','24','$type'),"
                    . "(25,'RABBIT BENEFICIARY','25','$type') ");    
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //create code ref
    function addIPCCodesToReg(){
        $query = $this->link->prepare("INSERT INTO coderegister (coderef,counter,code) VALUES "
                    . "('1','1','IPC1'),"
                    . "('1','2','IPC2'),"
                    . "('1','3','IPC3'),"
                    . "('1','4','IPC4'),"
                    . "('1','5','IPC5'),"
                    . "('1','6','IPC6'),"
                    . "('1','7','IPC7'),"
                    . "('1','8','IPC8'),"
                    . "('1','9','IPC9'),"
                    . "('1','10','IPC10'),"
                    . "('1','11','IPC11'),"
                    . "('1','12','IPC12'),"
                    . "('1','13','IPC13'),"
                    . "('1','14','IPC14')");    
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    
    
    //create code ref
    function createCodingRef(){
        $query = $this->link->prepare("INSERT INTO codereference (item,prefix) VALUES "
                    . "('IPC','IPC'),"
                    . "('DISTRICT','DST'),"
                    . "('ASSOCIATION','ASC'),"
                    . "('GAC','GAC'),"
                    . "('CLUB','CLB'),"
                    . "('LIVESTOCK','LVT'),"
                    . "('CROP','CRP'),"
                    . "('SEED','SED'),"
                    . "('TREE','TRE'),"
                    . "('VILLAGE','VGE'),"
                    . "('MARKET CENTER','MKC'),"
                    . "('CASUAL WORKER','CWK'),"
                    . "('WAREHOUSE','WHS'),"
                    . "('BUYER','BYR'),"
                    . "('DISPATCH LOCATION','DPL'),"
                    . "('DONORS','DON')");
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    //create districts
    function createDefaultIPCs(){
        $query = $this->link->prepare("INSERT INTO IPC (fieldname,fieldcode) VALUES "
                    . "('BALAKA','IPC1'),"
                    . "('KARONGA','IPC2'),"
                    . "('KASUNGU','IPC3'),"
                    . "('LILONGWE NORTH','IPC4'),"
                    . "('LILONGWE SOUTH','IPC5'),"
                    . "('MCHINJI','IPC6'),"
                    . "('MULANJE','IPC7'),"
                    . "('NAMWERA','IPC8'),"
                    . "('NKHOTAKOTA','IPC9'),"
                    . "('NTCHEU','IPC10'),"
                    . "('NTCHISI','IPC11'),"
                    . "('RUMPHI','IPC12'),"
                    . "('SOUTH MZIMBA','IPC13'),"
                    . "('ZOMBA','IPC14')");    
        if($query -> execute()){
            return 1;
        }else {
            return 0;
        }        
    }
    
    function createRegyearIPCs($regyear){
        $query = $this->link->prepare("INSERT INTO districtsregyear (regyear,IPC,target,fieldcode) VALUES "
                    . "('$regyear','1','0','IPC1'),"
                    . "('$regyear','2','0','IPC2'),"
                    . "('$regyear','3','0','IPC3'),"
                    . "('$regyear','4','0','IPC4'),"
                    . "('$regyear','5','0','IPC5'),"
                    . "('$regyear','6','0','IPC6'),"
                    . "('$regyear','7','0','IPC7'),"
                    . "('$regyear','8','0','IPC8'),"
                    . "('$regyear','9','0','IPC9'),"
                    . "('$regyear','10','0','IPC10'),"
                    . "('$regyear','11','0','IPC11'),"
                    . "('$regyear','12','0','IPC12'),"
                    . "('$regyear','13','0','IPC13'),"
                    . "('$regyear','14','0','IPC14')");    
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