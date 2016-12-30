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
            Member List For:
            <small><?php // echo $districtName; ?> club</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> IPC</a></li>
            <li class="active"> Summary</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
        <!-- /.row -->
        <div class="row">
          <div class="col-xs-12">
             <div class="box box-success">
            <div class="box-header with-border">
                <ol class="breadcrumb">
                    <li><a href="districtsipcs.php"> Back to Districts</a></li>
                    <li><a href="ipcdetails.php?ipcdid=<?php echo $ipcref ?>"> Back to IPCs</a></li>
                    <li><a href="assdetails.php?assdid=<?php echo $assocref ?>"> Back to Association</a></li>
                    <li><a href="gacdetails.php?gacdid=<?php echo $assocref ?>"> Back to GACs</a></li>
                    <li><a href="clubdetails.php?clubdid=<?php echo $gacid ?>"> Back to Clubs</a></li>
                   <li class="active"> Members</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12">
                        District: <?php echo $districtname ?><br>
                        IPC: <a href="ipcdetails.php?ipcdid=<?php echo $ipcref ?>"><?php echo $ipcname ?></a><br>
                        Association: <a href="assdetails.php?assdid=<?php echo $assocref ?>"><?php echo $assocname ?></a><br>
                        Gac: <a href="gacdetails.php?gacdid=<?php echo $assocref ?>"><?php echo $gacname ?></a><br>
                        Club: <a href="clubdetails.php?clubdid=<?php echo $gacid ?>"><?php echo $clubname ?></a><br>
                    </div> 
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <td>Member Number</td>
                        <td>Member Name</td>
                        <td>Gender</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                     <?php
                      if ($listClubMembers == 0) {
                      ?>
                        <tr> 
                        <td>Member Number</td>
                        <td>Member Name</td>
                        <td>Gender</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($listClubMembers as $value)
                                { 
//                                    $ipcid = $value['clubsID'];
//                                    $listClubMembers = $districts->listClubMembers($assid);
//                                    $totalass = count($listClubMembers);
                               ?>    
                         <tr> 
                            <td><?php  echo $value['memberNumber']; ?></td>
                        <td><?php echo $value['names'].' '.$value['names']; ?></td>
                        <td><?php echo $value['gender']; ?></td>
                        <td>
                            <a rel="tooltip" title="View more IPC details (Clubs, MEMBERS etc)" class="btn btn-info btn-xs" 
                               href="memberprofile.php?Sid=<?php echo $value['memberID'];?>">View Profile
                            </a>
                        </td>
                            </tr>
                         <?php  }
                        }
                        ?> 
                </tbody>
              </table>
             </div><!-- /.box-body -->
             <div class="box-footer clearfix">
              <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#DistrictsTargetsModal">Add New Member Activity Data</button>-->
              <!--<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
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
    <!-- INCLUDE ADD IPC ITEM MODAL -->
    
    <?php include('insertipcitem.php') ;?>
    
    <!-- END INCLUDE ADD IPC ITEM MODAL -->
   
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
            
            
              $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } ); 
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
            _("UpdateTrainingTargets").value = "UpdateTrainingTargets";        
            _("UpdateTrainingTargetsform").method = "post";
            _("UpdateTrainingTargetsform").action = "targets.php";
            _("UpdateTrainingTargetsform").submit();
        }
        
        function UpdateCDPTargets(){
            _("UpdateCDPTargets").value = "UpdateCDPTargets";        
            _("UpdateCDPTargetsform").method = "post";
            _("UpdateCDPTargetsform").action = "targets.php";
            _("UpdateCDPTargetsform").submit();
        }
        
        function UpdatePolicyTargets(){
            _("UpdatePolicyTargets").value = "UpdatePolicyTargets";        
            _("UpdatePolicyTargetsform").method = "post";
            _("UpdatePolicyTargetsform").action = "targets.php";
            _("UpdatePolicyTargetsform").submit();
        }
        
        function UpdateFarmTargets(){
            _("UpdateFarmTargets").value = "UpdateFarmTargets";        
            _("UpdateFarmTargetsform").method = "post";
            _("UpdateFarmTargetsform").action = "targets.php";
            _("UpdateFarmTargetsform").submit();
        }
        
    </script>
  </body>


</html>