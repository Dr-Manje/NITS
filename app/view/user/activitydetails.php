<?php  
session_start();
include_once ('../../controller/user/activitiescontroller.php'); 
?>
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
    <?php  include ('../common/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
        <?php  include ('../common/nav.php');?>
       
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Activity Details
            <small><?php echo $regyearName; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Activity Details</a></li>
            <li class="active"> listing</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
            <!-- summaries -->
          
       <!-- /summaries -->
            <div class="row">
              <div class="col-xs-12">
                 <div class="box">
                <div class="box-header">
                    <form class="form-inline " method="post" id="frmSearchActivityDetails">
                                <input type="hidden" id="SearchTypeActivityDetails" name="SearchTypeActivityDetails" >
                            <table>
                                <tr>
                                    
                                    <td style="padding-left: 20px;">
                                        
                                        <div id="option3" class="group">
                                            <label>Select Registration Year:</label>
                                            <select class="form-control" id="regyear" name="regyear">
                                                <?php foreach ($listregYear as $optionMemberList) { ;?>
                                                    <option value="<?php echo $optionMemberList['regyearID']; ?>"><?php echo $optionMemberList['regYear']; ?></option>
                                                <?php  } ;?>
                                            </select>                                            
                                            <button type="button" class="btn btn-info"  onclick="displayActivityDetails()">Display</button>                                   
                                        </div>
                                        
                                    </td>
                                </tr>
                            </table>
                            </form>
                    <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMemberActivityModal">Add New Member Activity Data</button>-->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                          <td>Activity</td>
                          <td>Category</td>
                          <td>Head of Activity</td> 
                          <td>Male</td>
                          <td>Female</td>
                          <td>Total</td>
                          <td>Target</td>
                          <td>% Achievement</td>
                          <td>Action</td>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php
                      if ($lstActivities == 0) {
                      ?>
                        <tr>
                            <td>Activity</td>
                          <td>Category</td>
                          <td>Head of Activity</td> 
                          <td>Male</td>
                          <td>Female</td>
                          <td>Total</td>
                          <td>Action</td>
                        </tr> 
                        <?php   }
                        else 
                        {
                           foreach($lstActivities as $value)
                                { 
                               
                                    $id = $value['aid']; //activity id
                                    $Aid = $value['aid']; //activity id
                                    $male = 'MALE';
                                    $female = 'FEMALE';
                                    //check if activity is tree planting
                                    if($value['acode'] == 24){
                                        $getFeMaleTotal = $targets->getSumOfTPMembersInActivity($regyearAssign,$female);
                                        $getMaleTotal = $targets->getSumOfTPMembersInActivity($regyearAssign,$male);
                                        $totalMembers = $getFeMaleTotal + $getMaleTotal;
                                        
                                    }else{
                                        //count number of female members who took this activity this reg year
                                        $getFeMaleTotal = $targets->getSumOfMembersInActivity($Aid,$regyearAssign,$female); //get female members count
                                        $getMaleTotal = $targets->getSumOfMembersInActivity($Aid,$regyearAssign,$male); //get male members count
                                    
                                        $totalMembers = $getFeMaleTotal + $getMaleTotal;
                                    }
                               
                                    
                                    
                                    
                                    $actDetails = $activities->getActDetails($id,$regyearAssign);

                                    if($actDetails == null){
                                        $hoa1 = 'Not Set';
                                    }else{
                                        $hoa1 = $actDetails[0][0];
                                    }
                                    
                                    //target items
                                    //$regyearAssign //regyear
                                    $getTarget = $targets->GetActivityTarget($regyearAssign,$id);
                                    $target = $getTarget[0][1];
                                    if($target > 1){
                                        $Getachievement = $totalMembers / $target * 100;
                                        $achievement = round($Getachievement); 
                                    }else{ //target is zero
                                        $achievement = 0;
                                    }
                               ?> 
                        <tr>                             
                            <td><?php echo $value['item'].' ('.$value['acode'].')' ?></td>
                            <td><?php echo $value['ActType'] ?></td>
                            <td><?php echo $hoa1 ?></td>
                            <td><?php echo $getMaleTotal ?></td>                                                              
                            <td><?php echo $getFeMaleTotal ?></td>
                            <td><?php echo $totalMembers ?></td>
                            <td><?php echo $target ?></td>
                            <td><?php echo $achievement ?></td>
                            <td>
<!--                                <a rel="tooltip" title="View Members in Activity" class="btn btn-info btn-simple btn-xs"
                                   href="/">
                                    View more</a>-->
                                <a rel="tooltip" title="Update/Edit Activity Details" class="btn btn-info btn-simple btn-xs openmodalhoa"
                                   data-id="<?php echo $Aid ?>" data-activity="<?php echo $value['item'] ?>" 
                                   data-activitytype="<?php echo $value['ActType'] ?>"
                                   href="/">
                                    <i class="fa fa-edit">Update</i></a>
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
           
            
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

     
    </div><!-- ./wrapper -->
    
    <!-- MODALS -->
    
    <!-- Add Seed Distribution Modal -->
    <div class="modal fade" id="edithoa" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalTitle"></h4>
              </div>
              <div class="modal-body">
                  <div id="editseed" class="cropgroup">
                    <form role="form" id="updatehoafrom" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="updatehoa" name="updatehoa" >
                        <input type="hidden" id="regyear" name="regyear" value="<?php echo $regyearAssign; ?>">
                        <input type="hidden" id="id" name="id" >
                        <div class="form-group">
                            <label for="cropcode1">Activity Name:</label>
                            <span id="activity"></span>
                        </div>
                        <div class="form-group">
                            <label for="cropnam1">Activity Type:</label>
                            <span id="activitytype"></span>
                        </div>
                        <div class="form-group">
                            <label for="cropdesc1">Head of activity:</label>
                            <input type="text" id="hoa" name="hoa" class="form-control">
                        </div> 
                    </form>
                  </div>               
              </div>
              <div class="modal-footer">
                    <button class="btn btn-success" id="savebtn" onclick="updatehoa()">Save</button>
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
            
            $(".openmodalhoa").click(function(e) {
                e.preventDefault();       
                $("#myModalTitle").html('Update Activity Details');
                $("#activity").html($(this).data('activity'));
                $("#activitytype").html($(this).data('activitytype'));
                $("#id").val($(this).data('id'));

                $('#edithoa').modal('show');
            });
            
            
       });
       
        $(document).ready(function() {
            
           
            $('#myModal').modal({backdrop: 'static', keyboard: false});
            $('#myModal').modal('show');
            
            $('#example1').DataTable( {
               // scrollX: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ],
                "order": [[ 1, "dsc" ]]
            } );
            
            $('#exampleLstActivities').DataTable( {
                dom: 'Bfrtip',
                buttons: [
//                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
            

            
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
        
        function displayActivityDetails(){
            _("SearchTypeActivityDetails").value = "SearchTypeActivityDetails";        
            _("frmSearchActivityDetails").method = "post";
            _("frmSearchActivityDetails").action = "activitydetails.php";
            _("frmSearchActivityDetails").submit();
        }
        
        function updatehoa(){
            _("updatehoa").value = "updatehoa";        
            _("updatehoafrom").method = "post";
            _("updatehoafrom").action = "activitydetails.php";
            _("updatehoafrom").submit();
        }
        
    </script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>


</html>