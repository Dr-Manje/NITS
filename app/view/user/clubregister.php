<?php  
session_start();
error_reporting(1);
require "../../config/appconfig.php";
include_once ('../../controller/user/clubscontroller.php'); ?>
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
    <SCRIPT language=JavaScript>
    function reload(form)
    {
        var val=form.cat.options[form.cat.options.selectedIndex].value;
        self.location='clubregister.php?cat=' + val;
    }
    
    function reload3(form)
    {
    //var val=form.cat.options[form.cat.options.selectedIndex].value; 
    var val2=form.subcat.options[form.subcat.options.selectedIndex].value;
    
    self.location='clubregister.php?cat3=' + val2;
    }
    
    function reload4(form)
    {
    //var val=form.cat.options[form.cat.options.selectedIndex].value; 
    var val2=form.subcat.options[form.subcat.options.selectedIndex].value;
    var val3=form.subcat1.options[form.subcat1.options.selectedIndex].value;
    
    self.location='clubregister.php?cat3=' + val2 + '&cat4=' + val3;
    }
    
    function reload5(form)
    {
    //var val=form.cat.options[form.cat.options.selectedIndex].value; 
    var val2=form.subcat.options[form.subcat.options.selectedIndex].value;
    var val3=form.subcat1.options[form.subcat1.options.selectedIndex].value;
    var val4=form.subcat2.options[form.subcat2.options.selectedIndex].value;
    
    self.location='clubregister.php?cat3=' + val2 + '&cat4=' + val3 + '&cat5=' + val4;
    }
    
    function reload6(form)
    {
    //var val=form.cat.options[form.cat.options.selectedIndex].value; 
    var val2=form.subcat.options[form.subcat.options.selectedIndex].value;
    var val3=form.subcat1.options[form.subcat1.options.selectedIndex].value;
    var val4=form.subcat2.options[form.subcat2.options.selectedIndex].value;
    var val5=form.subcat3.options[form.subcat3.options.selectedIndex].value;
    
    self.location='clubregister.php?cat3=' + val2 + '&cat4=' + val3 + '&cat5=' + val4 + '&cat6=' + val5;
    }
</script>
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
            Clubs Registered 
            <small><?php //echo $regYearName ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Clubs</a></li>
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
                <?php
                ///////// Getting the data from Mysql table for first list box//////////
                $quer2="SELECT regyearID ,DATE_FORMAT(regYear,'%M %Y') as regYear, status FROM registrationyear order by regyearID DESC"; 
                ///////////// End of query for first list box////////////
                
                /////// for second drop down list we will check if category is selected else we will display all the subcategory///// 
                $cat=$_GET['cat']; // This line is added to take care if your global variable is off
                
