<?php  include_once ('../../controller/user/dashboardcontroller.php'); ?>
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
    
    <link rel="stylesheet" href="../../../dist/css/skins/skin-blue.min.css">

    
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

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
    <?php   include ('../common/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
        <?php //  include ('common/supernav.php');?>
       

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
<!--        <section class="content-header">
          <h1>
            Admin
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Control Panel</li>
          </ol>
        </section>-->

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
           
          <!-- SCHOOLS -->
            <div class="row">
                <div class="col-xs-12">
                <div class="box">
                <div class="box-header">
                    <h3>Registration Year</h3><hr>
                </div><!-- /.box-header -->
                <div class="box-body">
                        <form role="form" id="addSchoolform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="addSchool" name="addSchool" >
                <div class="row">
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="schoolname">School Name</label>
                        <input type="text" class="form-control" name="schoolname" id="schoolname" />
                    </div>
                </div>
                
                <div class="col-sm-4">
                    <div>
                        <label for="logo">upload school logo</label>
                        <input type="file" name="logo" id="logo" />
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="country">Country:</label>
                        <input type="text" class="form-control" id="country" name="country"  />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="region">Region:</label>
                        <input type="text" class="form-control" id="region" name="region"  />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="city">City:</label>
                        <input type="text" class="form-control" id="city" name="city"  />
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="mailaddress">Mail Address:</label>
                        <input type="text" class="form-control" id="mailaddress" name="mailaddress"  />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="physicaladdress">Physical Address:</label>
                        <input type="text" class="form-control" id="physicaladdress" name="physicaladdress"  />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="web">Website:</label>
                        <input type="text" class="form-control" id="web" name="web"  />
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email"  />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="tel_1">Telephone:</label>
                        <input type="text" class="form-control" id="tel_1" name="tel_1"  />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="tel_2">Telephone 2:</label>
                        <input type="text" class="form-control" id="tel_2" name="tel_2"  />
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="facebook">Facebook:</label>
                        <input type="text" class="form-control" id="facebook" name="facebook"  />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="twitter">Twitter:</label>
                        <input type="text" class="form-control" id="twitter" name="twitter"  />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group label-floating">
                        <label class="control-label" for="instagram">Instagram:</label>
                        <input type="text" class="form-control" id="instagram" name="instagram"  />
                    </div>
                </div>
                </div>
                </form>     
                </div><!-- /.box-body -->
              </div><!-- /.box --> 
                </div>
            </div><!-- END SCHOOLS /.row -->
            
           
            
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

      <!-- Control Sidebar -->
      <?php // include('sidebar.php') ;?>
    </div><!-- ./wrapper -->

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
            $( "#dob" ).datepicker( { dateFormat: 'y-m-d' });
            
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
        
//      $(function () {
//        $("#example1").DataTable();
//        $('#example2').DataTable({
//            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
//          "paging": true,
//          "lengthChange": false,
//          "searching": false,
//          "ordering": true,
//          "info": true,
//          "autoWidth": false
//          
////          buttons: ['copy',
////            {
////                text: 'My button',
////                action: function ( e, dt, node, config ) {
////                    alert( 'Button activated' );
////                }
////            }
////        ]
//        });
//      });
      
        
        function assignSchool(){
            _("AssignSchool").value = "AssignSchool";        
            _("AssignSchoolform").method = "post";
            _("AssignSchoolform").action = "superdash.php";
            _("AssignSchoolform").submit();
        }
        
        function activateSchool(){
            _("activateSchool").value = "activateSchool";        
            _("activateSchoolform").method = "post";
            _("activateSchoolform").action = "superdash.php";
            _("activateSchoolform").submit();
        }
      
        function AddAdmin(){
            _("addAdmin").value = "addAdmin";        
            _("addAdminform").method = "post";
            _("addAdminform").action = "superdash.php";
            _("addAdminform").submit();
        }
       
       function AddSchool(){
            _("addSchool").value = "addSchool";        
            _("addSchoolform").method = "post";
            _("addSchoolform").action = "superdash.php";
            _("addSchoolform").submit();
        }
    </script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>


</html>