<?php  
session_start();
include_once ('../../controller/user/targetscontroller.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NASFAM</title>    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../font-awesome-4.4.0/css/font-awesome.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../../css/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../../../css/ionicons/css/ionicons.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <!-- DataTables -->
    <link rel="stylesheet" href="../../../plugins/datatables/dataTables.bootstrap.css">
    
    <link rel="stylesheet" href="../../../dist/css/skins/skin-green.min.css">

    
    <link href="../../../css/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link href="../../../css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../css/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
    <link href="../../../css/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../css/jquery-ui.structure.css" rel="stylesheet" type="text/css"/>
    <link href="../../../css/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
    
    <link href="../../../rpt/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../rpt/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../../rpt/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    #cropOption, #seedOption, #amountOption{
        display: none;
    }
    
    .input_container ul {
	width: 206px;
	border: 1px solid #eaeaea;
	position: absolute;
	z-index: 9;
	background: #f3f3f3;
	list-style: none;
    }
    .input_container ul li {
            padding: 2px;
    }
    .input_container ul li:hover {
            background: #eaeaea;
    }
            #cont_list_id {
            display: none;
    }
    </style>
</head>
    <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-green sidebar-mini">
      <div class="wrapper">
      <!-- Main Header -->
    <?php include ('../common/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
        <?php include ('../common/nav.php');?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Targets Summary for
            <small><?php echo $regYearName ?></small>
          </h1>             
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Targets</a></li>
            <li class="active"> Summary</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">                  
                        <div class="box-body">
                        <form class="form-inline" method="post" id="frmSearchSearchTargets">
                                <input type="hidden" id="SearchTargets" name="SearchTargets" >
                                <table class="table">
                                    <tr>
                                        <td>
                                           <label>Select registered Year: </label>
                                            <select class="form-control" id="regyearDS" name="regyearDS">
                                             <?php foreach ($listregYear as $optionMemberList) { ;?>
                                                <option value="<?php echo $optionMemberList['regyearID']; ?>"><?php echo $optionMemberList['regYear']; ?></option>
                                            <?php  } ;?>
                                            </select> 
                                        <button type="button" class="btn btn-info" onclick="SearchAllTargets()">Display</button>
                                       <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMembersModal">Register New Member(s)</button>-->   
                                    </td>                                       
                                </tr>                               
                            </table>
                            </form>                  
 </div>
                
                </div>
            </div>
        </div>
            
            
            
        <!-- /.row -->
        <div class="row">
          <div class="col-xs-12">
             <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">IPCs</h3>
                <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <td>Type of activity</td>
                        <td>Female</td>
                        <td>Male</td>
                        <td>%Female</td>
                        <td>%Male</td>
                        <td>Total</td>
                        <td>Target</td>
                        <td>%Achievement</td>
                    </tr>
                </thead>
                <tbody>
                     <?php
                      if ($lstDistrictsTargets == 0) {
                      ?>
                        <tr> 
                          <td>Type of activity</td>
                        <td>Female</td>
                      <td>Male</td>
                      <td>%Female</td>
                      <td>%Male</td>
                      <td>Total</td>
                      <td>Target</td>
                      <td>%Achievement</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstDistrictsTargets as $value)
                                {  
                                    $RYid = $value['did'];
                                    $ipc = $value['ipc']; //ipc
                                    $season = $value['season']; //reg year season
                                    
                                    $male = 'MALE';
                                    $female = 'FEMALE';
                                    
                                    $getFeMaleTotal = $targets->getTargetTotal($season,$ipc,$female); //get female total
                                    $getMaleTotal = $targets->getTargetTotal($season,$ipc,$male); //get male total
                                    $totalMembers = $getFeMaleTotal + $getMaleTotal; //total
                                    if($totalMembers > 0){
                                       $Getmalepercentage = $getMaleTotal/$totalMembers * 100;
                                        $Getfemalepercentage = $getFeMaleTotal/$totalMembers * 100;
                                        $malepercentage = round($Getmalepercentage);
                                        $femalepercentage = round($Getfemalepercentage);
                                        if($value['target'] > 0){
                                           $Getachievement = $totalMembers / $value['target'] * 100;
                                            $achievement = round($Getachievement); 
                                        }else{
                                          $achievement = 0;  
                                        }
                                        
                                    }else{
                                       $malepercentage = 0;
                                        $femalepercentage = 0; 
                                        $achievement = 0;  
                                    }
                                    
                               ?>    
                         <tr> 
                            <td><?php echo $value['IPCname'] ?></td>
                            <td><?php echo $getFeMaleTotal ?></td>
                            <td><?php echo $getMaleTotal ?></td>
                            <td><?php echo $femalepercentage ?></td>
                            <td><?php echo $malepercentage ?></td>
                            <td><?php echo $totalMembers ?></td>
                            <td><?php echo $value['target'] ?></td>
                            <td><?php echo $achievement ?></td>
                            </tr>
                         <?php  }
                        }
                        ?> 
                </tbody>
              </table>
             </div><!-- /.box-body -->
