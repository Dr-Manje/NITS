<?php  
session_start();

include_once ('../../controller/common/commoncontroller.php'); ?>
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

    #editseed, #viewbtn, #savebtn{
        display: none;
    }
    </style>
</head>

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
            Users
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
            <li class="active"> listing</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
            
          
          <div class="row">
              <div class="col-xs-12">
                 <div class="box">
                <div class="box-header">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#adduserModal">Add User</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="usertable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                          <th>Name</th>
                         <th>Email</th>
                         <th>Type</th>
                         <th>District</th>
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
                         <th>District</th>
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
                                            $userDistrict = $value['userID'];
                                            $getUserDistrict = $login_users->getUserDistrict($userDistrict);
                                            $district = $getUserDistrict[0][0];                                            
                                            break;
                                        case "Admin":
                                            //get district
                                            $district = 'N/A';
                                        
                                            break;
                                        default:
                                            echo "charge is neither processing fee or disturbance fee!";
                                    }
                               ?>    
                         <tr> 
                             <td><?php echo $value['firstname'].' '.$value['lastname'] ?></td>
                             <td><?php echo $value['email'] ?></td>
                             <td><?php echo $value['usertype'] ?></td>
                             <td><?php echo $district ?></td>
                             <td><?php echo $value['status'] ?></td>                                                                   
                            <td>                               
                               <a rel="tooltip" title="Edit/Update User details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php  echo $value['userID'] ?>" data-viewname="<?php echo $value['firstname'] ?>"
                                  data-viewsurname="<?php echo $value['lastname'] ?>" data-viewemail="<?php echo $value['email'] ?>"
                                  data-viewpassword="<?php echo $value['password'] ?>"  data-viewemail="<?php echo $district ?>"
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
                                
                                <a rel="tooltip" title="Edit/Update Password" class="btn btn-info openModalLink1" href="/" 
                                  data-id="<?php  echo $value['userID'] ?>"
                                  data-viewpassword="<?php echo $value['password'] ?>"
                                  >
                                    <i class="fa fa-key"></i>
                                </a>
                                
                                <?php if($value['status'] == 'INACTIVE'){ ?>
                                <a rel="tooltip" title="Activate User" class="btn btn-info openModalLink2" href="/" 
                                   data-id="<?php echo $value['userID'];?>" 
                                   data-name="activate" data-status="ACTIVE" data-username="<?php echo $value['firstname'].' '.$value['lastname'] ?>" >
                                    <i class="fa fa-play"></i>
                                </a><?php }else{ ?>
                                <a rel="tooltip" title="Deactivate User" class="btn btn-warning openModalLink2" href="/" 
                                   data-id="<?php echo $value['userID'];?>" 
                                   data-name="deactivate" data-status="INACTIVE" data-username="<?php echo $value['firstname'].' '.$value['lastname'] ?>" >
                                    <i class="fa fa-pause"></i>
                                </a><?php } ?>
                            </td>
                            </tr>
                         <?php  }
                        }
                        ?>                                       
                    </tbody>
                  </table>
                 </div><!-- /.box-body -->
              </div><!-- /.box -->                   
              </div>
          </div>          
       <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

     
    </div><!-- ./wrapper -->
    
    <!-- MODALS -->
    
    <!-- ADD SEED MODALS -->
    <div id="adduserModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add Activity</h3><br>
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
                                <th>District</th>
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
    <!-- END ADD SEED MODALS -->
    
    <!--  View Seed Details  -->
    <div class="modal fade" id="ActivateModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="updateuserform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="updateuser" name="updateuser" >
                        <input type="hidden" id="userID" name="userID" >
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="names1">Names:</label>
                                    <input type="text" class="form-control" id="names1" name="names1" placeholder="Please enter the name of the activity" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="surname1">Surname:</label>
                                    <input type="text" class="form-control" id="surname1" name="surname1" placeholder="Please enter the name of the activity" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="email1">Email:</label>
                                    <input type="text" class="form-control" id="email1" name="email1" placeholder="Please enter the name of the activity" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="pass2">Old Password:</label>
                                    <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Please enter the name of the activity" />
                                    <input type="hidden" class="form-control" id="pass3" name="pass3"  />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="pass1">New Password:</label>
                                    <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Please enter the name of the activity" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="confirmpass1">Confirm New Password:</label>
                                    <input type="password" class="form-control" id="confirmpass1" name="confirmpass1" placeholder="Please enter the name of the activity" />
                                </div>
                            </div>
                        </div>                     
                    </form>
                  </div>
                  <div id="viewseed" class="cropgroup">
                        <div class="form-group">
                            <span id="viewname"></span>
                        </div>
                        <div class="form-group">
                            <span id="viewsurname"></span>
                        </div>
                        <div class="form-group">
                            <span id="viewemail"></span>
                        </div> 
                  </div>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-success" id="editbtn" onclick="showEdit()">Edit</button>
                  <button class="btn btn-success" id="viewbtn" onclick="showView()">Cancel</button>
                    <button class="btn btn-success" id="savebtn" onclick="updateUser()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!--  End View Seed Details  -->
    
    <!-- activate school modal -->
    <div class="modal fade" id="ActivateModal1" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalTitle1"></h4>
              </div>
              <div class="modal-body">
                  <h3>Are you sure you want to <span id="StatusAction"></span> <span id="schoolnameID"></span>?</h3>
                <form role="form" id="activateUserform" enctype="multipart/form-data" onsubmit="return false">                        
                    <input type="hidden" id="activateUser" name="activateUser" >
                    <input type="hidden" id="UserID" name="UserID" >
                    <input type="hidden" id="UserStatus" name="UserStatus" >
                </form>
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" onclick="activateUser()"><span id="StatusAction1"></span></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- end active school modal -->
    
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
        $(".deleteuser").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add ipc item
        $(".addmoreuser").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='users[]' /></td>";
        data += "<td><input type='text' class='form-control' name='names[]' /></td>";
        data += "<td><input type='text' class='form-control' name='surname[]' /></td>";
        data += "<td><input type='text' class='form-control' name='email[]' /></td>";
        data += "<td><input type='text' class='form-control' name='password[]' /></td>";
        data += "<td><select class='form-control' name='usertype[]'><?php foreach ($lstUserTypes as $optionList) { ;?><option value='<?php echo $optionList['usertypesid']; ?>'><?php echo $optionList['usertype']; ?></option><?php  } ;?></select></td>";
        data += "<td><select class='form-control' name='district[]'><?php foreach ($lstDistricts as $optionList) { ;?><option value='<?php echo $optionList['districtID']; ?>'><?php echo $optionList['districtName']; ?></option><?php  } ;?></select></td></tr>";
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
        
        function updateUser(){                        
            var r = confirm("Are you sure you want to update?");
            if (r) {
                _("updateuser").value = "updateuser";        
                _("updateuserform").method = "post";
                _("updateuserform").action = "users.php";
                _("updateuserform").submit();
            }
        }
        
        
        $(function() {
            
            
            $(".openModalLink").click(function(e) {
                e.preventDefault();       
                $("#myModalTitle").html('User Details');
                $("#viewname").html($(this).data('viewname'));
                $("#viewsurname").html($(this).data('viewsurname'));
                $("#viewemail").html($(this).data('viewemail'));

                $("#userID").val($(this).data('id'));
                $("#names1").val($(this).data('viewname'));
                $("#surname1").val($(this).data('viewsurname'));
                $("#email1").val($(this).data('viewemail'));
                $("#pass3").val($(this).data('viewpassword'));
                
                $('#ActivateModal').modal('show');
            });
            
            $(".openModalLink2").click(function(e) {
                e.preventDefault();       
                $("#myModalTitle1").html('Activate/Deactivate User');
                $("#schoolnameID").html($(this).data('username'));
                $("#StatusAction").html($(this).data('name'));
                $("#StatusAction1").html($(this).data('name'));
                $("#UserID").val($(this).data('id'));
                $("#UserStatus").val($(this).data('status'));

                $('#ActivateModal1').modal('show');
            });
       });
       
        $(document).ready(function() {
                       
            $('#myModal').modal({backdrop: 'static', keyboard: false});
            $('#myModal').modal('show');
        
            
            $('#usertable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis',
                    {
                        text: 'Update Targets',
                        action: function () {
                            $('#DistrictsTargetsModal').modal('show');
                        }
                    }
                ]
            } );
            
            
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
        } );
        
        
        
        
        
        
        
    </script>
  </body>
</html>