<?php  
session_start();
//error_reporting(0);
include_once ('../../controller/user/cropscontroller.php'); ?>
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
    #memberOption {
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
    
    .modal-dialog {
            width: 100%;
            height: auto;
            margin: 0;
            padding: 0;
          }

        .modal-content {
          height: auto;
          min-height: 80%;
          border-radius: 0;
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
            Crop Marketing
            <small>Registration Year: <?php echo $regYearName ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Crop Marketing</a></li>
            <li class="active"> listing</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          
          
       <!-- /.row -->
            <div class="row">
              <div class="col-xs-12">
                 <div class="box">
                <div class="box-header">
                    
                        <form class="form-inline" method="post" id="frmSearchCMReg">
                                <input type="hidden" id="SearchCMReg" name="SearchCMReg" >
                                <table class="table">
                                    <tr>
                                        <td>
                                           <label>Select registered Year: </label>
                                            <select class="form-control" id="regyearCM" name="regyearCM">
                                             <?php foreach ($listregYear as $optionMemberList) { ;?>
                                                <option value="<?php echo $optionMemberList['regyearID']; ?>"><?php echo $optionMemberList['regYear']; ?></option>
                                            <?php  } ;?>
                                            </select> 
                                        <button type="button" class="btn btn-info" onclick="SearchCM()">Display</button>
                                       <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCropMarketingModal">Add New Crop Marketing Data</button>-->   
                                    </td>                                       
                                </tr>                               
                            </table>
                            </form>
                   
                    
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="cropmarketingtbl111" class="table table-bordered table-striped" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Member No.</th>                          
                        <th>Member</th>
                        <th>District</th>
                        <th>Crop</th>
                        <th>Receipt No.</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    
                  </table>
                 </div><!-- /.box-body -->
              </div><!-- /.box -->                   
              </div>
          </div>            
           
            
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

     
    </div><!-- ./wrapper -->
    
    <!-- MODALS -->
    
    <!-- Add Crop Marketing Modal -->
    <div id="addCropMarketingModal" class="modal fade" role="dialog" >
            <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Enter Multiple members crop marketing</h3><br>
                    <form method="post" action="cropmarketing.php" enctype="multipart/form-data" class="form-inline center-block">
                        
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
                            <input class="form-group" type="file" name="CropMarketingfile" />
                            </div> 
                        </div>
                            <div class="col-sm-4">
                               <input class="btn btn-default" type="submit" name="addCPBulk" value="upload" /> 
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-body" >                                        
                    <h3>Or Enter Single member crop marketing</h3>                    
                    <form role="form" id="addCPSingleform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="addCPSingle" name="addCPSingle" >
                    <table id="exampleLstActivities" class="table table-striped table-bordered tbladdCM" cellspacing="0" width="100%"> 
                        <tr>
                            <td>
                                <label for="regyearBulk">Registration Year:</label>
                            </td>
                            <td colspan="2">
                                     <select class="form-control" id="regyear" name="regyear">
                                         <?php foreach ($listregYear as $optionMemberList) { ;?>
                                 <option value="<?php echo $optionMemberList['regyearID']; ?>"><?php echo $optionMemberList['regYear']; ?></option>
                             <?php  } ;?>
                                     </select>
                            </td>                           
                        </tr>
                        <tr>
                            <th>Select</th>
                            <th>Member Type</th>
                            <th>Member Number</th> 
                            <th>None Member Name</th> 
                            <th>Crop</th> 
                            <th>Receipt</th> 
                            <th>Price</th>
                            <th>Total Value</th> 
                        </tr>
                    </table>                          
                    </form>                    
                </div>                            
                <div class="modal-footer">
                    <button type="button" class='btn btn-danger deleteCM'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreCM'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddMemberCropMarketing()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- end Add Crop Marketing Modal -->
    
    <!-- Edit CROP MARKETING -->
    <div class="modal fade" id="EditCPModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="EditCPTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="UpdateCPform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="UpdateCP" name="UpdateCP" >
                        <input type="hidden" id="viewcpeditid" name="viewcpeditid" >                        
                        <table id="exampleLstActivities" class="table table-striped table-bordered tbladdCM" cellspacing="0" width="100%"> 
                        <tr>
                            <td>
                                <label for="regyearBulk">Registration Year:</label>
                            </td>
                            <td colspan="2">
                                     <select class="form-control" id="viewregyear" name="viewregyear">
                                         <?php foreach ($listregYear as $optionMemberList) { ;?>
                                 <option value="<?php echo $optionMemberList['regyearID']; ?>"><?php echo $optionMemberList['regYear']; ?></option>
                             <?php  } ;?>
                                     </select>
                            </td>                           
                        </tr>
                        <tr>
                            <th>Member Type</th>
                            <th>Member Number</th> 
                            <th>None Member Name</th> 
                            <th>Crop</th> 
                            <th>Receipt</th> 
                            <th>Price</th>
                            <th>Total Value</th> 
                        </tr>
                        <tr>
                            <th>
                                <select class='form-control' id='viewmembertype' name='viewmembertype'>
                                    <option value='NoneMember'>None-Member</option>
                                    <option value='Member'>Member</option>
                                </select>
                            </th>
                            <th><input type='text' class='form-control' name='viewmembernumber' id="viewmembernumber" /></th> 
                            <th><input type='text' class='form-control' name='viewnonemembername' id="viewnonemembername" /></th> 
                            <th>
                                <select class='form-control' name='viewcrop' id="viewcrop">
                                    <?php foreach ($lstcrops as $optionList) { ;?>
                                    <option value='<?php echo $optionList['cropID']; ?>'><?php echo $optionList['fieldname']; ?></option>
                                        <?php  } ;?>
                                </select>
                            </th> 
                            <th><input type='text' class='form-control' name='viewreceipt' id="viewreceipt" /></th> 
                            <th><input type='text' class='form-control' name='viewprice' id="viewprice" /></th>
                            <th><input type='text' class='form-control' name='viewtotalvalue' id="viewtotalvalue" /></th> 
                        </tr>
                    </table> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="updateCP()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    
    <!-- END EDIT CROP MARKETING -->
    
    <!-- DELETE CROP MARKETING -->
    <div class="modal fade" id="DeleteCPModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="DeleteCPTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="deleteCPform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="deleteCP" name="deleteCP" >
                        <input type="hidden" id="DeleteCPid" name="DeleteCPid" >                       
                        <div class="form-group">
                            <p>
                                Are you sure you want to delete Crop Marketing Record?
                            </p>
                        </div> 
                    </form>
                  </div>                 
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="deleteCP()">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>
    
    <!-- END DELETE CROP MARKETING -->
    
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
        
        function SearchCM(){
            _("SearchCMReg").value = "SearchCMReg";        
            _("frmSearchCMReg").method = "post";
            _("frmSearchCMReg").action = "cropmarketing.php";
            _("frmSearchCMReg").submit();
        }
        
        
        //remove Crop Marketing item
        $(".deleteCM").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add crop marketing item
        $(".addmoreCM").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='members[]' /></td>";
        data += "<td><select class='form-control' id='member' name='membertype[]'><option value='NoneMember'>None-Member</option><option value='Member'>Member</option></select></td>";
        data += "<td><input type='text' class='form-control' name='membernumber[]' /></td>";
        data += "<td><input type='text' class='form-control' name='nonemembername[]' /></td>";
        data += "<td><select class='form-control' name='crop[]'><?php foreach ($lstcrops as $optionList) { ;?><option value='<?php echo $optionList['cropID']; ?>'><?php echo $optionList['fieldname']; ?></option><?php  } ;?></select></td>";
        data += "<td><input type='text' class='form-control' name='receipt[]' /></td>";
        data += "<td><input type='text' class='form-control' name='price[]' /></td>";
        data += "<td><input type='text' class='form-control' name='totalvalue[]' /></td></tr>";
            $('.tbladdCM').append(data);
        });
        
       
        function editvis(obj){
           $(function() {
                var field1 = obj.getAttribute('data-viewcpeditid');
                var field2 = obj.getAttribute('data-viewmembernumber');
                var field3 = obj.getAttribute('data-viewnonemembername');
                
                var field4 = obj.getAttribute('data-viewreceipt');
                var field5 = obj.getAttribute('data-viewprice');
                var field6 = obj.getAttribute('data-viewtotalvalue');

                $("#EditCPTitle").html('Edit Crop Marketing');
                $("#viewcpeditid").val(field1);
                $("#viewmembernumber").val(field2);
                $("#viewnonemembername").val(field3);
                $("#viewreceipt").val(field4);
                $("#viewprice").val(field5);
                $("#viewtotalvalue").val(field6);

                $('#EditCPModal').modal('show');
            });
        }
        
        function deletevis(obj){
            $(function() {
                var field1 = obj.getAttribute('data-id');

                $("#DeleteCPTitle").html('Discard Crop Marketing');
                $("#DeleteCPid").val(field1);
                $('#DeleteCPModal').modal('show');
            });
        }
        
        $(function() {
            
            $(".openModalLinkEditCPDetails").click(function(e) {
                e.preventDefault();       
                $("#EditCPTitle").html('Edit Crop Marketing');
                $("#viewcpeditid").val($(this).data('viewcpeditid'));
                $("#viewmembernumber").val($(this).data('viewmembernumber'));
                $("#viewnonemembername").val($(this).data('viewnonemembername'));
                $("#viewreceipt").val($(this).data('viewreceipt'));
                $("#viewprice").val($(this).data('viewprice'));
                $("#viewtotalvalue").val($(this).data('viewtotalvalue'));

                $('#EditCPModal').modal('show');
            });
            
            $(".openModalLinkDeleteCPDetails").click(function(e) {
                e.preventDefault();       
                $("#DeleteCPTitle").html('Discard Crop Marketing');
                $("#DeleteCPid").val($(this).data('id'));
                $('#DeleteCPModal').modal('show');
            });
            
       });
       
        $(document).ready(function() {
            var data1 = <?php echo json_encode($lstCropMarketing); ?>;
            
            $('#cropmarketingtbl111').DataTable( {
                data:           data1,
                deferRender:    true,
                scrollY:        400,
                scrollCollapse: true,
                scroller:       true,
                scrollX: true,
                dom: 'Bfrtip',
                //dom: 'lfrip', addCropMarketingModal">Add New Crop Marketing Data
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                    <?php if($_SESSION['nasfam_usertype'] == '2'){ ?> 
                         ,{
                        text: 'Add New Crop Marketing Data',
                        action: function () {
                            $('#addCropMarketingModal').modal('show');
                        }
                    }       
                    <?php  }?>
                ]
            } );
            
        } );
        
      
        function AddMemberCropMarketing(){
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to add Crop Marketing?'))
                {                  
                    _("addCPSingle").value = "addCPSingle";        
                    _("addCPSingleform").method = "post";
                    _("addCPSingleform").action = "cropmarketing.php";
                    _("addCPSingleform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            }   
        }
        
        //update CROP MARKETING
        function updateCP(){
            if (window.confirm('are you sure you want to update?'))
                {;
            _("UpdateCP").value = "UpdateCP";        
            _("UpdateCPform").method = "post";
            _("UpdateCPform").action = "cropmarketing.php";
            _("UpdateCPform").submit();
            }else{

                }
        }
        
        //delete CROP MARKETING
        function deleteCP(){
            _("deleteCP").value = "deleteCP";        
            _("deleteCPform").method = "post";
            _("deleteCPform").action = "cropmarketing.php";
            _("deleteCPform").submit();
        }
        
    </script>
  </body>
</html>