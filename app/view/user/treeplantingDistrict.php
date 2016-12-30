<?php  
session_start();
include_once ('../../controller/user/tpdcontroller.php'); ?>
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
            Tree Planting
            <small>Registration Year: <?php echo $regYearName ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Tree Planting</a></li>
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
                    <form class="form-inline" method="post" id="frmSearchTPD">
                        <input type="hidden" id="SearchTPD" name="SearchTPD" >
                        <table class="table">
                            <tr>
                                <td>
                                   <label>Select registered Year: </label>
                                    <select class="form-control" id="regyearTPD" name="regyearTPD">
                                     <?php foreach ($listregYear as $optionMemberList) { ;?>
                                        <option value="<?php echo $optionMemberList['regyearID']; ?>"><?php echo $optionMemberList['regYear']; ?></option>
                                    <?php  } ;?>
                                    </select> 
                                <button type="button" class="btn btn-info" onclick="searchbtn()">Display</button>
                                <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addTPD">Add New Tree Planting Data</button>-->   
                                </td>                                       
                            </tr>                               
                        </table>
                    </form>
                   
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="treeplantingtbl" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                          <th>Member Number</th>
                         <th>Member Name</th>
                         <th>District</th>
                         <th>Agroforestry</th>
                         <th>Exotic</th>
                         <th>Fruit</th>
                         <th>Indigenous</th>
                         <th>Total</th> 
                        <!--<th>Action</th>-->
                      </tr>
                    </thead>
                 
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
    <div id="addTPD" class="modal fade" role="dialog" >
            <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Enter Multiple</h3><br>
                    
                </div>
                <div class="modal-body" >                                        
                      <form role="form" id="UploadTPform"  enctype="multipart/form-data" class="form-inline center-block"  onsubmit="return false">
                        <input type="hidden" id="UploadTP" name="UploadTP" >
                        <div class="row">
                            <div class="col-sm-4">                          
                                 <div class="form-group">
                                     <label for="regyearBulk">Registration Year:</label>
                                     <select class="form-control" id="regyearBulk" name="regyearBulk">
                                         <?php foreach ($listregYear as $optionMemberList) { ;?>
                                 <option value="<?php echo $optionMemberList['regyearID']; ?>"><?php echo $optionMemberList['regYear']; ?></option>
                             <?php  } ;?>
                                     </select>
                                 </div>
                            </div>
                        <div class="col-sm-4"> 
                            <div class="form-group">
                            <input class="form-group" type="file" name="file" />
                            </div> 
                        </div>
                        </div>
                        
                    </form>                 
                     
                </div>                            
                <div class="modal-footer">
                    <!--<button type="button" class='btn btn-danger deleteTPD'>- Delete</button>-->
                    <!--<button type="button" class='btn btn-success addmoreTPD'>+ Add More</button>--> 
                    <button class="btn btn-success" onclick="AddTPD()">Upload</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- END ADD SEED MODALS -->
    
  
    
    <!-- END MODALS -->
    
    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/app.min.js"></script>
    
    <!-- material -->
<!--    <script src="../../../material/assets/js/material-kit.js" type="text/javascript"></script>
    <script src="../../../material/assets/js/material.min.js" type="text/javascript"></script>-->
    
    <!-- DataTables -->
<!--    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>-->
    

<!--<script src="js/AutoGetMemberDetails.js" type="text/javascript"></script>-->
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

        //remove Crop Marketing item
        $(".deleteTPD").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add crop marketing item
        $(".addmoreTPD").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='members[]' /></td>";
        data += "<td><input type='text' class='form-control' name='membernumber[]' /></td>";
        data += "<td><select class='form-control' name='tree[]'><?php foreach ($listTrees as $optionList) { ;?><option value='<?php echo $optionList['treesid']; ?>'><?php echo $optionList['fieldname']; ?></option><?php  } ;?></select></td>";
        data += "<td><input type='text' class='form-control' name='nooftrees[]' /></td></tr>";
            $('.tbladdTPD').append(data);
        });
        
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
                       
            //$listTPD
            var data1 = <?php echo json_encode($lstTreeplanting); ?>;
        
            $('#treeplantingtbl').DataTable( {
                data:           data1,
                deferRender:    true,
                scrollY:        400,
                scrollCollapse: true,
                scroller:       true,
                scrollX: true,
                dom: 'Bfrtip',
                //dom: 'lfrip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                    <?php if($_SESSION['nasfam_usertype'] == '2') { ?>,
                    {
                        text: 'Add New Tree Planting Data',
                        action: function () {
                            $('#addTPD').modal('show');
                        }
                    }
                     <?php } ?>
                ]
            } );
            
        } );
        
        function AddTPD(){
            if (window.confirm('are you sure you want to add tree Planting data?'))
            {                  
                _("UploadTP").value = "UploadTP";        
                _("UploadTPform").method = "post";
                _("UploadTPform").action = "treeplantingDistrict.php";
                _("UploadTPform").submit();
            }else{

            }   
        }

        function searchbtn(){
            _("SearchTPD").value = "SearchTPD";        
            _("frmSearchTPD").method = "post";
            _("frmSearchTPD").action = "treeplantingDistrict.php";
            _("frmSearchTPD").submit();
        }
            
    </script>
  </body>
</html>