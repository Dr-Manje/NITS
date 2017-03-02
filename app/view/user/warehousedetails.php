<?php  
session_start();
error_reporting(0);
include_once ('../../controller/user/warehousecontroller.php'); ?>
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
        table.dataTable tbody th,
        table.dataTable tbody td {
            white-space: nowrap;
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
            Casual Worker Details
            <small>Registration Year: <?php echo $regYearName ?></small>
          </h1>
<!--          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Members</a></li>
            <li class="active">Member listing</li>
          </ol>-->
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          
          
       <!-- /.row -->
            <div class="row">
              <div class="col-xs-12">
                 <div class="box">
                <div class="box-header">
                    <p>
                        Name: <?php echo $name ?><br>
                        Code: <?php echo $code ?><br>
                        Gender: <?php echo $gender ?><hr>
                    </p>
                        
                </div><!-- /.box-header -->
                <div class="box-body">
                   
                  <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                         <th>NAME</th>
                        <th>QTY</th>
                        <th>CHALIM</th>
                        <th>CG7</th>
                        <th>OTHER VARIETIES</th>
                        <th>GRADE OUTS</th>
                        <th>SHELLS</th>
                        <th>TOTAL</th>
                        <th>LOSS</th>
                        <th>NOTES</th>
                        <th>ACTION</th>
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
    <!-- Revenue budget Modal -->
        <div id="addMembersModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Enter New Casual Workers</h3><hr>
                    <form method="post" action="casualworkers.php" enctype="multipart/form-data" class="form-inline center-block">
                        
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
                            <div class="col-sm-4">
                               <input class="btn btn-default" type="submit" name="uploadBulkWorkers" value="upload" /> 
                            </div>
                        </div>
                        
                    </form>
                </div>

                <div class="modal-footer">                   
<!--                    <button type="button" class='btn btn-danger deletemember'>- Delete</button>
                    <button type="button" class='btn btn-success addmoremember'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddMember()">Save</button>-->
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
        <!-- end Revenue budget Modal -->
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
<script src="../../../rpt/dataTables.scroller.min.js" type="text/javascript"></script>
    <script>  
        function _(x) {
            return document.getElementById(x);
        }
        
         $(document).ready(function() {
            var data = <?php echo json_encode($TRs); ?>;
//           
//            $('#myModal').modal({backdrop: 'static', keyboard: false});
//            $('#myModal').modal('show');
        
            $('#example2').DataTable( {
                data:           data,
                deferRender:    true,
                scrollY:        350,
                scrollX:        true,
                scrollCollapse: true,
                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
            
            $('#example3').DataTable( {
                data:           data,
                deferRender:    true,
                scrollY:        400,
                scrollX:        true,
                scrollCollapse: true,
                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
            

            
        } );
        
        function SearchDistrictReg1(){
//            alert('Boom');
            _("SearchDistrictReg").value = "SearchDistrictReg";        
            _("frmSearchDistrictReg").method = "post";
            _("frmSearchDistrictReg").action = "casualworkers.php";
            _("frmSearchDistrictReg").submit();
        }
        
//        $(function() {
//  $( ".datepicker" ).datepicker({ dateFormat: "yyyy-mm-dd" });
//});
        $('body').on('focus',".datepicker_recurring_start", function(){
            $(this).datepicker(
                    {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'y-m-d',
                onClose: function(dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    $(this).datepicker();
                    //$(this).datepicker('setDate', new Date(year, month, 1));
                }
        });
        });
        
        $(function() {
            //$( "#dateitem" ).datepicker( { dateFormat: 'dd/mm/yy' }); 
            //revenue dates
            //$( "#dob" ).datepicker( { dateFormat: 'y-m-d' });
            
//            $("#regyear2").datepicker( {
//                format: " yyyy",
//                viewMode: "years", 
//                minViewMode: "years"
//            });
            
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
       
       
      
        //remove ipc item
        $(".deletemember").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add ipc item
        $(".addmoremember").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='members[]' /></td>";
        data += "<td><input type='text' class='form-control' name='names[]' /></td>";
        data += "<td><input type='text' class='form-control' name='lastname[]' /></td>";
        data += "<td><select class='form-control' name='gender[]'><option value='MALE'>MALE</option><option value='FEMALE'>FEMALE</option></select></td>";
        data += "<td><input type='text' class='form-control datepicker_recurring_start' name='dateofbirth[]'  /></td>";
        data += "<td><input type='text' class='form-control' name='hhsize[]' /></td>";
        data += "<td><select class='form-control' name='club[]'><?php foreach ($lstclubs as $optionList) { ;?><option value='<?php echo $optionList['clubsID']; ?>'><?php echo $optionList['clubName']; ?></option><?php  } ;?></select></td></tr>";
            $('.tbladdmember').append(data);
//            $(data).appendTo(".tbladdmember").fadeIn('slow');
        });
      
        function AddMember(){           
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to add members?'))
                {
                    //alert("Add IPC");
                    _("addMember").value = "addMember";        
                    _("addMemberform").method = "post";
                    _("addMemberform").action = "members.php";
                    _("addMemberform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            } 
        }
         
    </script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>


</html>

