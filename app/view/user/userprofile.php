<?php  
session_start();
include_once ('../../controller/user/userprofilecontroller.php'); ?>

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

    #cropmode,#cropmode1{
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
            User Profile
            <small></small>
          </h1>
          <ol class="breadcrumb">
              <li><a href=""><i class="fa fa-users"></i> User Profile</a></li>
            <li class="active"></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
           <!-- Small boxes (Stat box) -->

          <!-- SCHOOLS -->
            <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
              <div class="box box-success">
                  
                <div class="box-body box-profile">
                  <!--<img class="profile-user-img img-responsive img-circle" src="<?php// echo $logo ?>" alt="Member Photo">-->
                    <h3 class="profile-username text-center"><?php echo $fname.' '.$lname; ?></h3>
                    <p class="text-center"><?php echo $districtName ?></p>
                    <hr>                
                    <strong>First Name:</strong> <?php echo $fname; ?><br>
                    <strong>Last Name:</strong> <?php echo $lname; ?><br>
                    <strong>Email:</strong> <?php echo $email; ?><br>
                    <strong>District:</strong> <?php echo $districtName; ?><br>
                    <strong>Status:</strong> <?php echo $status; ?><br>
                </div><!-- /.box-body -->
              </div>
                
                 

            </div><!-- /.col -->
            
            <div class="col-md-9">
             
                <div class="nav-tabs-custom nav-pills-success">
                <ul class="nav nav-tabs nav-pills-success">
                  <li class="active"><a href="#personal" data-toggle="tab"><strong>Update personal Details</strong></a></li>
                  <li><a href="#pass" data-toggle="tab"><strong>Change Password</strong></a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="personal">                  
                    <form role="form" id="updateuserform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="updateuser" name="updateuser">                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="fname">Names:</label>
                                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="lname">Last Name:</label>
                                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname; ?>"  />                               
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>"  />                               
                                </div>
                            </div>
                        </div> 
                        <button class="btn btn-success" id="savebtn" onclick="updateUserDetails()">Save</button>
                    </form>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="pass">
                      <form role="form" id="updateuserpassform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="updateuserpass" name="updateuserpass">
                        <input type="hidden" id="oldpass" name="oldpass" value="<?php echo $password; ?>">                         
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="oldpassword">Old Password:</label>
                                    <input type="password" class="form-control" id="oldpassword" name="oldpassword"  />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="newpassword">New Password:</label>
                                    <input type="password" class="form-control" id="newpassword" name="newpassword"   />                               
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="confirmpassword">Confirm New Password:</label>
                                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"   />                               
                                </div>
                            </div>
                        </div> 
                        <button class="btn btn-success" id="savebtn" onclick="updateUserPassword()">Save</button>
                    </form>
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
                
                
             
                <!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
            </div><!-- /.row --><!-- END SCHOOLS /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

    
    </div><!-- ./wrapper -->
   
    
    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/app.min.js"></script>   
    <script src="../../../js/jquery-ui.js"></script>

    <script>
       function _(x) {
            return document.getElementById(x);
        }
             
        //update personal details
        function updateUserDetails(){
            //check if textboxes are empty or nah
            
            if (window.confirm('are you sure you want to update?'))
                {;
                    _("updateuser").value = "updateuser";        
                    _("updateuserform").method = "post";
                    _("updateuserform").action = "userprofile.php";
                    _("updateuserform").submit();
                }else{

                }
        }
        
        function updateUserPassword(){
            oldpass = _("oldpass").value; //old pass
            oldpassuser = _("oldpassword").value; //old pass
            newpass = _("newpassword").value; //new pass
            confirmpass = _("confirmpassword").value; //new pass confirm
            
            if(oldpass === oldpassuser){
                
                if(newpass === confirmpass){
                    //alert('save the new password');
                    _("updateuserpass").value = "updateuserpass";        
                    _("updateuserpassform").method = "post";
                    _("updateuserpassform").action = "userprofile.php";
                    _("updateuserpassform").submit();
                }else{
                    alert('New Passwords are not matching, please try again');
                    _("confirmpass").focus(); 
                }
                                
            }else{
                alert('Old Password is incorrect, please try again');
                _("oldpassword").focus();
            }
            
            
        }
    </script>
  </body>
</html>