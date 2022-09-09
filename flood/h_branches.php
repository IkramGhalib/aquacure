<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
     <?php  $pageName = "Branches - Historical Data";  ?>
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

      $river = (isset($_GET['r'])) ? $_GET['r'] : NULL;

      if ($river == NULL) {
        $query = "SELECT branches.*, rivers.name as rname, MIN(CAST(water_level.datetime AS CHAR)) as dtFrom, count(water_level.log_id) as cnt, MAX(CAST(water_level.datetime AS CHAR))dtTo FROM branches, rivers, water_level WHERE branches.bid = water_level.branch and rivers.rid = branches.river group by branch order by name";
      }else{
        $query = "SELECT branches.*, rivers.name as rname, MIN(CAST(water_level.datetime AS CHAR)) as dtFrom, count(water_level.log_id) as cnt, MAX(CAST(water_level.datetime AS CHAR))dtTo FROM branches, rivers, water_level WHERE branches.bid = water_level.branch and rivers.rid = branches.river and river = '".$river."' group by branch";
      }
      

      $result = $conn -> query($query) or die(error);
?>

    <section class="inner-page">
      <div class="container">
        <div class="row">



<?php
      foreach($result as $row){
        $b = $row['bid'];
        $bn = $row['name'];
        $from  = substr($row['dtFrom'],0,10);
        $to = substr($row['dtTo'],0,10);


        ?>

          <div class="card ">
            <div class=" row card-title bg-secondary">
              <h5 class="card-title"><br><?php echo $row['name']; ?><br></h5>
            </div>
            <div class="card-body" style="color: black; font-size: 12px;">
              
              <p>
                Branch ID: <?php echo $row['bid']; ?> <br>
                River Name <?php echo $row['rname']; ?><br>
                Data From: <?php echo $row['dtFrom']; ?><br>
                Data To: <?php echo $row['dtTo']; ?><br>
                Records: <?php echo $row['cnt']; ?><br>
              </p>
              
              <button class="btn btn-outline-success btn-sm" onclick="window.location.href = 'h_graph.php?b=<?php echo $b;?>&bn=<?php echo $bn; ?>&f=<?php echo $from; ?>&t=<?php echo $to; ?>'">Graph</button>
              <!-- <button class="btn btn-outline-danger btn-sm">Download</button> -->
              
            </div>
          </div>

        <?php
      }
    ?>
        

        </div>

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