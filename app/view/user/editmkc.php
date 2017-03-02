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
    
    
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../../plugins/iCheck/all.css">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="../../../plugins/select2/select2.min.css">
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
    
/*    table{
        table-layout: fixed;
        border-collapse: collapse;
        width: 100%;
    }
    
    td{
        width: 50px;
    }
    td+td{
      width: auto;  
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
            Edit Market Centre
            <small></small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="seasondetails.php?sid=<?php echo $season ?>"><i class="fa fa-users"></i> Back to season summary</a></li>
            <li class="active"></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
           <!-- Small boxes (Stat box) -->

          <!-- SCHOOLS -->
            <div class="row">
            
            
            <div class="col-md-12">
             
                <div class="nav-tabs-custom nav-pills-success">
                <ul class="nav nav-tabs nav-pills-success">
                  <li class="active"><a href="#personal" data-toggle="tab"><strong>Market Centre Details</strong></a></li>
                  <li><a href="#pass" data-toggle="tab"><strong>Market Centre Gacs</strong></a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="personal">                  
                    <form role="form" id="updatemkcform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="updatemkc" name="updatemkc">
                        <input type="hidden" id="updatemkcid1" name="updatemkcid1" value="<?php echo $marketcenter; ?>" > 
                        <input type="hidden" id="updatemkcid2" name="updatemkcid2" value="<?php echo $season; ?>" > 
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="editmkcname">Market Centre Name:</label>
                                    <input type="text" class="form-control" id="editmkcname" name="editmkcname" value="<?php echo $mkcName; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="editmpa">Market Procurement Amount:</label>
                                    <input type="text" class="form-control" id="editmpa" name="editmpa" value="<?php echo $mpa; ?>"  />                               
                                </div>
                            </div>
                            
                        </div> 
                        <button class="btn btn-success" id="savebtn" onclick="updatemkcn()">Save</button>
                        
                    </form>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="pass">
                      <form role="form" id="updatemkcgacsform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="updatemkcgacs" name="updatemkcgacs">
                        <input type="hidden" id="updatemkcid3" name="updatemkcid3" value="<?php echo $marketcenter; ?>" > 
                        <input type="hidden" id="updatemkcid4" name="updatemkcid4" value="<?php echo $season; ?>" >                        
                        <div class="row">
                            <div class="col-sm-12">
                            <table id="exampleLstActivities" class="table table-striped table-bordered tbladduser" cellspacing="0" width="100%"> 
                                <tr>
                                    <th>Select</th>
                                    <th>GAC</th>
                                </tr>
                                <?php 
                                foreach($Gacs as $value){ ?>
                                <tr>
                                    <td width="50" ><input type='checkbox' class='form-control case minimal' name='gacs[]' value="<?php echo $value['gacid'] ?>" /></td>
                                    <td>
                                        <input type='hidden' class='form-control' name='gacid[<?php echo $value['gacid'] ;?>]' value="<?php echo $value['mid'] ?>" />
                                        <input type='text' class='form-control' name='gacname[<?php echo $value['gacid'] ;?>]' value="<?php echo $value['gacname'] ?>" />
                                    </td>
                                </tr>
                                <?php  } ?>
                            </table> 
                        </div> 
                            </div>
                        <!--<button type="button" class='btn btn-danger delete'>- Delete</button>-->
                        <!--<button type="button" class='btn btn-success'>+ Add More</button>-->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMKCGacsModal">+ Add More</button>
                        <button class="btn btn-danger" id="savebtn" onclick="updatemkcgs()">- Delete</button>
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
    
    <div id="addMKCGacsModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Add GACs to Market Centre</h3>               
            </div>
            <div class="modal-body">  
                <form role="form" id="addNewMKCgacform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="addNewMKCgac" name="addNewMKCgac">
                <input type="hidden" id="updatemkcid5" name="updatemkcid5" value="<?php echo $marketcenter; ?>" > 
                <input type="hidden" id="updatemkcid6" name="updatemkcid6" value="<?php echo $season; ?>" >  
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editseason">Gacs File: *</label>
                            <input class="form-group" type="file" name="file" />
                        </div> 
                    </div>
                </div>
                </form>  
            </div>                            
            <div class="modal-footer">                   
                <button class="btn btn-success" onclick="addNewMKCgacs()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>
   
    
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
        
        //remove tree item
        $(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add tree item
        $(".addmore").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='gacs[]' /></td>";
            data += "<td><input type='text' class='form-control' name='gacname[]' /></td></tr>";
            $('.tbladduser').append(data);
        });
        
        //addNewMKCgacs
        function addNewMKCgacs(){
            //check if textboxes are empty or nah
            
            if (window.confirm('are you sure you want to add new Gacs?'))
                {;
                    _("addNewMKCgac").value = "addNewMKCgac";        
                    _("addNewMKCgacform").method = "post";
                    _("addNewMKCgacform").action = "editmkc.php";
                    _("addNewMKCgacform").submit();
                }else{

                }
        }
             
        //update personal details
        function updatemkcn(){
            //check if textboxes are empty or nah
            
            if (window.confirm('are you sure you want to update?'))
                {;
                    _("updatemkc").value = "updatemkc";        
                    _("updatemkcform").method = "post";
                    _("updatemkcform").action = "editmkc.php";
                    _("updatemkcform").submit();
                }else{

                }
        }
        
        //delete gacs
        function updatemkcgs(){
            //check if textboxes are empty or nah
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked == true){
                if (window.confirm('are you sure you want to update?'))
                {;
                    _("updatemkcgacs").value = "updatemkcgacs";        
                    _("updatemkcgacsform").method = "post";
                    _("updatemkcgacsform").action = "editmkc.php";
                    _("updatemkcgacsform").submit();
                }else{

                }
            }else{
                alert('Please select Gacs that you wish to delete');
            }
            
            
        }
        
    </script>
  </body>
</html>