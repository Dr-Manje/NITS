<!-- DO IT FOR THE GIT -->
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <!-- HQ ADMIN -->            
            <!-- DISTRICT ADMIN -->
            <!-- REGULAR USER -->
            
            <!-- Optionally, you can add icons to the links -->
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            
            <li class="treeview">
              <a href="#"><i class="fa fa-map"></i> <span>District IPCs</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="districtsipcs.php"><i class="fa fa-map"></i> <span>Districts And IPCs</span></a></li>
                <li><a href="clubregister.php"><i class="fa fa-list"></i> <span>Club Register</span></a></li>
              </ul>
            </li>
            
            <li><a href="targets.php"><i class="fa fa-bar-chart"></i> <span>Targets</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-users"></i> <span>Members</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="members.php"><i class="fa fa-users"></i> <span>Members</span></a></li>
                <li><a href="membership.php"><i class="fa fa-list"></i> <span>Full Membership Details</span></a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Crop Marketing</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="cropmarketing.php">Crop Marketing</a></li>
                <li><a href="">Crop Marketing Summary</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Seed Distribution</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="seeddistribution.php">Seed Distribution</a></li>
                <li><a href="">Seed Distribution Summary</a></li>
              </ul>
            </li>
            
            <?php if($_SESSION['nasfam_usertype'] == '1'){ ?>            
            <li class="treeview">
              <a href="#"><i class="fa fa-gears"></i> <span>Configuration</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="farmproduce.php"><i class="fa fa-leaf"></i> <span>Farm Produce</span></a></li>
                <li><a href="users.php"><i class="fa fa-users"></i> <span>Users</span></a></li>
                <li><a href="regyears.php"><i class="fa fa-calendar"></i> <span>Registration Years</span></a></li>
                
              </ul>
            </li>
            <?php }?>
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Activities</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="memberactivities.php">Member Activities</a></li>
                <li><a href="activitydetails.php">Activity Details</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Tree Planting</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">           
                <li><a href="treeplantingDistrict.php">Tree Planting Details</a></li>
                <li><a href="treeplantingHQ.php">Tree Planting Summary</a></li> 
              </ul>
            </li>
            <?php if($_SESSION['nasfam_usertype'] == '2'){ ?> 
            <li><a href="coderegister.php"><i class="fa fa-barcode"></i> <span>Code Register</span></a></li> 
            <?php }?>
            <!--<li class="header">SHELLING</li>-->
            <!--<li><a href=""><i class="fa fa-dashboard"></i> <span>Shelling Dashboard</span></a></li>-->
            <!--<li><a href=""><i class="fa fa-calendar"></i> <span>Warehouse</span></a></li>-->
            <!--<li><a href=""><i class="fa fa-calendar"></i> <span>Procurement</span></a></li>-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>