<!--             <div class="box-footer clearfix">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#DistrictsTargetsModal">Add New Member Activity Data</button>
              <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div> /.box-footer -->
          </div><!-- /.box -->                   
          </div>
        </div>   <!-- /.row --> 
        
        <!-- /.row -->
        <div class="row">
          <div class="col-xs-12">
             <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Training Unit</h3>
                <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="trainingunittbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <td>Type of activity</td>
                        <td>Female</td>
                      <td>Male</td>
                      <td>%Female</td>
                      <td>%Male</td>
                      <td>Total</td>
                      <td>Target</td>
                      <td>%Achievement</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      if ($lstTrainingTargets == 0) {
                      ?>
                        <tr> 
                          <td>Type of activity</td>
                        <td>Female</td>
                      <td>Male</td>
                      <td>%Female</td>
                      <td>%Male</td>
                      <td>Total</td>
                      <td>Target</td>
                      <td>%Achievement</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstTrainingTargets as $value)
                                {  
                                    $acode = $value['acode']; //get activity code
                                    $getActivityID = $targets->getActivityID($acode); //get activity id with activity code
                                    
                                    $activityID = $getActivityID[0][0]; //activity id
                                    
                                    $male = 'MALE';
                                    $female = 'FEMALE';
                                    //count number of female members who took this activity this reg year
                                    $getFeMaleTotal = $targets->getSumOfMembersInActivity($activityID,$regyear,$female); //get female members count
                                    $getMaleTotal = $targets->getSumOfMembersInActivity($activityID,$regyear,$male); //get male members count
                                    
                                    $totalMembers = $getFeMaleTotal + $getMaleTotal; //total
                                    if($totalMembers > 0){
                                        $Getmalepercentage = $getMaleTotal/$totalMembers * 100;
                                        $Getfemalepercentage = $getFeMaleTotal/$totalMembers * 100;
                                        $malepercentage = round($Getmalepercentage);
                                        $femalepercentage = round($Getfemalepercentage);
                                        if($value['target'] > 0){
                                           $Getachievement = $totalMembers / $value['target'] * 100;
                                            $achievement = round($Getachievement); 
                                        }else{
                                          $achievement = 0;  
                                        }
                                        
                                    }else{
                                       $malepercentage = 0;
                                        $femalepercentage = 0; 
                                        $achievement = 0;  
                                    }
                                    
                               ?>    
                         <tr> 
                            <td><?php echo $value['item'] ?></td>
                            <td><?php echo $getFeMaleTotal ?></td>
                            <td><?php echo $getMaleTotal ?></td>
                            <td><?php echo $femalepercentage ?></td>
                            <td><?php echo $malepercentage ?></td>
                            <td><?php echo $totalMembers ?></td>
                            <td><?php echo $value['target'] ?></td>
                            <td><?php echo $achievement ?></td>
                            </tr>
                         <?php  }
                        }
                        ?> 
                </tbody>
              </table>
             </div><!-- /.box-body -->
