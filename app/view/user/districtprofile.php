<?php  
session_start();
include_once ('../../controller/user/districtscontroller.php'); ?>
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
    
    
    <!-- material kit -->
    <link href="../../../material/assets/css/material-kit.css" rel="stylesheet" type="text/css"/>
    
    <!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
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
     <style type="text/css">

    #cropmode,#cropmode1{
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
            Members
            <small>Profile</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="members.php"><i class="fa fa-users"></i> Members</a></li>
            <li class="active">Profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
           <!-- Small boxes (Stat box) -->

          <!-- SCHOOLS -->
            <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
              <div class="box box-success">
                  
                <div class="box-body box-profile">
                  <!--<img class="profile-user-img img-responsive img-circle" src="<?php// echo $logo ?>" alt="Member Photo">-->
                  <h3 class="profile-username text-center"><?php// echo $personalinfo['fnames'].' '.$personalinfo['surname']; ?></h3>
                  <!--<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#picModal">update member photo</button>-->                          
                  <strong>General information</strong>                 
                  <p class="text-muted">
                      IPC: <?php // echo $Ginfo['ipc']; ?><br>
                      DISTRICT: <?php // echo $Ginfo['district']; ?><br>
                      T/A: <?php // echo $Ginfo['ta']; ?><br>
                      GAC: <?php // echo $Ginfo['gac']; ?><br>
                      TCC REG. #: <?php // echo $Ginfo['tccregno']; ?><br>
                    
                      GVH: <?php // echo $villageHeadMan; ?><br>
                      VILLAGE: <?php // echo $villageName; ?><br>
                      ASSOCIATION: <?php // echo $associationName; ?><br>
                      CLUB: <?php // echo $clubName; ?><br>
                  </p>                 
                 
           
                </div><!-- /.box-body -->
              </div>
                
