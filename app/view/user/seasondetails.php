<?php  
session_start();
error_reporting(1);
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
            NIS
            <small>Season Summary</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="regyears.php"><i class="fa fa-users"></i> Back To Seasons</a></li>
            <!--<li class="active">Profile</li>-->
          </ol>
        </section>
        
        <form class="form-inline" method="post" id="frmSearchDistrictReg">
                    <input type="hidden" id="SearchDistrictReg" name="SearchDistrictReg" >
                    <table class="table">
                        <tr>
                                <td>
                                   <label>Select registered Year: </label>
                                    <select class="form-control" id="regyearDS" name="regyearDS">
                                     <?php foreach ($listregYear as $optionMemberList) { ;?>
                                        <option value="<?php echo $optionMemberList['regyearID']; ?>"><?php echo $optionMemberList['regYear']; ?></option>
                                    <?php  } ;?>
                                    </select> 
                                <button type="button" class="btn btn-info" onclick="SearchDistrictReg1()">Display</button>
                               
                            </td>                                       
                        </tr>                               
                    </table>
                </form>
        
        

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    
                
                <div class="col-md-4">
                    <div class="box box-success">
                        <div class="box-body box-profile">
                            
                            <?php foreach($getSeasonHeader as $seasonheader){?>
                            <?php if($_SESSION['nasfam_usertype'] == '3') { ?>
                            <strong>Season Details</strong>
<!--                            <button type="button" class="btn btn-info btn-simple btn-xs pull-right" data-toggle="modal" data-target="#editSeasonHeaderModal"> <i class="fa fa-edit"></i> New Season </button> -->
                            <button type="button" class="btn btn-info btn-simple btn-xs pull-right" data-toggle="modal" data-target="#editSeasonHeaderModal"> <i class="fa fa-edit"></i> Edit</button>
                            <hr>
                            <?php } ?>
                            <p class="text-muted">
                                <?php if($_SESSION['nasfam_usertype'] == '1') { ?>
                                <?php }else{ ?>
                                <strong>IPC:</strong> <?php echo $seasonheader['ipc']; ?><br>
                                <?php } ?>
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
                        <?php if($_SESSION['nasfam_usertype'] == '3') { ?>
                            <strong>Procurement Details</strong>
                            
                            <button type="button" class="btn btn-info btn-simple btn-xs pull-right" data-toggle="modal" data-target="#InsertAdvanceModal"> <i class="fa fa-money"></i> Add Advance</button>
                            <hr>
                            <?php } ?>
                       
                        <strong>Total Advance (MWK): </strong> <?php echo $seasonheader['advance']; ?><br>
                        <strong>Advance to Date (MWK): </strong> <?php  $AdvanceToDate = $seasonheader['advance'] - $totalspent; echo $AdvanceToDate; ?><br>
                        <strong>Total Spent (MWK): </strong> <?php echo $totalspent; ?><br>
                        <strong>Variance (KG's): </strong> <?php  echo $variance; ?><br>
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
                                <strong>Male: </strong> <?php echo $nonemembermale ?><br>
                                <strong>Female: </strong> <?php echo $nonememberfemale ?><br>
                                <strong>Total: </strong> <?php echo $nonemembers ?>
                            </div>
                            <div class="col-md-6">
                                <strong>MEMBERS</strong><br>
                                <strong>Male: </strong> <?php echo $countMales ?><br>
                                <strong>Female: </strong> <?php echo $countFemales ?><br>
                                <strong>Total: </strong> <?php echo $members ?>
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
                            <!--<li class="active"><a href="#summaries" data-toggle="tab"><strong>Seasonal Summary</strong></a></li>-->
                            <!--<li><a href="#buyer" data-toggle="tab"><strong>Buying</strong></a></li>-->
                            
                            

                            <li class="active"><a href="#marketcenters" data-toggle="tab"><strong>Market Center</strong></a></li>
                            <li><a href="#buyers" data-toggle="tab"><strong>Buyers</strong></a></li>
                            <li><a href="#purchases" data-toggle="tab"><strong>Purchases</strong></a></li>
                            
                            
                            <li><a href="#warehouse" data-toggle="tab"><strong>Warehouse</strong></a></li>
                            <li><a href="#sorting" data-toggle="tab"><strong>Shelling</strong></a></li>
                            <li><a href="#grading" data-toggle="tab"><strong>Sorting and Grading</strong></a></li>
                            
                            <li><a href="#dispatch" data-toggle="tab"><strong>Dispatch</strong></a></li>
                            
                            <li><a href="#ipcadvance" data-toggle="tab"><strong>IPC Advance</strong></a></li>
                            <li><a href="#mkcadvance" data-toggle="tab"><strong>MKC Advance</strong></a></li>
                        </ul>
                        <div class="tab-content">                           
                            <div class="tab-pane" id="summaries"><!-- Summaries -->
                                <h3>Seasonal Totals</h3>
                                <table id="summary1" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th>Market Center</th>
                                          <th>Total QTY (KGs)</th>
                                          <th>Receipt Total (MWk)</th>
                                        </tr>
                                    </thead>                                   
                                </table><hr>                             
                            </div>                            
                            <div class="tab-pane  active" id="marketcenters"> <!-- Market Centres -->
                                <h3>Market Centres</h3>
                                <table id="marketcenterstbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Market Center Name</th>
                                            <th>Market Center Code</th>
                                            <th>Gacs</th>
                                            <th>Advance to Date (MWK)</th>
                                            <th>STATUS</th>
                                            <th>Total Spent (MWK)</th>
                                             <th>Total Bought (KGs)</th>                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>                                
                            </div>
                            
                            <div class="tab-pane" id="buyers"><!-- Buyers -->
                                <h3>Buyers</h3><hr>
                                <table id="buyerstbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Buyer Code</th>
                                            <th>Gender</th>
                                            <th>Contacts</th>
                                            <th>Market Centre</th>
                                            <th>Receipt Total</th>
                                            <th>Total (KGs)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="tab-pane" id="purchases"><!-- Purchases -->
                                <h3>Purchases</h3><hr>
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
                                          <!--<th>Cum</th>-->
                                          <th>Price</th>
                                          <th>Mkw</th>
                                          
                                          <th>Action</th>
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
                            
                            <div class="tab-pane" id="warehouse"><!-- Warehouse -->
                                <h3>Warehouse</h3><hr>
                                <table id="warehousetbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Warehouse</th>
                                            <th>Code</th>
                                            <th>IPC</th>
                                            <th>Status</th>
                                            <th>Casual Workers</th>
                                            <th>CG 7 Total</th>
                                            <th>CHALIM Total</th>
                                            <th>Total QTY (KGs)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane" id="sorting"><!-- Sorting -->
                                <h3>Shelling</h3><hr>
                                <table id="sortingtbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th>Casual Worker</th>
                                          
                                          <th>CG7 - Total QTY (KGs)</th>
                                          <th>CG7 - Gradeouts</th>
                                          <th>CG7 - Shells</th>
                                          
                                          <th>CHALIM - Total QTY (KGs)</th>
                                          <th>CHALIM - Gradeouts</th>
                                          <th>CHALIM - Shells</th>
                                          
                                          <th>Total QTY (KGs)</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="grading"><!-- Grading -->
                                <h3>Sorting and Grading</h3><hr>
                                <table id="gradingtbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Warehouse</th>
                                            <th>CG7 - Grade 1</th>
                                            <th>CG7 - Grade 2</th>
                                            <th>CG7 - Grade 3</th>
                                            <th>CG7 - Grade 4</th>
                                            <th>CG7 - Grade 5</th>
                                            <th>CG7 Total</th>
                                            <th>CHALIM - Grade 1</th>
                                            <th>CHALIM - Grade 2</th>
                                            <th>CHALIM - Grade 3</th>
                                            <th>CHALIM - Grade 4</th>
                                            <th>CHALIM - Grade 5</th>
                                            <th>CHALIM Total</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="dispatch">
                                <h3>Dispatch</h3><hr>
                                 <table id="dispatchtbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>GAC</th>
                                            <th>Destination</th>
                                            <th>CG7 Sent (KGs)</th>
                                            <th>CHALIM Sent (KGs)</th>
                                            <th>Total Sent (KGs)</th>
                                            <th>CG7 Received (KGs)</th>
                                            <th>Chalim Received (KGs)</th>
                                            <th>Total Received (KGs)</th>
                                            <th>Status</th>
                                            <th>Notes</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($lstDispatchList as $value){ 
                                            $total = $value['cg7'] + $value['chalim'];
                                            if($value['confirmed'] == '1'){
                                                $confirmation = 'YES';
                                            }else{
                                                $confirmation = 'NO';
                                            }
                                            
                                            ?>
                                        <tr>
                                            <td><?php echo $value['departuredate'] ?></td>
                                            <td><?php echo $value['departure'] ?></td>
                                            <td><?php echo $value['destination'] ?></td>
                                            <td><?php echo $value['cg7'] ?></td>
                                            <td><?php echo $value['chalim'] ?></td>
                                            <td><?php echo $total ?></td>
                                            <td><?php echo $confirmation ?></td>
                                            <td><?php echo $value['confirmedby'] ?></td>
                                            <td><?php echo $value['confirmeddate'] ?></td>
                                            <td><?php echo $value['notes'] ?></td>
                                            <td><?php echo $value['status'] ?></td>
                                            <td> 
                                                <button onclick="editDispatch(<?php echo $value['did'] ?>,<?php echo '\''.$value['departuredate'].'\'' ?>,<?php echo $value['cg7'] ?>,<?php echo $value['chalim'] ?>,<?php echo '\''.$value['confirmedby'].'\'' ?>,<?php echo '\''.$value['confirmeddate'].'\'' ?>,<?php echo '\''.$value['status'].'\'' ?>,<?php echo '\''.$value['notes'].'\'' ?>)" rel="tooltip" title="Edit/update Dispatch" class="btn btn-success btn-xs" ><i class="fa fa-edit"></i> Edit</button>
                                                <button onclick="deleteDispatch(<?php echo $value['did'] ?>,<?php echo $value['season'] ?>)" rel="tooltip" title="Delete Dispatch" class="btn btn-danger btn-xs" ><i class="fa fa-trash"></i> DELETE</button>
                                            </td>
                                        </tr>                                        
                                        <?php } ?>                                       
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="ipcadvance">
                                <h3>IPC Advance</h3><hr>
                                <table id="ipcadvancetbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>                                           
                                            <th>Advance Amount</th>
                                            <th>Advance Date</th>
                                            <th>Remarks</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if ($ListIPCadvance == 0) {
                                            ?>
                                              <tr> 
                                              <td>Season</td>
                                              <!--<td>Action</td>-->
                                               </tr>
                                           <?php   }
                                              else 
                                              {
                                                 foreach($ListIPCadvance as $value)
                                                      {                                   
                                                     ?>    
                                               <tr> 
                                                  <td><?php echo $value['amount']; ?></td>
                                                  <td><?php echo $value['confirmeddate']; ?></td>
                                                  <td><?php echo $value['remarkes']; ?></td>
                                                  
                                                  </tr>
                                               <?php  }
                                              }
                                              ?> 
                                    </tbody>
                                </table> 
                            </div>
                            <div class="tab-pane" id="mkcadvance">
                                <h3>Market Advance</h3><hr>
                                <table id="mkcadvancetbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Market Center</th>
                                            <th>Advance Amount</th>
                                            <th>Advance Date</th>
                                            <th>Remarks</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if ($ListMKCadvance == 0) {
                                            ?>
                                              <tr> 
                                              <td>Season</td>
                                              <!--<td>Action</td>-->
                                               </tr>
                                           <?php   }
                                              else 
                                              {
                                                 foreach($ListMKCadvance as $value)
                                                      {                                   
                                                     ?>    
                                               <tr>
                                                   <td><?php echo $value['mkc']; ?></td>
                                                  <td><?php echo $value['amount']; ?></td>
                                                  <td><?php echo $value['confirmeddate']; ?></td>
                                                  <td><?php echo $value['remarkes']; ?></td>
                                                  
                                                  </tr>
                                               <?php  }
                                              }
                                              ?> 
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
        
        //delete dispatch
        function deleteDispatch(item,item2){
            if (window.confirm('are you sure you want to Delete this Dispatch Record?'))
                {
                    window.location.href = "seasondetails.php?delDID="+item+"&delSID="+item2;
                }else{
                    
                }
        }
        
        //dispatch details
        function editDispatch(item,item1,cg7,chalim,confirmedby,confirmeddate,status,notes){
            $("#editDispatchID").val(item); //dispatch id
            $("#dateDispatch").val(item1);//date
            $("#cg7Dispatch").val(cg7);//cg7
            $("#chalimDispatch").val(chalim);//chalim
            $("#confirmedbyDispatch").val(confirmedby);//confirmedby
            $("#confirmeddateDispatch").val(confirmeddate);//confirmeddate
            $("#statusDispatch").val(status);//status
            $("#notesDispatch").val(notes);//notes
            $('#editDispatchModal').modal('show'); //editDispatchModal
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
        
        function editBuyerMKCs(item){
            $("#editMKCBuyersID").val(item); 
            $('#BuyerMKCModal').modal('show');
        }
        
        function editWarehouseIPC(item){
            $("#editWarehouseIPCID").val(item); //editWarehouseIPCID
            $('#WarehouseIPCModal').modal('show');
        }
        
        function editWarehouse(item,item2){
            $("#editWarehouseNameID").val(item); //editWarehouseIPCID
            $("#warehouseName").val(item2); //editWarehouseIPCID
            $('#editWarehouseModal').modal('show');
        }
        
        function editMarketPurchase(item,item2,item3,item4,item5,item6,item7,item8){
            $("#editpurchaseid").val(item);
            $("#mkc").val(item2);
            $("#mnumber").val(item3);
            $("#editfarmer").val(item3);
            
            $("#receipt").val(item4);
            $("#rdate").val(item5);
            
            $("#qty").val(item6);
            $("#price").val(item7);
            $("#mwk").val(item8);
            
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
        
        function dispatchUpdateModal(dispatchid){
            $("#editDispatchID").val(dispatchid);
//            $("#departuredate").val(departuredate);
//            $("#departure").val(departure);
//            $("#destination").val(destination);
//            alert('Update dispatch');
            $('#editDispatchModal').modal('show');
        }
        
        $(function() {
            $('#rdate').datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd-mm-yy'
            });
            
            //confirmeddateDispatch
            $('#confirmeddateDispatch').datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd-mm-yy'
            });
            
            $('#dateDispatch').datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd-mm-yy'
            });
            
            //dateDispatch
            
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
           //summary1
           var summary1 = <?php echo json_encode($seasonSummaryMarketCentre); ?>;
           $('#summary1').DataTable( {
                data:           summary1,
//                deferRender:    true,
//                scrollY:        350,
                //scrollX:        true,
//                scrollCollapse: true,
//                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print', 'colvis'
                ]
            } );
            
           //summary2
           $('#summary2').DataTable( {
                //data:           gradinglist,
//                deferRender:    true,
//                scrollY:        350,
                //scrollX:        true,
//                scrollCollapse: true,
//                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print', 'colvis'
                ]
            } );
           
           //dispatchtbl
           var dispatching = <?php echo json_encode($lstDispatch); ?>;
           $('#dispatchtbl').DataTable( {
                data:           dispatching,
//                deferRender:    true,
//                scrollY:        350,
                scrollX:        true,
//                scrollCollapse: true,
//                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print', 'colvis'
                                                
                    ,
                    {
                        text: 'Add Dispatch data',
                        action: function () {
                            $('#addDispatchModal').modal('show');
                        }
                    }
                    
                ]
            } );
            
            //IPC advance
            var ipcadvancelist = <?php  echo json_encode($IPCadvanceData); ?>;
           $('#ipcadvancetbl').DataTable( {
                //data:           ipcadvancelist,
//                deferRender:    true,
//                scrollY:        350,
               // scrollX:        true,
//                scrollCollapse: true,
//                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print', 'colvis'
                                                 
//                    ,
//                    {
//                        text: 'Add Grading data',
//                        action: function () {
//                            $('#addGradingModal').modal('show');
//                        }
//                    }
                   
                ]
            } );
            
           // var ipcadvancelist = <?php  //echo json_encode($IPCadvanceData); ?>;
           $('#mkcadvancetbl').DataTable( {
                //data:           ipcadvancelist,
//                deferRender:    true,
//                scrollY:        350,
               // scrollX:        true,
//                scrollCollapse: true,
//                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print', 'colvis'
                                                 
//                    ,
//                    {
//                        text: 'Add Grading data',
//                        action: function () {
//                            $('#addGradingModal').modal('show');
//                        }
//                    }
                   
                ]
            } );
           
           
           //gradingtbl
           var gradinglist = <?php  echo json_encode($lstGrading); ?>;
           $('#gradingtbl').DataTable( {
                data:           gradinglist,
//                deferRender:    true,
//                scrollY:        350,
                scrollX:        true,
//                scrollCollapse: true,
//                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'print', 'colvis'
                                                 
                    ,
                    {
                        text: 'Add Sorting and Grading data',
                        action: function () {
                            $('#addGradingModal').modal('show');
                        }
                    }
                   
                ]
            } );
           
           
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
                                                 
                    ,
                    {
                        text: 'Add Warehouse(s)',
                        action: function () {
                            $('#addWarehouseModal').modal('show');
                        }
                    }
                   
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
                data:           data2,
                deferRender:    true,
                scrollY:        400,
                scrollX:        true,