<!--             <div class="box-footer clearfix">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#TrainingTargetsModal">Add New Member Activity Data</button>
              <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div> /.box-footer -->
          </div><!-- /.box -->                   
          </div>
        </div>   <!-- /.row --> 
        
        <!-- /.row -->
        <div class="row">
          <div class="col-xs-12">
             <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Community Development Programmes</h3>
                <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="communitytbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <td>Type of activity</td>
                        <td>Female</td>
                      <td>Male</td>
                      <td>%Female</td>
                      <td>%Male</td>
                      <td>Total</td>
                      <td>Target</td>
                      <td>%Achievement</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      if ($lstCDPTargets == 0) {
                      ?>
                        <tr> 
                          <td>Type of activity</td>
                        <td>Female</td>
                      <td>Male</td>
                      <td>%Female</td>
                      <td>%Male</td>
                      <td>Total</td>
                      <td>Target</td>
                      <td>%Achievement</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstCDPTargets as $value)
                                {  
                               $acode = $value['acode']; //get activity code
                                    $getActivityID = $targets->getActivityID($acode); //get activity id with activity code
                                    $activityID = $getActivityID[0][0]; //activity id
                                    
                                    $male = 'MALE';
                                    $female = 'FEMALE';
                                    //count number of female members who took this activity this reg year
                                    $getFeMaleTotal = $targets->getSumOfMembersInActivity($activityID,$regyear,$female); //get female members count
                                    $getMaleTotal = $targets->getSumOfMembersInActivity($activityID,$regyear,$male); //get male members count
                                    
                                    $totalMembers = $getFeMaleTotal + $getMaleTotal; //total
                                    if($totalMembers > 0){
                                       $Getmalepercentage = $getMaleTotal/$totalMembers * 100;
                                        $Getfemalepercentage = $getFeMaleTotal/$totalMembers * 100;
                                        $malepercentage = round($Getmalepercentage);
                                        $femalepercentage = round($Getfemalepercentage);
                                        if($value['target'] > 0){
                                           $Getachievement = $totalMembers / $value['target'] * 100;
                                            $achievement = round($Getachievement); 
                                        }else{
                                          $achievement = 0;  
                                        }
                                        
                                    }else{
                                       $malepercentage = 0;
                                        $femalepercentage = 0; 
                                        $achievement = 0;  
                                    }
                               ?>    
                         <tr> 
                            <td><?php echo $value['item'] ?></td>
                            <td><?php echo $getFeMaleTotal ?></td>
                            <td><?php echo $getMaleTotal ?></td>
                            <td><?php echo $femalepercentage ?></td>
                            <td><?php echo $malepercentage ?></td>
                            <td><?php echo $totalMembers ?></td>
                            <td><?php echo $value['target'] ?></td>
                            <td><?php echo $achievement ?></td>
                            </tr>
                         <?php  }
                        }
                        ?> 
                </tbody>
              </table>
             </div><!-- /.box-body -->
