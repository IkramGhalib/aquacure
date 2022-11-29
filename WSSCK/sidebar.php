<aside class="main-sidebar" style="margin-top: <?php echo $sidebarmargin;?>px;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
      <!-- Sidebar user panel -->
     <div class="user-panel">
        <div class="pull-left image">
          <img src="images/logo2.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['name']?></p>
          <a href="#"></i><?php echo $_SESSION['email']; ?></a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu tree" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i><span>TW Dashboard</span></a></li>
        <li><a href="dashboard_wq.php"><i class="fa fa-dashboard"></i><span>WQ Dashboard</span></a></li>
        <li><a href="list.php"><i class="fa fa-list"></i><span>Tube Well List</span></a></li>
        
        <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa fa-plug"></i> <span>Switching</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="auto_switching.php"><i class="fa fa-circle-o"></i>Auto Switching</a></li>
            <li><a href="switching.php"><i class="fa fa-circle-o"></i>Online Switching</a></li>
          </ul>
        </li>


        <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa fa-bolt"></i> <span>Logs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="current_logs.php"><i class="fa fa-circle-o"></i>Current Logs</a></li>
            <li><a href="consumption_logs.php"><i class="fa fa-circle-o"></i>Consumption Logs</a></li>
             <li><a href="wq_logs.php"><i class="fa fa-circle-o"></i>Water Quality Logs</a></li>
              <li><a href="fm_logs.php"><i class="fa fa-circle-o"></i>Flowmeter Logs</a></li>
          </ul>
        </li>

        <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
          </a>
          <ul class="treeview-menu" style="display: none;">
            <!-- <li><a href="pump_reports.php"><i class="fa fa-circle-o"></i>Event Reports</a></li> -->
             <li><a href="tw_run_report.php"><i class="fa fa-circle-o"></i>TW Running Report</a></li>
            <!-- <li><a href="tw_run_report_custom.php"><i class="fa fa-circle-o"></i>TW Running Report (Custom)</a></li> -->
            <li><a href="event_report.php"><i class="fa fa-circle-o"></i>Event Reports</a></li>

          </ul>
        </li>

        <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa fa-exclamation-triangle"></i> <span>Faults</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="faults.php"><i class="fa fa-circle-o"></i>Auto Logged Faults</a></li>
            <li><a href="tw_run_fault.php"><i class="fa fa-circle-o"></i>Excessive TW Running</a></li>
            <li><a href="add_manual_faults.php"><i class="fa fa-circle-o"></i>Add Manual Fault</a></li>
            <li><a href="manual_faults.php"><i class="fa fa-circle-o"></i>Manual Faults List</a></li>
          </ul>
        </li>

        <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Tanks</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="tanks_dashboard.php"><i class="fa fa-circle-o"></i>Tanks Dashboard</a></li>
            <li><a href="tank_list.php"><i class="fa fa-circle-o"></i>Tanks List</a></li>
          </ul>
        </li>

        <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="users.php"><i class="fa fa-circle-o"></i>Users List</a></li>
            <?php 
              if ($_SESSION['role'] == "Admin") {
                 echo "<li><a href='add_user.php'><i class='fa fa-circle-o'></i>Add New User</a></li>";
                 echo "<li><a href='email_list.php'><i class='fa fa-circle-o'></i>Email List</a></li>";
              }
            ?>
            <li><a href='report_contact.php'><i class='fa fa-circle-o'></i>Report Contacts</a></li>
           
          </ul>
        </li>
        <li><a href="connections_map.php"><i class="fa fa-map-marker"></i><span>Connections Map</span></a></li>
        <li><a href="Manual/WaterScada.pdf"  target="_blank"><i class="fa fa-clone"></i><span>User Manual</span></a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>