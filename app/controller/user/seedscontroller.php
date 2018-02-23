<?php
//session_start();
if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}
        
include_once ('../../model/user/dashboardmodel.php');
//include_once ('../../model/common/commonmodel.php');
include_once ('../../model/user/seedsmodel.php');
include_once ('../../model/user/membersmodel.php');
include_once ('../../model/user/cropsmodel.php');

//$login_users = new usersmodel();
$dashboard = new dashmodel();
$seeds = new seedsmodel();
$members = new membersmodel();
$crops = new cropsmodel();

$datetime_var = new DateTime();

//list registration year
$listregYear = $dashboard->ListRegYear();

//list seeds
$lstSeeds = $seeds->listSeeds();

//list of members
$lstMembers = $members->listMembers();

//list all crops
$lstcrops = $crops->listCrops();

//list seed distribution for current year
//$lstSeedDistribution = $seeds->listSeedDistribution();

//add seed
if(isset($_POST['addSeeds'])){   
    $rowCount = count($_POST['Seeds']); //number of ipcs
   
    for($i=0;$i<$rowCount;$i++){
        
        $seedName = $_POST['seedname'][$i];
        $seedcode = $_POST['seedcode'][$i];
        $addSeed = $seeds->addSeed($seedName,$seedcode);
    }
    
    header("Location: farmproduce.php");
//    $seedName = $_POST['seednam'];
//    $seedDesc = $_POST['seeddesc'];
//    $seedcode = $_POST['seedcode'];
//    
//    
//    if($addSeed == 1){
//        header("Location: seeds.php");
//    }
}

//update seed
if(isset($_POST['updateSeed'])){
    $seedID = $_POST['seedID'];
    $seedname = $_POST['seednam1'];
    $seedcode1 = $_POST['seedcode1'];
    $seeddesc = $_POST['seeddesc1'];
    
    $updateSeed = $seeds->UpdateSeed($seedname,$seeddesc,$seedID,$seedcode1);
    
    if($updateSeed == 1){
        header("Location: seeds.php");
    }
}

// sedd distribution --------------------------
//add seed distribution single
if(isset($_POST['addSDSingle'])){
    $rowCount = count($_POST['seeds']);
    
    $memberID  = $_POST['memberIDS'];
    echo 'number of items selected '.$rowCount.'<br>';
    
    for($i=0;$i<$rowCount;$i++){
        $seed = $_POST['seed'][$i];
        $amount = $_POST['amount'][$i];
        
        echo 'seed ID: '.$seed.'<br>';
        echo 'Amount: '.$amount.'<hr>';
        $addSingleSeedDistribution = $seeds->addSingleSeedDistribution($memberID,$seed,$amount);
    }
    header("Location: seeddistribution.php");
    

}

