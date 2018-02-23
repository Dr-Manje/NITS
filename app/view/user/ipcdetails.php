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
            Districts List For:
            <small><?php echo $districtName; ?> IPC</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> IPC</a></li>
            <li class="active"> List</li>
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
                    <li><a href="districtsipcs.php"> Back to IPCs</a></li>
                   <li class="active"> Districts</li>
                </ol>
                <div class="row">
                    <div class="col-xs-12">
                        IPC: <?php echo $districtName; ?>
                    </div> 
                </div>
                
            </div><!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <td>District Name</td>
                        <td>District Code</td>
                        <td>Associations</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                     <?php
                      if ($listDistrictIPCs == 0) {
                      ?>
                        <tr> 
                        <td>District Name</td>
                        <td>District Code</td>
                        <td>Associations</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($listDistrictIPCs as $value)
                                { 
                                    $ipcid = $value['districtID'];
                                    $listIPCAssociations = $districts->listIPCAssociations($ipcid);
                                    $totalass = count($listIPCAssociations);
                               ?>    
                         <tr> 
                            <td><?php echo $value['fieldname']; ?></td>
                        <td><?php echo $value['fieldcode']; ?></td>
                        <td><?php echo $totalass; ?></td>
                        <td>
                            <?php if($totalass > 0){ ?>
                            <a rel="tooltip" title="View more IPC details (GACs, ASSOCIATIONS etc)" class="btn btn-info btn-xs" 
                               href="assdetails.php?assdid=<?php echo $value['districtID'];?>">View more</a> 
                          <?php } ?>
                            <?php if($_SESSION['nasfam_usertype'] == '1'){ ?>
                            <a rel="tooltip" title="Edit/Update Details" class="btn btn-warning btn-xs openEditIPCModal" href="/" 
                                data-editid="<?php echo $value['districtID'] ?>"
                                data-editviewitem="2" 
                                data-editviewname="<?php echo $value['fieldname'] ?>"
                                data-returnpathid="districtsipcs"
                                >
                                <i class="fa fa-edit"></i>
                            </a>
                            <?php } ?>
                        </td>
                            </tr>
                         <?php  }
                        }
                        ?> 
                </tbody>
              </table>
             </div><!-- /.box-body -->
             <div class="box-footer clearfix">
              <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#DistrictsTargetsModal">Add New IPC</button>-->
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
    
    <?php include('updateIPCitem.php') ;?>
    <!-- END INCLUDE ADD IPC ITEM MODAL -->
    
    <!-- ADD IPC -->
    <div id="addIpcsModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>ADD IPC FOR <?php echo $districtName; ?> District</h3>
                    <form method="post" action="ipcdetails.php" enctype="multipart/form-data" class="form-inline center-block">
                        <input type="hidden" id="addIPCBulk" name="addIPCBulk" >
                        <input type="hidden" id="codeitem" name="codeitem" value="2" >
                    <input type="hidden" id="refitem" name="refitem" value="<?php echo $id ?>" >
                     <input type="hidden" id="districtID" name="districtID" value="<?php echo $districtID ?>" >
                        <div class="row">
                        <div class="col-sm-4"> 
                            <div class="form-group">
                            <input class="form-group" type="file" name="file" />
                            </div> 
                        </div>
                            <div class="col-sm-4">
                               <input class="btn btn-default" type="submit" name="uploadBulkIPCs" value="upload" /> 
                            </div>
                        </div>                      
                    </form>
                </div>
                <div class="modal-body">                                        
                                        
                    <form role="form" id="addIPCform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="addIPC" name="addIPC" >
                    <input type="hidden" id="codeitem" name="codeitem" value="2" >
                    <input type="hidden" id="refitem" name="refitem" value="<?php echo $id ?>" >
                    <input type="hidden" id="ipcDistrict" name="ipcDistrict" value="<?php echo $id ?>" >
                    <table id="exampleLstActivities" class="table table-striped table-bordered tbladdipc" cellspacing="0" width="100%"> 
                        <tr>
                            <th>SELECT</th> 
                            <th>IPC NAME</th>
                        </tr>
                    </table>                      
                    </form>                    
                </div>                            
                <div class="modal-footer">                   
                    <button type="button" class='btn btn-danger deleteipc'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreipc'>+ Add More</button> 
                    <button class="btn btn-success" onclick="Addipc()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- END ADD IPC -->
   
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
        
        //remove ipc item
        $(".deleteipc").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
         //add ipc item
        $(".addmoreipc").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='ipcs[]' /></td>";
        data += "<td><input type='text' class='form-control' name='ipcname[]' /></td></tr>";
            $('.tbladdipc').append(data);
        });
        
        function Addipc(){           
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to add IPCs?'))
                {                    
                    _("addIPC").value = "addIPC";        
                    _("addIPCform").method = "post";
                    _("addIPCform").action = "ipcdetails.php";
                    _("addIPCform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            } 
        }
        
        //Addipcs
        function Addipcs(){
            
        itemcheck =  _("Ipcitem").value;
        if(itemcheck === "NONE"){
            //alert('please select an item');
            //$('#AlertModal').modal('show');
            $("#AlertModal").fadeTo(2000, 500).slideUp(500, function(){
                $("#AlertModal").slideUp(500);
            });
        }else{
            if (window.confirm('are you sure you want to Add?'))
                {
                    _("addIPCItemsBulk").value = "addIPCItemsBulk";        
                    _("addIPCItemsBulkform").method = "post";
                    _("addIPCItemsBulkform").action = "ipcdetails.php";
                    _("addIPCItemsBulkform").submit();
                }else{

                } 
        }

        }
        
        $(function() {            
            $(".openEditIPCModal").click(function(e) {
                e.preventDefault();       
                $("#EditIPCModalTitle").html('Update District Details');
                $("#editid").val($(this).data('editid'));
                $("#editviewitem").val($(this).data('editviewitem'));
                $("#editviewname").val($(this).data('editviewname'));
                $("#returnpathid").val($(this).data('returnpathid'));
                $('#EditIPCModal').modal('show');
            });
            
       });
       
       function updateIPCitem(){
            if (window.confirm('are you sure you want to update?'))
                {
                    _("updateIPCItem").value = "updateIPCItem";        
                    _("updateIPCitemform").method = "post";
                    _("updateIPCitemform").action = "districtsipcs.php";
                    _("updateIPCitemform").submit();
                }else{
                    
                }
        }

        $(function() {            
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
            
            
            //addIpcsModal
            <?php // if($_SESSION['nasfam_usertype'] == '1'){ ?>
            $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis',
                    {
                        text: 'Add IPC Item',
                        action: function () {
                            $('#AddIPCItemModal').modal('show');
                        }
                    }
//                    ,
//                    {
//                        text: 'Add New IPC',
//                        action: function () {
//                            $('#addIpcsModal').modal('show');
//                        }
//                    }
                    
                ]
            } );
            <?php // }else{?>
//              $('#example1').DataTable( {
//                dom: 'Bfrtip',
//                buttons: [
//                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
//                    ,
//                    {
//                        text: 'Add Club(s)',
//                        action: function () {
//                            $('#AddIPCItemModal').modal('show');
//                        }
//                    }
//                ]
//            } );
            <?php // }?>


        } );
        
        function UpdateMemberTargets(){
            _("UpdateMemberTargets").value = "UpdateMemberTargets";        
            _("UpdateMemberTargetsform").method = "post";
            _("UpdateMemberTargetsform").action = "targets.php";
            _("UpdateMemberTargetsform").submit();
        }
        
    </script>
  </body>
</html>