<?php  
session_start();
include_once ('../../controller/user/userscontroller.php'); ?>
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
    <?php include('../common/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
        <?php include('../common/nav.php');?>
       
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User Management 
            <small> Listing</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> User Management</a></li>
            <li class="active"> Listing</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
        <!-- /.row -->
        <div class="row">
          <div class="col-xs-12">
             <div class="box box-success">
            <div class="box-header with-border">
                <!--<h3 class="box-title">Districts IPC Summary</h3>-->
                <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                         <th>Email</th>
                         <th>Type</th>
                         <th>IPC</th>
                        <th>Status</th>                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                     <?php
                      if ($lstUsers == 0) {
                      ?>
                        <tr> 
                        <th>Name</th>
                         <th>Email</th>
                         <th>Type</th>
                         <th>IPC</th>
                        <th>Status</th>                        
                        <th>Action</th>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstUsers as $value)
                                {  
                                //Check user type
                                    switch ($value['usertype']) {
                                        case "Regular":
                                            //get district
                                            $userIPC = $value['userID'];
                                            $getUserIPC = $login_users->getUserDistrict($userIPC);
                                            $ipc = $getUserIPC[0][0];                                            
                                            break;
                                        case "Admin":
                                            //get district
                                            $ipc = 'N/A';
                                        
                                            break;
                                        case "HQ Admin":
                                            //get district
                                            $userIPC = $value['userID'];
                                            $getUserIPC = $login_users->getUserDistrict($userIPC);
                                            $ipc = $getUserIPC[0][0]; 
                                        
                                            break;
                                        default:
                                            echo "charge is neither processing fee or disturbance fee!";
                                    }
                               ?> 
                         <?php if($value['status'] == 'ACTIVE'){ ?>
                         <tr class="success"> 
                         <?php }else{?>
                            <tr class="danger"> 
                         <?php } ?>
                             <td><?php echo $value['firstname'].' '.$value['lastname'] ?></td>
                             <td><?php echo $value['email'] ?></td>
                             <td><?php echo $value['usertype'] ?></td>
                             <td><?php echo $ipc ?></td>
                             <td><?php echo $value['status'] ?></td>                                                                   
                            <td>
<!--                                <a rel="tooltip" title="Edit/Update User details" class="btn btn-info openUserEditModalLink" href="/" 
                                  data-id="<?php  //echo $value['userID'] ?>" data-viewname="<?php //echo $value['firstname'] ?>"
                                  data-viewsurname="<?php //echo $value['lastname'] ?>" data-viewemail="<?php //echo $value['email'] ?>"
                                  data-viewpassword="<?php //echo $value['password'] ?>"  data-viewdistrict="<?php //echo $district ?>"
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>-->
                                
                                <a rel="tooltip" title="Reset Password" class="btn btn-info" href="users.php?passreset=<?php echo $value['userID'];?>" 
                                  >
                                    <i class="fa fa-key"></i>
                                </a>
                                
                                <?php if($value['status'] == 'INACTIVE'){ ?>
                                <a rel="tooltip" title="Activate User" class="btn btn-info" href="users.php?userstat=<?php echo $value['userID'];?>&stat=<?php echo $value['status'] ?>" >
                                    <i class="fa fa-play"></i>
                                </a><?php }else{ ?>
                                <a rel="tooltip" title="Deactivate User" class="btn btn-warning" href="users.php?userstat=<?php echo $value['userID'];?>&stat=<?php echo $value['status'] ?>" >
                                    <i class="fa fa-pause"></i>
                                </a><?php } ?>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?> 
                </tbody>
              </table>

            </div><!-- /.box-header -->
            <div class="box-body">
              
             </div><!-- /.box-body -->
             
          </div><!-- /.box -->                   
          </div>
        </div>   <!-- /.row --> 

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

     
    </div><!-- ./wrapper -->
    
    <!-- MODALS -->
    <!-- ADD VILLAGES MODAL -->
    <div id="adduserModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Add New Users</h3><br>
            </div>
            <div class="modal-body">                                                           
                <form role="form" id="adduserform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="adduser" name="adduser" >
                   <table id="exampleLstActivities" class="table table-striped table-bordered tbladduser" cellspacing="0" width="100%"> 
                        <tr>
                            <th>Select</th>
                            <th>Names</th>
                            <th>Surname</th>
                            <th>Email</th> 
                            <th>Password</th>
                            <th>User Type</th>
                            <th>IPC</th>
                        </tr>
                    </table>  
                </form>
            </div>                            
            <div class="modal-footer">
                <button type="button" class='btn btn-danger deleteuser'>- Delete</button>
                <button type="button" class='btn btn-success addmoreuser'>+ Add More</button> 
                <button class="btn btn-success" onclick="Adduser()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>
    <!-- END ADD VILLAGES MODAL -->
   
    <!-- EDIT USER MODAL -->
    <div id="UserEditModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Edit User Details</h3><br>
            </div>
            <div class="modal-body">                                                           
                <form role="form" id="adduserform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="adduser" name="adduser" >
                    <div class="form-group">
                        <label for="cname1">USER ID:</label>
                        <input type="text" class="form-control" id="cname1" name="cname1" placeholder="Please enter the name of the activity" />
                    </div>
                    <div class="form-group">
                        <label for="cname1">Names:</label>
                        <input type="text" class="form-control" id="cname1" name="cname1" placeholder="Please enter the name of the activity" />
                    </div>
                    <div class="form-group">
                        <label for="cname1">Surname:</label>
                        <input type="text" class="form-control" id="cname1" name="cname1" placeholder="Please enter the name of the activity" />
                    </div>
                    <div class="form-group">
                        <label for="cname1">Email:</label>
                        <input type="text" class="form-control" id="cname1" name="cname1" placeholder="Please enter the name of the activity" />
                    </div>
                    <div class="form-group">
                        <label for="cname1">District:</label>
                        <input type="text" class="form-control" id="cname1" name="cname1" placeholder="Please enter the name of the activity" />
                    </div>
                </form>
            </div>                            
            <div class="modal-footer"> 
                <button class="btn btn-success" onclick="Adduser()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>
   
    <!-- END EDIT USER MODAL -->
    
    
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
        
        function SearchDistrictReg1(){
            _("SearchDistrictReg").value = "SearchDistrictReg";        
            _("frmSearchDistrictReg").method = "post";
            _("frmSearchDistrictReg").action = "districtsipcs.php";
            _("frmSearchDistrictReg").submit();
        }
        
        
       //remove tree item
        $(".deleteuser").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add tree item
        $(".addmoreuser").on('click',function(){
        var data="<tr><td><input type='checkbox' class='case' name='users[]' /></td>";
        data += "<td><input type='text' class='form-control' name='names[]' /></td>";
        data += "<td><input type='text' class='form-control' name='surname[]' /></td>";
        data += "<td><input type='text' class='form-control' name='email[]' /></td>";
        data += "<td><input type='text' class='form-control' name='password[]' /></td>";
        data += "<td><select class='form-control' name='usertype[]'><?php foreach ($lstUserTypes as $optionList) { ?><option value='<?php echo $optionList['usertypesid'] ?>'><?php echo $optionList['usertype'] ?></option><?php }?></select></td>";
        data += "<td><select class='form-control' name='IPC[]'><?php foreach ($lstIPC as $optionList) { ?><option value='<?php echo $optionList['IPCid'] ?>'><?php echo $optionList['fieldname'] ?></option><?php }?></select></td></tr>";
            $('.tbladduser').append(data);
        });
        
        
        function Adduser(){
           //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to add users?'))
                {
                    //alert("Add IPC");
                    _("adduser").value = "adduser";        
                    _("adduserform").method = "post";
                    _("adduserform").action = "users.php";
                    _("adduserform").submit();
                }else{

                }
            }else{
                alert('Please select users that you wish to add');
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
            
            $(".openUserEditModalLink").click(function(e) {
                e.preventDefault();       
                $("#myModalTitle").html('Activate school');
                $("#id").html($(this).data('id'));
                $("#viewname").val($(this).data('viewname'));
                $("#viewsurname").val($(this).data('viewsurname'));
                $("#viewemail").html($(this).data('viewemail'));
                $("#viewpassword").val($(this).data('viewpassword'));
                $("#viewdistrict").val($(this).data('viewdistrict'));

                $('#UserEditModal').modal('show');
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
            
//            $('#example1').DataTable( {
//                dom: 'Bfrtip',
//                buttons: [
//                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
//                ]
//            } );
            
            $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis',
                    {
                        text: 'Add User',
                        action: function () {
                            $('#adduserModal').modal('show');
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