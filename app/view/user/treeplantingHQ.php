<?php  
session_start();
error_reporting(1);
include_once ('../../controller/user/tphqcontroller.php'); ?>
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
                    <form class="form-inline" method="post" id="frmSearchTPHQ">
                        <input type="hidden" id="SearchTPHQ" name="SearchTPHQ" >
                        <table class="table">
                            <tr>
                                <td>
                                   <label>Select registered Year: </label>
                                    <select class="form-control" id="regyearTPHQ" name="regyearTPHQ">
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
                  <table id="treeplantingsummarytbl" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>District</th>
                         <th>Agroforestry</th>
                         <th>Indigenous</th>
                         <th>Exotic</th>                        
                        <th>Fruit</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>                       
                        <?php
                      if ($TPs == 0) {
                      ?>
                        <tr> 
                            <th>District</th>
                         <th>Agroforestry</th>
                         <th>Indigenous</th>
                         <th>Exotic</th>                        
                        <th>Fruit</th>
                        <th>Total</th>
                        </tr>
                     <?php   }
                        else 
                        {
                           foreach($TPs as $value)
                                {  
                                   $total =  $value['1'] + $value['2'] + $value['3'] + $value['4'];
                               ?>    
                         <tr> 
                             <td><?php echo $value['0']; ?></td>
                             <td><?php echo $value['1']; ?></td>
                             <td><?php echo $value['2']; ?></td>
                             <td><?php echo $value['3']; ?></td>
                             <td><?php echo $value['4']; ?></td>
                             <td><?php echo $total; ?></td>
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
<script>
        
        function _(x) {
            return document.getElementById(x);
        }
        
        function searchbtn(){
            _("SearchTPHQ").value = "SearchTPHQ";        
            _("frmSearchTPHQ").method = "post";
            _("frmSearchTPHQ").action = "treeplantingHQ.php";
            _("frmSearchTPHQ").submit();
        }
        
        $(document).ready(function() {
            
            //treeplantingsummarytbl
            $('#treeplantingsummarytbl').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
            
            
        } );
        
        
    </script>
  </body>
</html>