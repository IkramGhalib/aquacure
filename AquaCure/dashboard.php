<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Pumps Dashboard"?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('includes/head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue sidebar-mini" >
<!-- Site wrapper -->
<div class="wrapper" style="overflow: hidden;">
	
	
	<!-- Navbar -->
	<?php include_once('includes/navbar.php') ?>
	<!-- Sidebar -->
	<?php include_once('includes/sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper" style="margin-top: <?php echo $contentmargin?>px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <b><?php echo $pageName;?></b>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $pageName;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row"><div class="col-md-6"><a href="dashboard.php?status=ON">
                <button class="btn btn-success"><i class="icofont icofont-check-circled"></i> On 11</button>
            </a><a href="dashboard.php?status=OFL">
                <button class="btn  btn-warning" style="background:blue;border-color:blue;><i class=" icofont="" icofont-warning-alt'=""> Offline 2</button>
            </a><a href="dashboard.php?status=OFF">
                <button class="btn btn-danger"><i class="icofont icofont-eye-alt"></i> Off 0</button>
            </a></div>       

       <div class="col col-md-3 pull-right">
         <input type="text" name="search" id="search" onkeyup="filterSelection()" class="form-control" placeholder="Search Pump ID/Name ...">
       </div>
       </div>
       <br>
       <br>
    <div class="row" id="pumps">

      
              
<div class="filterDiv SECTOR D4 TW#061G1PU01 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-green" style="min-height: 170px;">
      
      <h3><b>On</b></h3>
      <h5 id="pumpName">Sector D4 TW#06</h5>
      <h5>Device ID: 1G1PU01</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-07-18 10:22:28<br>
      Average Voltage = 234.81 Volts <br>
      Total Current = 247.57 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.78 <br>
      Total KVA = 58.03<br>
      Switch On Time: 2022-07-18 10:13:18<br>
       On due to: Manual                               
      <br><br>
          <button disabled class="btn btn-danger" onclick="window.location.href = 'change_pump_status.php?pumpid=1G1PU01&amp;status=Off'">Switch Off</button>
<button disabled class="btn btn-primary" onclick="window.location.href=&quot;device_dashboard.php?id=1G1PU01&quot;">Details</button>


                                <br><br>
    </div>
  </div>
</div>
</div>

<div class="filterDiv SECTOR D4 TW#081G1PU02 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-green" style="min-height: 170px;">
      
      <h3><b>On</b></h3>
      <h5 id="pumpName">Sector D4 TW#08</h5>
      <h5>Device ID: 1G1PU02</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-07-18 10:21:38<br>
      Average Voltage = 205.91 Volts  <br>
      Total Current = 176.95 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.78 <br>
      Total KVA = 36.44<br>
      Switch On Time: 2022-07-18 04:03:04<br>
       On due to: Manual                               
      <br><br>
                                <button disabled class="btn btn-danger" onclick="window.location.href = 'change_pump_status.php?pumpid=1G1PU02&amp;status=Off'">Switch Off</button>
<button disabled class="btn btn-primary" onclick="window.location.href=&quot;device_dashboard.php?id=1G1PU02&quot;">Details</button>


                                <br><br>
    </div>
  </div>
</div>
</div>

<div class="filterDiv SECTOR D2 NEW TW1G1PU03 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-green" style="min-height: 170px;">
      
      <h3><b>On</b></h3>
      <h5 id="pumpName">Sector D2 new TW</h5>
      <h5>Device ID: 1G1PU03</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-07-18 10:22:07<br>
      Average Voltage = 238.29 Volts <br>
      Total Current = 307.81 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.8 <br>
      Total KVA = 73.37<br>
      Switch On Time: 2022-07-18 05:53:51<br>
       On due to: Manual                               
      <br><br>
                                <button disabled class="btn btn-danger" onclick="window.location.href = 'change_pump_status.php?pumpid=1G1PU03&amp;status=Off'">Switch Off</button>
<button disabled class="btn btn-primary" onclick="window.location.href=&quot;device_dashboard.php?id=1G1PU03&quot;">Details</button>


                                <br><br>
    </div>
  </div>
</div>
</div>

<div class="filterDiv SECTOR D5 SITE OFFICE ROAD PARK1G1PU04 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-blue" style="min-height: 170px;">
      
      <h3><b>Offline</b></h3>
      <h5 id="pumpName">sector D5 site office road park</h5>
      <h5>Device ID: 1G1PU04</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-07-18 08:46:47<br>
      Average Voltage = 206.69 Volts  <br>
      Total Current = 0 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.78 <br>
      Total KVA = 0<br>
      Offline Time: 2022-07-18 08:46:47<br>
       Non-Functional                               
      <br><br>
                           
<button class="btn btn-primary" disabled="">Switch</button>
<button class="btn btn-primary" disabled="disabled">Details</button>
                              <br><br>
    </div>
  </div>
</div>
</div>

<div class="filterDiv SECTOR E2 TW#3 1G1PU05 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-green" style="min-height: 170px;">
      
      <h3><b>On</b></h3>
      <h5 id="pumpName">Sector E2 Tw#3 </h5>
      <h5>Device ID: 1G1PU05</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-07-18 10:21:44<br>
      Average Voltage = 200.4 Volts  <br>
      Total Current = 290.94 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.79 <br>
      Total KVA = 57.96<br>
      Switch On Time: 2022-07-18 10:03:03<br>
       On due to: Manual                               
      <br><br>
                                <button disabled class="btn btn-danger" onclick="window.location.href = 'change_pump_status.php?pumpid=1G1PU05&amp;status=Off'">Switch Off</button>
<button disabled class="btn btn-primary" onclick="window.location.href=&quot;device_dashboard.php?id=1G1PU05&quot;">Details</button>


                                <br><br>
    </div>
  </div>
</div>
</div>

<div class="filterDiv SECTOR E3 NISAR TW1G1PU06 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-green" style="min-height: 170px;">
      
      <h3><b>On</b></h3>
      <h5 id="pumpName">Sector E3 nisar TW</h5>
      <h5>Device ID: 1G1PU06</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-07-18 10:21:16<br>
      Average Voltage = 242.42 Volts <br>
      Total Current = 201.12 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.78 <br>
      Total KVA = 48.76<br>
      Switch On Time: 2022-07-18 10:02:55<br>
       On due to: Manual                               
      <br><br>
                                <button disabled class="btn btn-danger" onclick="window.location.href = 'change_pump_status.php?pumpid=1G1PU06&amp;status=Off'">Switch Off</button>
<button disabled class="btn btn-primary" onclick="window.location.href=&quot;device_dashboard.php?id=1G1PU06&quot;">Details</button>


                                <br><br>
    </div>
  </div>
</div>
</div>

<div class="filterDiv SECTOR E1 DONGA GALI NEW TW1G1PU07 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-green" style="min-height: 170px;">
      
      <h3><b>On</b></h3>
      <h5 id="pumpName">Sector E1 donga gali new TW</h5>
      <h5>Device ID: 1G1PU07</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-07-18 10:22:47<br>
      Average Voltage = 228.58 Volts <br>
      Total Current = 197.21 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.78 <br>
      Total KVA = 45.02<br>
      Switch On Time: 2022-07-14 11:05:57<br>
       On due to: Manual                               
      <br><br>
                                <button disabled class="btn btn-danger" onclick="window.location.href = 'change_pump_status.php?pumpid=1G1PU07&amp;status=Off'">Switch Off</button>
<button disabled class="btn btn-primary" onclick="window.location.href=&quot;device_dashboard.php?id=1G1PU07&quot;">Details</button>


                                <br><br>
    </div>
  </div>
</div>
</div>

<div class="filterDiv SECTOR D2 PARK  TW 1G1PU08 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-green" style="min-height: 170px;">
      
      <h3><b>On</b></h3>
      <h5 id="pumpName">Sector D2 park  TW </h5>
      <h5>Device ID: 1G1PU08</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-07-18 10:17:18<br>
      Average Voltage = 240.2 Volts <br>
      Total Current = 121.22 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.78 <br>
      Total KVA = 29.11<br>
      Switch On Time: 2022-07-18 08:59:36<br>
       On due to: Manual                               
      <br><br>
                                <button disabled class="btn btn-danger" onclick="window.location.href = 'change_pump_status.php?pumpid=1G1PU08&amp;status=Off'">Switch Off</button>
<button disabled class="btn btn-primary" onclick="window.location.href=&quot;device_dashboard.php?id=1G1PU08&quot;">Details</button>


                                <br><br>
    </div>
  </div>
</div>
</div>

<div class="filterDiv SECTOR D5 SHOMALI MARKET1G1PU09 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-green" style="min-height: 170px;">
      
      <h3><b>On</b></h3>
      <h5 id="pumpName">Sector D5 shomali market</h5>
      <h5>Device ID: 1G1PU09</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-07-18 10:22:33<br>
      Average Voltage = 237.47 Volts <br>
      Total Current = 228.45 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.78 <br>
      Total KVA = 54.27<br>
      Switch On Time: 2022-07-18 05:51:23<br>
       On due to: Manual                               
      <br><br>
                                <button disabled class="btn btn-danger" onclick="window.location.href = 'change_pump_status.php?pumpid=1G1PU09&amp;status=Off'">Switch Off</button>
<button disabled class="btn btn-primary" onclick="window.location.href=&quot;device_dashboard.php?id=1G1PU09&quot;">Details</button>


                                <br><br>
    </div>
  </div>
</div>
</div>

<div class="filterDiv SECTOR E3 JEHANGIR TW1G1PU10 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-green" style="min-height: 170px;">
      
      <h3><b>On</b></h3>
      <h5 id="pumpName">Sector E3 jehangir TW</h5>
      <h5>Device ID: 1G1PU10</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-07-18 10:22:05<br>
      Average Voltage = 225.14 Volts <br>
      Total Current = 240.11 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.78 <br>
      Total KVA = 53.95<br>
      Switch On Time: 2022-07-18 10:02:57<br>
       On due to: Manual                               
      <br><br>
                                <button disabled class="btn btn-danger" onclick="window.location.href = 'change_pump_status.php?pumpid=1G1PU10&amp;status=Off'">Switch Off</button>
<button disabled class="btn btn-primary" onclick="window.location.href=&quot;device_dashboard.php?id=1G1PU10&quot;">Details</button>


                                <br><br>
    </div>
  </div>
</div>
</div>

<div class="filterDiv SHAMA MARKET SECTOR D-41G1PU11 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-blue" style="min-height: 170px;">
      
      <h3><b>Offline</b></h3>
      <h5 id="pumpName">Shama market Sector D-4</h5>
      <h5>Device ID: 1G1PU11</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-03-26 16:54:55<br>
      Average Voltage = 239.59 Volts <br>
      Total Current = 297.35 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.83 <br>
      Total KVA = 71.25<br>
      Offline Time: 2022-03-26 16:54:55<br>
       Non-Functional                               
      <br><br>
                           
<button disabled class="btn btn-primary" disabled="">Switch</button>
<button disabled class="btn btn-primary" disabled="disabled">Details</button>
                              <br><br>
    </div>
  </div>
</div>
</div>

<div class="filterDiv C-03 AFGHAN MARKET1G1PU12 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-green" style="min-height: 170px;">
      
      <h3><b>On</b></h3>
      <h5 id="pumpName">C-03 afghan market</h5>
      <h5>Device ID: 1G1PU12</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-07-18 10:22:15<br>
      Average Voltage = 229.71 Volts <br>
      Total Current = 301.77 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.85 <br>
      Total KVA = 69.39<br>
      Switch On Time: 2022-07-18 10:00:00<br>
       On due to: Auto-Online                               
    <br><br>
    <button disabled class="btn btn-danger" onclick="window.location.href = 'change_pump_status.php?pumpid=1G1PU12&amp;status=Off'">Switch Off</button>
    <button disabled class="btn btn-primary" onclick="window.location.href=&quot;device_dashboard.php?id=1G1PU12&quot;">Details</button>


                                <br><br>
    </div>
  </div>
</div>
</div>

<div class="filterDiv P2 TATARA PARK1G1PU13 show">
<div class="col col-md-3">
  <div class="box box-widget widget-user-2" style="text-align: center;">
 
    <div class="widget-user-header bg-green" style="min-height: 170px;">
      
      <h3><b>On</b></h3>
      <h5 id="pumpName">P2 Tatara Park</h5>
      <h5>Device ID: 1G1PU13</h5>
    
    </div>

    <div class="box-footer no-padding">
      
      Last Pulse: 2022-07-18 10:22:09<br>
      Average Voltage = 240.67 Volts <br>
      Total Current = 282.45 Amps<br>
      <!--?php?-->
      Average Power Factor = 0.86 <br>
      Total KVA = 67.96<br>
      Switch On Time: 2022-07-18 09:57:16<br>
       On due to: Manual                               
      <br><br>
<button disabled class="btn btn-danger" onclick="window.location.href = 'change_pump_status.php?pumpid=1G1PU13&amp;status=Off'">Switch Off</button>
<button disabled class="btn btn-primary" onclick="window.location.href=&quot;device_dashboard.php?id=1G1PU13&quot;">Details</button>


                                <br><br>
    </div>
  </div>
</div>
</div>


</div>
    </section>
   
  </div>
  <!-- /.content-wrapper -->
  
	<?php include_once('includes/footer.php') ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include_once('includes/script.php') ?>
</body>
</html>
