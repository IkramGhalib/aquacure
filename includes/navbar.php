<header class="main-header">

  <?php
  require 'Mobile_Detect.php';
  $detect = new Mobile_Detect;
  $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

  if ($detect->isMobile() or $detect->isTablet()) {
    $contentmargin = 0;
    $sidebarmargin = 0;
  } else {
    $contentmargin = 40;
    $sidebarmargin = 100;
  ?>
    <img src="images/2header.jpg" id="header_image" width="100%" height="90px">
  <?php
  }
  ?>


  <?php

  ?>

  <!-- Logo -->
  <a href="#" class="logo" style="background-color: 3c8dbc;">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class=" logo-mini"><b>Aqua</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>AquaCure</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" style="background-color: 3c8dbc;">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <a href="#" class="bi bi-bag"
      <span class="sr-only"></span>
      <i class="fa fa-cart-plus"></i>
    </a>


  </nav>
</header>