<!--             <div class="box-footer clearfix">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#CDPTargetsModal">Add New Member Activity Data</button>
              <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div> /.box-footer -->
          </div><!-- /.box -->                   
          </div>
        </div>   <!-- /.row --> 
        
        <!-- /.row -->
        <div class="row">
          <div class="col-xs-12">
             <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Policy Activities</h3>
                <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="policytbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <td>Type of activity</td>
                        <td>Female</td>
                      <td>Male</td>
                      <td>%Female</td>
                      <td>%Male</td>
                      <td>Total</td>
                      <td>Target</td>
                      <td>%Achievement</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      if ($lstPolicyTargets == 0) {
                      ?>
                        <tr> 
                          <td>Type of activity</td>
                        <td>Female</td>
                      <td>Male</td>
                      <td>%Female</td>
                      <td>%Male</td>
                      <td>Total</td>
                      <td>Target</td>
                      <td>%Achievement</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstPolicyTargets as $value)
                                {  
                               $acode = $value['acode']; //get activity code
                                    $getActivityID = $targets->getActivityID($acode); //get activity id with activity code
                                    $activityID = $getActivityID[0][0]; //activity id
                                    
                                    $male = 'MALE';
                                    $female = 'FEMALE';
                                    //count number of female members who took this activity this reg year
                                    $getFeMaleTotal = $targets->getSumOfMembersInActivity($activityID,$regyear,$female); //get female members count
                                    $getMaleTotal = $targets->getSumOfMembersInActivity($activityID,$regyear,$male); //get male members count
                                    
                                    $totalMembers = $getFeMaleTotal + $getMaleTotal; //total
                                    if($totalMembers > 0){
                                       $Getmalepercentage = $getMaleTotal/$totalMembers * 100;
                                        $Getfemalepercentage = $getFeMaleTotal/$totalMembers * 100;
                                        $malepercentage = round($Getmalepercentage);
                                        $femalepercentage = round($Getfemalepercentage);
                                        if($value['target'] > 0){
                                           $Getachievement = $totalMembers / $value['target'] * 100;
                                            $achievement = round($Getachievement); 
                                        }else{
                                          $achievement = 0;  
                                        }
                                        
                                    }else{
                                       $malepercentage = 0;
                                        $femalepercentage = 0; 
                                        $achievement = 0;  
                                    }
                               ?>    
                         <tr> 
                            <td><?php echo $value['item'] ?></td>
                            <td><?php echo $getFeMaleTotal ?></td>
                            <td><?php echo $getMaleTotal ?></td>
                            <td><?php echo $femalepercentage ?></td>
                            <td><?php echo $malepercentage ?></td>
                            <td><?php echo $totalMembers ?></td>
                            <td><?php echo $value['target'] ?></td>
                            <td><?php echo $achievement ?></td>
                            </tr>
                         <?php  }
                        }
                        ?> 
                </tbody>
              </table>
             </div><!-- /.box-body -->
<!--             <div class="box-footer clearfix">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#PolicyTargetsModal">Add New Member Activity Data</button>
              <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div> /.box-footer -->
          </div><!-- /.box -->                   
          </div>
        </div>   <!-- /.row --> 
        
        <!-- /.row -->
        <div class="row">
          <div class="col-xs-12">
             <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Farm Services</h3>
                <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="farmtbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <td>Type of activity</td>
                        <td>Female</td>
                      <td>Male</td>
                      <td>%Female</td>
                      <td>%Male</td>
                      <td>Total</td>
                      <td>Target</td>
                      <td>%Achievement</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      if ($lstFarmTargets == 0) {
                      ?>
                        <tr> 
                          <td>Type of activity</td>
                        <td>Female</td>
                      <td>Male</td>
                      <td>%Female</td>
                      <td>%Male</td>
                      <td>Total</td>
                      <td>Target</td>
                      <td>%Achievement</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstFarmTargets as $value)
                                {  
                               $acode = $value['acode']; //get activity code
                                    $getActivityID = $targets->getActivityID($acode); //get activity id with activity code
                                    $activityID = $getActivityID[0][0]; //activity id
                                    
                                    $male = 'MALE';
                                    $female = 'FEMALE';
                                    //count number of female members who took this activity this reg year
                                    $getFeMaleTotal = $targets->getSumOfMembersInActivity($activityID,$regyear,$female); //get female members count
                                    $getMaleTotal = $targets->getSumOfMembersInActivity($activityID,$regyear,$male); //get male members count
                                    
                                    $totalMembers = $getFeMaleTotal + $getMaleTotal; //total
                                    if($totalMembers > 0){
                                       $Getmalepercentage = $getMaleTotal/$totalMembers * 100;
                                        $Getfemalepercentage = $getFeMaleTotal/$totalMembers * 100;
                                        $malepercentage = round($Getmalepercentage);
                                        $femalepercentage = round($Getfemalepercentage);
                                        if($value['target'] > 0){
                                           $Getachievement = $totalMembers / $value['target'] * 100;
                                            $achievement = round($Getachievement); 
                                        }else{
                                          $achievement = 0;  
                                        }
                                        
                                    }else{
                                       $malepercentage = 0;
                                        $femalepercentage = 0; 
                                        $achievement = 0;  
                                    }
                               ?>    
                         <tr> 
                            <td><?php echo $value['item'] ?></td>
                            <td><?php echo $getFeMaleTotal ?></td>
                            <td><?php echo $getMaleTotal ?></td>
                            <td><?php echo $femalepercentage ?></td>
                            <td><?php echo $malepercentage ?></td>
                            <td><?php echo $totalMembers ?></td>
                            <td><?php echo $value['target'] ?></td>
                            <td><?php echo $achievement ?></td>
                            </tr>
                         <?php  }
                        }
                        ?> 
                </tbody>
              </table>
             </div><!-- /.box-body -->
