<?php  include_once ('../../controller/user/livestockcontroller.php'); ?>
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
    <?php   include ('../common/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
        <?php   include ('../common/nav.php');?>
       

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Livestock
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Livestock</a></li>
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
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addLivestockModal">Add Livestock</button>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Livestock Name</td>
                        <td>Code</td>
                        <td>Description</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                      if ($lstLivestock == 0) {
                      ?>
                        <tr> 
                          <td>Livestock Name</td>
                        <td>Code</td>
                        <td>Description</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstLivestock as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['livestockname'] ?></td>
                            <td><?php echo $value['code'] ?></td>
                            <td><?php echo $value['livestockdescription'] ?></td>
                            <td>
<!--                                <a rel="tooltip" title="View more seed details" class="btn btn-info openModalLink" href="/" data-id="<?php echo $value['seedID'] ?>" data-status="ACCEPTED">
                                    <i class="fa fa-expand"></i>
                                </a>-->
                               <a rel="tooltip" title="Edit/Update livestock details" class="btn btn-info openModalLink" href="/" 
                                  data-id="<?php echo $value['livestockID'] ?>" 
                                  data-viewname="<?php echo $value['livestockname'] ?>" data-viewdesc="<?php echo $value['livestockdescription'] ?>"
                                  data-viewcode="<?php echo $value['code'] ?>"
                                  >
                                    <i class="fa fa-edit"></i>
                                </a>
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
    <div id="addLivestockModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add Livestock</h3><br>
                </div>
                <div class="modal-body">                                                           
                    <form role="form" id="addLivestockform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="addLivestock" name="addLivestock" >
                        
                        <div class="form-group">
                            <label for="livestocknam">Livestock:</label>
                            <input type="text" class="form-control" id="livestocknam" name="livestocknam" placeholder="Please enter the name of the livestock" />
                        </div>
                        <div class="form-group">
                            <label for="code">Code:</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Please enter the code of the seed" />
                        </div>
                        <div class="form-group">
                            <label for="livestockdesc">Livestock Description:</label>
                            <textarea class="form-control" id="livestockdesc" name="livestockdesc"></textarea>
                        </div>                                                
                    </form>
                </div>                            
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="AddLivestock()">Save Livestock</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- END ADD SEED MODALS -->
    
    
    <!--  View Seed Details  -->
    <div class="modal fade" id="ActivateModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="livestockgroup">
                    <form role="form" id="updateLivestockform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="updateLivestock" name="updateLivestock" >
                        <input type="hidden" id="livestockID" name="livestockID" >
                        <div class="form-group">
                            <label for="livestocknam1">Seed:</label>
                            <input type="text" class="form-control" id="livestocknam1" name="livestocknam1" placeholder="Please enter the name of the livestock" />
                        </div>
                        <div class="form-group">
                            <label for="code1">Code:</label>
                            <input type="text" class="form-control" id="code1" name="code1" placeholder="Please enter the code of the seed" />
                        </div>
                        <div class="form-group">
                            <label for="livestockdesc1">seed Discription:</label>
                            <textarea class="form-control" id="livestockdesc1" name="livestockdesc1"></textarea>
                        </div> 
                    </form>
                  </div>
                  <div id="viewseed" class="livestockgroup">
                      <p>view livestock details <span id="actionItem"></span>?</p>
                        <div class="form-group">
                            <span id="viewname"></span>
                        </div>
                        <div class="form-group">
                            <span id="viewcode"></span>
                        </div>
                        <div class="form-group">
                            <span id="viewdesc"></span>
                        </div> 
                  </div>
                  
                  
                
              </div>
              <div class="modal-footer">
                  <button class="btn btn-success" id="editbtn" onclick="showEdit()">Edit Seed</button>
                  <button class="btn btn-success" id="viewbtn" onclick="showView()">Cancel</button>
                    <button class="btn btn-success" id="savebtn" onclick="updateLivestock()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    <!--  End View Seed Details  -->
    
    <!--  Edit Seed Details  -->
    
    <!--  End Edit Seed Details  -->
    
    
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
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
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
        
        //show edit screen
        function showView(){
            $('.livestockgroup').hide();
            $('#viewseed').show();
            $('#viewbtn').hide();
            $('#editbtn').show();
            $('#savebtn').hide();
        }
        
        //show view seeds
        function showEdit(){
            $('.livestockgroup').hide();
            $('#editseed').show();
            $('#viewbtn').show();
            $('#savebtn').show();
            $('#editbtn').hide();
        }
        
        $(function() {
            //$( "#dateitem" ).datepicker( { dateFormat: 'dd/mm/yy' }); 
            //revenue dates
            $( "#regyear1" ).datepicker( { dateFormat: 'y-m-d' });
            
            $("#regyear2").datepicker( {
                format: " yyyy",
                viewMode: "years", 
                minViewMode: "years"
            });
            
            $('#regyear').datepicker( {
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
                $("#myModalTitle").html('Livestock Details');
                $("#viewname").html($(this).data('viewname'));
                $("#viewcode").html($(this).data('viewcode'));
                $("#viewdesc").html($(this).data('viewdesc'));

                $("#livestockID").val($(this).data('id'));
                $("#livestocknam1").val($(this).data('viewname'));
                $("#code1").val($(this).data('viewcode'));
                $("#livestockdesc1").val($(this).data('viewdesc'));

                $('#ActivateModal').modal('show');
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
        
        function AddLivestock(){
            _("addLivestock").value = "addLivestock";        
            _("addLivestockform").method = "post";
            _("addLivestockform").action = "livestock.php";
            _("addLivestockform").submit();
        }
        
        function updateLivestock(){                        
            var r = confirm("Are you sure you want to update?");
            if (r) {
                _("updateLivestock").value = "updateLivestock";        
                _("updateLivestockform").method = "post";
                _("updateLivestockform").action = "livestock.php";
                _("updateLivestockform").submit();
            }
        }
        
        
    </script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>


</html>