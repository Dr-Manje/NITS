<?php  
session_start();
include_once ('../../controller/user/activitycontroller.php'); ?>
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
    
    .table_overflow{
        overflow: auto;
        width: 2000px;
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
            Member Activities
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Member Activities</a></li>
            <li class="active"> listing</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
       <!-- /.row -->
            <div class="row">
              <div class="col-xs-12">
                 <div class="box">
                <div class="box-header">
                    <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMemberActivityModal">Add New Member Activity Data</button>-->
                    <form class="form-inline" method="post" id="frmSearchDistrictReg">
                                <input type="hidden" id="SearchDistrictReg" name="SearchDistrictReg" >
                                <table class="table">
                                    <tr>
                                        <td>
                                           <label>Select registered Year: </label>
                                            <select class="form-control" id="regyearDS" name="regyearDS">
                                             <?php foreach ($listregYear as $optionMemberList) { ;?>
                                                <option value="<?php echo $optionMemberList['regyearID']; ?>"><?php echo $optionMemberList['regYear']; ?></option>
                                            <?php  } ;?>
                                            </select> 
                                        <!--<button type="button" class="btn btn-info" onclick="SearchDistrictReg()">Display</button>-->
                                        <button type="button" class="btn btn-info" onclick="SearchDistrictReg1()">Display</button>                                     
                                        </td>                                       
                                </tr>                               
                            </table>
                            </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                        <th>IPC</th>
                        <th>GAC</th> 
                        <th>CLUB</th> 
                        <th>Member</th> 
                        <th>Gender</th>
                        
                          <th>Farming Business Training</th>
                          <th>Leadership Training</th>
                          <th>Adult Literacy</th>
                          
                          <th>Soya Utilization Training</th>
                          <th>Food Preservation & Preparation Training</th>
                          <th>Nutrition Training</th>
                          <th>Leadership Roles</th>
                          <th>Gender & HIV/AIDS programs</th>
                          <th>Cookstove making Training</th>
                          <th>Occupational Safety & Health Training</th>
                          <th>Child Labour Training</th>
                          <th>Field & Life Skills Training</th>
                          
                          <th>Participate in Policy Dialogue Meetings</th>
                          <th>Participate in Extension Advocacy</th>
                          <th>Participate in CA Advocacy Campaigns</th>
                          
                          <th>CSA PArticipant</th>
                          <th>Attended Field Day</th>
                          <th>AFO training</th>
                          <th>FT Training</th>
                          <th>Goat beneficiary</th>
                          <th>Winter Cropping/Irrigation Farming</th>
                          <th>Utilising Chitetezo Mbaula</th>
                          <th>Tree Planting</th>
                          <th># Of trees Planted</th>                      
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
    
    <!-- Add Seed Distribution Modal -->
    <div id="addMemberActivityModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Enter Members Activitiy Data</h3><br>
                    
                </div>
                <div class="modal-body">                                        
                           <form method="post" action="memberactivities.php" enctype="multipart/form-data" class="form-inline center-block">                  
                        <div class="row">
                            <div class="col-sm-6">                          
                                 <div class="form-group">
                                     <label for="regyearBulk">Registration Year:</label>
                                     <select class="form-control" id="regyearBulk" name="regyearBulk">
                                         <?php foreach ($listregYear as $optionMemberList) { ;?>
                                 <option value="<?php echo $optionMemberList['regyearID']; ?>"><?php echo $optionMemberList['regYear']; ?></option>
                             <?php  } ;?>
                                     </select>
                                 </div>
                            </div>
                        <div class="col-sm-6"> 
                            <div class="form-group">
                            <input class="form-group" type="file" name="memberactivitiesFile" />
                            </div> 
                        </div>
                            
                        </div>                                                    
                </div>                            
                <div class="modal-footer">
                    <input class="btn btn-default" type="submit" name="addMABulk" value="upload" /> 
                    </form> 
                    <!--<button class="btn btn-success" onclick="AddSingleMemberActivities()">Save</button>-->
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- end Add Seed Distribution Modal -->
    
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
<!-- DataTables -->
<!--<script src="../../../datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../../../datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="../../../datatables/jszip.min.js" type="text/javascript"></script>
<script src="../../../datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="../../../datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="../../../datatables/buttons.html5.min.js" type="text/javascript"></script>-->
    <script>
        
        function _(x) {
            return document.getElementById(x);
        }
        
        
        // autocomplet : this function will be executed every time we change the text 
        function autocomplet() {
//            alert('Working');
                var min_length = 0; // min caracters to display the autocomplete
                var keyword = $('#memberNumberS').val();
                if (keyword.length >= min_length) {
                        $.ajax({
                                url: 'AutocompleteGetMemberDetails.php',
                                type: 'POST',
                                data: {keyword:keyword},
                                success:function(data){
                                        $('#cont_list_id').show();
                                        $('#cont_list_id').html(data);
                                }
                        });
                } else {
                        $('#cont_list_id').hide();
                }
        }
        
        // set_item : this function will be executed when we select an item
        function set_item(item,item2,item3,item4,item5) {
                $('#memberNameS').val(item +' '+ item2);
                $('#memberNumberS').val(item3);
                $('#regYearS').val(item4);
                $('#memberIDS').val(item5);

                $('#cont_list_id').hide();
        }
        
        function ShowHideDiv(){
            var selectedItem = _("selectMe").value;
            
            
            switch(selectedItem){
                case "seedOption":
                    //alert('changed to: '+selectedItem);
                    $('.displaygroup').hide();
                    $('#seedOption').show();
                    $('#amountOption').show();
                    break;
                case "cropOption":
                    //alert('changed to: '+selectedItem);
                    $('.displaygroup').hide();
                    $('#cropOption').show();
                    $('#amountOption').show();
                    break;
                case "noRepaymentOption":
                    //alert('changed to: '+selectedItem);
                    $('.displaygroup').hide();
                    //$('#cropOption').show();
                    break;
                default:
                    $('.displaygroup').hide();
                    //$('#seedOption').show();
                    //alert('changed to: '+selectedItem);
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
            var data = <?php echo json_encode($lstMembers); ?>;
           
            $('#myModal').modal({backdrop: 'static', keyboard: false});
            $('#myModal').modal('show');
            
            $('#example1').DataTable( {
                data:           data,
                deferRender:    true,
                scrollY:        400,
                scrollCollapse: true,
                scroller:       true,
                scrollX: true,
                dom: 'Bfrtip',
                //dom: 'lfrip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                    <?php if($_SESSION['nasfam_usertype'] == '2') { ?>,
                    {
                        text: 'Add New Member Activity Data',
                        action: function () {
                            $('#addMemberActivityModal').modal('show');
                        }
                    }
                     <?php } ?>
                ]
            } );
            
            $('#exampleLstActivities').DataTable( {
                dom: 'Bfrtip',
                buttons: [
//                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
            
//            $('#example0').DataTable( {
//                dom: 'Bfrtip',
//                buttons: [{
//                        text: 'My button',
//                        action: function ( e, dt, node, config ) {
//                             $("#addSchoolModal").modal("show"); 
//                        }
//                    },
//                    'copyHtml5',
//                    'excelHtml5',
//                    'csvHtml5',
//                    'pdfHtml5'
//                ]
//            } );
            
//            $('#example2').DataTable( {
//                dom: 'Bfrtip',
//                buttons: [{
//                        text: 'My button',
//                        action: function ( e, dt, node, config ) {
//                             $("#addSchoolModal").modal("show"); 
//                        }
//                    },
//                    'copyHtml5',
//                    'excelHtml5',
//                    'csvHtml5',
//                    'pdfHtml5'
//                ]
//            } );
            
           // $("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');
            
        } );
        
        function AddSingleMemberActivities(){
            _("addMASingle").value = "addMASingle";        
            _("addMASingleform").method = "post";
            _("addMASingleform").action = "memberactivities.php";
            _("addMASingleform").submit();
        }
      
        function AddMemberSeedDistribution(){
            _("addSDSingle").value = "addSDSingle";        
            _("addSDSingleform").method = "post";
            _("addSDSingleform").action = "seeddistribution.php";
            _("addSDSingleform").submit();
        }
        
        function SearchDistrictReg1(){
//            alert('Boom');
            _("SearchDistrictReg").value = "SearchDistrictReg";        
            _("frmSearchDistrictReg").method = "post";
            _("frmSearchDistrictReg").action = "memberactivities.php";
            _("frmSearchDistrictReg").submit();
        }
        
        
    </script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>


</html>