<?php  
session_start();
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
/* tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }*/
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
            Donors  
            <!--<small>Locations</small>-->
          </h1>
<!--          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dispatch</a></li>
            <li class="active"> Locations</li>
          </ol>-->
        </section>

        <!-- Main content -->
        <section class="content">
        
        <!-- /.row -->
        <div class="row">
          <div class="col-xs-12">
             <div class="box box-success">
            <div class="box-header with-border">
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Donor Name</th>
                        <th>Donor Code</th>
                        <th>Donor Contact</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($LstDonors as $value){ ?>
                    <tr>
                        <td><?php echo $value['fieldname'] ?></td>
                        <td><?php echo $value['fieldcode'] ?></td>
                        <td><?php echo $value['contacts'] ?></td>
                        <th><?php echo $value['status'] ?></th>
                        <td>
                            <a rel="tooltip" title="Edit/Update Donors Location Details" class="btn btn-info btn-simple btn-xs openModalLinkDonorsDetails" href="/" 
                                    data-id="<?php echo $value['donorsid'] ?>"
                                    data-viewfieldname="<?php echo $value['fieldname'] ?>" 
                                    data-viewcontacts="<?php echo $value['contacts'] ?>"
                                >
                                 <i class="fa fa-edit"></i>
                            </a>
                            <?php if($value['status'] == 'INACTIVE'){ ?>
                                <a rel="tooltip" title="Activate Donor" class="btn btn-info btn-xs" href="donors.php?donorstat=<?php echo $value['donorsid'];?>&donstat=<?php echo $value['status'] ?>" >
                                    <i class="fa fa-play"></i>
                                </a><?php }else{ ?>
                                <a rel="tooltip" title="Deactivate Donor" class="btn btn-warning btn-xs" href="donors.php?donorstat=<?php echo $value['donorsid'];?>&donstat=<?php echo $value['status'] ?>" >
                                    <i class="fa fa-pause"></i>
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
                    
                    
                    <?php } ?>
                </tbody>
              </table>
             </div><!-- /.box-body -->
             <div class="box-footer clearfix">
                             
            </div><!-- /.box-footer -->
          </div><!-- /.box -->                   
          </div>
        </div>   <!-- /.row --> 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

     
    </div><!-- ./wrapper -->
    
    <!-- MODALS -->
    <div id="addDonorsModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>ADD Donors</h3>               
            </div>
            <div class="modal-body">                                                                               
                <form role="form" id="addDonorsform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="addDonors" name="addDonors" >
                    <div class="form-group">
                        <label for="editseason">Upload Donors</label>
                        <input class="form-group" type="file" name="file" />
                    </div>              
                </form>                    
            </div>                            
            <div class="modal-footer">                    
                <button class="btn btn-success" onclick="AddNewDonors()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>
    
    <div id="updateDonorsModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 id="UpdateCWDetailsModalTitle">Update Donor Details</h3><br>
            </div>
            <div class="modal-body">                                                           
                <form role="form" id="updateDonorform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="updateDonor" name="updateDonor" >
                <input type="hidden" id="DlID" name="DlID" >
                    <div class="form-group">
                        <label for="viewfieldname">Dispatch Location Name:</label>
                        <input type="text" class="form-control" id="viewfieldname" name="viewfieldname"  />
                    </div>                  
                    <div class="form-group">
                        <label for="viewcontacts">Contacts:</label>
                        <input type="text" class="form-control" id="viewcontacts" name="viewcontacts"  />
                    </div>
                </form>
            </div>                            
            <div class="modal-footer"> 
                <button class="btn btn-success" onclick="updateDonor()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>
   
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
        
        $('body').on('focus',".datepicker_recurring_start", function(){
            $(this).datepicker(
                    {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'y-m-d',
                onClose: function(dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    $(this).datepicker();
                    //$(this).datepicker('setDate', new Date(year, month, 1));
                }
        });
        });
        
        function updateDonor(){
            if (window.confirm('are you sure you want to Update Donor Details?'))
            {
                _("updateDonor").value = "updateDonor";        
                _("updateDonorform").method = "post";
                _("updateDonorform").action = "donors.php";
                _("updateDonorform").submit();
            }else{
                
            } 
        }
        
        function AddNewDonors(){           
            if (window.confirm('are you sure you want to add Donors?'))
            {
                _("addDonors").value = "addDonors";        
                _("addDonorsform").method = "post";
                _("addDonorsform").action = "donors.php";
                _("addDonorsform").submit();
            }else{

            } 
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
            
            $(".openModalLinkDonorsDetails").click(function(e) {
                e.preventDefault();       
                $("#DlID").val($(this).data('id'));
                $("#viewfieldname").val($(this).data('viewfieldname'));
                $("#viewcontacts").val($(this).data('viewcontacts'));

                $('#updateDonorsModal').modal('show');
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
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis',
                    {
                        text: 'Register New Donor(s)',
                        action: function () {
                            $('#addDonorsModal').modal('show');
                        }
                    }
                ]
            } );
            
            $('#exampleLstActivities').DataTable( {
                dom: 'Bfrtip',
                buttons: [
//                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );

        } );
    </script>
  </body>
</html>