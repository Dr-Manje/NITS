<?php

//session_start();
if (empty($_SESSION['nasfam_userid'])) {
 header('Location: ../common/login.php');
 exit;
}

include_once ('../../model/user/dashboardmodel.php');

include_once ('../../model/user/seedsmodel.php');
include_once ('../../model/user/cropsmodel.php');
include_once ('../../model/user/livestockmodel.php');
include_once ('../../model/user/treesmodel.php');

$dashboard = new dashmodel();
$seeds = new seedsmodel();
$livestock = new livestockmodel();
$crops = new cropsmodel();
$trees = new treesmodel();

$lstLivestock = $livestock->listLivestock(); //list all livestock

$lstcrops = $crops->listCrops(); //list all crops

$lstSeeds = $seeds->listSeeds(); //list seeds

$listTrees = $trees->listTrees(); //list trees