<!-- <aside class="main-sidebar" style="margin-top: 100px;background: black" style="margin-top: <?php //echo $sidebarmargin; ?>px;"> -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="margin-top: 0%;">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" style="height: auto;">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="images/logo2.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <!-- <p> <?php echo $_SESSION['userid']; ?></p> -->
      </div>
    </div> <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu tree" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>

      <li><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
       <li><a href="daily.php"><i class="fa fa-history"></i><span>Daily Attendence</span></a></li>
       <li><a href="monthly.php"><i class="fa fa-history"></i><span>Monthly Attendence</span></a></li>
      <!-- <li><a href="device_list.php"><i class="fa fa-hourglass-2"></i><span>List</span></a></li> -->
      <li><a href="attendance_logs.php"><i class="fa fa-bolt"></i>Attendance Logs</a></li>

      <!-- <li><a href="device_map.php"><i class="fa fa-map"></i>Map</a></li>
      <li><a href="https://content.iospress.com/articles/journal-of-ambient-intelligence-and-smart-environments/ais180509"><i class="fa fa-fire"></i>Side Effect</a></li> -->
     <!--  <li><a href="PollutionImpact.php"><i class="fa fa-fire"></i>Pollution Impact</a></li> 
 -->
      <li><a href="logout.php"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>
      
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>