//                if(isset($cat) and strlen($cat) > 0){
//                    $quer="select DY.districtsregyearID as did, D.fieldname as dname
//                            from districtsregyear DY
//                            join districts D on D.districtID = DY.district
//                            where regyear = $cat "; 
//                    }
                    $quer="select * from ipc "; 
                ////////// end of query for second subcategory drop down list box ///////////////////////////
                
                /////// for Third drop down list we will check if sub category is selected else we will display all the subcategory3///// 
                $cat3=$_GET['cat3']; // This line is added to take care if your global variable is off
                
                if(isset($cat3) and strlen($cat3) > 0){
                    $quer1="select D.districtID as did,D.fieldname as district
                            from districts D join IPC I on I.IPCid = D.fieldref
                            where D.fieldref = $cat3 "; 
                    }
                
                ////////// end of query for third subcategory drop down list box ///////////////////////////
                    
                /////// for Third drop down list we will check if sub category is selected else we will display all the subcategory3///// 
                $cat4=$_GET['cat4']; // This line is added to take care if your global variable is off
                
                if(isset($cat4) and strlen($cat4) > 0){
                    $quer3="select A.fieldname as assocname, A.associationsID as associd
                            from associations A 
                            where A.fieldref = $cat4 "; 
                    }
                
                ////////// end of query for third subcategory drop down list box ///////////////////////////  
                /////// for Third drop down list we will check if sub category is selected else we will display all the subcategory3///// 
                $cat5=$_GET['cat5']; // This line is added to take care if your global variable is off
                
                if(isset($cat5) and strlen($cat5) > 0){
                    $quer4="select G.fieldname as gac, G.GACid as gid 
                            from gac G 
                            where G.fieldref = $cat5 "; 
                    }
                
                ////////// end of query for third subcategory drop down list box ///////////////////////////  
                /////// for Third drop down list we will check if sub category is selected else we will display all the subcategory3///// 
                $cat6=$_GET['cat6']; // This line is added to take care if your global variable is off
                
                // LOAD TABLE WITH IPC DATA
                //define the criteria
                if(isset($cat6) and strlen($cat6) > 0){
                    $thequery="select C.fieldname as club, C.fieldcode as clubcode
                                , G.fieldname as gac, G.fieldcode as gaccode
                                , A.fieldname as assoc, A.fieldcode as assoccode
                                , D.fieldname as dname, D.fieldcode as dcode
                                , I.fieldname as ipc 
                                from clubs C
                                join gac G on G.GACid = C.fieldref
                                join associations A on A.associationsID = G.fieldref
                                join districts D on D.districtID = A.fieldref
                                join ipc I on I.IPCid = D.fieldref
                                where C.fieldref = '$cat6' "; }
                    
                ?>
               <form>
                    <table class="table table-hover">
                        <tr>
                            <td>
                                <label for="cat">IPC:</label>
                            </td>
                            <td>
                                <?php
                                    //////////  Starting of second drop downlist /////////
                                    echo "<select class='form-control' name='subcat' id='subcat' onchange=\"reload3(this.form)\">";
                                    foreach ($dbo->query($quer) as $noticia) {
                                        if($noticia['IPCid']==@$cat3){echo "<option selected value='$noticia[IPCid]'>$noticia[fieldname]</option>"."<BR>";}
                                        else{echo  "<option value='$noticia[IPCid]'>$noticia[fieldname]</option>";}
                                        }
                                    echo "</select>";
                                    //////////////////  This will end the second drop down list ///////////
                                    ?>
                            </td>
                            <td>
                                <label for="cat">District:</label>
                            </td>
                            <td>
                                <?php
                                    //////////  Starting of second drop downlist /////////
                                    echo "<select class='form-control' name='subcat1' id='subcat1' onchange=\"reload4(this.form)\"><option value=''>Select IPC</option>";
                                    foreach ($dbo->query($quer1) as $noticia) {
                                        if($noticia['did']==@$cat4){echo "<option selected value='$noticia[did]'>$noticia[district]</option>"."<BR>";}
                                        else{echo  "<option value='$noticia[did]'>$noticia[district]</option>";}
                                        }
                                    echo "</select>";
                                    //////////////////  This will end the second drop down list ///////////
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="cat">Associations:</label>
                            </td>
                            <td>
                                <?php
                                    //////////  Starting of second drop downlist /////////
                                    echo "<select class='form-control' name='subcat2' id='subcat2' onchange=\"reload5(this.form)\"><option value=''>Select Associations</option>";
                                    foreach ($dbo->query($quer3) as $noticia) {
                                        if($noticia['associd']==@$cat5){echo "<option selected value='$noticia[associd]'>$noticia[assocname]</option>"."<BR>";}
                                        else{echo  "<option value='$noticia[associd]'>$noticia[assocname]</option>";}
                                        }
                                    echo "</select>";
                                    //////////////////  This will end the second drop down list ///////////
                                    ?>
                            </td>
                            <td>
                                <label for="cat">GACs:</label>
                            </td>
                            <td>
                                <?php
                                    //////////  Starting of second drop downlist /////////
                                    echo "<select class='form-control' name='subcat3' id='subcat3' onchange=\"reload6(this.form)\"><option value=''>Select Associations</option>";
                                    foreach ($dbo->query($quer4) as $noticia) {
                                        if($noticia['gid']==@$cat6){echo "<option selected value='$noticia[gid]'>$noticia[gac]</option>"."<BR>";}
                                        else{echo  "<option value='$noticia[gid]'>$noticia[gac]</option>";}
                                        }
                                    echo "</select>";
                                    //////////////////  This will end the second drop down list ///////////
                                    ?>
                            </td>
                        </tr>
                    </table>
                </form>
                

            </div><!-- /.box-header -->
            <div class="box-body">
                
              <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>CLUB</th>
                        <th>CLUBE CODE</th>
                        <th>GAC</th>
                        <th>GAC CODE</th>
                        <th>ASSOCIATION</th>
                        <th>ASSOCIATION CODE</th>
                        <th>DISTRICT</th>
                        <th>DISTRICT CODE</th>
                        <th>IPC</th>
                    </tr>
                </thead>
                <tbody>
                     <?php    
                        {
                            $i = 0;
                           foreach($dbo->query($thequery) as $value)
                                { 
                                   //$districtId = $value['did'];
                                   //$getDistrictRealDetails = $districts->getDistrictRealDetails($districtId);
                                   //$district = $getDistrictRealDetails[0][0];
                               ?>    
                         <tr> 
                        <td><?php echo $value['club']; ?></td>
                        <td><?php echo $value['clubcode']; ?></td>
                        <td><?php echo $value['gac']; ?></td>
                        <td><?php echo $value['gaccode']; ?></td>
                        <td><?php echo $value['assoc']; ?></td>
                        <td><?php echo $value['assoccode']; ?></td>
                        <td><?php echo $value['dname']; ?></td>
                        <td><?php echo $value['dcode']; ?></td>
                        <td><?php echo $value['ipc']; ?></td>
                       
                            </tr>
                         <?php $i++;  }
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
        
        function SearchDistrictReg1(){
            _("SearchDistrictReg").value = "SearchDistrictReg";        
            _("frmSearchDistrictReg").method = "post";
            _("frmSearchDistrictReg").action = "clubregister.php";
            _("frmSearchDistrictReg").submit();
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