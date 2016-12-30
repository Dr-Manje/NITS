<?php
session_start();
include_once ('../../controller/user/dashboardcontroller.php'); 
include_once ('../../controller/user/seedscontroller.php');
include_once ('../../controller/user/cropscontroller.php');
include_once ('../../controller/user/livestockcontroller.php');
include_once ('../../controller/user/activitiescontroller.php');
include_once ('../../controller/user/memberscontroller.php');
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
            Admin
            <small>Control Panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Control Panel</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class="row">
              
          </div>
          
          
          <div class="row">
              <!-- left column -->
              <div class="col-lg-6 col-xs-6">
                   <!-- Livestock -->
                  <div class="col-lg-12 col-xs-6">              
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Livestock</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="livestocktbl" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Livestock Name</td>
                        <td>Code</td>
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
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstLivestock as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['fieldname'] ?></td>
                            <td><?php echo $value['fieldcode'] ?></td>
                            <td>
                               <a rel="tooltip" title="Edit/Update details" class="btn btn-info openUpdateModal" href="/" 
                                  data-editid="<?php echo $value['livestockID'] ?>" 
                                  data-viewname="<?php echo $value['fieldname'] ?>" data-viewcode="1" 
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
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <!--<button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addLivestockModal">Add Livestock</button>-->
                  <!--<a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- ./col Seed -->
                    
            <!-- Crop -->
            <div class="col-lg-12 col-xs-6"> 
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Crops</h3>                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="cropstbl" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <td>Crop Name</td>
                          <td>Crop Code</td>
                        
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>                       
                        <?php
                      if ($lstcrops == 0) {
                      ?>
                        <tr> 
                          <td>Crop Code</td>
                        <td>Crop Name</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstcrops as $value)
                                {  
                               ?>    
                         <tr> 
                             <td><?php echo $value['fieldname'] ?></td>
                            <td><?php echo $value['fieldcode'] ?></td>            
                            <td>
                               <a rel="tooltip" title="Edit/Update details" class="btn btn-info openUpdateModal" href="/" 
                                  data-editid="<?php echo $value['cropID'] ?>" 
                                  data-viewname="<?php echo $value['fieldname'] ?>" data-viewcode="2" 
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
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <!--<button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addcropModal">Add Crop</button>-->
<!--                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- ./col Crop -->
            
            
              </div><!-- End left column ------------------------------------------------------------------------------------------------>
              
              
              
              
              <!-- right column -->
              <div class="col-lg-6 col-xs-6">
                
            
            <!-- Seeds -->
            <div class="col-lg-12 col-xs-6"> 
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Seeds</h3>                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="seedstbl" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Seed Name</td>
                        <td>Code</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>                       
                        <?php
                      if ($lstSeeds == 0) {
                      ?>
                        <tr> 
                          <td>Seed Name</td>
                        <td>Code</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($lstSeeds as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['fieldname'] ?></td>
                            <td><?php echo $value['fieldcode'] ?></td>
                            <td>                              
                               <a rel="tooltip" title="Edit/Update details" class="btn btn-info openUpdateModal" href="/" 
                                  data-editid="<?php echo $value['seedID'] ?>" 
                                  data-viewname="<?php echo $value['fieldname'] ?>" data-viewcode="3" 
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
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <!--<button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addseedModal">Add Seed</button>-->
<!--                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- ./col Seeds -->
            
            <!-- Trees -->
            <div class="col-lg-12 col-xs-6"> 
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Trees</h3>                 
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="treestbl" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Name</td>
                        <td>Code</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>                       
                        <?php
                      if ($listTrees == 0) {
                      ?>
                        <tr> 
                          <td>Name</td>
                        <td>Code</td>
                        <td>Action</td>
                         </tr>
                     <?php   }
                        else 
                        {
                           foreach($listTrees as $value)
                                {  
                               ?>    
                         <tr> 
                            <td><?php echo $value['fieldname'] ?></td>            
                            <td><?php echo $value['fieldcode'] ?></td>
                            <td>                              
                               <a rel="tooltip" title="Edit/Update details" class="btn btn-info openUpdateModal" href="/" 
                                  data-editid="<?php echo $value['treesid'] ?>" 
                                  data-viewname="<?php echo $value['fieldname'] ?>" data-viewcode="4" 
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
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <!--<button type="button" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#addtreeModal">Add Tree Type</button>-->
<!--                  <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                  <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div>
            <!-- ./col Trees -->
              </div><!-- End right column -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include('../common/footer.php') ;?>

      <!-- Control Sidebar -->
      <?php // include('sidebar.php') ;?>
    </div><!-- ./wrapper -->
    
    <!-- MODAL -->
    
    <?php include('insertfarmproduce.php') ;?>
    
    
    
   
    
    <!-- END MODAL -->
    
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
        
        $(function() {            
            $(".openUpdateModal").click(function(e) {
                e.preventDefault();       
                $("#EditFarmProduceModalTitle").html('Update Details');
                $("#editid").val($(this).data('editid'));
                $("#viewcode").val($(this).data('viewcode'));
                $("#viewname").val($(this).data('viewname'));
                $('#EditFarmProduceModal').modal('show');
            });
            
       });
       
       function updateFarmProduceitem(){
           
           viewname = _("viewname").value;
           if(viewname === ''){
               alert('Item cannot be blank. Please enter valid name');
               _("viewname").focus();
           }else{
               if (window.confirm('are you sure you want to update?'))
                {
                    _("updateFarmProduceitem").value = "updateFarmProduceitem";        
                    _("updateFarmProduceitemform").method = "post";
                    _("updateFarmProduceitemform").action = "farmproduce.php";
                    _("updateFarmProduceitemform").submit();
                }else{
                    
                }
           }
            
        }
        
        //add items
        function Additems(){
            if (window.confirm('are you sure you want to Add?'))
                {
                    _("addFarmProduceBulk").value = "addFarmProduceBulk";        
                    _("addFarmProduceBulkform").method = "post";
                    _("addFarmProduceBulkform").action = "farmproduce.php";
                    _("addFarmProduceBulkform").submit();
                }else{

                } 
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
             $('#livestocktbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print',
                    {
                        text: 'Add Item',
                        action: function () {
                            $('#AddFarmProduceItemModal').modal('show');
                        }
                    }
                ]
            } );
            
             $('#cropstbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print',
                    {
                        text: 'Add Item',
                        action: function () {
                            $('#AddFarmProduceItemModal').modal('show');
                        }
                    }
                ]
            } );
            
            $('#seedstbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print',
                    {
                        text: 'Add Item',
                        action: function () {
                            $('#AddFarmProduceItemModal').modal('show');
                        }
                    }
                ]
            } );
            
            $('#treestbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print',
                    {
                        text: 'Add Item',
                        action: function () {
                            $('#AddFarmProduceItemModal').modal('show');
                        }
                    }
                ]
            } );
            
        } );
        
        //remove tree item
        $(".deleteaddSeeds").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add tree item
        $(".addmoreaddSeeds").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='Seeds[]' /></td>";
        data += "<td><input type='text' class='form-control' name='seedname[]' /></td>";
        data += "<td><input type='text' class='form-control' name='seedcode[]' /></td></tr>";
            $('.tbladdSeeds').append(data);
        });
        
        //save trees
        function AddSeeds(){
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to Add new Seeds?'))
                {
                    //alert("Add IPC");
                    _("addSeeds").value = "addSeeds";        
                    _("addSeedsform").method = "post";
                    _("addSeedsform").action = "farmproduce.php";
                    _("addSeedsform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            }        
        }
        
        //remove tree item
        $(".deleteaddCrops").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add tree item
        $(".addmoreaddCrops").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='crops[]' /></td>";
        data += "<td><input type='text' class='form-control' name='cropname[]' /></td>";
        data += "<td><input type='text' class='form-control' name='cropcode[]' /></td></tr>";
            $('.tbladdCrops').append(data);
        });
        
        //save trees
        function AddCrops(){
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to Add new Crops?'))
                {
                    //alert("Add IPC");
                    _("addCrops").value = "addCrops";        
                    _("addCropsform").method = "post";
                    _("addCropsform").action = "farmproduce.php";
                    _("addCropsform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            }        
        }
        
        
        //remove tree item
        $(".deleteaddLivestock").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add tree item
        $(".addmoreaddLivestock").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='livestocks[]' /></td>";
        data += "<td><input type='text' class='form-control' name='livestockname[]' /></td>";
        data += "<td><input type='text' class='form-control' name='livestockcode[]' /></td></tr>";
            $('.tbladdLivestock').append(data);
        });
        
        //save trees
        function AddLivestock(){
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to Add new Livestock?'))
                {
                    //alert("Add IPC");
                    _("addLivestock").value = "addLivestock";        
                    _("addLivestockform").method = "post";
                    _("addLivestockform").action = "farmproduce.php";
                    _("addLivestockform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            }        
        }
       
        
        //remove tree item
        $(".deleteaddtree").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('.check_all').prop("checked", false); 
	check();
        });
        
        //add tree item
        $(".addmoreaddtree").on('click',function(){
        var data="<tr><td><input type='checkbox' class='form-control case' name='trees[]' /></td>";
        data += "<td><input type='text' class='form-control' name='treesname[]' /></td>";
        data += "<td><input type='text' class='form-control' name='treescode[]' /></td></tr>";
            $('.tbladdtree').append(data);
        });
        
        //save trees
        function AddTree(){
            //check atleast one textbox has been ticked
            var checked = false;
            $('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")){
                    checked = true;
                }
            });
            
            if(checked === true){
                if (window.confirm('are you sure you want to Add new Tree?'))
                {
                    //alert("Add IPC");
                    _("addTree").value = "addTree";        
                    _("addTreeform").method = "post";
                    _("addTreeform").action = "hq.php";
                    _("addTreeform").submit();
                }else{

                }
            }else{
                alert('Please select items that you wish to add');
            }        
        }
        
        function addmembernumbers(){
            _("addmembernumbers").value = "addmembernumbers";        
            _("addmembernumbersform").method = "post";
            _("addmembernumbersform").action = "hq.php";
            _("addmembernumbersform").submit();
        }
    </script>
  </body>
</html>