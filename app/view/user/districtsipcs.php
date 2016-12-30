<?php  
session_start();
error_reporting(0);
include_once ('../../controller/user/districtscontroller.php'); ?>
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
    <?php include ('../common/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
        <?php include ('../common/nav.php');?>
       
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Districts Listing for: 
            <small><?php echo $regYearName ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Districts</a></li>
            <li class="active"> Listing</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
<!--            <div class="alert alert-success" id="AlertModal1">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Success! </strong>
    Product have added to your wishlist.
</div>-->
        
        <!-- /.row -->
        <div class="row">
          <div class="col-xs-12">
             <div class="box box-success">
            <div class="box-header with-border">
                <!--<h3 class="box-title">Districts IPC Summary</h3>-->
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
                        <td>District</td>
                        <td>Code</td>
                        <td>IPC</td>
                        <td>Association</td>
                        <td>GAC</td>
                        <td>Clubs</td>
                        <td>Members</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                     <?php
                      if ($IPCs == 0) {
                      ?>
                        <tr> 
                        <td>District</td>
                        <td>Code</td>
                        <td>IPC</td>
                        <td>Association</td>
                        <td>GAC</td>
                        <td>Clubs</td>
                        <td>Members</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                            foreach($IPCs as $value)
                                { 
                                    $districtId = $value['0'];
                                    $getIpcsTotalsDistrict = $districts->getIpcsTotalsDistrict($districtId); //get total ipcs
                                    $getAssTotalsDistrict = $districts->getAssTotalsDistrict($districtId); //get total associations
                                    $getGacTotalsDistrict = $districts->getGacTotalsDistrict($districtId); //get total gacs
                                    $getClubTotalsDistrict = $districts->getClubTotalsDistrict($districtId); //get clubs total
                                    $getMemberTotalsDistrict = $districts->getMemberTotalsDistrict($districtId); //get members total
                                    $ipcs = $getIpcsTotalsDistrict;
                                    $associations = $getAssTotalsDistrict;
                                    $gacs = $getGacTotalsDistrict;
                                    $clubs = $getClubTotalsDistrict;
                                    $members = $getMemberTotalsDistrict;                                   
                               ?>    
                        <tr> 
                        <td><?php echo $value['1']; ?></td>
                        <td><?php echo $value['3']; ?></td>
                        <td><?php echo $ipcs; ?></td>
                        <td><?php echo $associations; ?></td>
                        <td><?php echo $gacs; ?></td>
                        <td><?php echo $clubs; ?></td>
                        <td><?php echo $members; ?></td>
                        <td>
                            <?php if($ipcs > 0){ ?>
                            <a rel="tooltip" title="View more IPC details (GACs, ASSOCIATIONS etc)" class="btn btn-info btn-xs"  href="ipcdetails.php?ipcdid=<?php echo $value['0'];?>">View more                                
                            </a> 
                            <?php } ?>
                            <?php if($_SESSION['nasfam_usertype'] == '1'){ ?>
                            <a rel="tooltip" title="Edit/Update district details" class="btn btn-warning btn-xs openEditIPCModal" href="/" 
                                data-editid="<?php echo $value['0'] ?>"
                                data-editviewitem="1" 
                                data-editviewname="<?php echo $value['1'] ?>"
                                data-returnpathid="districtsipcs"
                                >
                                <i class="fa fa-edit"></i>
                            </a>
                            <?php } ?>
                        </td>
                            </tr>
                         <?php  }
                        }
                        ?> 
                </tbody>
              </table>
             </div><!-- /.box-body -->
             <div class="box-footer clearfix">
                             
            </div><!-- /.box-footer -->
          </div><!-- /.box -->                   
          </div>
        </div>   <!-- /.row --> 
        
        <div class="row">
          <div class="col-xs-12">
             <div class="box box-success">
            <div class="box-header with-border">
                <!--<h3 class="box-title">Districts IPC Summary</h3>-->
                <h3>Villages</h3>
                <?php if($_SESSION['nasfam_usertype'] == '1'){ ?>
                <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addVillageModal">Add New Districts</button>-->
                <?php } ?> 
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php if($_SESSION['nasfam_usertype'] == '1'){ ?>
              <table id="villagetable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <td>Village</td>
                        <td>Village Headman</td>
                        <td>Code</td>
                        <td>Action</td>
                    </tr>
                </thead>
               
              </table>
                <?php }else{ ?> 
                <table id="villagetableDistrict" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <td>Village</td>
                        <td>Village Headman</td>
                        <td>Code</td>
                    </tr>
                </thead>
               
              </table>
                <?php } ?> 
             </div><!-- /.box-body -->
             <div class="box-footer clearfix">
                             
            </div><!-- /.box-footer -->
          </div><!-- /.box -->                   
          </div>
        </div>   <!-- /.row --> 
        
        
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>
      
     
    </div><!-- ./wrapper -->
    
    <!-- MODALS -->
    
    <!-- INCLUDE ADD IPC ITEM MODAL -->
    <?php include('insertipcitem.php') ;?>

    <?php include('updateIPCitem.php') ;?>
    <!-- END INCLUDE ADD IPC ITEM MODAL -->
    
    <!-- ADD IPC ITEM -->
    <div id="AddDistrictModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>ADD DISTRICT</h3>                   
                </div>
                <div class="modal-body">                                        
                    <form role="form" id="addDistrictform" onsubmit="return false" enctype="multipart/form-data" class="form-inline center-block">
                        <input type="hidden" id="regyear" name="regyear" value="<?php echo $regYear ?>" >
                        <input type="hidden" id="Ipcitem" name="Ipcitem" value="1" >
                        <input type="hidden" id="addNewDistrict" name="addNewDistrict" >
                        <table id="lstDistrictssss" class="table table-striped table-bordered tbladddistrict" cellspacing="0" width="100%">                         
                            <tr>
                                <td>Select</td>
                                <td>Name</td> 
                            </tr>
                        </table>                       
                    </form>                                                        
                </div>                            
                <div class="modal-footer">                   
                    <button type="button" class='btn btn-danger deletedistrict'>- Delete</button>
                    <button type="button" class='btn btn-success addmoredistrict'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddDistricts()">Save</button>       
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- END ADD IPC ITEM -->
    
    <!-- ADD VILLAGES MODAL -->
    <div id="addVillageModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add Villages</h3><br>
                    
                    <form role="form" id="addVillageBulkform" onsubmit="return false" enctype="multipart/form-data" class="form-inline center-block">
                        <input type="hidden" id="addVillageBulk" name="addVillageBulk" >
                        <div class="row">
                       
                        <div class="col-sm-4"> 
                            <div class="form-group">
                                <input class="form-group" type="file" name="file" id="file" />
                            </div> 
                        </div>
                        <div class="col-sm-4">
                           <button class="btn btn-default" onclick="AddBulkVillage()">Upload Villages</button>
                        </div>
                        </div>                      
                    </form> 

                </div>
                <div class="modal-body">  
                    <h3>Add Villages One at a time</h3>
                    <form role="form" id="addVillageform" enctype="multipart/form-data" onsubmit="return false">
                    <input type="hidden" id="addVillage" name="addVillage" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tbladdVillage" cellspacing="0" width="100%">                   
                            <tr>
                                <th>Select</th>
                                <th>Village Name</th>
                                <th>Village Headman</th>                                                   
                            </tr>
                        </table>                                                                  
                    </form>
                </div>                            
                <div class="modal-footer">
                    <button type="button" class='btn btn-danger deleteaddVillage'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreaddVillage'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddVillage()">Save Village</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>  
    <!-- END ADD VILLAGES MODAL -->
   
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
        
        function AddBulkVillage(){
            if (window.confirm('are you sure you want to add villages?'))
                {
                    _("addVillageBulk").value = "addVillageBulk";        
                    _("addVillageBulkform").method = "post";
                    _("addVillageBulkform").action = "districtsipcs.php";
                    _("addVillageBulkform").submit();
                }else{
                    
                }
        }
        
        
        function updateIPCitem(){
            if (window.confirm('are you sure you want to update?'))
                {
                    _("updateIPCItem").value = "updateIPCItem";        
                    _("updateIPCitemform").method = "post";
                    _("updateIPCitemform").action = "districtsipcs.php";
                    _("updateIPCitemform").submit();
                }else{
                    
                }
        }
        
        function SearchDistrictReg1(){
            _("SearchDistrictReg").value = "SearchDistrictReg";        
            _("frmSearchDistrictReg").method = "post";
            _("frmSearchDistrictReg").action = "districtsipcs.php";
            _("frmSearchDistrictReg").submit();
        }
        
        //remove tree item
        $(".deletedistrict").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add tree item
        $(".addmoredistrict").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='ipcs[]' /></td>";
        data += "<td><input type='text' class='form-control' name='ipcname[]' /></td></tr>";
            $('.tbladddistrict').append(data);
        });
        
        
        //Addipcs
        function AddDistricts(){
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to add District(s)?'))
                {
//                    alert("Add district");
                    _("addNewDistrict").value = "addNewDistrict";        
                    _("addDistrictform").method = "post";
                    _("addDistrictform").action = "districtsipcs.php";
                    _("addDistrictform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            }

        }
        
        
       //remove tree item
        $(".deleteaddVillage").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add tree item
        $(".addmoreaddVillage").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='villages[]' /></td>";
        data += "<td><input type='text' class='form-control' name='villagename[]' /></td>";
        data += "<td><input type='text' class='form-control' name='villageheadman[]' /></td></tr>";
            $('.tbladdVillage').append(data);
        });
        
        
        
        
        //Addipcs
        function Addipcs(){
            
        itemcheck =  _("Ipcitem").value;
        fileupload =  _("file").value;
        if(itemcheck === "NONE"){
            //alert('please select an item');
            //$('#AlertModal').modal('show');
            $("#AlertModal").fadeTo(2000, 500).slideUp(500, function(){
                $("#AlertModal").slideUp(500);
            });
        }else{
            if(document.getElementById("file").value  < 4){ //if file is empty
                alert('Please select file to upload');
            }else{ //upload file
                if (window.confirm('are you sure you want to Add?'))
                {
                    _("addIPCItemsBulk").value = "addIPCItemsBulk";        
                    _("addIPCItemsBulkform").method = "post";
                    _("addIPCItemsBulkform").action = "districtsipcs.php";
                    _("addIPCItemsBulkform").submit();
                }else{

                }
            }
             
        }

        }
        
        //save trees
        function AddVillage(){
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                
            }else{
                alert('Please select items that you wish to add');
            }        if (window.confirm('are you sure you want to Add new Village?'))
                {
                    //alert("Add IPC");
                    _("addVillage").value = "addVillage";        
                    _("addVillageform").method = "post";
                    _("addVillageform").action = "districtsipcs.php";
                    _("addVillageform").submit();
                }else{

                }
        }
  
  
        function editv(obj){
            
            $(function() {
                var fieldname = obj.getAttribute('data-editvillagename');
                var fieldid = obj.getAttribute('data-editvillageid');
                var fieldhead = obj.getAttribute('data-editviewhead');

                $("#EditVillageModalTitle").html('Update Village Details');
                $("#editvillageid").val(fieldid);
                $("#editvillagename").val(fieldname);
                $("#editviewhead").val(fieldhead);
                $('#EditVillageModal').modal('show');
            });
        }
        
        $(function() {            
            $(".openEditIPCModal").click(function(e) {
                e.preventDefault();       
                $("#EditIPCModalTitle").html('Update District Details');
                $("#editid").val($(this).data('editid'));
                $("#editviewitem").val($(this).data('editviewitem'));
                $("#editviewname").val($(this).data('editviewname'));
                $("#returnpathid").val($(this).data('returnpathid'));
                $('#EditIPCModal').modal('show');
            });
            
            //update village
            $(".openEditVillageModal").click(function(e) {
                e.preventDefault();       
                $("#EditVillageModalTitle").html('Update Village Details');
                $("#editvillageid").val($(this).data('editvillageid'));
                $("#editvillagename").val($(this).data('editvillagename'));
                $("#editviewhead").val($(this).data('editviewhead'));
                $('#EditVillageModal').modal('show');
            });
            
       });
       
        $(document).ready(function() {
            
           
            $('#myModal').modal({backdrop: 'static', keyboard: false});
            $('#myModal').modal('show');
            
            //villagetable
            var data = <?php echo json_encode($listVillages); ?>;
            
            //villagetableDistrict
            var data2 = <?php echo json_encode($listVillagesDistrict); ?>;
            $('#villagetableDistrict').DataTable( {
                data:           data2,
                deferRender:    true,
                scrollY:        400,
                scrollCollapse: true,
                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
            
            $('#villagetable').DataTable( {
                data:           data,
                deferRender:    true,
                scrollY:        400,
                scrollCollapse: true,
                scroller:       true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis',
                    {
                        text: 'Add Villages',
                        action: function () {
                            $('#addVillageModal').modal('show');
                        }
                    }
                ]
            } );
            
            <?php if($_SESSION['nasfam_usertype'] == '1'){ ?>
            $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis',
                    {
                        text: 'Add IPC Item',
                        action: function () {
                            $('#AddIPCItemModal').modal('show');
                        }
                    }
                    ,
                    {
                        text: 'Add District',
                        action: function () {
                            $('#AddDistrictModal').modal('show');
                        }
                    }
                ]
            } );
            <?php  }else{?>
              $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
            <?php  }?>
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
        
        function updateVillage(){
            if (window.confirm('are you sure you want to update Village?'))
                {
//                    alert("update village");
                    _("updateVillage").value = "updateVillage";        
                    _("updateVillageform").method = "post";
                    _("updateVillageform").action = "districtsipcs.php";
                    _("updateVillageform").submit();
                }else{

                }
        }
        
    </script>
  </body>
</html>