<!--             <div class="box-footer clearfix">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#FarmTargetsModal">Add New Member Activity Data</button>
              <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div> /.box-footer -->
          </div><!-- /.box -->                   
          </div>
        </div>   <!-- /.row --> 
           
            
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

     
    </div><!-- ./wrapper -->
    
    <!-- MODALS -->
    
    <!-- Member Targets Modal -->
<!--    <div id="MemberTargetsModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
             modal content 
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Update Member Targets</h3>                   
                </div>
                <div class="modal-body">                                                      
                    <form role="form" id="UpdateMemberTargetsform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="UpdateMemberTargets" name="UpdateMemberTargets" >
                    <input type="hidden" id="regyear" name="regyear" value="<?php // echo $regyear ?>">
                    <div class="row">
                        <div class="col-sm-12 input_container">                          
                            <div class="form-group">
                                <label for="memberTarget">Member Target:</label>
                                <input type="text" class="form-control" id="memberTarget" name="memberTarget" value="<?php // echo $TotalMembersTarget ?>" placeholder="Enter Member Target" />
                            </div>                         
                        </div>
                    </div>                        
                    </form>                    
                </div>                            
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="UpdateMemberTargets()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>-->
    <!-- End Member Targets Modal -->
    
    <!-- Districts Targets Modal -->
    <div id="DistrictsTargetsModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Update District Targets for <?php echo $regYearName; ?></h3>                   
                </div>
                <div class="modal-body">                                                      
                    <form role="form" id="UpdateDistrictTargetsform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="UpdateDistrictTargets" name="UpdateDistrictTargets" >
                    <input type="hidden" id="regyear" name="regyear" value="<?php echo $regyear ?>">
                    <div class="row">
                        <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">              
                            <tr>
                                <td>SELECT</td>
                                <td>DISTRICT</td>                       
                                <td>Target</td>                  
                            </tr>  
                            <?php  
                           foreach($lstDistrictsTargets as $value)
                                {  
                               ?>    
                            <tr> 
                            <td>
                                <input type="checkbox" class="case" name="districts[]" value="<?php echo $value['did'] ?>" />
                                <input type="hidden" class="form-control case" name="targetID[<?php echo $value['did'] ?>]" value="<?php echo $value['did'] ?>"/>
                                <input type="hidden" class="form-control case" name="targetItem[<?php echo $value['did'] ?>]" value="<?php echo $value['IPCname'] ?>"/>
                            </td>
                            <td><?php echo $value['IPCname'] ?></td>
                            <td><input type="text" class="form-control case" name="districttarget[<?php echo $value['did'] ?>]" value="<?php echo $value['target'] ?>"></td>
                            </tr>
                         <?php  }
                        ?>               
                        </table>
                    </div>                        
                    </form>                    
                </div>                            
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="UpdateDistrictTargets()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- End Districts Targets Modal -->
    
    <!-- Training Targets Modal -->
    <div id="TrainingTargetsModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Update Training Targets</h3>                   
                </div>
                <div class="modal-body">                                                      
                    <form role="form" id="UpdateTrainingTargetsform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="updateactivitytarget" name="updateactivitytarget" >
                    <input type="hidden" id="regyear" name="regyear" value="<?php echo $regyear ?>">
                    <div class="row">
                        <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">              
                            <tr>
                                <td>SELECT</td>
                                <td>ITEM</td>                       
                                <td>TARGET</td>                  
                            </tr>  
                            <?php  
                           foreach($lstTrainingTargets as $value)
                                {  
                               ?>    
                            <tr> 
                            <td>
                                <input type="checkbox" class="case" name="districts[]" value="<?php echo $value['tid'] ?>" />
                                <input type="hidden" class="form-control case" name="targetID[<?php echo $value['tid'] ?>]" value="<?php echo $value['tid'] ?>"/>
                                <input type="hidden" class="form-control case" name="targetItem[<?php echo $value['tid'] ?>]" value="<?php echo $value['item'] ?>"/>
                            </td>
                            <td><?php echo $value['item'] ?></td>
                            <td><input type="text" class="form-control case" name="districttarget[<?php echo $value['tid'] ?>]" value="<?php echo $value['target'] ?>"></td>
                            </tr>
                         <?php  }
                        ?>               
                        </table>
                    </div>                        
                    </form>                    
                </div>                            
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="UpdateTrainingTargets()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- End Training Targets Modal -->
    
    <!-- CDP Targets Modal -->
    <div id="CDPTargetsModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Update CDP Targets</h3>                   
                </div>
                <div class="modal-body">                                                      
                    <form role="form" id="UpdateCDPTargetsform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="updateactivitytarget" name="updateactivitytarget" >
                    <input type="hidden" id="regyear" name="regyear" value="<?php echo $regyear ?>">
                    <div class="row">
                        <div class="col-sm-12 input_container">                            
                            <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">              
                            <tr>
                                <td>SELECT</td>
                                <td>ITEM</td>                       
                                <td>TARGET</td>                  
                            </tr>  
                            <?php  
                           foreach($lstCDPTargets as $value)
                                {  
                               ?>    
                            <tr> 
                            <td>
                                <input type="checkbox" class="case" name="districts[]" value="<?php echo $value['tid'] ?>" />
                                <input type="hidden" class="form-control case" name="targetID[<?php echo $value['tid'] ?>]" value="<?php echo $value['tid'] ?>"/>
                                <input type="hidden" class="form-control case" name="targetItem[<?php echo $value['tid'] ?>]" value="<?php echo $value['item'] ?>"/>
                            </td>
                            <td><?php echo $value['item'] ?></td>
                            <td><input type="text" class="form-control case" name="districttarget[<?php echo $value['tid'] ?>]" value="<?php echo $value['target'] ?>"></td>
                            </tr>
                         <?php  }
                        ?>               
                        </table>                                                  
                        </div>
                    </div>                        
                    </form>                    
                </div>                            
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="UpdateCDPTargets()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- End CDP Targets Modal -->
    
    <!-- Policy Targets Modal -->
    <div id="PolicyTargetsModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Update Policy Targets</h3>                   
                </div>
                <div class="modal-body">                                                      
                    <form role="form" id="UpdatePolicyTargetsform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="updateactivitytarget" name="updateactivitytarget" >
                    <input type="hidden" id="regyear" name="regyear" value="<?php echo $regyear ?>">
                    <div class="row">
                        <div class="col-sm-12 input_container">
                            <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">              
                            <tr>
                                <td>SELECT</td>
                                <td>ITEM</td>                       
                                <td>TARGET</td>                  
                            </tr>  
                            <?php  
                           foreach($lstPolicyTargets as $value)
                                {  
                               ?>    
                            <tr> 
                            <td>
                                <input type="checkbox" class="case" name="districts[]" value="<?php echo $value['tid'] ?>" />
                                <input type="hidden" class="form-control case" name="targetID[<?php echo $value['tid'] ?>]" value="<?php echo $value['tid'] ?>"/>
                                <input type="hidden" class="form-control case" name="targetItem[<?php echo $value['tid'] ?>]" value="<?php echo $value['item'] ?>"/>
                            </td>
                            <td><?php echo $value['item'] ?></td>
                            <td><input type="text" class="form-control case" name="districttarget[<?php echo $value['tid'] ?>]" value="<?php echo $value['target'] ?>"></td>
                            </tr>
                         <?php  }
                        ?>               
                        </table>                   
                        </div>
                    </div>                        
                    </form>                    
                </div>                            
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="UpdatePolicyTargets()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- End Policy Targets Modal -->
    
    <!-- Farm Targets Modal -->
    <div id="FarmTargetsModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Update Farm Targets</h3>                   
                </div>
                <div class="modal-body">                                                      
                    <form role="form" id="UpdateFarmTargetsform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="updateactivitytarget" name="updateactivitytarget" >
                    <input type="hidden" id="regyear" name="regyear" value="<?php echo $regyear ?>">
                    <div class="row">
                        <div class="col-sm-12 input_container">
                            <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">              
                            <tr>
                                <td>SELECT</td>
                                <td>ITEM</td>                       
                                <td>TARGET</td>                  
                            </tr>  
                            <?php  
                           foreach($lstFarmTargets as $value)
                                {  
                               ?>    
                            <tr> 
                            <td>
                                <input type="checkbox" class="case" name="districts[]" value="<?php echo $value['tid'] ?>" />
                                <input type="hidden" class="form-control case" name="targetID[<?php echo $value['tid'] ?>]" value="<?php echo $value['tid'] ?>"/>
                                <input type="hidden" class="form-control case" name="targetItem[<?php echo $value['tid'] ?>]" value="<?php echo $value['item'] ?>"/>
                            </td>
                            <td><?php echo $value['item'] ?></td>
                            <td><input type="text" class="form-control case" name="districttarget[<?php echo $value['tid'] ?>]" value="<?php echo $value['target'] ?>"></td>
                            </tr>
                         <?php  }
                        ?>               
                        </table>                   
                        </div>
                    </div>                        
                    </form>                    
                </div>                            
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="UpdateFarmTargets()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- End Farm Targets Modal -->
    
    
    <!-- END MODALS -->
    
    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/app.min.js"></script>
    
    
