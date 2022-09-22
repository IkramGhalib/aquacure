<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Tanks"?>

<style>
.filterDiv {
  display: none;
}

.show {
  display: block;
}

</style>
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
  <?php include_once('navbar.php'); ?>
  <!-- Sidebar -->
  <?php include_once('sidebar.php'); ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper" style="margin-top: <?php echo $contentmargin?>px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <b><?php echo $pageName;?></b>
        
      </h1>
      <ol class="breadcrumb">
        <?php echo "Page Load Time: ".date('Y/m/d H:i:s');?>
        
      </ol>
    </section>

    <?php
      require_once("opendb.php");
      $query = "select tank.*, (select distance from tank_parameters where tank_parameters.tank_id = tank.tank_id order by datetime desc limit 1) as distance,(select datetime from tank_parameters where tank_parameters.tank_id = tank.tank_id order by datetime desc limit 1) as lastpulse from tank";
      $result = $conn -> query($query) or die(error);
    ?>


    <!-- Main content -->
    <section class="content">

      <div class="row" style="text-align: center;">
         <?php
          foreach ($result as $row) {
            $distance = ($row['distance'] == NULL) ? $row['t_height'] : $row['distance'];
            $percent = (($row['t_height']-$distance)/$row['t_height'])*100;
            $capacity = round(($row['t_height']*$row['t_area'])/3785.41,2);
            $water = ($percent/100)*$capacity;
            $lastPulse = $row['lastpulse'];
          ?>
            <div class="col col-sm-3 col-md-2" style="width: 225px;">
              <div class="box box-widget widget-user" >
                <div class="widget-user-header bg-primary">
                  <h3 class="widget-user-username"><b><?php echo $row['tank_id']; ?></b></h3>
                  <p>
                    <?php echo $row['name']; ?><br>
                    <!-- <?php //echo "Capacity: ".$capacity; ?> gal<br> -->
                    <?php echo "LP: ".$lastPulse; ?><br>
                  </p>
                 
                  
                </div>
                <div class="box-footer no-padding" style="height: 280px; align-items: center; display: block;">
                  <iframe src="load_tank.php?gal=<?php echo $water; ?>&percent=<?php echo $percent; ?>" width="100%" height="270" border="0" style="border:none;"></iframe>
                </div>

              </div>
              <!-- /.widget-user -->
            </div>

          <?php
          }
         ?>
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
