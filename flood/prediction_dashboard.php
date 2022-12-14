<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <?php  $pageName = "Predication Dashboard";  ?>

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

  <!-- ======= Top Bar ======= -->
 <!--  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+92</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section> -->

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
   // $id =$_GET['id'];
   // $query = "select * from htdl where id = '".$id."'";

    $query = "select *from htdl";
      $result = $conn -> query($query) or die(error);
?>
    <section class="inner-page">
      <div class="container">
        <div class="row">
    <?php
      foreach($result as $row){
        $id = $row['id'];
        if ($row['predicted_waterlevel']<=0.2) {
          $color = "bg-success";
        }elseif($row['predicted_waterlevel']<=0.4) {
          $color = "bg-warning";
        }else {
          $color = "bg-danger";
        }
                
                

        ?>
          <div class="card">
              <div class="row card-title <?php echo $color;?>">
                <h5 class="card-title"><br><?php echo $row['name']; ?><br></h5>
              </div>
              <div class="card-body" style="color: black; font-size: 12px;">             
                <p>
                ID: <?php echo $row['id']; ?> <br>
                Name: <?php echo $row['name']; ?> <br>
                Longitude: <?php echo $row['longitude']; ?> <br>
                Latitude: <?php echo $row['latitude']; ?><br>
                Predicted Water level: <?php echo $row['predicted_waterlevel'];?> m<br>              
                </p>             
                <button class="btn btn-outline-primary btn-sm" onclick="window.location.href = 'prediction_details.php?id=<?php echo $id;?>'">Details</button>
              </div>
            </div>
        <?php
      }
    ?>
   
          </div>    
        </div>   <!----row end---->  
      </div>
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