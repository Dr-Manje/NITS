<?php
include_once ('../../controller/user/activitiescontroller.php'); 

$keyword = '%'.$_POST['keyword'].'%';



//$sql = "SELECT M.names as fname, M.surname as lname, M.memberNumber as memberNo, DATE_FORMAT(R.regYear,'%M %Y') as regYear
//        FROM members M
//        JOIN registrationyear R ON R.regyearID = M.yearRegistered 
//        WHERE M.memberNumber LIKE $keyword ";
//$query = $pdo->prepare($sql);
////$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
//$query->execute();
//$list = $query->fetchAll();
//foreach ($list as $rs) {
//    // put in bold the written text
//    $country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['fname'].' '.$rs['lname']);
//    // add new option
//    echo '<li onclick="set_item1(\''.str_replace("'", "\'", $rs['fname']).'\',\''.str_replace("'", "\'", $rs['lname']).'\',\''.str_replace("'", "\'", $rs['fname']).'\',\''.str_replace("'", "\'", $rs['lname']).'\')">'.$country_name.'</li>';
////    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['Cnum']).'\',\''.str_replace("'", "\'", $rs['TR']).'\')">'.$country_name.'</li>';
//}

//echo 'bounce: '.$keyword;