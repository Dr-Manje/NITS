<?php
session_start();
include_once ('../../controller/user/dashboardcontroller.php'); 
include_once ('../../controller/user/seedscontroller.php');
include_once ('../../controller/user/cropscontroller.php');
include_once ('../../controller/user/livestockcontroller.php');
include_once ('../../controller/user/activitiescontroller.php');
include_once ('../../controller/user/memberscontroller.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NASFAM</title>    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
<!--   <link href="../../datatables/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="../../datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
    
    <!-- material kit -->
    <link href="../../../material/assets/css/material-kit.css" rel="stylesheet" type="text/css"/>
    
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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
    <?php    include ('../common/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
        <?php  include ('../common/nav.php');?>
       

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Control Panel</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class="row">
              
          </div>
          
          
          <div class="row">
              <!-- left column -->
              <div class="col-lg-6 col-xs-6">
                  
                  <!-- Districts -->
                   <div class="col-lg-12 col-xs-6">
                  <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Districts</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>District</td>
                        <td>Code</td>
                        <td>Prefix</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                      if ($lstDistricts == 0) {
                      ?>
                        <tr> 
                          <td>District</td>
                        <td>Code</td>
                        <td>Prefix</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstDistricts as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['districtName'] ?></td>
                            <td><?php echo $value['districtCode'] ?></td>
                            <td><?php echo $value['districtPrefix'] ?></td>
                            <td>
<!--                                <a rel="tooltip" title="View more seed details" class="btn btn-info openModalLink" href="/" data-id="<?php echo $value['seedID'] ?>" data-status="ACCEPTED">
                                    <i class="fa fa-expand"></i>
                                </a>-->
                               <a rel="tooltip" title="Edit/Update District details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php echo $value['districtID'] ?>" 
                                  data-viewname="<?php echo $value['districtName'] ?>" data-viewdesc="<?php echo $value['districtPrefix'] ?>"
                                  data-viewcode="<?php echo $value['districtCode'] ?>"
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>                                       
                    </tbody>
                  </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#adddistrictModal">Add District</button>
                  <!--<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
              </div>
                  
                  <!-- END Districts -->
                  
                  
                  
                
                  
            <!-- Activity Categories -->
                  <div class="col-lg-12 col-xs-6">              
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Activity Categories</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Livestock Name</td>
                        <td>Code</td>
                        <td>Description</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                      if ($lstLivestock == 0) {
                      ?>
                        <tr> 
                          <td>Livestock Name</td>
                        <td>Code</td>
                        <td>Description</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstLivestock as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['livestockname'] ?></td>
                            <td><?php echo $value['code'] ?></td>
                            <td><?php echo $value['livestockdescription'] ?></td>
                            <td>
<!--                                <a rel="tooltip" title="View more seed details" class="btn btn-info openModalLink" href="/" data-id="<?php echo $value['seedID'] ?>" data-status="ACCEPTED">
                                    <i class="fa fa-expand"></i>
                                </a>-->
                               <a rel="tooltip" title="Edit/Update livestock details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php echo $value['livestockID'] ?>" 
                                  data-viewname="<?php echo $value['livestockname'] ?>" data-viewdesc="<?php echo $value['livestockdescription'] ?>"
                                  data-viewcode="<?php echo $value['code'] ?>"
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>                                       
                    </tbody>
                  </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addLivestockModal">Add Livestock</button>
                  <!--<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div>
            <!-- ./Activity Categories -->
            
            <!-- Seed -->
                  <div class="col-lg-12 col-xs-6">              
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Activities</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                      <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                         <td>actName</td>
                         <td>code</td>
                        <td>Adesc</td>
                        <td>ActType</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>                       
                        <?php
                      if ($lstActivities == 0) {
                      ?>
                        <tr> 
                          <td>actName</td>
                          <td>code</td>
                          <td>ActType</td>
                        <td>Adesc</td>                       
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstActivities as $value)
                                {  
                               ?>    
                         <tr> 
                             <td><?php echo $value['actName'] ?></td>
                             <td><?php echo $value['code'] ?></td>                             
                            <td><?php echo $value['Adesc'] ?></td>
                            <td><?php echo $value['ActType'] ?></td>
                            <td>                               
                               <a rel="tooltip" title="Edit/Update Activity details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php  echo $value['Aid'] ?>" data-viewtype="<?php echo $value['ActType'] ?>"
                                  data-viewname="<?php echo $value['actName'] ?>" data-viewdesc="<?php echo $value['Adesc'] ?>"
                                  data-viewcode="<?php echo $value['code'] ?>"
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>                                       
                    </tbody>
                  </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addLivestockModal">Add Livestock</button>
                  <!--<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- ./col Seed -->
            
            
              </div><!-- End left column ------------------------------------------------------------------------------------------------>
              
              
              
              
              <!-- right column -->
              <div class="col-lg-6 col-xs-6">
                  <!-- Seed -->
                  <div class="col-lg-12 col-xs-6">              
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Livestock</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Livestock Name</td>
                        <td>Code</td>
                        <td>Description</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                      if ($lstLivestock == 0) {
                      ?>
                        <tr> 
                          <td>Livestock Name</td>
                        <td>Code</td>
                        <td>Description</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstLivestock as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['livestockname'] ?></td>
                            <td><?php echo $value['code'] ?></td>
                            <td><?php echo $value['livestockdescription'] ?></td>
                            <td>
<!--                                <a rel="tooltip" title="View more seed details" class="btn btn-info openModalLink" href="/" data-id="<?php echo $value['seedID'] ?>" data-status="ACCEPTED">
                                    <i class="fa fa-expand"></i>
                                </a>-->
                               <a rel="tooltip" title="Edit/Update livestock details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php echo $value['livestockID'] ?>" 
                                  data-viewname="<?php echo $value['livestockname'] ?>" data-viewdesc="<?php echo $value['livestockdescription'] ?>"
                                  data-viewcode="<?php echo $value['code'] ?>"
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>                                       
                    </tbody>
                  </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addLivestockModal">Add Livestock</button>
                  <!--<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- ./col Seed -->
                    
            <!-- Crop -->
            <div class="col-lg-12 col-xs-6"> 
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Crops</h3>                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <td>Crop Code</td>
                        <td>Crop Name</td>
                        <td>Description</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>                       
                        <?php
                      if ($lstcrops == 0) {
                      ?>
                        <tr> 
                          <td>Crop Code</td>
                        <td>Crop Name</td>
                        <td>Description</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstcrops as $value)
                                {  
                               ?>    
                         <tr> 
                             <td><?php echo $value['code'] ?></td>
                            <td><?php echo $value['cropname'] ?></td>            
                            <td><?php echo $value['cropdescription'] ?></td>
                            <td>
<!--                                <a rel="tooltip" title="View more seed details" class="btn btn-info openModalLink" href="/" data-id="<?php echo $value['seedID'] ?>" data-status="ACCEPTED">
                                    <i class="fa fa-expand"></i>
                                </a>-->
                               <a rel="tooltip" title="Edit/Update crop details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php echo $value['cropID'] ?>" data-viewcode="<?php echo $value['code'] ?>"
                                  data-viewname="<?php echo $value['cropname'] ?>" data-viewdesc="<?php echo $value['cropdescription'] ?>"
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>                                       
                    </tbody>
                  </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addcropModal">Add Crop</button>
<!--                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- ./col Crop -->
            
            <!-- Seeds -->
            <div class="col-lg-12 col-xs-6"> 
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Seeds</h3>                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Seed Name</td>
                        <td>Description</td>
                        <td>Code</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>                       
                        <?php
                      if ($lstSeeds == 0) {
                      ?>
                        <tr> 
                          <td>Seed Name</td>
                        <td>Description</td>
                        <td>Code</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstSeeds as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['seedname'] ?></td>            
                            <td><?php echo $value['seeddescription'] ?></td>
                            <td><?php echo $value['code'] ?></td>
                            <td>                              
                               <a rel="tooltip" title="Edit/Update seed details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php echo $value['seedID'] ?>" 
                                  data-viewname="<?php echo $value['seedname'] ?>" data-viewdesc="<?php echo $value['seeddescription'] ?>"
                                  data-viewcode="<?php echo $value['code'] ?>" 
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>                                       
                    </tbody>
                  </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addseedModal">Add Seed</button>
<!--                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- ./col Seeds -->
            
            <!-- Trees -->
            <div class="col-lg-12 col-xs-6"> 
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Trees</h3>                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Name</td>
                        <td>Code</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>                       
                        <?php
                      if ($listTrees == 0) {
                      ?>
                        <tr> 
                          <td>Name</td>
                        <td>Code</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($listTrees as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['treeName'] ?></td>            
                            <td><?php echo $value['treescode'] ?></td>
                            <td>                              
                               <a rel="tooltip" title="Edit/Update Tree Type details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php echo $value['treesid'] ?>" 
                                  data-viewname="<?php echo $value['treeName'] ?>"
                                  data-viewcode="<?php echo $value['treescode'] ?>" 
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>                                       
                    </tbody>
                  </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addtreeModal">Add Tree Type</button>
<!--                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div>
            <!-- ./col Trees -->
            
            <!-- IPC -->
            <div class="col-lg-12 col-xs-6"> 
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">IPC</h3>                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Name</td>
                        <td>Code</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>                       
                        <?php
                      if ($lstIPCs == 0) {
                      ?>
                        <tr> 
                          <td>Name</td>
                        <td>Code</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstIPCs as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['IPC_name'] ?></td>            
                            <td><?php echo $value['IPC_code'] ?></td>
                            <td>                              
                               <a rel="tooltip" title="Edit/Update seed details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php echo $value['IPCid'] ?>" 
                                  data-viewname="<?php echo $value['IPC_name'] ?>"
                                  data-viewcode="<?php echo $value['IPC_code'] ?>" 
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>                                       
                    </tbody>
                  </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addIPCModal">Add IPC</button>
<!--                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- ./col IPC -->
            
            <!-- Association -->
            <div class="col-lg-12 col-xs-6"> 
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Association</h3>                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Association Name</td>
                        <td>Code</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>                       
                        <?php
                      if ($lstSeeds == 0) {
                      ?>
                        <tr> 
                          <td>Association Name</td>
                        <td>Code</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstSeeds as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['seedname'] ?></td>            
                            <td><?php echo $value['code'] ?></td>
                            <td>                              
                               <a rel="tooltip" title="Edit/Update seed details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php echo $value['seedID'] ?>" 
                                  data-viewname="<?php echo $value['seedname'] ?>"
                                  data-viewcode="<?php echo $value['code'] ?>" 
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>                                       
                    </tbody>
                  </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addAssociationModal">Add Association</button>
<!--                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- ./col Association -->
            
            <!-- GAC -->
            <div class="col-lg-12 col-xs-6"> 
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">GAC</h3>                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Seed Name</td>
                        <td>Description</td>
                        <td>Code</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>                       
                        <?php
                      if ($lstSeeds == 0) {
                      ?>
                        <tr> 
                          <td>Seed Name</td>
                        <td>Description</td>
                        <td>Code</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstSeeds as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['seedname'] ?></td>            
                            <td><?php echo $value['seeddescription'] ?></td>
                            <td><?php echo $value['code'] ?></td>
                            <td>                              
                               <a rel="tooltip" title="Edit/Update seed details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php echo $value['seedID'] ?>" 
                                  data-viewname="<?php echo $value['seedname'] ?>" data-viewdesc="<?php echo $value['seeddescription'] ?>"
                                  data-viewcode="<?php echo $value['code'] ?>" 
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>                                       
                    </tbody>
                  </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addseedModal">Add Seed</button>
<!--                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- ./col GAC -->
            
            <!-- Clubs -->
            <div class="col-lg-12 col-xs-6"> 
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Clubs</h3>                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Seed Name</td>
                        <td>Description</td>
                        <td>Code</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>                       
                        <?php
                      if ($lstSeeds == 0) {
                      ?>
                        <tr> 
                          <td>Seed Name</td>
                        <td>Description</td>
                        <td>Code</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstSeeds as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['seedname'] ?></td>            
                            <td><?php echo $value['seeddescription'] ?></td>
                            <td><?php echo $value['code'] ?></td>
                            <td>                              
                               <a rel="tooltip" title="Edit/Update seed details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php echo $value['seedID'] ?>" 
                                  data-viewname="<?php echo $value['seedname'] ?>" data-viewdesc="<?php echo $value['seeddescription'] ?>"
                                  data-viewcode="<?php echo $value['code'] ?>" 
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>                                       
                    </tbody>
                  </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addseedModal">Add Seed</button>
<!--                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- ./col Clubs -->
            
              </div><!-- End right column -->
            
            
          </div><!-- /.row -->
          
          
        
          
          
           
            
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

      <!-- Control Sidebar -->
      <?php // include('sidebar.php') ;?>
    </div><!-- ./wrapper -->
    
    <!-- MODAL -->
    
    <!-- ADD SEED MODALS -->
    <div id="addmembernumbersModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>add member numbers</h3><br>
                </div>
                <div class="modal-body">                                                           
                    <form role="form" id="addmembernumbersform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="addmembernumbers" name="addmembernumbers" >
                        <div class="form-group">
                            <label for="category">Association:</label>                 
                                <select id="District" name="District" class="form-control">
                                    <option value="BTL">Blantyre</option>
                                    <option value="LLW">Lilongwe</option>
                                    <option value="ZBA">Zomba</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="numberOfMembers">Number Of Members:</label>
                            <input type="text" class="form-control" id="numberOfMembers" name="numberOfMembers" />
                        </div>                                                
                    </form>
                </div>                            
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="addmembernumbers()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- END ADD SEED MODALS -->
    
    <!-- ADD LIVE STOCK -->
    <div id="addLivestockModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add Livestock</h3><br>
                </div>
                <div class="modal-body">                                                           
                    <form role="form" id="addLivestockform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="addLivestock" name="addLivestock" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tbladdLivestock" cellspacing="0" width="100%">                   
                            <tr>
                                <th>Select</th>
                                <th>Name</th>
                                <th>Code</th>                                                   
                            </tr>
                        </table>
                                                                   
                    </form>
                </div>                            
                <div class="modal-footer">
                    <button type="button" class='btn btn-danger deleteaddLivestock'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreaddLivestock'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddLivestock()">Save Livestock</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    
    <!-- END ADD LIVESTOCK -->
    
    
    
    <!-- ADD TREE MODAL -->
    <div id="addtreeModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add Tree</h3><br>
                </div>
                <div class="modal-body">                                                           
                    <form role="form" id="addTreeform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="addTree" name="addTree" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tbladdtree" cellspacing="0" width="100%">                   
                            <tr>
                                <th>Select</th>
                                <th>Name</th>
                                <th>Code</th>                                                   
                            </tr>
                        </table>
                                                                   
                    </form>
                </div>                            
                <div class="modal-footer">
                    <button type="button" class='btn btn-danger deleteaddtree'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreaddtree'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddTree()">Save Tree</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- END ADD TREE MODAL -->
    
    <!-- ADD IPC MODALS -->
    <div id="addIPCModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add IPC</h3><br>
                </div>
                <div class="modal-body">                                                           
                    <form role="form" id="addIPCform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="addIPC" name="addIPC" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tblipc" cellspacing="0" width="100%">                   
                            <tr>
                                <th>Select</th>
                                <th>Name</th>
                                <th>Code</th>                                                   
                            </tr>
                        </table>
                                                                   
                    </form>
                </div>                            
                <div class="modal-footer">
                    <button type="button" class='btn btn-danger deleteipc'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreipc'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddIPC()">Save IPC</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- END ADD IPC MODALS -->
    
    <!-- ADD Association Modal -->
    <div id="addAssociationModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add IPC</h3><br>
                </div>
                <div class="modal-body">                                                           
                    <form role="form" id="addAssociationform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="Association" name="Association" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tbladdass" cellspacing="0" width="100%">                   
                            <tr>
                                <th>Select</th>
                                <th>Name</th>
                                <th>Code</th>                                                   
                            </tr>
                        </table>
                                                                   
                    </form>
                </div>                            
                <div class="modal-footer">
                    <button type="button" class='btn btn-danger deleteass'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreass'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddAss()">Save Association</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- END ADD Association Modal -->
    
    <!-- ADD District -->
    <div id="adddistrictModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add District</h3><br>
                </div>
                <div class="modal-body">                                                           
                    <form role="form" id="addDistrictform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="addDistrict" name="addDistrict" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tbladdDistrict" cellspacing="0" width="100%">                   
                            <tr>
                                <th>Select</th>
                                <th>Name</th>
                                <th>Prefix</th>
                                <th>Code</th>                                                   
                            </tr>
                        </table>
                                                                   
                    </form>
                </div>                            
                <div class="modal-footer">
                    <button type="button" class='btn btn-danger deleteDistrict'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreDistrict'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddDistrict()">Save District</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    
    <!-- END ADD District -->
    
    
    <!-- END MODAL -->
    
    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/app.min.js"></script>
    
    <!-- material -->
    <script src="../../../material/assets/js/material-kit.js" type="text/javascript"></script>
    <script src="../../../material/assets/js/material.min.js" type="text/javascript"></script>
    
    <!-- DataTables -->
<!--    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>-->
    
<script src="../../../js/jquery-ui.js"></script>
<!-- DataTables -->
<script src="../../../datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../../../datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="../../../datatables/jszip.min.js" type="text/javascript"></script>
<script src="../../../datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="../../../datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="../../../datatables/buttons.html5.min.js" type="text/javascript"></script>
    <script>
        
        function _(x) {
            return document.getElementById(x);
        }
        
        $(function() {
            //$( "#dateitem" ).datepicker( { dateFormat: 'dd/mm/yy' }); 
            //revenue dates
            $( "#regyear1" ).datepicker( { dateFormat: 'y-m-d' });
            
            $("#regyear2").datepicker( {
                format: " yyyy",
                viewMode: "years", 
                minViewMode: "years"
            });
            
            $('#regyear').datepicker( {
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
        
            
            $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [{
                        text: 'My button',
                        action: function ( e, dt, node, config ) {
                             $("#addSchoolModal").modal("show"); 
                        }
                    },
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
            
            $('#example2').DataTable( {
                dom: 'Bfrtip',
                buttons: [{
                        text: 'My button',
                        action: function ( e, dt, node, config ) {
                             $("#addSchoolModal").modal("show"); 
                        }
                    },
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
            
           // $("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');
            
        } );
        
        //remove district add item
        $(".deleteDistrict").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add district item
        $(".addmoreDistrict").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='districts[]' /></td>";
        data += "<td><input type='text' class='form-control' name='Dname[]' /></td>";
        data += "<td><input type='text' class='form-control' name='Dprfx[]' /></td>";
        data += "<td><input type='text' class='form-control' name='Dcode[]' /></td></tr>";
            $('.tbladdDistrict').append(data);
        });
        
        //save district
        function AddDistrict(){
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to Add new District?'))
                {
                    _("addDistrict").value = "addDistrict";        
                    _("addDistrictform").method = "post";
                    _("addDistrictform").action = "hq.php";
                    _("addDistrictform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            }        
        }
        
        //remove ipc item
        $(".deleteipc").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add ipc item
        $(".addmoreipc").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='ipcs[]' /></td>";
        data += "<td><input type='text' class='form-control' name='ipcname[]' /></td>";
        data += "<td><input type='text' class='form-control' name='ipccode[]' /></td></tr>";
            $('.tblipc').append(data);
        });
        
        //save ipc
        function AddIPC(){
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to Add new IPC?'))
                {
                    //alert("Add IPC");
                    _("addIPC").value = "addIPC";        
                    _("addIPCform").method = "post";
                    _("addIPCform").action = "hq.php";
                    _("addIPCform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            }        
        }
        
        //remove tree item
        $(".deleteaddtree").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add tree item
        $(".addmoreaddtree").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='trees[]' /></td>";
        data += "<td><input type='text' class='form-control' name='treesname[]' /></td>";
        data += "<td><input type='text' class='form-control' name='treescode[]' /></td></tr>";
            $('.tbladdtree').append(data);
        });
        
        //save trees
        function AddTree(){
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to Add new Tree?'))
                {
                    //alert("Add IPC");
                    _("addTree").value = "addTree";        
                    _("addTreeform").method = "post";
                    _("addTreeform").action = "hq.php";
                    _("addTreeform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            }        
        }
        
        function addmembernumbers(){
            _("addmembernumbers").value = "addmembernumbers";        
            _("addmembernumbersform").method = "post";
            _("addmembernumbersform").action = "hq.php";
            _("addmembernumbersform").submit();
        }
    </script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>


</html>