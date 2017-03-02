<?php  
session_start();
error_reporting(0);
include_once ('../../controller/user/seasonscontroller.php'); ?>
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
        table.dataTable tbody th,
        table.dataTable tbody td {
            white-space: nowrap;
        }
        #option2{
        display: none;
        }
        .modal-header {
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #00a65a;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
     color: white;
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
          
          <?php
       if(isset($_SESSION['notification'])){ 
          // echo '<div class="alert alert-error">'.$error.'</div>';
           if($_SESSION['notification']['title'] == 'FAILED!'){
               echo '
           <div class="alert alert-danger alert-dismissable">';
           }else{
               echo '
           <div class="alert alert-success alert-dismissable">';
           }
           echo '
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4> '.$_SESSION['notification']['title'].'</h4>
        '.$_SESSION['notification']['message'].'
            
        </div>';
           unset($_SESSION['notification']);
       }
       ?>
          
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Season Summary
            <!--<small>Profile</small>-->
          </h1>
<!--          <ol class="breadcrumb">
              <li><a href="members.php"><i class="fa fa-users"></i> Members</a></li>
            <li class="active">Profile</li>
          </ol>-->
        </section>
        
        

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    
                
                <div class="col-md-4">
                    <div class="box box-success">
                        <div class="box-body box-profile">
                            
                            <?php foreach($getSeasonHeader as $seasonheader){?>
                            <?php if($_SESSION['nasfam_usertype'] == '1') { ?>
                            <strong>Season Details</strong>
                            
                            <button type="button" class="btn btn-info btn-simple btn-xs pull-right" data-toggle="modal" data-target="#editSeasonHeaderModal"> <i class="fa fa-edit"></i> Edit</button>
                            <hr>
                            <?php } ?>
                            <p class="text-muted">
                                <strong>Season:</strong> <?php echo $seasonheader['regYear']; ?><br>
                                <strong>Start Date:</strong> <?php echo $seasonheader['startDate']; ?><br>
                                <strong>End Date:</strong> <?php echo $seasonheader['endDate']; ?><br>
                                
                            </p>
                            
                           
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-success">
                    <div class="box-body box-profile">
                        <strong>Procurement Details</strong><hr>
                        <strong>Procurement Amount:</strong> <?php echo $seasonheader['procurement']; ?><br>
                        <strong>Market Procurement Amount:</strong><br>
                        
                        <strong>Total CG7:</strong><br>
                        <strong>Total CHALIM:</strong><br>
                    <?php } ?> 
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-success">
                        <div class="box-body box-profile">
                            <strong>Participation</strong><hr>
                            <div class="col-md-6">
                                <strong>NON MEMBERS</strong><br>
                                <strong>Male:</strong><br>
                                <strong>Female:</strong><br>
                                <strong>Male:</strong>
                            </div>
                            <div class="col-md-6">
                                <strong>MEMBERS</strong><br>
                                <strong>Male:</strong><br>
                                <strong>Female:</strong><br>
                                <strong>Male:</strong>
                            </div>
                        </div>
                        </div>
                </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="nav-tabs-custom nav-pills-success">
                        <ul class="nav nav-tabs nav-pills-success">
                            <li class="active"><a href="#marketcenter" data-toggle="tab"><strong>Seasonal Summary</strong></a></li>
                            <!--<li><a href="#buyer" data-toggle="tab"><strong>Buying</strong></a></li>-->
                            <li><a href="#purchases" data-toggle="tab"><strong>Purchases</strong></a></li>
                            <li><a href="#warehouse" data-toggle="tab"><strong>Warehouse</strong></a></li>
                            <!--<li><a href="#sorting" data-toggle="tab"><strong>Sorting/Grading</strong></a></li>-->

                            <li><a href="#marketcenters" data-toggle="tab"><strong>Market Center</strong></a></li>
                            <li><a href="#buyers" data-toggle="tab"><strong>Buyers</strong></a></li>
                            <li><a href="#casualworkers" data-toggle="tab"><strong>Casual Workers</strong></a></li>
                        </ul>
                        <div class="tab-content">                           
                            <div class="tab-pane active" id="marketcenter">
                                <table id="marketcentertbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th>Market Center</th>
                                          <th>CG7 - Grade 1</th>
                                          <th>CG7 - Grade 2</th>
                                          <th>CG7 - Grade 3</th>
                                          <th>CG7 - Grade 4</th>
                                          <th>CG7 - Grade 5</th>
                                          <th>CG7 - Receipt Total</th>
                                          <th>CG7 - Total QTY (KGs)</th>
                                          <th>CHALIM - Grade 1</th>
                                          <th>CHALIM - Grade 2</th>
                                          <th>CHALIM - Grade 3</th>
                                          <th>CHALIM - Grade 4</th>
                                          <th>CHALIM - Grade 5</th>
                                          <th>CHALIM - Receipt Total</th>
                                          <th>CHALIM - Total QTY (KGs)</th>
                                          <th>Receipt Total</th>
                                          <th>Total QTY (KGs)</th>
                                        </tr>
                                    </thead>                                   
                                </table>
                            </div>
                            <div class="tab-pane" id="buyer">
                                <table id="buyersummarytbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th>Buyer</th>
                                          <th>Date</th>
                                          <th>Market Center</th>                                          
                                          <th>QTY Total Amount</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                </table>                               
                            </div>
                            <div class="tab-pane" id="purchases">
                                <table id="purchasestbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th>Receipt</th>
                                          <th>Date</th>
                                          <th>Buyer</th>
                                          <th>Market Center</th>
                                          
                                          <th>Membership</th>
                                          <th>Farmer</th>
                                          <th>Gender</th>
                                          <th>Club</th>
                                          <th>GAC</th>
                                          
                                          <th>QTY</th>
                                          <th>Type</th>
                                          <th>Cum</th>
                                          <th>Price</th>
                                          <th>Mkw</th>
                                          
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                            <div class="tab-pane" id="warehouse">
                                <table id="warehousetbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Warehouse</th>
                                            <th>Code</th>
                                            <th>IPC</th>
                                            <th>Status</th>
                                            <th>CG 7 Total</th>
                                            <th>CHALIM Total</th>
                                            <th>Total QTY (KGs)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane" id="sorting">
                                <table id="sortingtbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th>Casual Worker</th>
                                          <th>Date</th>
                                          
                                          <th>CG7 - Total QTY (KGs)</th>
                                          <th>CG7 - Gradeouts</th>
                                          <th>CG7 - Shells</th>
                                          <th>CG7 - Grade 1</th>
                                          <th>CG7 - Grade 2</th>
                                          <th>CG7 - Grade 3</th>
                                          <th>CG7 - Grade 4</th>
                                          <th>CG7 - Grade 5</th>
                                          
                                          <th>CHALIM - Total QTY (KGs)</th>
                                          <th>CHALIM - Gradeouts</th>
                                          <th>CHALIM - Shells</th>
                                          <th>CHALIM - Grade 1</th>
                                          <th>CHALIM - Grade 2</th>
                                          <th>CHALIM - Grade 3</th>
                                          <th>CHALIM - Grade 4</th>
                                          <th>CHALIM - Grade 5</th>
                                          
                                          <th>Total QTY (KGs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="marketcenters">
                                <table id="marketcenterstbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Market Center Name</th>
                                            <th>Market Center Code</th>
                                            <th>Gacs</th>
                                            <th>MPA</th>
                                            <th>STATUS</th>
                                            <th>Receipts Total</th>
                                            <th>Balance</th>                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="buyers">
                                <table id="buyerstbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Buyer Code</th>
                                            <th>Gender</th>
                                            <th>Contacts</th>
                                            <th>Market Center</th>
                                            <th>Receipt Total</th>
                                            <th>Total (Kgs)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="casualworkers">
                                 <table id="casualworkerstbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Gender</th>
                                            <th>Warehouse</th>
                                            <th>Status</th>
                                            <th>CG7 Total</th>
                                            <th>CHALIM Total</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- nav-tabs-custom -->
                </div>
            </div>
         
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

    
    </div><!-- ./wrapper -->
    
    <!-- MODALS -->
    <?php include('seasonmodals.php') ;?>
    
    <!-- END MODALS -->
    
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
<script src="../../../rpt/dataTables.scroller.min.js" type="text/javascript"></script>
    <script>
        
        function _(x) {
            return document.getElementById(x);
        }
        
        function ShowHideDiv(){
            var selectedItem = _("selectMe").value;
            
            
            switch(selectedItem){
                case "none":
                    //alert('changed to: '+selectedItem);
                    $('.group').hide();
                    $('#option1').show();
                    break;
                case "member":
                    //alert('changed to: '+selectedItem);
                    $('.group').hide();
                    $('#option2').show();
                    break;
                
                default:
                    $('.group').hide();
                    $('#none').show();
                    //alert('changed to: '+selectedItem);
            }
            
        }
        
        function editCasualWorker(item2,item,item3){
            $("#editfname").val(item2);
            $("#editlname").val(item);
            $("#editWorkerid").val(item3);
            
            $('#CasualWorkerEditModal').modal('show');
        }
        
        function editWarehouseCW(item){
            $("#editWarehouseCWID").val(item); 
            $('#CasualWorkerWHSModal').modal('show');
        }
        
        function editBuyerMKC(item){
            $("#editMKCBuyersID").val(item); 
            $('#BuyerMKCModal').modal('show');
        }
        
        function editWarehouseIPC(item){
            $("#editWarehouseIPCID").val(item); //editWarehouseIPCID
            $('#WarehouseIPCModal').modal('show');
        }
        
        function editPurchase(item,item2,item3,item4,item5,item6,item7,item8,item9){
            $("#cum").val(item2);
            $("#qty").val(item);
            $("#price").val(item3);
            $("#mwk").val(item4);
            
            $("#receipt").val(item5);
            $("#mkc").val(item6);
            $("#rdate").val(item7);
            
            $("#mnumber").val(item8);
            $("#editfarmer").val(item8);
            
            $("#editpurchaseid").val(item9);
            //alert(item9);
            
            $('#PurchaseEditModal').modal('show');
        }
        
        function deletePurchase(item,item2){
           // alert('Delete purchase '+item+', Then reload page with season id: '+item2);
            if (window.confirm('are you sure you want to Delete this purchase?'))
                {
                    window.location.href = "seasondetails.php?delPID="+item+"&sid="+item2;
                }else{
                    
                }
        }
        
        $(function() {
            $('#rdate').datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd-mm-yy'
            });
            
            $( "#daterequested" ).datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd-mm-yy' 
            });
            
            $('#editenddate').datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'y-m-d'
            });
           
            
       });
       
       $(document).ready(function() {
           //warehouse
            var warehouselist = <?php  echo json_encode($lstwarehouseData); ?>;
           $('#warehousetbl').DataTable( {
                data:           warehouselist,
//                deferRender:    true,
//                scrollY:        350,
//                scrollX:        true,
//                scrollCollapse: true,
//                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print', 'colvis'
                     <?php if($_SESSION['nasfam_usertype'] == '1') { ?>                             
                    ,
                    {
                        text: 'Add Warehouse(s)',
                        action: function () {
                            $('#addWarehouseModal').modal('show');
                        }
                    }
                    <?php  } ?>
                ]
            } );
           
           
           
           //marketcentertbl $lstMC
           var data = <?php  echo json_encode($lstMC); ?>;
           $('#marketcentertbl').DataTable( {
                //data:           data,
                deferRender:    true,
                scrollY:        350,
                scrollX:        true,
                scrollCollapse: true,
                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print', 'colvis'
                ]
            } );
            
            //buyersummarytbl
            var buyersdata = <?php echo json_encode($lstBuyersSummary); ?>;
            $('#buyersummarytbl').DataTable( {
                //data:           buyersdata,
//                deferRender:    true,
//                scrollY:        400,
//                scrollX:        true,
                //scrollCollapse: true,
                //scroller:       true,
                 dom: 'Bfrtip',
                 buttons: [
                     'copy', 'excel', 'print', 'colvis'
                 ]
             } );
           
           //$lstPurchases
           var data2 = <?php echo json_encode($lstPurchases); ?>;
           
           $('#purchasestbl').DataTable( {
                //data:           data2,
                deferRender:    true,
                scrollY:        400,
                scrollX:        true,
//                scrollCollapse: true,
                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                    <?php if($_SESSION['nasfam_usertype'] == '1') { ?>                             
                    ,
                    {
                        text: 'Add Purchase(s)',
                        action: function () {
                            $('#addPurchasesModal').modal('show');
                        }
                    }
                    <?php  } ?>
                ]
            } );
            
            //sortingtbl
            var sortingdata = <?php echo json_encode($lstSorting); ?>;
           
           $('#sortingtbl').DataTable( {
                //data:           sortingdata,
                deferRender:    true,
                scrollY:        400,
                scrollX:        true,
//                scrollCollapse: true,
                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                    <?php if($_SESSION['nasfam_usertype'] == '1') { ?>                             
                    ,
                    {
                        text: 'Add Sorting Data',
                        action: function () {
                            $('#addSortingModal').modal('show');
                        }
                    }
                    ,
                    {
                        text: 'Add Grading Data',
                        action: function () {
                            $('#addCasualWorkerModal').modal('show');
                        }
                    }
                    ,
                    {
                        text: 'Add Casual Worker(s)',
                        action: function () {
                            $('#addCasualWorkerModal').modal('show');
                        }
                    }
                    <?php  } ?>
                ]
            } );
            
            //marketcenterstbl
             var marketcentersdata = <?php echo json_encode($lstAllMarketCenterList); ?>;
           
           $('#marketcenterstbl').DataTable( {
                data:           marketcentersdata,
//                deferRender:    true,
//                scrollY:        400,
//                scrollX:        false,
//                scrollCollapse: true,
//                scroller:       true,
//                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                    <?php if($_SESSION['nasfam_usertype'] == '1') { ?>                             
                    ,
                    {
                        text: 'Add Market Center',
                        action: function () {
                            $('#addMarketCenterModal').modal('show');
                        }
                    }
                    <?php  } ?>
                ]
            } );
            
            
            //buyerstbl
            var buyerstbl = <?php echo json_encode($lstBuyers); ?>;
           
           $('#buyerstbl').DataTable( {
                data:           buyerstbl,
//                deferRender:    true,
//                scrollY:        400,
//                scrollX:        false,
//                scrollCollapse: true,
//                scroller:       true,
//                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                    <?php if($_SESSION['nasfam_usertype'] == '1') { ?>                             
                    ,
                    {
                        text: 'Add Buyer(s)',
                        action: function () {
                            $('#addBuyersModal').modal('show');
                        }
                    }
                    <?php  } ?>
                ]
            } );
            
            //casualworkerstbl
            var CasualWorkersdata = <?php echo json_encode($lstCasualWorkers); ?>;
           
           $('#casualworkerstbl').DataTable( {
                data:           CasualWorkersdata,
//                deferRender:    true,
//                scrollY:        400,
//                scrollX:        false,
//                scrollCollapse: true,
//                scroller:       true,
//                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                    <?php if($_SESSION['nasfam_usertype'] == '1') { ?>                             
                    ,
                    {
                        text: 'Add Casual Workers',
                        action: function () {
                            $('#addCasualWorkerModal').modal('show');
                        }
                    }
                    <?php  } ?>
                ]
            } );
           
       });
       
       //addnewWarehouseSeason
        function addnewWarehouseSeason(){
            if (window.confirm('Are you sure you want to add warehouse(s)?'))
                {
                    _("addnewWarehouse").value = "addnewWarehouse";        
                    _("addnewWarehouseform").method = "post";
                    _("addnewWarehouseform").action = "seasondetails.php";
                    _("addnewWarehouseform").submit();
                }else{

                }
        }
       
        function editWarehouseCWs(){
            if (window.confirm('Are you sure you want to update Casual Worker?'))
                {
                    _("editWarehouseCW").value = "editWarehouseCW";        
                    _("editWarehouseCWform").method = "post";
                    _("editWarehouseCWform").action = "seasondetails.php";
                    _("editWarehouseCWform").submit();
                }else{

                }
        }
       
       
        function editWarehouseIPCs(){
            if (window.confirm('Are you sure you want to update Warehouse IPC?'))
                {
                    _("editWarehouseIPC").value = "editWarehouseIPC";        
                    _("editWarehouseIPCform").method = "post";
                    _("editWarehouseIPCform").action = "seasondetails.php";
                    _("editWarehouseIPCform").submit();
                }else{

                }
        }
        
        function editMKCbuyer(){
            if (window.confirm('Are you sure you want to update Market Center?'))
                {
                    _("editMKCBuyers").value = "editMKCBuyers";        
                    _("editMKCBuyersform").method = "post";
                    _("editMKCBuyersform").action = "seasondetails.php";
                    _("editMKCBuyersform").submit();
                }else{

                }
        }       
       
        function addnewBuyersSeason(){
            if (window.confirm('are you sure you want to add buyers?'))
                {
                    _("addnewBuyers").value = "addnewBuyers";        
                    _("addnewBuyersform").method = "post";
                    _("addnewBuyersform").action = "seasondetails.php";
                    _("addnewBuyersform").submit();
                }else{

                }
        }
       
       function EditCWinfo(){
           if (window.confirm('are you sure you want to update Purchase details?'))
                {
                    //alert("Add IPC");
                    _("editpurchase").value = "editpurchaseRD";        
                    _("editpurchaseform").method = "post";
                    _("editpurchaseform").action = "seasondetails.php";
                    _("editpurchaseform").submit();
                }else{

                }
       }
       
       
       //edit/update purchase
       function EditPurchaseRD(){
           if (window.confirm('are you sure you want to update Purchase details?'))
                {
                    //alert("Add IPC");
                    _("editpurchase").value = "editpurchaseRD";        
                    _("editpurchaseform").method = "post";
                    _("editpurchaseform").action = "seasondetails.php";
                    _("editpurchaseform").submit();
                }else{

                }
       }
       
       //edit/update purchase
       function EditPurchaseR(){
           if (window.confirm('are you sure you want to update Purchase details?'))
                {
                    //alert("Add IPC");
                    _("editpurchase").value = "editpurchaseR";        
                    _("editpurchaseform").method = "post";
                    _("editpurchaseform").action = "seasondetails.php";
                    _("editpurchaseform").submit();
                }else{

                }
       }
       
       //edit/update purchase
       function EditPurchaseF(){
           if (window.confirm('are you sure you want to update Purchase details?'))
                {
                    //alert("Add IPC");
                    _("editpurchase").value = "editpurchaseF";        
                    _("editpurchaseform").method = "post";
                    _("editpurchaseform").action = "seasondetails.php";
                    _("editpurchaseform").submit();
                }else{

                }
       }
       
       function EditPurchaseMKC(){
           if (window.confirm('are you sure you want to update Purchase details?'))
                {
                    //alert("Add IPC");
                    _("editpurchase").value = "editpurchaseMKC";        
                    _("editpurchaseform").method = "post";
                    _("editpurchaseform").action = "seasondetails.php";
                    _("editpurchaseform").submit();
                }else{

                }
       }
       
       //edit/update purchase