<!--                 About Me Box 
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">General Information</h3>
                </div> /.box-header 
                <div class="box-body">
                  <strong><i class="fa fa-file-text-o margin-r-5"></i> Comments</strong>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div> /.box-body 
              </div> /.box -->
              

            </div><!-- /.col -->
            
            <div class="col-md-9">
             
                <div class="row">
                   <!-- Tabs with icons on Card -->
                <div class="card card-nav-tabs">
                        <div class="header header-success">
                                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                            <ul class="nav nav-tabs" data-tabs="tabs">
                                                <li class="active">
                                                    <a href="#crops" data-toggle="tab">
                                                        
                                                        Crops
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#livestock" data-toggle="tab">
                                                        
                                                        Livestock
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#seed" data-toggle="tab">
                                                        
                                                        Seed Distribution
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#marketing" data-toggle="tab">
                                                        
                                                        Crop Marketing
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#activities" data-toggle="tab">
                                                       
                                                        Activities
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#treeplanting" data-toggle="tab">
                                                       
                                                        Tree Planting
                                                    </a>
                                                </li>
                                            </ul>
                                    </div>
                                </div>
                        </div>
                        <div class="content">
                            <div class="tab-content text-center">
                                <div class="tab-pane active" id="crops">
                                    <p><strong>Crops</strong>
                                        <button rel="tooltip" title="Add crops" type="button" class="btn btn-success btn-simple btn-xs" data-toggle="modal" data-target="#addCropModal"><i class="fa fa-plus"></i></button> 
                                    </p>                                   
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                      <tr>
                                        <td>Crop Name</td>
                                        <td>Acreage</td>
                                        <td>Action</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                      if ($memberCropInfo == 0) {
                                      ?>
                                        <tr> 
                                        <td>Crop Name</td>
                                        <td>Acreage</td>
                                        <td>Action</td>
                                         </tr>
                                     <?php   }
                                        else 
                                        {
                                           foreach($memberCropInfo as $value)
                                                {  
                                               ?>    
                                         <tr> 
                                            <td><?php echo $value['cropname'] ?></td>            
                                            <td><?php echo $value['acres'] ?></td>
                                            <td>
                                               <a rel="tooltip" title="Edit/Update crop details" class="btn btn-info openModalLinkEditCropDetails btn-xs" href="/" 
                                                  data-id="<?php echo $value['mcID'] ?>" 
                                                  data-viewname="<?php // echo $value['seedname'] ?>" data-viewacreage="<?php echo $value['acres'] ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a rel="tooltip" title="Remove crop details" class="btn btn-danger openModalLinkDeleteCropDetails btn-xs" href="/" 
                                                  data-id="<?php echo $value['mcID'] ?>" 
                                                  data-viewname="<?php // echo $value['seedname'] ?>" data-viewdesc="<?php // echo $value['seeddescription'] ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                            </tr>
                                         <?php  }
                                        }
                                        ?>                                       
                                    </tbody>
                                  </table>
                                        
                                </div>
                                <div class="tab-pane" id="livestock">
                                     <p><strong>Livestock</strong>
                                        <button rel="tooltip" title="Add Livestock" type="button" class="btn btn-success btn-simple btn-xs" data-toggle="modal" data-target="#addLivestockModal"><i class="fa fa-plus"></i></button> 
                                    </p>  
                                     <table id="memberLivestock" class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                            <td>Livestock</td>
                                            <td>Quantity</td>
                                            <td>Action</td>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                          if ($memberLivestock == 0) {
                                          ?>
                                            <tr> 
                                           <td>Livestock</td>
                                            <td>Quantity</td>
                                            <td>Action</td>
                                             </tr>
                                         <?php   }
                                            else 
                                            {
                                               foreach($memberLivestock as $value)
                                                    {  
                                                   ?>    
                                             <tr> 
                                                <td><?php echo $value['livestockname'] ?></td>            
                                                <td><?php echo $value['qty'] ?></td>
                                                <td>
                                               <a rel="tooltip" title="Edit/Update Livestock details" class="btn btn-info openModalLinkEditLivestockDetails btn-xs" href="/" 
                                                  data-id="<?php echo $value['mlivestockID'] ?>" 
                                                  data-viewname="<?php // echo $value['seedname'] ?>" data-viewacreage="<?php echo $value['qty'] ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a rel="tooltip" title="Remove Livestock details" class="btn btn-danger openModalLinkDeleteLivestockDetails btn-xs" href="/" 
                                                  data-id="<?php echo $value['mlivestockID'] ?>" 
                                                  data-viewname="<?php // echo $value['seedname'] ?>" data-viewdesc="<?php // echo $value['seeddescription'] ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                                </tr>
                                             <?php  }
                                            }
                                            ?>                                       
                                        </tbody>
                                      </table>
                                </div>
                                <div class="tab-pane" id="seed">
                                    <p><strong>Seed Distribution</strong>
                                        <button rel="tooltip" title="Add Seed Distribution" type="button" class="btn btn-success btn-simple btn-xs" data-toggle="modal" data-target="#addSeedDistributionModal"><i class="fa fa-plus"></i></button> 
                                    </p>
                                     <table id="memberLivestock" class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                            <td>Seed Acquired</td>
                                            <td>Seed Acquired Amount</td>
                                            <td>Acquiring Action</td>
                                            <td>Repayment Type</td>
                                            <td>Repayment Amount</td>
                                            <td>Status</td>
                                            <td>Action</td>
                                          </tr>
                                        </thead>
                                        <tbody>
                                              <?php
                                        if ($lstMemberSeedsDistribution == 0) {
                                        ?>
                                          <tr> 
                                          <td>Seed Acquired</td>
                                          <td>Seed Acquired Amount</td>
                                          <td>Acquiring Action</td>
                                          <td>Repayment Type</td>
                                          <td>Repayment Amount</td>
                                          <td>Status</td>
                                            <td>Action</td>
                                          </tr> 
                                          <?php   }
                                          else 
                                          {
                                             foreach($lstMemberSeedsDistribution as $value)
                                                  { 

                                                  if($value['repaymentMode'] == 'SEED'){
                                                      $SDID = $value['SDID'];
                                                      //get seed amount
                                                      $getSeedCropAmount = $seeds->getSeedCropAmount($SDID);
                                                      $rapidKgs = $getSeedCropAmount[0][0];
                                                  }
                                                  if($value['repaymentMode'] == 'CROP'){
                                                    $SDID = $value['SDID'];
                                                      //get crop amount
                                                      $getSeedCropAmount = $seeds->getSeedCropAmount($SDID);
                                                      $rapidKgs = $getSeedCropAmount[0][1];
                                                  }
                                                  if($value['repaymentMode'] == ''){
                                                      $rapidKgs = '';
                                                  }


                                                 ?> 
                                          <tr>                                                               
                                                  <td><?php  echo $value['seedname'];?></td>
                                                  <td><?php  echo $value['acquiredseedkgs'];?></td>
                                                  <td>
                                                      <a rel="tooltip" title="Edit/Update Acquisition details" class="btn btn-info openModalLinkEditAcquisitionDetails btn-xs" href="/" 
                                                        data-id="<?php echo $value['SDID'] ?>" 
                                                        data-viewacquisitionamount="<?php echo $value['acquiredseedkgs'] ?>">
                                                          <i class="fa fa-edit"></i>
                                                        </a>
                                                      <!-- Show this is if status is unpaid -->
                                                      <?php if($value['status'] == 'UNPAID'){?>
                                                    <a rel="tooltip" title="Make payment" class="btn btn-success openModalLinkMakePayment btn-xs" href="/" 
                                                      data-id="<?php echo $value['SDID'] ?>" 
                                                      data-viewname="<?php echo $value['seedname'] ?>" data-viewacquisitionamount1="<?php echo $value['acquiredseedkgs'] ?>">
                                                        <i class="fa fa-money"></i>
                                                    </a>
                                                      <?php } ?>
                                                  </td>
                                                  <td><?php  echo $value['repaymentMode'];?></td>
                                                  <td><?php echo $rapidKgs; ?></td>
                                                  <td><?php  echo $value['status'];?></td>
                                              <td>
                                                  <?php if($value['status'] == 'PAID'){?>
                                                 <a rel="tooltip" title="Edit/Update payment details" class="btn btn-info openModalLinkeditpaymentDetails btn-xs" href="/" 
                                                        data-id="<?php echo $value['SDID'] ?>" data-viewname2="<?php echo $value['seedname'] ?>"
                                                        data-viewacquisitionamount1="<?php echo $value['acquiredseedkgs'] ?>" data-viewpaidamount="<?php echo $rapidKgs; ?>">
                                                          <i class="fa fa-edit"></i>
                                                        </a>
                                                  <?php } ?>
                                                <a rel="tooltip" title="Remove record" class="btn btn-danger openModalLinkDiscardPayment btn-xs" href="/" 
                                                  data-id="<?php echo $value['SDID'] ?>"  >
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                            </tr>
                                         <?php  }
                                        }
                                        ?>                                    
                                        </tbody>
                                      </table>
                                        
                                </div>
                                <div class="tab-pane" id="marketing">
                                    <p><strong>Crop Marketing</strong>
                                        <button rel="tooltip" title="Add Crop Marketing" type="button" class="btn btn-success btn-simple btn-xs" data-toggle="modal" data-target="#addCropMarketingModal"><i class="fa fa-plus"></i></button> 
                                    </p>
                                     <table id="memberActivities" class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                              <th>Crop</th>
                                            <th>Receipt</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                          if ($lstcropsMarketing == 0) {
                                          ?>
                                            <tr>
                                                <th>Crop</th>
                                           <th>Receipt</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                            <th>Action</th>
                                             </tr>
                                         <?php   }
                                            else 
                                            {
                                               foreach($lstcropsMarketing as $value)
                                                    {  
                                                   ?>    
                                             <tr> 
                                                 <td><?php echo $value['crop'] ?></td>
                                                <td><?php echo $value['receipt'] ?></td>            
                                                <td><?php echo $value['price'] ?></td>
                                                <td><?php echo $value['totalprice'] ?></td>
                                                <td>
                                                   <a rel="tooltip" title="Edit/Update crop details" class="btn btn-info openModalLinkEditCMDetails btn-xs" href="/" 
                                                  data-id="<?php echo $value['CPID'] ?>" data-viewreceipt="<?php echo $value['receipt'] ?>"
                                                  data-viewprice="<?php echo $value['price'] ?>" data-viewtotalprice="<?php echo $value['totalprice'] ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a rel="tooltip" title="Remove crop details" class="btn btn-danger openModalLinkDeleteCMDetails btn-xs" href="/" 
                                                  data-id="<?php echo $value['CPID'] ?>" 
                                                  data-viewdesc="<?php // echo $value['seeddescription'] ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                </td>
                                                </tr>
                                             <?php  }
                                            }
                                            ?> 
                                        </tbody>
                                      </table>
                                     
                                </div>
                                <div class="tab-pane" id="activities">
                                     <p><strong>Activities</strong>
                                        <button rel="tooltip" title="Add Activities" type="button" class="btn btn-success btn-simple btn-xs" data-toggle="modal" data-target="#addActivitiesModal"><i class="fa fa-plus"></i></button> 
                                    </p>
                                     <table id="memberActivities" class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                            <th>Activity</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                          if ($memberActivities == 0) {
                                          ?>
                                            <tr> 
                                           <th>Activity</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                             </tr>
                                         <?php   }
                                            else 
                                            {
                                               foreach($memberActivities as $value)
                                                    {  
                                                   ?>    
                                             <tr> 
                                                <td><?php echo $value['activitiesname'] ?></td>            
                                                <td><?php echo $value['activitytypename'] ?></td>
                                                <td>
                                                   <a rel="tooltip" title="Remove Activity" class="btn btn-danger openModalLinkDeleteActivityDetails btn-xs" href="/" 
                                                  data-id="<?php echo $value['memberactivitiesID'] ?>" 
                                                  data-viewdesc="<?php // echo $value['seeddescription'] ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                </td>
                                                </tr>
                                             <?php  }
                                            }
                                            ?>                                       
                                        </tbody>
                                      </table>
                                </div>
                                <div class="tab-pane" id="treeplanting">
                                    <p><strong>Tree Planting</strong><button type="button" rel="tooltip" data-toggle="modal" data-target="#openModalLinkAddTreePlanting" class="btn btn-info btn-simple btn-xs"> <i class="fa fa-plus"></i></button>
                                     </a></p>
                                    <table id="memberActivities" class="table table-bordered table-striped">
                                        <thead>
                                          <tr>
                                            <th>Tree</th>
                                            <th>Number Of Trees</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                          if ($listMemberTreePlantingItems == 0) {
                                          ?>
                                            <tr> 
                                           <th>Tree</th>
                                            <th>Number Of Trees</th>
                                            <th>Action</th>
                                             </tr>
                                         <?php   }
                                            else 
                                            {
                                               foreach($listMemberTreePlantingItems as $value)
                                                    {  
                                                   ?>    
                                             <tr> 
                                                <td><?php echo $value['treename'] ?></td>            
                                                <td><?php echo $value['notrees'] ?></td>
                                                <td>
                                                   <a rel="tooltip" title="Edit/Update Tree Planting details" class="btn btn-info openModalLinkEditTPDetails btn-xs" href="/" 
                                                  data-id="<?php echo $value['tid'] ?>" data-viewnotrees="<?php echo $value['notrees'] ?>"
                                                  data-viewtotalprice="<?php// echo $value['totalprice'] ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a rel="tooltip" title="Remove Tree Planting details" class="btn btn-danger openModalLinkDeleteTPDetails btn-xs" href="/" 
                                                  data-id="<?php echo $value['tid'] ?>" 
                                                  data-viewdesc="<?php // echo $value['seeddescription'] ?>">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                </td>
                                                </tr>
                                             <?php  }
                                            }
                                            ?>                                       
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- End Tabs with icons on Card --> 
                </div>
                <!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
            </div><!-- /.row --><!-- END SCHOOLS /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

    
    </div><!-- ./wrapper -->
   
    <!-- MODALS -->
    <!-- CROPS ---------------------------------------------------------------------------------------------->
    <!--  Add Crops  -->
    <div id="addCropModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add Crops</h3>                    
                </div>
                <div class="modal-body">                                        
                   <form role="form" id="AddCropmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="AddCropID" name="AddCropID" value="<?php echo $memberProfID ?>" >
                        <input type="hidden" id="AddCropmember" name="AddCropmember" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tblAddCrop" cellspacing="0" width="100%"> 
                            <tr>
                                <th>Select</th>
                                <th>Crop</th>
                                <th>Acreage</th>  
                            </tr>
                        </table> 
                    </form>                                  
                </div>                            
                <div class="modal-footer">                   
                    <button type="button" class='btn btn-danger deleteAddCrop'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreAddCrop'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddCropMember()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!--  End Add Crops  -->
    
    <!-- EDIT CROP Details -->    
    <div class="modal fade" id="editcropdetails" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editcropdetailsTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="UpdateCropmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="UpdateCropmember" name="UpdateCropmember" >
                        <input type="hidden" id="cropeditID" name="cropeditID" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">                        
                        <div class="form-group">
                            <label for="acreageedit">Acreage:</label>
                            <input type="text" class="form-control" id="acreageedit" name="acreageedit" placeholder="" />
                        </div> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="updateCrop()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END Edit Crop Details -->
    
    <!-- DELETE CROP -->
    <div class="modal fade" id="deletecropdetails" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deletecropdetailsTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="deleteCropmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="deleteCropmember" name="deleteCropmember" >
                        <input type="hidden" id="cropdeleteID" name="cropdeleteID" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">                        
                        <div class="form-group">
                            <p>
                                Are you sure you want to delete this crop from member?
                            </p>
                        </div> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="deleteCrop()">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END DELETE CROP --><!-- END CROPS ----------------------------------------------------------->
    
    <!-- LIVESTOCK ------------------------------------------------------------------------------------------->
    <!--  Add LIVESTOCK  -->
    <div id="addLivestockModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add Livestock</h3>                    
                </div>
                <div class="modal-body">                                        
                   <form role="form" id="AddLivestockmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="AddLivestockID" name="AddLivestockID" value="<?php echo $memberProfID ?>" >
                        <input type="hidden" id="AddLivestockmember" name="AddLivestockmember" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tblAddLivestock" cellspacing="0" width="100%"> 
                            <tr>
                                <th>Select</th>
                                <th>Livestock</th>
                                <th>Quantity</th>  
                            </tr>
                        </table> 
                    </form>                                  
                </div>                            
                <div class="modal-footer">                   
                    <button type="button" class='btn btn-danger deleteAddLivestock'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreAddLivestock'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddLivestockMember()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!--  End Add LIVESTOCK  -->
    
    <!-- EDIT LIVESTOCK Details -->    
    <div class="modal fade" id="editlivestockdetails" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlivestockdetailsTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="UpdateLivestockmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="UpdateLivestockmember" name="UpdateLivestockmember" >
                        <input type="hidden" id="livestockeditID" name="livestockeditID" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">                        
                        <div class="form-group">
                            <label for="Quantityedit">Quantity:</label>
                            <input type="text" class="form-control" id="Quantityedit" name="Quantityedit" placeholder="" />
                        </div> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="updateLivestock()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END Edit LIVESTOCK Details -->
    
    <!-- DELETE LIVESTOCK -->
    <div class="modal fade" id="deletelivestockdetails" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deletelivestockdetailsTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="deleteLivestockmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="deleteLivestockmember" name="deleteLivestockmember" >
                        <input type="hidden" id="livestockdeleteID" name="livestockdeleteID" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">                        
                        <div class="form-group">
                            <p>
                                Are you sure you want to delete Livestock from member?
                            </p>
                        </div> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="deleteLivestock()">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END DELETE LIVESTOCK --><!-- LIVESTOCK --------------------------------------------------------------->
    
    <!-- SEED DISTRIBUTION ------------------------------------------------------------------------------------->
    <!--  Add SEED DISTRIBUTION  -->
    <div id="addSeedDistributionModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add Seed Distribution</h3>                    
                </div>
                <div class="modal-body">                                        
                   <form role="form" id="AddSeedDistributionmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="AddSeedDistributionID" name="AddSeedDistributionID" value="<?php echo $memberProfID ?>" >
                        <input type="hidden" id="AddSeedDistributionmember" name="AddSeedDistributionmember" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tblAddSeedDistribution" cellspacing="0" width="100%"> 
                            <tr>
                                <th>Select</th>
                                <th>Seed</th>
                                <th>Quantity (Kgs)</th>  
                            </tr>
                        </table> 
                    </form>                                  
                </div>                            
                <div class="modal-footer">                   
                    <button type="button" class='btn btn-danger deleteSeedDistribution'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreSeedDistribution'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddSeedDistribution()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!--  End Add SEED DISTRIBUTION  -->
    
    <!-- EDIT SEED DISTRIBUTION Acquisition Details -->    
    <div class="modal fade" id="editacquisitiondetails" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editacquisitiondetailsTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="Updateacquisitionmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="Updateacquisitionmember" name="Updateacquisitionmember" >
                        <input type="hidden" id="acquisitioneditID" name="acquisitioneditID" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">                        
                        <div class="form-group">
                            <label for="acquisitionamountedit">Quantity (Kgs)</label>
                            <input type="text" class="form-control" id="acquisitionamountedit" name="acquisitionamountedit" placeholder="" />
                        </div> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="updateacquisition()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END EDIT SEED DISTRIBUTION Acquisition Details -->
    
    <!-- SEED DISTRO MAKE PAYMENT -->
     <div class="modal fade" id="seedrepaymentmodal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="makepaymentTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="repaymentmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="repaymentmember" name="repaymentmember" >
                        <input type="hidden" id="repaymentID" name="repaymentID" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">
                        <div class="form-group">
                            <label for="acquisitionamountedit">Seed</label>
                            <span id="seedrepayment"></span>
                        </div> 
                        <div class="form-group">
                            <label for="acquisitionamountedit">Acquired Quantity (Kgs)</label>
                            <span id="acquisitionamountedit1"></span>
                        </div>
                        <div class="form-group">
                            <label for="repaymode">Repayment Mode:</label>
                            <select id="selectMe" class="form-control" id="repaymode" name="repaymode" onchange="ShowHideDiv()"> 
                                <option value="seedmode">Seed</option>
                                <option value="cropmode">Crop</option>
                            </select>
                        </div>
                        <div>
                            <div id="seedmode" class="group">
                                <label>Select Seed:</label>
                                <select class="form-control" name="seedpay">
                                <?php foreach ($lstSeeds as $optionSeedList) { ;?>
                                    <option value="<?php echo $optionSeedList['seedID']; ?>"><?php echo $optionSeedList['seedname']; ?></option>
                                <?php  } ;?></select>                                                                             
                            </div>
                            <div id="cropmode" class="group">
                                <label>Select Crop:</label>
                                <select class="form-control" name="croppay">
                                <?php foreach ($lstcrops as $optionSeedList) { ;?>
                                    <option value="<?php echo $optionSeedList['cropID']; ?>"><?php echo $optionSeedList['cropname']; ?></option>
                                <?php  } ;?></select>                                                                        
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="repaymentquantity">Quantity (Kgs)</label>
                            <input type="text" class="form-control" id="repaymentquantity" name="repaymentquantity" placeholder="" />
                        </div> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="repaydistro()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END SEED DISTRO MAKE PAYMENT -->
    
    <!-- EDIT SEED DISTRO REPAYMENT -->
    <div class="modal fade" id="seedrepaymenteditmodal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="makepaymenteditTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="seedrepaymenteditform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="repaymenteditmember" name="repaymenteditmember" >
                        <input type="hidden" id="repaymentID2" name="repaymentID2" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">
                        <div class="form-group">
                            <label for="acquisitionamountedit">Seed</label>
                            <span id="viewname2"></span>
                        </div> 
                        <div class="form-group">
                            <label for="acquisitionamountedit">Acquired Quantity (Kgs)</label>
                            <span id="viewacquisitionamount1"></span>
                        </div>
                        <div class="form-group">
                            <label for="repaymode">Repayment Mode:</label>
                            <select class="form-control" id="repaymode1" name="repaymode1" onchange="ShowHideDiv1()"> 
                                <option value="seedmode1">Seed</option>
                                <option value="cropmode1">Crop</option>
                            </select>
                        </div>
                        <div>
                            <div id="seedmode1" class="group1">
                                <label>Select Seed:</label>
                                <select class="form-control" name="seedpay1">
                                <?php foreach ($lstSeeds as $optionSeedList) { ;?>
                                    <option value="<?php echo $optionSeedList['seedID']; ?>"><?php echo $optionSeedList['seedname']; ?></option>
                                <?php  } ;?></select>                                                                             
                            </div>
                            <div id="cropmode1" class="group1">
                                <label>Select Crop:</label>
                                <select class="form-control" name="croppay1">
                                <?php foreach ($lstcrops as $optionSeedList) { ;?>
                                    <option value="<?php echo $optionSeedList['cropID']; ?>"><?php echo $optionSeedList['cropname']; ?></option>
                                <?php  } ;?></select>                                                                        
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="viewpaidamount">Quantity (Kgs)</label>
                            <input type="text" class="form-control" id="viewpaidamount" name="viewpaidamount" placeholder="" />
                        </div> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="repaydistroedit()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END EDIT SEED DISTRO REPAYMENT -->
    
    <!-- DELETE SEED DISTRIBUTION -->
    <div class="modal fade" id="discarddistromodal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="discarddistroTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="discarddistromemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="discarddistromember" name="discarddistromember" >
                        <input type="hidden" id="discarddistroID" name="discarddistroID" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">                        
                        <div class="form-group">
                            <p>
                                Are you sure you want to discard this record?
                            </p>
                        </div> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="discarddistro()">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END DELETE SEED DISTRIBUTION --><!-- SEED DISTRIBUTION ------------------------------------------------------------->
    
    <!-- CROP MARKETING ----------------------------------------------------------------------------------------------------->
    <!--  Add CROP MARKETING  -->
    <div id="addCropMarketingModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add Crop Marketing</h3>                    
                </div>
                <div class="modal-body">                                        
                   <form role="form" id="AddCropMarketingmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="AddCropMarketingmemberID" name="AddCropMarketingmemberID" value="<?php echo $memberProfID ?>" >
                        <input type="hidden" id="AddCropMarketingmemberregyear" name="AddCropMarketingmemberregyear" value="<?php echo $memberregyear ?>" >
                        <input type="hidden" id="AddCropMarketingmember" name="AddCropMarketingmember" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tblAddCM" cellspacing="0" width="100%"> 
                            <tr>
                                <th>Select</th>
                                <th>Crop</th>
                                <th>Receipt</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </table> 
                    </form>                                  
                </div>                            
                <div class="modal-footer">                   
                    <button type="button" class='btn btn-danger deleteAddCM'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreAddCM'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddCropMarketingMember()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!--  End Add CROP MARKETING  -->
    
    <!-- EDIT CROP MARKETING Details -->    
    <div class="modal fade" id="editcmcrop" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editcmdetailsTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="Updatecmmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="Updatecmmember" name="Updatecmmember" >
                        <input type="hidden" id="cmeditID" name="cmeditID" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">

                        <div class="form-group">
                            <label>Select Crop:</label>
                            <select class="form-control" name="editcmcrop">
                            <?php foreach ($lstcrops as $optionSeedList) { ;?>
                                <option value="<?php echo $optionSeedList['cropID']; ?>"><?php echo $optionSeedList['cropname']; ?></option>
                            <?php  } ;?></select>  
                        </div>
                        <div class="form-group">
                            <label for="Quantityedit">Receipt:</label>
                            <input type="text" class="form-control" id="viewreceipt" name="viewreceipt" placeholder="" />
                        </div>
                        <div class="form-group">
                            <label for="Quantityedit">Price:</label>
                            <input type="text" class="form-control" id="viewprice" name="viewprice" placeholder="" />
                        </div>
                        <div class="form-group">
                            <label for="Quantityedit">Total Price:</label>
                            <input type="text" class="form-control" id="viewtotalprice" name="viewtotalprice" placeholder="" />
                        </div>
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="updateCM()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END Edit CROP MARKETING Details -->
    
    <!-- DELETE CROP MARKETING -->
    <div class="modal fade" id="deletecmdetails" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deletecmdetailsTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="deletecmmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="deletecmmember" name="deletecmmember" >
                        <input type="hidden" id="cmdeleteID" name="cmdeleteID" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">                        
                        <div class="form-group">
                            <p>
                                Are you sure you want to delete Crop Marketing from member?
                            </p>
                        </div> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="deleteCM()">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END DELETE CROP MARKETING --><!-- CROP MARKETING ------------------------------------------------------>
    
    <!-- ACTIVITIES ----------------------------------------------------------------------------------------------------->
    <!--  Add ACTIVITIES  -->
    <div id="addActivitiesModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add Activities</h3>                    
                </div>
                <div class="modal-body">                                        
                   <form role="form" id="AddActivitiesmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="AddActivitiesmemberID" name="AddActivitiesmemberID" value="<?php echo $memberProfID ?>" >
                        <input type="hidden" id="AddActivitiesmember" name="AddActivitiesmember" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tblAddActivities" cellspacing="0" width="100%"> 
                            <tr>
                                <th>Select</th>
                                <th>Activity</th>
                            </tr>
                        </table> 
                    </form>                                  
                </div>                            
                <div class="modal-footer">                   
                    <button type="button" class='btn btn-danger deleteAddActivities'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreAddActivities'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddActivitiesMember()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!--  End Add ACTIVITIES  -->
    
    <!-- DELETE ACTIVITIES -->
    <div class="modal fade" id="deleteactivitydetails" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteActivitydetailsTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="deleteActivitymemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="deleteActivitymember" name="deleteActivitymember" >
                        <input type="hidden" id="ActivitydeleteID" name="ActivitydeleteID" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">                        
                        <div class="form-group">
                            <p>
                                Are you sure you want to delete Activity from member?
                            </p>
                        </div> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="deleteActivity()">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END DELETE ACTIVITIES --><!-- ACTIVITIES ------------------------------------------------------>

    
    <!-- TREE PLANTING  ----------------------------------------------------------------------------------------------------->
    <!-- ADD TREE PLANTING -->  
    <div class="modal fade" id="openModalLinkAddTreePlanting" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="AddTreePlanting">Tree Planting Activity</h4>
              </div>
              <div class="modal-body">                  
                    <form role="form" id="AddTreePlantingform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="AddTreememberID" name="AddTreememberID" value="<?php echo $memberProfID ?>" >
                        <input type="hidden" id="ActivityID" name="ActivityID" value="23" >
                        <input type="hidden" id="AddTreePlanting" name="AddTreePlanting" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tblTreePlanting" cellspacing="0" width="100%"> 
                            <tr>
                                <th>Select</th>
                                <th>Type Of Tree</th>
                                <th>Number Of Trees</th>  
                            </tr>
                        </table> 
                    </form>
              </div>
              <div class="modal-footer">
                    <button type="button" class='btn btn-danger deleteTreePlanting'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreTreePlanting'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddTreePlanting()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END ADD TREE PLANTING -->
    
    <!-- EDIT TREE PLANTING Details -->    
    <div class="modal fade" id="edittpcrop" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="edittpdetailsTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="Updatetpmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="Updatetpmember" name="Updatetpmember" >
                        <input type="hidden" id="tpeditID" name="tpeditID" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">

                        <div class="form-group">
                            <label>Select Crop:</label>
                            <select class="form-control" name="edittreetype">
                                <?php foreach ($listTrees as $optionList) { ;?>
                                <option value="<?php echo $optionList['treesid']; ?>"><?php echo $optionList['treeName']; ?></option>
                                <?php  } ;?>
                            </select>  
                        </div>
                        <div class="form-group">
                            <label for="viewnotrees">No of Trees:</label>
                            <input type="text" class="form-control" id="viewnotrees" name="viewnotrees" placeholder="" />
                        </div>                        
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="updateTP()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END Edit TREE PLANTING Details -->
    
    <!-- DELETE TREE PLANTING -->
    <div class="modal fade" id="deletetmdetails" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deletetmdetailsTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="deletetpmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="deletetpmember" name="deletetpmember" >
                        <input type="hidden" id="tmdeleteID" name="tmdeleteID" >
                        <input type="hidden" id="memberID" name="memberID" value="<?php echo $memberProfID ?>">                        
                        <div class="form-group">
                            <p>
                                Are you sure you want to delete Tree Planting Detail from member?
                            </p>
                        </div> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="deleteTP()">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END DELETE TREE PLANTING --><!-- TREE PLANTING ------------------------------------------------------>
    
    
    <!--  View Seed Details  -->
    <div class="modal fade" id="MemberDetails" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalTitle"></h4>
              </div>
              <div class="modal-body">                  
                    <form role="form" id="updateSeedform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="updateSeed" name="updateSeed" >
                        <input type="hidden" id="seedID" name="seedID" >
                        <div class="form-group">
                            <label for="seednam1">Seed:</label>
                            <input type="text" class="form-control" id="seednam1" name="seednam1" placeholder="Please enter the name of the seed" />
                        </div>
                        <div class="form-group">
                            <label for="seeddesc1">seed Description:</label>
                            <textarea class="form-control" id="seeddesc1" name="seeddesc1"></textarea>
                        </div> 
                    </form>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-success" id="viewbtn" onclick="showView()">Cancel</button>
                    <button class="btn btn-success" id="savebtn" onclick="updateSeed()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!--  End View Seed Details  -->

    <!--  Add member Livestock  -->
    <div class="modal fade" id="AddLivestock" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="AddLivestockTitle"></h4>
              </div>
              <div class="modal-body">                  
                    <form role="form" id="AddLivestockmemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="AddLivestockmember" name="AddLivestockmember" >
                        <input type="hidden" id="AddLivestockmemberID" name="AddLivestockmemberID" >
                        <div class="form-group">
                            <label for="livestock">Livestock:</label>
                            <select class="form-control" id="livestock" name="livestock">
                                <?php foreach ($lstLivestock as $optionList) { ;?>
                                <option value="<?php echo $optionList['livestockID']; ?>"><?php echo $optionList['livestockname']; ?></option>
                            <?php  } ;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="LivestockQuantity">Quantity:</label>
                            <input type="text" class="form-control" id="LivestockQuantity" name="LivestockQuantity" placeholder="Please enter the Livestock Quantity" />
                        </div>
                    </form>
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savelivestockMember" onclick="AddLivestockMember()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!--  End Add member Livestock  -->
    
    <!--  Add member Activity  -->
    <div class="modal fade" id="AddActivity" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="AddActivityTitle"></h4>
              </div>
              <div class="modal-body">                  
                    <form role="form" id="AddActivitymemberform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="AddActivitymember" name="AddActivitymember" >
                        <input type="hidden" id="AddActivitymemberID" name="AddActivitymemberID" >
                        <div class="form-group">
                            <label for="Activity1">Activity:</label>
                            <select class="form-control" id="Activity1" name="Activity1">
                                <?php foreach ($lstActivities as $optionList) { ;?>
                                <option value="<?php echo $optionList['Aid']; ?>"><?php echo $optionList['actName']; ?></option>
                            <?php  } ;?>
                            </select>
                        </div>
                    </form>
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="saveactivityMember" onclick="AddActivityMember()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!--  End Add member Activity  -->
    
    <!-- Edit personal details -->
    
    <div class="modal fade" id="UpdateMemberDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="UpdateMemberDetailsModalTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="seedgroup">
                    <form role="form" id="updatePersonalInfoform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="updatePersonalInfo" name="updatePersonalInfo" >
                        <input type="hidden" id="memberID" name="memberID" >
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="viewfname">Names:</label>
                                    <input type="text" class="form-control" id="viewfname" name="viewfname" placeholder="Please enter the name of the seed" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="viewlname">Last Name:</label>
                                    <input type="text" class="form-control" id="viewlname" name="viewlname" placeholder="Please enter the name of the seed" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="editgender">Seed:</label>
                                    <select class="form-control" id="editgender" name="editgender">
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="viewdob">Date of birth:</label>
                                    <input type="text" class="form-control" id="viewdob" name="viewdob" placeholder="Please enter the name of the seed" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="viewhh">House Hold:</label>
                                    <input type="text" class="form-control" id="viewhh" name="viewhh" placeholder="Please enter the name of the seed" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="viewgvh">GVH:</label>
                                    <input type="text" class="form-control" id="viewgvh" name="viewgvh" placeholder="Please enter the name of the seed" />
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
              </div>
              <div class="modal-footer">
                  <!--<button class="btn btn-success" id="editbtn" onclick="showEdit()">Edit Seed</button>-->
                  <!--<button class="btn btn-success" id="viewbtn" onclick="showView()">Cancel</button>-->
                    <button class="btn btn-success" id="savebtn" onclick="updatePersonalInfo()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    
    
    <!-- END Edit personal details -->
    
    <!-- Edit General Info -->
    
    <div class="modal fade" id="ModalLinkGeneralInfo" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="GeneralInfoTitle"></h4>
              </div>
              <div class="modal-body">
                 
                    <form role="form" id="updateGeneralInfoform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="updateGeneralInfo" name="updateGeneralInfo" >
                        <input type="hidden" id="GeneralInfomemberID" name="GeneralInfomemberID" >
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="viewipc">IPC:</label>
                                    <input type="text" class="form-control" id="viewipc" name="viewipc" placeholder="" />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="viewdistrict">DISTRICT:</label>
                                    <input type="text" class="form-control" id="viewdistrict" name="viewdistrict" placeholder="Please enter the name of the seed" />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="viewta">T/A:</label>
                                    <input type="text" class="form-control" id="viewta" name="viewta" placeholder="Please enter the name of the seed" />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="viewgac">GAC:</label>
                                    <input type="text" class="form-control" id="viewgac" name="viewgac" placeholder="Please enter the name of the seed" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="viewtcc">TCC REG #:</label>
                                    <input type="text" class="form-control" id="viewtcc" name="viewtcc" placeholder="Please enter the name of the seed" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="viewvillage">VILLAGE:</label>
                                    <select class="form-control" id="viewvillage" name="viewvillage">
                                        <?php foreach ($lstVillages as $optionVList) { ;?>
                                        <option value="<?php echo $optionVList['villageID']; ?>"><?php echo $optionVList['villageName']; ?></option>
                                    <?php  } ;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="viewclub">CLUB:</label>
                                    <select class="form-control" id="viewclub" name="viewclub">
                                        <?php foreach ($lstClubs as $optionCList) { ;?>
                                        <option value="<?php echo $optionCList['clubsID']; ?>"><?php echo $optionCList['clubName']; ?></option>
                                    <?php  } ;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
             
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="updateGeneralInfo()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END Edit General Info -->
    
    <!-- Edit Annual Income Info -->
    
    <div class="modal fade" id="ModalLinkAnnualIncome" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="AnnualIncomeTitle"></h4>
              </div>
              <div class="modal-body">                
                    <form role="form" id="updateAnnualIncomeform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="updateAnnualIncome" name="updateAnnualIncome" >
                        <input type="hidden" id="AnnualIncomememberID" name="AnnualIncomememberID" >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="viewcropsale">CROP SALES:</label>
                                    <input type="text" class="form-control" id="viewcropsale" name="viewcropsale" placeholder="" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="viewsources">OTHER SOURCES:</label>
                                    <input type="text" class="form-control" id="viewsources" name="viewsources" placeholder="Please enter the name of the seed" />
                                </div>
                            </div>                            
                        </div>                
                    </form>
                  </div>
             
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="updateAnnualIncome()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END Edit Annual Income Info -->
    
    <!-- Edit Annual Income Info -->
    
    <div class="modal fade" id="ModalLinkFoodSecurity" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="FoodSecurityTitle"></h4>
              </div>
              <div class="modal-body">                
                    <form role="form" id="updateFoodSecurityform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="updateFoodSecurity" name="updateFoodSecurity" >
                        <input type="hidden" id="FoodSecuritymemberID" name="FoodSecuritymemberID" >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="viewmonths"># months with food:</label>
                                    <input type="text" class="form-control" id="viewmonths" name="viewmonths" placeholder="" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="viewmechanism">Coping mechanism:</label>
                                    <input type="text" class="form-control" id="viewmechanism" name="viewmechanism" placeholder="" />
                                </div>
                            </div>                            
                        </div>                
                    </form>
                  </div>
             
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="updateFoodSecurity()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- END Edit Annual Income Info -->
    
    <!-- END MODALS -->
    
    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    
    <!-- material -->
    <script src="../../../material/assets/js/material-kit.js" type="text/javascript"></script>
    <script src="../../../material/assets/js/material.min.js" type="text/javascript"></script>
    
    <!-- AdminLTE App -->
    <script src="../../../dist/js/app.min.js"></script>
