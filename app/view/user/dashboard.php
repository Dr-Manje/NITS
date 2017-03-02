<?php  
session_start();
include_once ('../../controller/user/dashboardcontroller.php'); ?>
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
      <?php if(isset($_SESSION['nasfam_regyearID'])){ ?>
      <div class="wrapper">
      <!-- Main Header -->
    <?php   include ('../common/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
        <?php   include ('../common/nav.php');?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin
            <small>Control Panel</small>
          </h1>
            <h1>
            <form class="form-inline" method="post" id="frmSearchDistrictReg">
                <input type="hidden" id="SearchDistrictReg" name="SearchDistrictReg" >
                <select class="form-control" id="regyearDS" name="regyearDS">
                <?php foreach ($listregYear as $optionMemberList) { ;?>
                   <option value="<?php echo $optionMemberList['regyearID']; ?>"><?php echo $optionMemberList['regYear']; ?></option>
               <?php  } ;?>
               </select> 
                <button type="button" class="btn btn-info" onclick="SearchDistrictReg1()">Display</button>
            </form>
            </h1>
            
            
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Control Panel</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
           <!-- Small boxes (Stat box) -->
           
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>1</h3>
                  <p>Members Registered</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>1</h3>
                  <p>Male</p>
                </div>
                <div class="icon">
                  <i class="ion ion-man"></i>
                </div>
                <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>1</h3>
                  <p>Female</p>
                </div>
                <div class="icon">
                  <i class="ion ion-woman"></i>
                </div>
                <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
           <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>1</h3>
                  <p>Member Target</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-people"></i>
                </div>
                <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
              </div>
            </div><!-- ./col -->
            <!--
            <div class="col-lg-3 col-xs-6">
               small box 
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Unique Visitors</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div> ./col -->
          </div><!-- /.row -->
          
         
       <!-- /.row -->
          
           
            
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

      <!-- Control Sidebar -->
      <?php // include('sidebar.php') ;?>
    </div><!-- ./wrapper -->
    
      
      <?php }else{?>
      <div class="wrapper">

      <!-- Main Header -->
    <?php   include ('../common/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
        <?php   include ('../common/nav.php');?>
       

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
           <!-- Small boxes (Stat box) -->
       
       <!-- /.row -->
            
           
            
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

     
    </div><!-- ./wrapper -->
    <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- modal content -->
                <div class="modal-content">
                    <div class="modal-header">                        
                        <h4 class="modal-title">Add new Season</h4>
                    </div>
                    <div class="modal-body">
                        <p>Welcome, There is no Season registered in the system, to proceed with the system please add a registration year in the text box below and Save when done.</p><hr>
                        <form role="form" id="Addregyearform" onsubmit="return false">
                            <input type="hidden" id="Addregyear" name="Addregyear" >
                            <?php // echo 'Reg year ID: '.$_SESSION['regyearID'].'<br>' ?>
                            <?php // echo 'Reg year: '.$_SESSION['regyear'].'<br>' ?>
                            <div class="form-group">
                                <label class="control-label" for="startdate">Start Date</label>
                                <input type="text" class="form-control" name="startdate" id="startdate" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="enddate">End Date</label>
                                <input type="text" class="form-control" name="enddate" id="enddate" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="seasonname">Season</label>
                                <input type="text" class="form-control" name="seasonname" id="seasonname" />
                            </div>
                          </form> 
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" onclick="saveregyear()">Save</button>
                        <button type="button" class="btn btn-default" onclick="logout()">cancel</button>
                    </div>
                </div>
            </div>
        </div>
      
      <?php } ?>
    
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
        
        $(function() {
            //$( "#dateitem" ).datepicker( { dateFormat: 'dd/mm/yy' }); 
            //revenue dates
            $('#startdate').datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'y-m-d'
            });
            
            $('#enddate').datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'y-m-d'
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
      
        function saveregyear(){
            _("Addregyear").value = "Addregyear";        
            _("Addregyearform").method = "post";
            _("Addregyearform").action = "dashboard.php";
            _("Addregyearform").submit();
        }
      
        function AddAdmin(){
            _("addAdmin").value = "addAdmin";        
            _("addAdminform").method = "post";
            _("addAdminform").action = "superdash.php";
            _("addAdminform").submit();
        }

    </script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>


</html>