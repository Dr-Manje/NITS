<script type="text/javascript"> 
    function logout() {
        var r = confirm("Do you really want to log out?");
        if (r) {
           window.location.href = '../common/logout.php';
        }
    }
</script>
<header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>N</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>NASFAM</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          
          
          
          
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
<!--                  <img src="../../../../dist/img/user9-128x128.jpg" class="user-image" alt="User Image">-->
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo 'Welcome '.$_SESSION['nasfam_user_name']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
<!--                  <li class="user-header">
                    <img src="../../../../dist/img/user9-128x128.jpg" class="img-circle" alt="User Image">
                    <p>
                      Emmanuel Namanja - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a class="btn btn-default btn-flat" onclick="logout()">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
<!--              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>                 
              </li>-->
            </ul>
          </div>
        </nav>
      </header>