<script src="../../../js/jquery-ui.js"></script>

    <script>
       function _(x) {
            return document.getElementById(x);
        }
        
        // ACTIVITIES --------------------------------------------------------------------------------------------------------------
        //remove add ACTIVITIES items
        $(".deleteAddActivities").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add more ACTIVITIES items
        $(".addmoreAddActivities").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case selectactivities' name='activities[]' /></td>";
        data += "<td><select class='form-control' name='activity[]'><?php foreach ($lstActivities as $optionSeedList) { ;?><option value='<?php echo $optionSeedList['Aid']; ?>'><?php echo $optionSeedList['actName']; ?></option><?php  } ;?></select></td>";
        data += "</tr>";
            $('.tblAddActivities').append(data);
        });
        
        //add ACTIVITIES
        function AddActivitiesMember(){
           //check atleat 1 checkbox is checked
            if (!$('.selectactivities').is(':checked')) {
                alert('Please select activities that you wish to add');               
            }else{
               if (window.confirm('are you sure you want to add activities?'))
                {
                    _("AddActivitiesmember").value = "AddActivitiesmember";        
                    _("AddActivitiesmemberform").method = "post";
                    _("AddActivitiesmemberform").action = "memberprofile.php";
                    _("AddActivitiesmemberform").submit();
                }else{

                }
            } 
        }
        
        
        //delete ACTIVITIES
        function deleteActivity(){           
            _("deleteActivitymember").value = "deleteActivitymember";        
            _("deleteActivitymemberform").method = "post";
            _("deleteActivitymemberform").action = "memberprofile.php";
            _("deleteActivitymemberform").submit();                
        }
        
        // END ACTIVITIES --------------------------------------------------------------------------------------------------------------
        
        
        
        // CROPS --------------------------------------------------------------------------------------------------------------
        //remove add crop items
        $(".deleteAddCrop").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add more crop items
        $(".addmoreAddCrop").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='crops[]' /></td>";
        data += "<td><select class='form-control' name='crop[]'><?php foreach ($lstcrops as $optionSeedList) { ;?><option value='<?php echo $optionSeedList['cropID']; ?>'><?php echo $optionSeedList['cropname']; ?></option><?php  } ;?></select></td>";
        data += "<td><input type='text' class='form-control' name='acreage[]' /></td></tr>";
            $('.tblAddCrop').append(data);
        });
        
        //add crops
        function AddCropMember(){
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to add crops?'))
                {
                    //alert('crops added');
                    _("AddCropmember").value = "AddCropmember";        
                    _("AddCropmemberform").method = "post";
                    _("AddCropmemberform").action = "memberprofile.php";
                    _("AddCropmemberform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            } 
        }
        
        //update crops
        function updateCrop(){
            if (window.confirm('are you sure you want to update crops?'))
                {;
                    _("UpdateCropmember").value = "UpdateCropmember";        
                    _("UpdateCropmemberform").method = "post";
                    _("UpdateCropmemberform").action = "memberprofile.php";
                    _("UpdateCropmemberform").submit();
                }else{

                }
        }
        
        //delete crops
        function deleteCrop(){           
            _("deleteCropmember").value = "deleteCropmember";        
            _("deleteCropmemberform").method = "post";
            _("deleteCropmemberform").action = "memberprofile.php";
            _("deleteCropmemberform").submit();                
        }
        
        // END CROPS --------------------------------------------------------------------------------------------------------------
        
        
        // LIVESTOCK --------------------------------------------------------------------------------------------------------------
        //remove add LIVESTOCK items
        $(".deleteAddLivestock").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add more LIVESTOCK items
        $(".addmoreAddLivestock").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case livestockselect' name='livestocks[]' /></td>";
        data += "<td><select class='form-control' name='livestock[]'><?php foreach ($lstLivestock as $optionSeedList) { ;?><option value='<?php echo $optionSeedList['livestockID']; ?>'><?php echo $optionSeedList['livestockname']; ?></option><?php  } ;?></select></td>";
        data += "<td><input type='text' class='form-control' name='quantity[]' /></td></tr>";
            $('.tblAddLivestock').append(data);
        });
        
        
        //dom ready handler
        jQuery(function ($) {
            //form submit handler
            $('#booking').submit(function (e) {
                //check atleat 1 checkbox is checked
                if (!$('.livestockselect').is(':checked')) {
                    //prevent the default form submit if it is not checked
                    //e.preventDefault();
                    alert('not selected'); 
                }else{
                   alert('one selected'); 
                }
            });
        });
        
        
        //add LIVESTOCK
        function AddLivestockMember(){
            //check atleat 1 checkbox is checked
            if (!$('.livestockselect').is(':checked')) {
                alert('Please select items that you wish to add');               
            }else{
               if (window.confirm('are you sure you want to add Livestock?'))
                {
                    //alert('crops added');
                    _("AddLivestockmember").value = "AddLivestockmember";        
                    _("AddLivestockmemberform").method = "post";
                    _("AddLivestockmemberform").action = "memberprofile.php";
                    _("AddLivestockmemberform").submit();
                }else{

                }
            }
        }
        
        //update LIVESTOCK
        function updateLivestock(){
            if (window.confirm('are you sure you want to update Livestock?'))
                {;
                    _("UpdateLivestockmember").value = "UpdateLivestockmember";        
                    _("UpdateLivestockmemberform").method = "post";
                    _("UpdateLivestockmemberform").action = "memberprofile.php";
                    _("UpdateLivestockmemberform").submit();
                }else{

                }
        }
        
        //delete LIVESTOCK
        function deleteLivestock(){           
            _("deleteLivestockmember").value = "deleteLivestockmember";        
            _("deleteLivestockmemberform").method = "post";
            _("deleteLivestockmemberform").action = "memberprofile.php";
            _("deleteLivestockmemberform").submit();                
        }
        
        // END LIVESTOCK --------------------------------------------------------------------------------------------------------------
        
        // SEED DISTRIBUTION --------------------------------------------------------------------------------------------------------------
        //remove add SEED DISTRIBUTION items
        $(".deleteSeedDistribution").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add more SEED DISTRIBUTION items
        $(".addmoreSeedDistribution").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case seeddistributionselect' name='seeddees[]' /></td>";
        data += "<td><select class='form-control' name='seedsdee[]'><?php foreach ($lstSeeds as $optionSeedList) { ;?><option value='<?php echo $optionSeedList['seedID']; ?>'><?php echo $optionSeedList['seedname']; ?></option><?php  } ;?></select></td>";
        data += "<td><input type='text' class='form-control' name='seedskgs[]' /></td></tr>";
            $('.tblAddSeedDistribution').append(data);
        });
        
        
        //add SEED DISTRIBUTION
        function AddSeedDistribution(){
            //check atleat 1 checkbox is checked
            if (!$('.seeddistributionselect').is(':checked')) {
                alert('Please select items that you wish to add');               
            }else{
               if (window.confirm('are you sure you want to add Livestock?'))
                {
                    //alert('crops added');
                    _("AddSeedDistributionmember").value = "AddSeedDistributionmember";        
                    _("AddSeedDistributionmemberform").method = "post";
                    _("AddSeedDistributionmemberform").action = "memberprofile.php";
                    _("AddSeedDistributionmemberform").submit();
                }else{

                }
            }
        }
        
        //update SEED DISTRIBUTION acquisition
        function updateacquisition(){
            if (window.confirm('are you sure you want to update?'))
                {;
                    _("Updateacquisitionmember").value = "Updateacquisitionmember";        
                    _("Updateacquisitionmemberform").method = "post";
                    _("Updateacquisitionmemberform").action = "memberprofile.php";
                    _("Updateacquisitionmemberform").submit();
                }else{

                }
        }
        
        //pay seed distro
        function repaydistro(){
            if (window.confirm('are you sure you want to make payment?'))
                {;
                    _("repaymentmember").value = "repaymentmember";        
                    _("repaymentmemberform").method = "post";
                    _("repaymentmemberform").action = "memberprofile.php";
                    _("repaymentmemberform").submit();
                }else{

                }
        }
        
        
        //pay seed distro edit
        function repaydistroedit(){
            if (window.confirm('are you sure you want to edit payment?'))
                {;
                    _("repaymenteditmember").value = "repaymenteditmember";        
                    _("seedrepaymenteditform").method = "post";
                    _("seedrepaymenteditform").action = "memberprofile.php";
                    _("seedrepaymenteditform").submit();
                }else{

                }
        }
        
        //delete SEED DISTRIBUTION
        function discarddistro(){           
            _("discarddistromember").value = "discarddistromember";        
            _("discarddistromemberform").method = "post";
            _("discarddistromemberform").action = "memberprofile.php";
            _("discarddistromemberform").submit();                
        }
        
        // END SEED DISTRIBUTION --------------------------------------------------------------------------------------------------------------
        
        
        // CROP MARKETING --------------------------------------------------------------------------------------------------------------
        //remove add crop marketing items
        $(".deleteAddCM").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add more crop marketing items
        $(".addmoreAddCM").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case cropmarketingselect' name='cropmarketings[]' /></td>";
        data += "<td><select class='form-control' name='crop4marketing[]'><?php foreach ($lstcrops as $optionSeedList) { ;?><option value='<?php echo $optionSeedList['cropID']; ?>'><?php echo $optionSeedList['cropname']; ?></option><?php  } ;?></select></td>";
        data += "<td><input type='text' class='form-control' name='Receipt[]' /></td>";
        data += "<td><input type='text' class='form-control' name='Price[]' /></td>";
        data += "<td><input type='text' class='form-control' name='TotalPrice[]' /></td></tr>";
            $('.tblAddCM').append(data);
        });
        
        //add crops
        function AddCropMarketingMember(){
            //check atleat 1 checkbox is checked
            if (!$('.cropmarketingselect').is(':checked')) {
                alert('Please select items that you wish to add');               
            }else{
               if (window.confirm('are you sure you want to add crop marketing?'))
                {
                    //alert('crops added');
                    _("AddCropMarketingmember").value = "AddCropMarketingmember";        
                    _("AddCropMarketingmemberform").method = "post";
                    _("AddCropMarketingmemberform").action = "memberprofile.php";
                    _("AddCropMarketingmemberform").submit();
                }else{

                }
            }
        }
        
        //update crops
        function updateCM(){
            if (window.confirm('are you sure you want to update crop marketing details?'))
                {;
                    _("Updatecmmember").value = "Updatecmmember";        
                    _("Updatecmmemberform").method = "post";
                    _("Updatecmmemberform").action = "memberprofile.php";
                    _("Updatecmmemberform").submit();
                }else{

                }
        }
        
        //delete crops
        function deleteCM(){           
            _("deletecmmember").value = "deletecmmember";        
            _("deletecmmemberform").method = "post";
            _("deletecmmemberform").action = "memberprofile.php";
            _("deletecmmemberform").submit();                
        }
        
        // END CROP MARKETING --------------------------------------------------------------------------------------------------------------
        
        
        
        // TREE PLANTING --------------------------------------------------------------------------------------------------------------
        
         $(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        $(".addmore").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='seeds[]' /></td>";
        data += "<td><select class='form-control' name='seed[]'><?php foreach ($lstSeeds as $optionSeedList) { ;?><option value='<?php echo $optionSeedList['seedID']; ?>'><?php echo $optionSeedList['seedname']; ?></option><?php  } ;?></select></td>";
        data += "<td><input type='text' class='form-control' name='amount[]' /></td></tr>";
            $('.tbl').append(data);
        });
        
        
        
        //remove tree planting
        $(".deleteTreePlanting").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add tree planting items
        $(".addmoreTreePlanting").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='treeplantings[]' /></td>";
        data += "<td><select class='form-control' name='treetype[]'><?php foreach ($listTrees as $optionList) { ;?><option value='<?php echo $optionList['treesid']; ?>'><?php echo $optionList['treeName']; ?></option><?php  } ;?></select></td>";
        data += "<td><input type='text' class='form-control' name='numberoftrees[]' /></td></tr>";
            $('.tblTreePlanting').append(data);
        });
        
        
        
        
        //add tree planting items and tree planting
        function AddTreePlanting(){           
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to add Trees plating activity?'))
                {
                    _("AddTreePlanting").value = "AddTreePlanting";        
                    _("AddTreePlantingform").method = "post";
                    _("AddTreePlantingform").action = "memberprofile.php";
                    _("AddTreePlantingform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            } 
        }
        
        //update crops
        function updateTP(){
            if (window.confirm('are you sure you want to update Tree Planting details?'))
                {;
                    _("Updatetpmember").value = "Updatetpmember";        
                    _("Updatetpmemberform").method = "post";
                    _("Updatetpmemberform").action = "memberprofile.php";
                    _("Updatetpmemberform").submit();
                }else{

                }
        }
        
        //delete crops
        function deleteTP(){           
            _("deletetpmember").value = "deletetpmember";        
            _("deletetpmemberform").method = "post";
            _("deletetpmemberform").action = "memberprofile.php";
            _("deletetpmemberform").submit();                
        }
        
        // END TREE PLANTING --------------------------------------------------------------------------------------------------------------
        
        $(function() {
            $( "#regyear1" ).datepicker( { dateFormat: 'y-m-d' });
            
            $( "#viewdob" ).datepicker( { dateFormat: 'y-m-d' });
            
            
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
            
            // TREE PLANTING --------------------------------------------------------------------
            $(".openModalLinkEditTPDetails").click(function(e) {
                e.preventDefault();       
                $("#edittpdetailsTitle").html('Tree Planting Details Edit');
                $("#tpeditID").val($(this).data('id'));
                $("#viewnotrees").val($(this).data('viewnotrees'));

                $('#edittpcrop').modal('show');
            });
            
            $(".openModalLinkDeleteTPDetails").click(function(e) {
                e.preventDefault();       
                $("#deletetmdetailsTitle").html('Delete Tree Planting');
                $("#tmdeleteID").val($(this).data('id'));
                $('#deletetmdetails').modal('show');
            });
            
            //END TREE PLANTING --------------------------------------------------------------------
            
            
            //Activities --------------------------------------------------------------------
            $(".openModalLinkDeleteActivityDetails").click(function(e) {
                e.preventDefault();       
                $("#deleteActivitydetailsTitle").html('Remove Activity');
                $("#ActivitydeleteID ").val($(this).data('id'));
                $('#deleteactivitydetails').modal('show');
            });
            
            //END Activities --------------------------------------------------------------------
            
            // CROP MARKETING --------------------------------------------------------------------
            $(".openModalLinkEditCMDetails").click(function(e) {
                e.preventDefault();       
                $("#editcmdetailsTitle").html('Crop Marketing Details Edit');
                $("#cmeditID").val($(this).data('id'));
                $("#viewreceipt").val($(this).data('viewreceipt'));
                $("#viewprice").val($(this).data('viewprice'));
                $("#viewtotalprice").val($(this).data('viewtotalprice'));

                $('#editcmcrop').modal('show');
            });
            
            $(".openModalLinkDeleteCMDetails").click(function(e) {
                e.preventDefault();       
                $("#deletecmdetailsTitle").html('Delete Crop Marketing');
                $("#cmdeleteID ").val($(this).data('id'));
                $('#deletecmdetails').modal('show');
            });
            
            //END CROP MARKETING --------------------------------------------------------------------
            
            //CROP --------------------------------------------------------------------
            $(".openModalLinkEditCropDetails").click(function(e) {
                e.preventDefault();       
                $("#editcropdetailsTitle").html('Crop Details Edit');
                $("#cropeditID ").val($(this).data('id'));
                $("#acreageedit ").val($(this).data('viewacreage'));

                $('#editcropdetails').modal('show');
            });
            
            $(".openModalLinkDeleteCropDetails").click(function(e) {
                e.preventDefault();       
                $("#deletecropdetailsTitle").html('Delete Crop');
                $("#cropdeleteID ").val($(this).data('id'));
                //$("#acreageedit ").val($(this).data('viewacreage'));

                $('#deletecropdetails').modal('show');
            });
            
            //END CROP --------------------------------------------------------------------
            
            //LIVESTOCK --------------------------------------------------------------------
            $(".openModalLinkEditLivestockDetails").click(function(e) {
                e.preventDefault();       
                $("#editlivestockdetailsTitle").html('Livestock Details Edit');
                $("#livestockeditID").val($(this).data('id'));
                $("#Quantityedit").val($(this).data('viewacreage'));

                $('#editlivestockdetails').modal('show');
            });
            
            $(".openModalLinkDeleteLivestockDetails").click(function(e) {
                e.preventDefault();       
                $("#deletelivestockdetailsTitle").html('Delete Livestock');
                $("#livestockdeleteID ").val($(this).data('id'));
                //$("#acreageedit ").val($(this).data('viewacreage'));

                $('#deletelivestockdetails').modal('show');
            });
            
            //END LIVESTOCK --------------------------------------------------------------------
            
            
            //SEED DISTRO --------------------------------------------------------------------
            $(".openModalLinkEditAcquisitionDetails").click(function(e) {
                e.preventDefault();       
                $("#editacquisitiondetailsTitle").html('Seed Distribution Details: Acquisition Edit');
                $("#acquisitioneditID").val($(this).data('id'));
                $("#acquisitionamountedit").val($(this).data('viewacquisitionamount'));

                $('#editacquisitiondetails').modal('show');
            });
            
            $(".openModalLinkMakePayment").click(function(e) {
                e.preventDefault();       
                $("#makepaymentTitle").html('Seed Distribution: Make Payment');
                $("#repaymentID ").val($(this).data('id'));
                $("#seedrepayment").html($(this).data('viewname'));
                $("#acquisitionamountedit1").html($(this).data('viewacquisitionamount1'));
                $('#seedrepaymentmodal').modal('show');
            });
            
            //edit repayment details
            $(".openModalLinkeditpaymentDetails").click(function(e) {
                e.preventDefault();       
                $("#makepaymenteditTitle").html('Seed Distribution: Edit RePayment');
                $("#repaymentID2").val($(this).data('id'));
                $("#viewname2").html($(this).data('viewname2')); // acquired seed
                $("#viewacquisitionamount1").html($(this).data('viewacquisitionamount1')); // acquire amount
                $("#viewpaidamount").val($(this).data('viewpaidamount')); // paid amount
                $('#seedrepaymenteditmodal').modal('show');
            });
            
            $(".openModalLinkDiscardPayment").click(function(e) {
                e.preventDefault();       
                $("#discarddistroTitle").html('Discard Seed Distribution Record');
                $("#discarddistroID").val($(this).data('id'));
                $('#discarddistromodal').modal('show');
            });
            
            
            //END SEED DISTRO --------------------------------------------------------------------
            
            $(".openModalLinkMemberDetails").click(function(e) {
                e.preventDefault();       
                $("#UpdateMemberDetailsModalTitle").html('Member Details');
//                $("#viewname").html($(this).data('viewname'));

                $("#memberID").val($(this).data('id'));
                $("#viewfname").val($(this).data('viewfname'));
                $("#viewlname").val($(this).data('viewlname'));
                $("#viewdob").val($(this).data('viewdob'));
                $("#viewhh").val($(this).data('viewhh'));
                $("#viewgvh").val($(this).data('viewgvh'));

                $('#UpdateMemberDetailsModal').modal('show');
            });
            
            $(".openModalLinkAddCrop").click(function(e) {
                e.preventDefault();       
                $("#AddCropsTitle").html('Add Member Crops');
                $("#AddCropmemberID").val($(this).data('id'));
                $('#AddCrops').modal('show');
            });
            
            $(".openModalLinkAddLivestock").click(function(e) {
                e.preventDefault();       
                $("#AddLivestockTitle").html('Add Member Livestock');
                $("#AddLivestockmemberID").val($(this).data('id'));
                $('#AddLivestock').modal('show');
            });
            
            $(".openModalLinkAddActivity").click(function(e) {
                e.preventDefault();       
                $("#AddActivityTitle").html('Add Member Activities');
                $("#AddActivitymemberID").val($(this).data('id'));
                $('#AddActivity').modal('show');
            });
            
            $(".openModalLinkAddSeedDistribution").click(function(e) {
                e.preventDefault();       
                $("#AddSeedDistributionTitle").html('Seed Distribution');
                $("#AddSeedDistributionmemberID").val($(this).data('id'));
                $('#AddSeedDistribution').modal('show');
            });
            
            $(".openModalLinkAddCropMarketing").click(function(e) {
                e.preventDefault();       
                $("#AddCropMarketingTitle").html('Crop Marketing');
                $("#AddCropMarketingmemberID").val($(this).data('id'));
                $('#AddCropMarketing').modal('show');
            });
            
            //general info
            $(".openModalLinkGeneralInfo").click(function(e) {
                e.preventDefault();       
                $("#GeneralInfoTitle").html('General Info');
                $("#GeneralInfomemberID").val($(this).data('id'));
                $("#viewipc").val($(this).data('viewipc'));
                $("#viewdistrict").val($(this).data('viewdistrict'));
                $("#viewta").val($(this).data('viewta'));
                $("#viewgac").val($(this).data('viewgac'));
                $("#viewtcc").val($(this).data('viewtcc'));
                $('#ModalLinkGeneralInfo').modal('show');
            });
            
            //annual income
            $(".openModalLinkAnnualIncome").click(function(e) {
                e.preventDefault();       
                $("#AnnualIncomeTitle").html('Annual Income');
                $("#AnnualIncomememberID").val($(this).data('id'));
                $("#viewcropsale").val($(this).data('viewcropsale'));
                $("#viewsources").val($(this).data('viewsources'));
                $('#ModalLinkAnnualIncome').modal('show');
            });
            
            //food security
            $(".openModalLinkFoodSecurity").click(function(e) {
                e.preventDefault();       
                $("#FoodSecurityTitle").html('Food Security');
                $("#FoodSecuritymemberID").val($(this).data('id'));
                $("#viewmonths").val($(this).data('viewmonths'));
                $("#viewmechanism").val($(this).data('viewmechanism'));
                $('#ModalLinkFoodSecurity').modal('show');
            });
            
       });
       
       function ShowHideDiv(){
            var selectedItem = _("selectMe").value;
            switch(selectedItem){
                case "seedmode":
                    //alert('changed to: '+selectedItem);
                    $('.group').hide();
                    $('#seedmode').show();
                    break;
                case "cropmode":
                    //alert('changed to: '+selectedItem);
                    $('.group').hide();
                    $('#cropmode').show();
                    break;
                default:
                    $('.group').hide();
                    $('#seedmode').show();
                    //alert('changed to: '+selectedItem);
            }
            
        }
        
        function ShowHideDiv1(){
            var selectedItem = _("repaymode1").value;
            switch(selectedItem){
                case "seedmode1":
                    //alert('changed to: '+selectedItem);
                    $('.group1').hide();
                    $('#seedmode1').show();
                    break;
                case "cropmode1":
                    //alert('changed to: '+selectedItem);
                    $('.group1').hide();
                    $('#cropmode1').show();
                    break;
                default:
                    $('.group1').hide();
                    $('#seedmode1').show();
                    //alert('changed to: '+selectedItem);
            }
            
        }
       
        
        
//        function AddLivestockMember(){                        
//            var r = confirm("Are you sure you want to Add Livestock to member?");
//            if (r) {
//                _("AddLivestockmember").value = "AddLivestockmember";        
//                _("AddLivestockmemberform").method = "post";
//                _("AddLivestockmemberform").action = "memberprofile.php";
//                _("AddLivestockmemberform").submit();
//            }
//        }
        
//        function AddActivityMember(){                        
//            var r = confirm("Are you sure you want to Add Activity to member?");
//            if (r) {
//                _("AddActivitymember").value = "AddActivitymember";        
//                _("AddActivitymemberform").method = "post";
//                _("AddActivitymemberform").action = "memberprofile.php";
//                _("AddActivitymemberform").submit();
//            }
//        }
        
//        function updatePersonalInfo(){                        
//            var r = confirm("Are you sure you want to update member details?");
//            if (r) {
//                _("updatePersonalInfo").value = "updatePersonalInfo";        
//                _("updatePersonalInfoform").method = "post";
//                _("updatePersonalInfoform").action = "memberprofile.php";
//                _("updatePersonalInfoform").submit();
//            }
//        }
        
        //update general info
//        function updateGeneralInfo(){                        
//            var r = confirm("Are you sure you want to update member details?");
//            if (r) {
//                _("updateGeneralInfo").value = "updateGeneralInfo";        
//                _("updateGeneralInfoform").method = "post";
//                _("updateGeneralInfoform").action = "memberprofile.php";
//                _("updateGeneralInfoform").submit();
//            }
//        }
        
        //update annual income
//        function updateAnnualIncome(){                        
//            var r = confirm("Are you sure you want to update member details?");
//            if (r) {
//                _("updateAnnualIncome").value = "updateAnnualIncome";        
//                _("updateAnnualIncomeform").method = "post";
//                _("updateAnnualIncomeform").action = "memberprofile.php";
//                _("updateAnnualIncomeform").submit();
//            }
//        }
        
        //update food security
//        function updateFoodSecurity(){                        
//            var r = confirm("Are you sure you want to update member details?");
//            if (r) {
//                _("updateFoodSecurity").value = "updateFoodSecurity";        
//                _("updateFoodSecurityform").method = "post";
//                _("updateFoodSecurityform").action = "memberprofile.php";
//                _("updateFoodSecurityform").submit();
//            }
//        }
        
//        function AddSeedDistributionMember(){
//            var r = confirm("Are you sure you want to enter seed distribuition details?");
//            if (r) {
//                _("AddSeedDistributionmember").value = "AddSeedDistributionmember";        
//                _("AddSeedDistributionmemberform").method = "post";
//                _("AddSeedDistributionmemberform").action = "memberprofile.php";
//                _("AddSeedDistributionmemberform").submit();
//            }
//        }
        
//        function AddCropMarketingmember(){
//            var r = confirm("Are you sure you want to enter Crop Marketing details?");
//            if (r) {
//                _("AddCropMarketingmember").value = "AddCropMarketingmember";        
//                _("AddCropMarketingmemberform").method = "post";
//                _("AddCropMarketingmemberform").action = "memberprofile.php";
//                _("AddCropMarketingmemberform").submit();
//            }
//        }
    </script>
  </body>
</html>