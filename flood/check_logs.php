<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
<?php  $pageName = "Devices Logs";  ?>
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

    <section class="inner-page">
      <div class="container">
        <form method="post" id="frm" name="frm">
  <div class="row">
    <div class="col col-md-3">

     <input type="text" list="devices" name="device" placeholder="Select Device" required="required" class="form-control"> 
     <datalist id="devices">"; 
     <?php  require "db/opendb.php"; 
     $sql="Select * from devices"; 
     $result = $conn->query($sql); 
     foreach ($result as $value)
     {
      echo  "<option value=".$value['device_id']."/>";
  
      }
     echo "</datalist>";
     
     ?>
   
    </div>
        <div class="col col-md-3">
     
      <select class="form-control" name="txtinterval" id="txtinterval">
        
        <option >--Select Interval--</option>
        <option value="60">Hourly</option>
        <option value="1440">Daily</option>
      </select>
    </div>
    <div class="col col-md-3">
     <select class="form-control" name="txtrange" id="txtrange">
        
        <option name="txtrange">--Select Range--</option>
        <option>Today</option>
        <option>Yesterday</option>
      </select>
    </div>
    <div class="col col-md-1">
      
      <button type="submit" name="btnShowmoreDetails" class="btn btn-block btn-info">Load</button>
    </div>
  </div>
</form> 
<br>
<div id="dataTable" name="dataTable"> </div>

<?php 
if(isset($_POST['btnShowmoreDetails']))
{
  
  $id=$_POST['device'];
  $interval=$_POST['txtinterval'];
  // $range=$_POST['txtrange'];
        $query = "SELECT FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(dateTime) / ($interval*60)) * ($interval*60)) AS hourlytime, device_id,water_level from devicelogs where device_id='".$id."' GROUP BY device_id, hourlytime,water_level ORDER BY hourlytime desc limit 24";
       
            $result = $conn->query($query); 
            if($result->rowCount()>0)
            {
                  echo ' <br><div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> Success!</h5>
                  Showing data  of Device <B>'.$id.'<B> '.$interval.' To '.$range.' </b>
                </div>';


               ?> 
              
            
      <div id="overflow" style="overflow-x:auto; border-style:">
          <table id="example1" style="width:100%;" class="table table-striped table-bordered">
            <thead class="thead-dark">
              <!-- <table class="table">
  <thead class="thead-dark"> -->
              <tr>
                <th>Device ID</th>
                <!-- <th>Name</th> -->
                <th>River Level</th>
                <!-- <th>Date & Time</th> -->
                
               

              </tr>
            </thead>
            <tbody>
              <?php

                 foreach ($result as $value) {
              ?>
                <tr>
                  <td><?php echo $value['device_id']; ?></td>
                  <td><?php //echo $value['name']; ?></td>
                  <td><?php echo $value['water_level']; ?></td>

                  
                  

                </tr>
              <?php } ?>
             
            </tbody>
            <tfoot class="bg-blue">
              <tr>

                <th>Device ID</th>
                <!-- <th>Name</th> -->
                <th>River Level</th>
                <!-- <th>Date & Time</th> -->
               
              </tr>

            </tfoot>
          </table>

        </div>
      </div>
      <?php }
       else{
        echo ' <br><div class="alert alert-danger alert-dismissible">
                  
                  <h5><i class="icon fas fa-check"></i> Error!</h5>
                  No data found against From  '.$interval.'
                </div>';
                
       }


      }



        ?>

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