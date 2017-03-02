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
    <?php include('../common/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
        <?php include('../common/nav.php');?>
       
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Buyer Purchase Details 
            
            <!--<small> Listing</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Buyer Purchase Details</a></li>
            <li class="active"><a href="seasondetails.php?sid=<?php echo $mcid ?>">View Season Summary</a> </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
        <!-- /.row -->
        <div class="row">
          <div class="col-xs-12">
             <div class="box box-success">
            <div class="box-header with-border">
                
                <strong>Buyer: </strong><?php echo $buyerName ?> <br>
                <strong>Market: </strong><?php echo $marketcenter ?> <br>
               <strong>Date: </strong><?php echo $date ?><hr>
               total cg7, total chalim, total mwk
                <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Receipt</th>
                        <th>Type</th>
                         <th>QTY</th>
                         <th>Cum</th>
                         <th>Price</th>
                        <th>MWK</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($BuyerPurchaseDetails as $value) { ?>
                    <tr>
                        <td><?php echo $value['receipt'] ?></td>
                        <td><?php echo $value['type'] ?></td>
                        <td><?php echo $value['qty'] ?></td>
                        <td><?php echo $value['cum'] ?></td>
                        <td><?php echo $value['price'] ?></td>
                        <td><?php echo $value['mwk'] ?></td>                                                                                              
                    </tr>
                    <?php  } ?> 
                </tbody>
              </table>

            </div><!-- /.box-header -->
            <div class="box-body">
              
             </div><!-- /.box-body -->
             
          </div><!-- /.box -->                   
          </div>
        </div>   <!-- /.row --> 

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
       
        $(document).ready(function() {
            
            $('#example1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                ]
            } );
        } );
        
    </script>
  </body>
</html>