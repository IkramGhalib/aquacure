<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <?php  $pageName = "Device-- Historical Data";  ?>

  <title><?php echo $pageName; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

    <?php   include("includes/head.php");  ?>
    
  <!-- =======================================================
  * Template Name: BizLand - v3.1.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
 <?php   include("includes/navbar.php");  ?>

  <main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
   <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2><?php  echo $pageName ?></h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><?php  echo $pageName ?></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <style type="text/css">
     .card{
      margin: 3px;
      color: white;
      width: 24%;
     } 
    </style>

    <?php 
      require_once("db/opendb.php");
      $query = "SELECT * FROM `device`";
      // echo $query;
      

      $result = $conn -> query($query) or die(error);
?>

    <section class="inner-page">
      <div class="container">
        <div class="row">



<?php
      foreach($result as $row){
        $d= $row['device_id'];
        // echo $r;

        ?>

          <div class="card ">
            <div class=" row card-title bg-primary">
              <h5 class="card-title"><br><?php echo $row['name']; ?><br></h5>
            </div>
            <div class="card-body" style="color: black; font-size: 12px;">
              
              <p>
                Device ID: <?php echo $row['device_id']; ?> <br>
                Name: <?php echo $row['name']; ?> <br>
                Longitude:  <?php echo $row['latitude']; ?><br>
                Latitude: <?php echo $row['longitude']; ?>
              </p>
              
              <button class="btn btn-outline-primary btn-sm" onclick="window.location.href = 'graph.php?id=<?php echo $d;?>'">Details</button>
            </div>
          </div>

        <?php
      }
    ?>
        

        </div>

      </div>

      <br>
      <br>
      <br>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->

     <?php  include("includes/footer.php");  ?>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php  include("includes/scripts.php");  ?>

</body>

</html>