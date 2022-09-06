<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Write Name Here!"?>



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
	<?php include_once('sidebar.php') ?>

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
      <?php 
      include("opendb.php");
      $total="Select count(*) as total from person";
      $result = $conn -> query($total) or die(error);
      // $res=mysqli_query($conn,$total);
      foreach($result as $row){
        $total=$row['total'];
        // echo $total;

      }
      ?>
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $total?></h3>
              <p>Total Employees</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <?php 
                include("opendb.php");
                $absent="Select count(*) as present from raw_data where date_time=substring_index(now(), ' ',1 )";
                $result1 = $conn -> query($absent) or die(error);
                // $res=mysqli_query($conn,$total);
                foreach($result1 as $row){
                  $present=$row['present'];
                  // echo $total;

                }
                ?>


              <div class="row">                
                <div class="col-lg-3 col-xs-6">
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3><?php echo $present?></h3>
                      <p>Total Present</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>

                      <!-- <div class="row">  
                        <div class="col-lg-3 col-xs-6">
                          <div class="small-box bg-red">
                            <div class="inner">
                              <h3>150</h3>
                              <p>Total Absent</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                              </div>

               -->
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
