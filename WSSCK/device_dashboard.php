<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  

  <?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

  }
  $pageName = $id ." Detailed Satistics"?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue sidebar-mini" >
<!-- Site wrapper -->
<div class="wrapper" style="overflow: hidden;">
  
  
  <!-- Navbar -->
  <?php include_once('navbar.php') ?>
  <!-- Sidebar -->
  <?php  include_once('sidebar.php') ?>

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

    <?php
      require_once("opendb.php");

      $query = "SELECT * FROM transformer where trid = '".$id."'";

      $result = $conn -> query($query) or die("Query error");
      $avgVoltage =0;
      $totalCurrent = 0;
        $avgpf = 0;
        $totalKVA = 0;
        //$peak = round(($row['kwh_peak1'] + $row['kwh_peak2'] + $row['kwh_peak3']),2);
        $offpeak = 0;
        $nc = 0;
      foreach ($result as $row) {
        $avgVoltage = round(($row['v1'] + $row['v2'] + $row['v3'])/3,2);
        $totalCurrent = round(($row['c1'] + $row['c2'] + $row['c3']),2);
        $avgpf = round(($row['pf1'] + $row['pf2'] + $row['pf3'])/3,2);
        $totalKVA = round((($row['v1']*$row['c1'] + $row['v2']*$row['c2'] + $row['v3']*$row['c3'])/1000),2);
        
        
      }
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $avgVoltage; ?> V</h3>

              <p><b>Average Voltage</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>

          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
             <h3><?php echo $totalCurrent; ?> A</h3>

              <p><b>Total Current</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $avgpf; ?></h3>

              <p><b>Average PF</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <h3><?php echo $totalKVA; ?></h3>

              <p><b>Total KVA</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>

          </div>
        </div>
        </div>

       

        <div class="row">
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="load_device_graph.php?id=<?php echo $id; ?>&type=3&name=Transformer 1" width="600" height="400" frameborder="0"></iframe>                                      
        </div>
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="load_device_graph.php?id=<?php echo $id; ?>&type=4&name=Transformer 1" width="600" height="400" frameborder="0"></iframe>                                      
        </div>
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="load_device_graph.php?id=<?php echo $id; ?>&type=0&name=Transformer 1" width="600" height="400" frameborder="0"></iframe>                                      
        </div>
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="load_device_graph.php?id=<?php echo $id; ?>&type=2&name=Transformer 1" width="600" height="400" frameborder="0"></iframe>                                      
        </div>
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="peak_offpeak_graph.php?id=<?php echo $id; ?>" width="600" height="450" frameborder="0"></iframe>                                      
        </div>

 </div>
 <table border="0" width="100%"></table>
    </div>

    </section>

    <!-- /.content -->






   
  </div>
  <!-- /.content-wrapper -->
  
  <?php include_once('footer.php') ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include_once('script.php') ?>
</body>
</html>
