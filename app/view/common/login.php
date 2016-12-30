<?php  include_once ('../../controller/common/CommonController.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nasfam</title>    
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
    <link rel="stylesheet" href="../../../dist/css/skins/skin-green.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../../plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <script type="text/javascript" >           
            
            var Email, Password, login;
            function _(x) {
                return document.getElementById(x);
            }
            
            function login(){
                Email = _("Email").value;
                Password = _("Password").value;
                _("loginuser").value = "loginuser";
                

                
                if (Email.length > 2 && Password.length > 2 ){
                
               //window.location.href = "index.php?w1=" + Username + "&w2=" + Password + "&w3=" + login;
                
                    _("loginform").method = "post";
                    _("loginform").action = "login.php";
                    _("loginform").submit();
                
                //alert("its all good famalam!");
                
                }else{
                    alert ("please fill in all fields");
                }
            }
            
        </script>
        <style>
            .login-background{
                 position: fixed;
  left: 0;
  right: 0;
  z-index: 1;

  /*display: block;*/
                /*background-image: url(../../../images/bg/z.jpg);*/ 
             -webkit-filter: blur(1px);
  -moz-filter: blur(1px);
  -o-filter: blur(1px);
  -ms-filter: blur(1px);
  filter: blur(1px);
            }
        </style>
    </head>
    <body class="hold-transition login-page" >
        <div class="login-background"> <img src="../../../images/bg/wg_blurred_backgrounds_3.jpg" alt=""/></div>
        
        <div class="login-box" style="position: fixed;
  left: 0;
  right: 0;
  z-index: 9999;">
      <div class="login-logo">
          <a href="#" style="color: white; text-shadow: 1px 1px 1px #000;"><b>NASFAM</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body" style="box-shadow: 3px 3px 3px #888888;
            -webkit-box-shadow:0 0 40px rgba(0,0,0,0.5);
    box-shadow:0 0 40px rgba(0,0,0,0.5);
    bottom:0px;
/*    left:10%;
    right:10%;
    width:80%;
    height:50%;*/
    -moz-border-radius:100%;
    border-radius:2%;
    ">
          
          <?php
       if(isset($errorHead)){ 
          // echo '<div class="alert alert-error">'.$error.'</div>';
           echo '
           <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> '.$errorHead.'</h4>
        '.$errorMessage.'
        </div>';
       }
       ?>
        <?php
       if(isset($msg)){ 
           //echo '<div class="alert alert-success">'.$msg.'</div>';
           echo '
           <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Login Error!</h4>
        '.$error.'
        </div>';
       }
       ?>
          
        <p class="login-box-msg">login</p>
        <form role="form" id="loginform" onsubmit="return false">
            
            <!--<input type="hidden" id="loginuser" name="loginuser" placeholder="hidden">-->
            <div class="form-group has-feedback" >
            <input type="text" id="Email" name="Email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>                       
          </div>
          <div class="form-group has-feedback">
            <input type="password" id="Password" name="Password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
             <input type="hidden" id="loginuser" name="loginuser" >
             <!--<input type="hidden" id="test" name="test" >--> 
          </div>
          <div class="row">
<!--            <div class="col-xs-8">
              <a href="#">I forgot my password</a><br>
            </div> /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="login()">Sign In</button>
              <!--<button type="submit" class="btn btn-primary btn-block btn-flat" >Sign In</button>-->
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->    
    <!-- jQuery 2.1.4 -->
    <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <!--<script src="../../../plugins/fastclick/fastclick.min.js"></script>-->
    <!-- AdminLTE App -->
    <!--<script src="../../../dist/js/app.min.js"></script>-->
    <!-- AdminLTE for demo purposes -->
    <!--<script src="../../../dist/js/demo.js"></script>-->
    <script type="text/javascript" >                      
            var Email, Password, login;
            function _(x) {
                return document.getElementById(x);
            }
            
            function login(){
                Email = _("Email").value;
                Password = _("Password").value;
                _("loginuser").value = "loginuser";

                if (Email.length > 2 && Password.length > 2 ){
                
               //window.location.href = "index.php?w1=" + Username + "&w2=" + Password + "&w3=" + login;
                
                    _("loginform").method = "post";
                    _("loginform").action = "login.php";
                    _("loginform").submit();
                
                //alert("its all good famalam!");
                
                }else{
                    alert ("please fill in all fields");
                }
            }
            
        </script>
    </body>
</html>