 <?php 
 include("includes/contacts.php");
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  
   
  ?>

  
 <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.php">SMART ENV<span></span></a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto <?php echo ($curPageName=='index.php')?'active':'' ?>" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="about.php">About</a></li>
          <li><a class="nav-link scrollto" href="dashboard.php">Dashboard</a></li>
          <li><a class="nav-link scrollto" href="date.php">Live Devices Logs</a></li>
          <li><a class="nav-link scrollto" href="devices.php">Device</a></li>
          <li><a class="nav-link scrollto" href="prediction_dashboard.php" >Prediction Dashboard</a></li>
          <li><a class="nav-link scrollto" href="prediction.php" >Prediction Logs</a></li>
          <!-- <li class="dropdown"><a href="#"><span>AI Models</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">ECGPANN</a></li>
              <li><a href="#">MC-CGPRNN</a></li>
              <li><a href="#">LSTM</a></li>
          
            </ul>
          </li> -->
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->