<script src="../../../js/jquery-ui.js"></script>

    <!--<script src="../../../rpt/jquery-1.12.3.js" type="text/javascript"></script>-->
    <script src="../../../rpt/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../../../rpt/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../rpt/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="../../../rpt/buttons.bootstrap.min.js" type="text/javascript"></script>
    <script src="../../../rpt/jszip.min.js" type="text/javascript"></script>
    <script src="../../../rpt/pdfmake.min.js" type="text/javascript"></script>
    <script src="../../../rpt/vfs_fonts.js" type="text/javascript"></script>
    <script src="../../../rpt/buttons.html5.min.js" type="text/javascript"></script>
    <script src="../../../rpt/buttons.print.min.js" type="text/javascript"></script>
    <script src="../../../rpt/buttons.colVis.min.js" type="text/javascript"></script>

    <script>
        
        function _(x) {
            return document.getElementById(x);
        }
        
        function SearchAllTargets(){
//            alert('boom');
            _("SearchTargets").value = "SearchTargets";        
            _("frmSearchSearchTargets").method = "post";
            _("frmSearchSearchTargets").action = "targets.php";
            _("frmSearchSearchTargets").submit();
        }
        
        $(function() {
            //$( "#dateitem" ).datepicker( { dateFormat: 'dd/mm/yy' }); 
            //revenue dates
            $( "#dob" ).datepicker( { dateFormat: 'y-m-d' });
            
            $("#regyear2").datepicker( {
                format: " yyyy",
                viewMode: "years", 
                minViewMode: "years"
            });
            
            $('#dob1').datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'y-m-d',
                onClose: function(dateText, inst) { 
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1));
                }
            });
            
            $(".openModalLink").click(function(e) {
                e.preventDefault();       
                $("#myModalTitle").html('Activate school');
                $("#schoolnameID").html($(this).data('school'));
                $("#StatusAction").html($(this).data('name'));
                $("#StatusAction1").html($(this).data('name'));
                $("#schoolID").val($(this).data('id'));
                $("#schoolStatus").val($(this).data('status'));

                $('#ActivateModal').modal('show');
            });
            
            $(".openModalLink1").click(function(e) {
                e.preventDefault();       
                $("#myModalTitle1").html('Assign school to admin');
//                $("#schoolnameID").html($(this).data('school'));
//                $("#StatusAction").html($(this).data('name'));
//                $("#StatusAction1").html($(this).data('name'));
                $("#adminID1").val($(this).data('id'));
//                $("#schoolStatus").val($(this).data('status'));

                $('#AssignSchoolModal').modal('show');
            });
            
       });
       
        $(document).ready(function() {
            $('#myModal').modal({backdrop: 'static', keyboard: false});
            $('#myModal').modal('show');

            //district table buttons
            <?php if($_SESSION['nasfam_usertype'] == '3'){ ?>
            $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis',
                    {
                        text: 'Update Targets',
                        action: function () {
                            $('#DistrictsTargetsModal').modal('show');
                        }
                    }
                ]
            } );
            <?php  }else{?>
              $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
            <?php  }?>
           
           //training table buttons
           <?php if($_SESSION['nasfam_usertype'] == '3'){ ?>
            $('#trainingunittbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis',
                    {
                        text: 'Update Targets',
                        action: function () {
                            $('#TrainingTargetsModal').modal('show');
                        }
                    }
                ]
            } );
            <?php  }else{?>
              $('#trainingunittbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
            <?php  }?>
           
           //community development table
           <?php if($_SESSION['nasfam_usertype'] == '3'){ ?>
            $('#communitytbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis',
                    {
                        text: 'Update Targets',
                        action: function () {
                            $('#CDPTargetsModal').modal('show');
                        }
                    }
                ]
            } );
            <?php  }else{?>
              $('#communitytbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
            <?php  }?>
           
           //policy activities table
           <?php if($_SESSION['nasfam_usertype'] == '3'){ ?>
            $('#policytbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis',
                    {
                        text: 'Update Targets',
                        action: function () {
                            $('#PolicyTargetsModal').modal('show');
                        }
                    }
                ]
            } );
            <?php  }else{?>
              $('#policytbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
            <?php  }?>
           
           //farm services table
           <?php if($_SESSION['nasfam_usertype'] == '3'){ ?>
            $('#farmtbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis',
                    {
                        text: 'Update Targets',
                        action: function () {
                            $('#FarmTargetsModal').modal('show');
                        }
                    }
                ]
            } );
            <?php  }else{?>
              $('#farmtbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
            <?php  }?>
        } );
        
        
        
        
        function UpdateMemberTargets(){
            _("UpdateMemberTargets").value = "UpdateMemberTargets";        
            _("UpdateMemberTargetsform").method = "post";
            _("UpdateMemberTargetsform").action = "targets.php";
            _("UpdateMemberTargetsform").submit();
        }
        
        function UpdateDistrictTargets(){
            _("UpdateDistrictTargets").value = "UpdateDistrictTargets";        
            _("UpdateDistrictTargetsform").method = "post";
            _("UpdateDistrictTargetsform").action = "targets.php";
            _("UpdateDistrictTargetsform").submit();
        }
      
        function UpdateTrainingTargets(){
            _("updateactivitytarget").value = "updateactivitytarget";        
            _("UpdateTrainingTargetsform").method = "post";
            _("UpdateTrainingTargetsform").action = "targets.php";
            _("UpdateTrainingTargetsform").submit();
        }
        
        function UpdateCDPTargets(){
            _("updateactivitytarget").value = "updateactivitytarget";        
            _("UpdateCDPTargetsform").method = "post";
            _("UpdateCDPTargetsform").action = "targets.php";
            _("UpdateCDPTargetsform").submit();
        }
        
        function UpdatePolicyTargets(){
            _("updateactivitytarget").value = "updateactivitytarget";        
            _("UpdatePolicyTargetsform").method = "post";
            _("UpdatePolicyTargetsform").action = "targets.php";
            _("UpdatePolicyTargetsform").submit();
        }
        
        function UpdateFarmTargets(){
            _("updateactivitytarget").value = "updateactivitytarget";        
            _("UpdateFarmTargetsform").method = "post";
            _("UpdateFarmTargetsform").action = "targets.php";
            _("UpdateFarmTargetsform").submit();
        }
        
    </script>
  </body>


</html>