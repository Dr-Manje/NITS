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
 tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
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
            Warehouse Grading Details
            <!--<small></small>-->
          </h1>
          <ol class="breadcrumb">
              <li><a href="seasondetails.php?sid=<?php echo $id ?>"><i class="fa fa-users"></i> Back To Seasons</a></li>
            <!--<li class="active">Profile</li>-->
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <!--<h3>Buyer Details Header</h3>-->
                    <div class="box box-success">
                        
                        <div class="box-body box-profile">
                            <h3 class="profile-username text-center"> <?php echo $Warehouse; ?></h3>
                            <p class="text-center"></p>
                            <hr>
                            <strong>Grading Summary</strong>
                            <hr>
                            <p class="text-muted">
                                <strong>CG7 Grade 1:</strong> <?php echo $CG7g1; ?><br>
                                <strong>CG7 Grade 2:</strong> <?php echo $CG7g2; ?><br>
                                <strong>CG7 Grade 3:</strong> <?php echo $CG7g3; ?><br>
                                <strong>CG7 Grade 4:</strong> <?php echo $CG7g4; ?><br>
                                <strong>CG7 Grade 5:</strong> <?php echo $CG7g5; ?><br>
                                <strong>CG7 Total:</strong> <?php echo $CG7total; ?>
                            </p>
                            <hr>
                            <p class="text-muted">                               
                                <strong>CHALIM Grade 1:</strong> <?php echo $CHALIMg1; ?><br>
                                <strong>CHALIM Grade 2:</strong> <?php echo $CHALIMg2; ?><br>
                                <strong>CHALIM Grade 3:</strong> <?php echo $CHALIMg3; ?><br>
                                <strong>CHALIM Grade 4:</strong> <?php echo $CHALIMg4; ?><br>
                                <strong>CHALIM Grade 5:</strong> <?php echo $CHALIMg5; ?><br>
                                <strong>CHALIM Total:</strong> <?php echo $CHALIMtotal; ?>
                            </p>
                            <hr>
                            <strong>Grading Total:</strong> <?php echo $total; ?>
                        </div>                    
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box box-success">
                        <div class="box-body box-profile">
                            <h3>Grading Details</h3><hr>
                            <table id="gradingtbl" class="table table-bordered table-striped" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Variety</th>
                                        <th>Grade</th>
                                        <th>Quantity (KGs)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Variety</th>
                                        <th>Grade</th>
                                        <th>Quantity (KGs)</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach($GradingDataWarehouse as $value){ ?>
                                    <tr>
                                        <td><?php echo $value['pDate'] ?> </td>
                                        <td><?php echo $value['variety'] ?></td>
                                        <td><?php echo $value['grade'] ?></td>
                                        <td><?php echo $value['quantity'] ?></td>
                                        <td>
                                            <a rel="tooltip" title="Edit/Update Grading Details" class="btn btn-info btn-simple btn-xs openModalLinkGradingDetails" href="/" 
                                                data-id="<?php echo $value['gradingid'] ?>"
                                                data-viewdate="<?php echo $value['eDate'] ?>" 
                                                data-viewvariety="<?php echo $value['variety'] ?>"
                                                data-viewgrade="<?php echo $value['grade'] ?>"
                                                data-viewquantity="<?php echo $value['quantity'] ?>"
                                                >
                                                 <i class="fa fa-edit"></i>
                                            </a>
                                            <a rel="tooltip" title="Delete Grading Details" class="btn btn-info btn-danger btn-xs openModalLinkDeleteGradingDetails" href="/" 
                                                data-id="<?php echo $value['gradingid'] ?>"
                                                >
                                                 <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                       
                    </div>
                </div>
            </div>
         
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

    
    </div><!-- ./wrapper -->
    
    <!-- MODALS -->
    <?php// include('seasonmodals.php') ;?>
    
    <!-- edit sorting -->
    <div id="UpdateCWGradingModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 id="UpdateCWDetailsModalTitle">Update Grading Details</h3><br>
            </div>
            <div class="modal-body">                                                           
                <form role="form" id="updateCWGradingform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="updateCWGrading" name="updateCWGrading" >
                <input type="text" id="CWgradingID" name="CWgradingID" >
                <input type="text" id="WHSid" name="WHSid" value="<?php echo $whsID ?>">
                <input type="text" id="Sid" name="Sid" value="<?php echo $id ?>">
                    <div class="form-group">
                        <label for="viewvariety">Variety:</label>
                        <select class="form-control" id="viewvariety" name="viewvariety">
                            <option value="CG7">CG7</option>
                            <option value="CHALIM">CHALIM</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="viewdate">Date:</label>
                        <input type="text" class="form-control" id="viewdate" name="viewdate"  />
                    </div>
                    <div class="form-group">
                        <label for="viewgrade">Grade:</label>
                        <input type="text" class="form-control" id="viewgrade" name="viewgrade"  />
                    </div>                   
                    <div class="form-group">
                        <label for="viewquantity">Quantity:</label>
                        <input type="text" class="form-control" id="viewquantity" name="viewquantity"  />
                    </div>
                </form>
            </div>                            
            <div class="modal-footer"> 
                <button class="btn btn-success" onclick="updateCWGradingDetails()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>
    
    <!-- DELETE SORTING ID -->
    <div id="DeleteGradingModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 id="UpdateCWDetailsModalTitle">Delete?</h3><br>
            </div>
            <div class="modal-body">                                                           
                <form role="form" id="gradingDeleteform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="gradingDeleteCW" name="gradingDeleteCW" >
                <input type="hidden" id="WHSid" name="WHSid" value="<?php echo $whsID ?>">
                <input type="hidden" id="Sid" name="Sid" value="<?php echo $id ?>">
                <input type="hidden" id="gradingDeleteID" name="gradingDeleteID" >
                <P>
                    Are you sure you want to delete?
                </P>
                </form>
                
            </div>                            
            <div class="modal-footer"> 
                <button class="btn btn-success" onclick="deleteGrading()">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
            </div>            
        </div>
    </div>
    
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
        
        $(function() {
            
            //edit casual worker details
            $(".openModalLinkCWDetails").click(function(e) {
                e.preventDefault();       
                $("#UpdateCWDetailsModalTitle").html('Casual Worker Details');

                $("#CWID").val($(this).data('id'));
                $("#viewfname").val($(this).data('viewfname'));
                $("#viewlname").val($(this).data('viewlname'));
                $("#viewgender").val($(this).data('viewgender'));
                //$("#viewwhs").val($(this).data('viewwhs'));

                $('#UpdateCWDetailsModal').modal('show');
            });
            
            //edit sorting data
            $(".openModalLinkGradingDetails").click(function(e) {
                e.preventDefault();       

                $("#CWgradingID").val($(this).data('id'));
                $("#viewdate").val($(this).data('viewdate'));
                $("#viewvariety").val($(this).data('viewvariety'));
                $("#viewgrade").val($(this).data('viewgrade'));
                $("#viewquantity").val($(this).data('viewquantity'));

                $('#UpdateCWGradingModal').modal('show');
            });
            
            //delete sorting data 
            $(".openModalLinkDeleteGradingDetails").click(function(e) {
                e.preventDefault();       
                $("#gradingDeleteID").val($(this).data('id'));
                $('#DeleteGradingModal').modal('show');
            });
            
            $('#viewdate').datepicker( {
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
            // Setup - add a text input to each footer cell
            $('#gradingtbl tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            // DataTable
            //var table = $('#gradingtbl').DataTable();
            
            var table = $('#gradingtbl').DataTable( {
               // data:           data2,
//                deferRender:    true,
//                scrollY:        400,
                //scrollX:        true,
//                scrollCollapse: true,
//                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );

            // Apply the search
            table.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        } );
       
//        $(document).ready(function() {       
//            // Setup - add a text input to each footer cell
//            $('#gradingtbl tfoot th').each( function () {
//                var title = $(this).text();
//                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
//            } );
//           
//           //$lstPurchases
//           //var data2 = <?php //echo json_encode($lstPurchases); ?>;
//           
//           $('#gradingtbl').DataTable( {
//               // data:           data2,
////                deferRender:    true,
////                scrollY:        400,
//                //scrollX:        true,
////                scrollCollapse: true,
////                scroller:       true,
//                dom: 'Bfrtip',
//                buttons: [
//                    'copy', 'excel', 'pdf', 'print', 'colvis'
//                ]
//            } );
//            
//             // Apply the search
//            table.columns().every( function () {
//                var that = this;
//
//                $( 'input', this.footer() ).on( 'keyup change', function () {
//                    if ( that.search() !== this.value ) {
//                        that
//                            .search( this.value )
//                            .draw();
//                    }
//                } );
//            } );
//           
//       });
       
        function updateCWSortingDetails(){
            if (window.confirm('Are you sure you want to update Sorting details?'))
                {
                    _("updateCWSorting").value = "updateCWSorting";        
                    _("updateCWSortingform").method = "post";
                    _("updateCWSortingform").action = "sortingdetails.php";
                    _("updateCWSortingform").submit();
                }else{

                }
        }
        
        function updateCWDetails(){
            if (window.confirm('Are you sure you want to update Casual Worker details?'))
                {
                    _("updateCWdetails").value = "updateCWdetails";        
                    _("updateCWform").method = "post";
                    _("updateCWform").action = "sortingdetails.php";
                    _("updateCWform").submit();
                }else{

                }
        }
       
        function updateBuyerDetails(){
            if (window.confirm('Are you sure you want to update buyer details?'))
                {
                    _("updateCW").value = "updateCW";        
                    _("updateCWform").method = "post";
                    _("updateCWform").action = "sortingdetails.php";
                    _("updateCWform").submit();
                }else{

                }
        }
       
       //addnewWarehouseSeason
        function deleteGrading(){
            _("gradingDeleteCW").value = "gradingDeleteCW";        
            _("gradingDeleteform").method = "post";
            _("gradingDeleteform").action = "gradingdetails.php";
            _("gradingDeleteform").submit();
        }
       
        function updateCWGradingDetails(){
            if (window.confirm('Are you sure you want to update Grading data?'))
                {
                    _("updateCWGrading").value = "updateCWGrading";        
                    _("updateCWGradingform").method = "post";
                    _("updateCWGradingform").action = "gradingdetails.php";
                    _("updateCWGradingform").submit();
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