//                scrollCollapse: true,
                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                                               
                    ,
                    {
                        text: 'Add Purchase(s)',
                        action: function () {
                            $('#addPurchasesModal').modal('show');
                        }
                    }
                    
                ]
            } );
            
            //sortingtbl
            var sortingdata = <?php echo json_encode($lstCasualWorkers); ?>;
           
           $('#sortingtbl').DataTable( {
                data:           sortingdata,
                //deferRender:    true,
                //scrollY:        600,
                scrollX:        true,
//                scrollCollapse: true,
               // scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                                             
                    ,
                    {
                        text: 'Add Shelling Data',
                        action: function () {
                            $('#addSortingModal').modal('show');
                        }
                    }
                                                
                    ,
                    {
                        text: 'Add Casual Workers',
                        action: function () {
                            $('#addCasualWorkerModal').modal('show');
                        }
                    }
                   
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
                                              
                    ,
                    {
                        text: 'Add Market Center',
                        action: function () {
                            $('#addMarketCenterModal').modal('show');
                        }
                    }
                   
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
                                              
                    ,
                    {
                        text: 'Add Buyer(s)',
                        action: function () {
                            $('#addBuyersModal').modal('show');
                        }
                    }
                   
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
                                              
                    ,
                    {
                        text: 'Add Casual Workers',
                        action: function () {
                            $('#addCasualWorkerModal').modal('show');
                        }
                    }
                    
                ]
            } );          
       });
       
       //update dispatch
        function editDispatchTing(){
            if (window.confirm('Are you sure you want to Update Dispatch Data?'))
                    {
                        _("editDispatch").value = "editDispatch";        
                        _("editDispatchform").method = "post";
                        _("editDispatchform").action = "seasondetails.php";
                        _("editDispatchform").submit();
                    }else{

                    }
        }
       
       //add dispatch data
       function addnewDispatchDatas(){
            if (window.confirm('Are you sure you want to add Dispatch Data?'))
                {
                    _("addnewDispatchData").value = "addnewDispatchData";        
                    _("addnewDispatchDataform").method = "post";
                    _("addnewDispatchDataform").action = "seasondetails.php";
                    _("addnewDispatchDataform").submit();
                }else{

                }
        }
       
       //add grading
        function addnewGradingDatas(){
            if (window.confirm('Are you sure you want to add Grading Data?'))
                {
                    _("addnewGradingData").value = "addnewGradingData";        
                    _("addnewGradingDataform").method = "post";
                    _("addnewGradingDataform").action = "seasondetails.php";
                    _("addnewGradingDataform").submit();
                }else{

                }
        }
       
       //edit warehouse name
        function editWarehouseName(){
            if (window.confirm('Are you sure you want to edit warehouse Name?'))
                {
                    _("editWarehouseName").value = "editWarehouseName";        
                    _("editWarehouseNameform").method = "post";
                    _("editWarehouseNameform").action = "seasondetails.php";
                    _("editWarehouseNameform").submit();
                }else{

                }
        }
       
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
       
       //insert advance
       function InsertAdvance(){
           if (window.confirm('are you sure you want to insert advance?'))
                {
                    _("InsertAdvance").value = "InsertAdvance";        
                    _("InsertAdvanceform").method = "post";
                    _("InsertAdvanceform").action = "seasondetails.php";
                    _("InsertAdvanceform").submit();
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
        
        function SearchDistrictReg1(){
            _("SearchDistrictReg").value = "SearchDistrictReg";        
            _("frmSearchDistrictReg").method = "post";
            _("frmSearchDistrictReg").action = "seasondetails.php";
            _("frmSearchDistrictReg").submit();
        }
       </script>
      </body>
</html>