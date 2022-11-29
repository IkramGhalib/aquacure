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
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $pageName;?></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <?php echo "Page Load Time: ".date('Y/m/d H:i:s');?>
      <div class="row" style="text-align: center;">
         <?php
          for($i=1; $i<11; $i++){
          ?>
            <div class="col col-sm-3 col-md-2" style="width: 225px;">
              <div class="box box-widget widget-user" >
                <div class="widget-user-header bg-primary">
                  <h3 class="widget-user-username"><b>Tank <?php echo $i; ?></b></h3>
                  <h5 class="widget-user-desc">1G1TK<?php echo $i; ?></h5>
                </div>
                <div class="box-footer no-padding" style="height: 280px; align-items: center; display: block;">
                  <iframe src="load_tank.php?gal=<?php echo $i*100; ?>&percent=<?php echo $i*10; ?>" width="100%" height="270" border="0" style="border:none;"></iframe>
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
