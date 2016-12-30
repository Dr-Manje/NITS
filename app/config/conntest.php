<?php

//$db_name = 'JB';
$db_name = 'startmwc_nasfam'; //database name
$db_user = 'sa'; //database user
$db_host = 'localhost'; //database host machine
$db_pass = 'Manje@2014'; //database user password

$conn = new PDO("mysql:host=$db_host;dbname=$db_name",  $db_user, $db_pass);
//$conn = new PDO("sqlsrv:server=$db_host;Database=$db_name");

if($conn){
    echo "Database connection is good<br>";
}else{
    "connection failed<br>";
    die(print_r(sqlsrv_errors(), true));
}

$datetime_var = new DateTime();
//  $datetime_formatted = date_format($datetime_var, 'Y-m-d H:i:s');
//$datecreated = date_format($datetime_var, 'Y-m-d H:i:s');
$datecreated = date_format($datetime_var, 'Y-m-d');
echo $datecreated;
//$datecreatedYear = date_format($datetime_var, 'Y');
//$datecreatedMonth = date_format($datetime_var, 'm');
//echo 'Today Year: '.$datecreatedYear.'<br>'.'Today Month: '.$datecreatedMonth.'<br>';

//DATEPART(YEAR, SAMPLE_DATE) = '2003'
//DATEPART(MONTH,SAMPLE_DATE) = '04' AND 
//DATEPART(DAY, SAMPLE_DATE) = '09
//$sql = "SELECT Currency,RevenueRate,ExpenseRate, CONVERT(CHAR(10),datecreated,120) As Date FROM ExchangeRate WHERE CONVERT(CHAR(10),datecreated,120) = '$datecreated' " ;
//$sql = "SELECT TR_number, TR_counter, CONVERT(CHAR(10),datecreated,120) As Date FROM TRs WHERE CONVERT(CHAR(10),datecreated,120) = '$datecreated' " ;
//$sql = "SELECT TR_number, TR_counter, DATEPART(MONTH, datecreated) As Date FROM TRs WHERE DATEPART(YEAR, datecreated) = '$datecreatedYear' AND DATEPART(MONTH, datecreated) = '$datecreatedMonth' " ;
//$sql = "SELECT COUNT (*) as count FROM TRs WHERE DATEPART(YEAR, datecreated) = '$datecreatedYear' AND DATEPART(MONTH, datecreated) = '$datecreatedMonth' " ;

//$sql = "SELECT COUNT (*) as count FROM StagingFiles WHERE CONVERT(CHAR(10),datecreated,120) = '$datecreated'  " ;
//foreach($conn->query($sql) as $row){
//    //print 'TR Number: '.$row['TR_number'].' | Date: '.$row['Date'].'<br>';
//    print $row['count'];
//}

//$sql = "SELECT COUNT (*) as count FROM StagingFiles WHERE CONVERT(CHAR(10),datecreated,120) = '$datecreated'  " ;
//foreach($conn->query($sql) as $row){
//    //print 'TR Number: '.$row['TR_number'].' | Date: '.$row['Date'].'<br>';
//    print $row['count'];
//}        
        
//        try
//        {
//            $this->db_conn = new PDO("sqlsrv:server=$db_host;Database=$db_name");
//            return $this->db_conn;
//        } catch (PDOException $ex) {
//            return $ex->getMessage();
//        }   