//       function EditPurchase(){
//           if (window.confirm('are you sure you want to update Purchase details?'))
//                {
//                    //alert("Add IPC");
//                    _("editpurchase").value = "editpurchase";        
//                    _("editpurchaseform").method = "post";
//                    _("editpurchaseform").action = "seasondetails.php";
//                    _("editpurchaseform").submit();
//                }else{
//
//                }
//       }
       
       //addNewCasualWorkers
       function addNewCasualWorkers(){
           if (window.confirm('are you sure you want to add new casual workers?'))
                {
                    //alert("Add IPC");
                    _("addCasualWorkers").value = "addCasualWorkers";        
                    _("addCasualWorkersform").method = "post";
                    _("addCasualWorkersform").action = "seasondetails.php";
                    _("addCasualWorkersform").submit();
                }else{

                }
       }
       
       function updateSeason(){
           if (window.confirm('are you sure you want to update season details?'))
                {
                    //alert("Add IPC");
                    _("updateseasonheader").value = "updateseasonheader";        
                    _("updateseasonheaderform").method = "post";
                    _("updateseasonheaderform").action = "seasondetails.php";
                    _("updateseasonheaderform").submit();
                }else{

                }
       }
       
       //
        function addNewMKC(){
           if (window.confirm('are you sure you want to add new Market Center?'))
                {
                    _("addNewMarketCenter").value = "addNewMarketCenter";        
                    _("addNewMarketCenterform").method = "post";
                    _("addNewMarketCenterform").action = "seasondetails.php";
                    _("addNewMarketCenterform").submit();
                }else{
                }
        }
        
        function addNewPurchase(){
            if (window.confirm('are you sure you want to add new Purchase Data?'))
                {
                    _("addPurchase").value = "addPurchase";        
                    _("addPurchaseform").method = "post";
                    _("addPurchaseform").action = "seasondetails.php";
                    _("addPurchaseform").submit();
                }else{
                }
        }
        
        function addNewSorting(){
            if (window.confirm('are you sure you want to add new Sorting Data?'))
                {
                    _("addSorting").value = "addSorting";        
                    _("addSortingform").method = "post";
                    _("addSortingform").action = "seasondetails.php";
                    _("addSortingform").submit();
                }else{
                }
        }
            
       
       //DISTRICTS ------------------------------------
       //remove district items
        $(".deleteDistricts").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add more district items
        $(".addmoreDistricts").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case selectdistricts' name='districts[]' /></td>";
        data += "<td><select class='form-control' name='district[]'><?php foreach ($lstDistricts as $optionSeedList) { ;?><option value='<?php echo $optionSeedList['districtID']; ?>'><?php echo $optionSeedList['fieldname']; ?></option><?php  } ;?></select></td>";
        data += "</tr>";
            $('.tblDistricts').append(data);
        });
       </script>
      </body>
</html>