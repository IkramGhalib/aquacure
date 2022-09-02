<?php
require 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

if ($detect->isMobile() or $detect->isTablet()) {
  $contentmargin = 0;
  $sidebarmargin = 0;
  ?>
   <header class="main-header">
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand"><b>Electrocure</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
<?php
}else{
  
      $contentmargin = 40;
      $sidebarmargin = 100;
    ?>

    <header class="main-header">
    <!-- Logo -->
  
    <img src="images/header.jpg" id="header_image" width="100%" height="90px">
    <a href="feeder_dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Electrocure</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->

     <nav class="navbar navbar-inverse">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
        <div class="container-fluid">

       
      <?php    
}
?>

<ul class="nav navbar-nav">
          
      <!--     <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Dashboard
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="outfeeder_dashboard.php?id=0G0&status=all">Outfeeder Dashboard</a></li>
            <li><a href="transformer_dashboard.php?id=0G0&status=all">Transformer Dashboard</a></li>
            <li><a href="db_dashboard.php?id=0G0&status=all">Distribution Box Dashboard</a></li>
            <li><a href="kpuma_dashboard.php?status=all">KPUMA Dashboard</a></li>
          </ul>
          </li> -->
          
         <!-- <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Out Feeders
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="outfeeder_dashboard.php?id=0G0&status=all">Outfeeder Dashboard</a></li>
            <li><a href="outfeeder_list.php?filter=0G0">Out Feeders List</a></li>

            <li><a href="outfeeder-current-logs.php?filter=0G0">Out Feeders Current Logs</a></li>
            <li><a href="outfeeder-kwh-logs.php?filter=0G0">Out Feeders Consumption Logs</a></li>
          </ul>
          </li> -->
          
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Transformers
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a href="transformer_dashboard.php?id=0G0&status=all">Transformer Dashboard</a></li>
            <li><a href="transformer-list.php?filter=0G0">Transformers List</a></li>
            <li><a href="transformer-current-logs.php?filter=0G0">Transformers Current Logs</a></li>
            <li><a href="transformer-kwh-logs.php?filter=0G0">Transformer Consumption Logs</a></li>
            <?php
            if ($_SESSION['employee']['can_edit'] != 0) {
                
          ?>
          <li><a href="transformer-kwh-logs_flag.php?filter=0G0">Transformer Consumption Logs Flag</a></li>

        <?php 
          }
        ?>
          </ul>
          </li>

          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Distribution Boxes
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="db_dashboard.php?id=0G0&status=all">Distribution Box Dashboard</a></li>
             <li><a href="kpuma_dashboard.php?status=all">KPUMA Dashboard</a></li>
            <li><a href="db-list.php?filter=0G0">Distribution Boxes List</a></li>
            <li><a href="db-current-logs.php?filter=0G0">Distribution Boxes Current Logs</a></li>

          </ul>
          </li>
          
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Connections
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="connection-list.php?filter=0G0">Connection List</a></li>
            <li><a href="connection-current-logs.php?filter=0G0">Customer Current Logs</a></li>
            <li><a href="connection-kwh-logs.php?filter=0G0">Customer Consumption Logs</a></li>
            <li><a href="dashboard_prepaid.php">Shops Dashboard</a></li>
            <!-- <li><a href="assign_customer.php">Assign Connections</a></li> -->
          </ul>
          </li>

          <?php
            if ($_SESSION['employee']['bills'] != 0) {
              
          ?>

           

        <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Billing <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    
                      <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">ElectroCure Billing</a>
                        <ul class="dropdown-menu">
                          <li><a href="bills.php?filter=0G0">Postpaid</a></li>
                          <li><a href=" bills_collective.php">Postpaid Collective</a></li>
                          <li><a href="bill_collection.php">Bill Collection</a></li>
                           <li><a href="recharge.php">Prepaid Recharge</a></li>
                           <li><a href="recharge_logs.php">Prepaid Recharge Logs</a></li>
                        </ul>
                      </li>
                      <li class="dropdown dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">TransfoCure Billing</a>
                        <ul class="dropdown-menu">
                                         
                          <li><a href="bills_tr.php?filter=0G0">Postpaid</a></li>
                          <li><a href="bills_collective_tr.php">Postpaid Collective</a></li>
                          <li><a href="bills_tr_custom.php">Generate Custom Bill</a></li>
                          <li><a href="bills_tr_custom_list.php">Custom Bill List</a></li>
                          <li><a href="bill_collection_tr.php">Bill Collection</a></li>
                                       
                        </ul>
                      </li>
                    </ul>
                  </li>



              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tariff <b class="caret"></b></a>
                  <ul class="dropdown-menu">
               
                          <li><a href="tariff.php?filter=0G0">Transfocure Tariff</a></li>
                          <li><a href="tariff_electrocure.php">Electrocure Tariff</a></li>

                    </ul>
                  </li>

                  



<!-- 
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Electrocure Billing
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            
            <li><a href="bills.php?filter=0G0">Postpaid</a></li>
            <li><a href=" bills_collective.php">Postpaid Collective</a></li>
             <li><a href="bill_collection.php?filter=0G0">Bill Collection</a></li>
          </ul>
          </li> -->

          <!-- <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Transfocure Billing
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            
            <li><a href="bills_tr.php?filter=0G0">Postpaid</a></li>
            <li><a href="bills_collective_tr.php">Postpaid Collective</a></li>
            <li><a href="bills_tr_custom.php">Custom Billing</a></li>
            <li><a href="bill_collection_tr.php">Bill Collection</a></li>
          </ul>
          </li> -->
          <!-- <li><a href="tariff.php?filter=0G0">Tariff</a></li> -->
          
        <?php 
          }
        ?>

          <li><a href="faults.php">Faults</a></li>
          <li><a href="logout.php">Log Out</a></li>
        </ul>


<?php 
        if ($detect->isMobile() or $detect->isTablet()) {
?>
 </div>
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <?php

        }else{
          ?>

           </div>
      </nav>
  </header>
          <?php
        }


?>


<style type="text/css">
  

  .dropdown-submenu{ position: relative; }
.dropdown-submenu>.dropdown-menu{
  top:0;
  left:100%;
  margin-top:-6px;
  margin-left:-1px;
  -webkit-border-radius:0 6px 6px 6px;
  -moz-border-radius:0 6px 6px 6px;
  border-radius:0 6px 6px 6px;
}
.dropdown-submenu>a:after{
  display:block;
  content:" ";
  float:right;
  width:0;
  height:0;
  border-color:transparent;
  border-style:solid;
  border-width:5px 0 5px 5px;
  border-left-color:#cccccc;
  margin-top:5px;margin-right:-10px;
}
.dropdown-submenu:hover>a:after{
  border-left-color:#555;
}
.dropdown-submenu.pull-left{ float: none; }
.dropdown-submenu.pull-left>.dropdown-menu{
  left: -100%;
  margin-left: 10px;
  -webkit-border-radius: 6px 0 6px 6px;
  -moz-border-radius: 6px 0 6px 6px;
  border-radius: 6px 0 6px 6px;
}

/*
@media (min-width: 768px) { 
}
@media (min-width: 992px) { 
}
@media (min-width: 1200px) { 
}
*/
</style>

<script type="text/javascript">
  
  (function($){
  $(document).ready(function(){
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
      event.preventDefault(); 
      event.stopPropagation(); 
      $(this).parent().siblings().removeClass('open');
      $(this).parent().toggleClass('open');
    });
  });
})(jQuery);
/* http://www.bootply.com/nZaxpxfiXz */
</script>