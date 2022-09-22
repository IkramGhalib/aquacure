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
     $sql="Select * from device"; 
     $result = $conn->query($sql); 
     foreach ($result as $value)
     {?>
        <option value="<?php echo $value['device_id']; ?>"><?php echo $value['name']; ?></option>
          
	     <?php
     	}
     ?>
   </datalist>
   
    </div>
        <div class="col col-md-1">
         <b> From Date</b>
        </div>
    <div class="col col-md-3">
      <input type="date" id="fromdate" name="fromdate" class="form-control" placeholder="Logs From">
    </div>
     <div class="col col-md-1">
         <b> To Date</b>
        </div>
    <div class="col col-md-3">
      <input type="date" id="todate" name="todate" class="form-control" placeholder="Logs From">
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
  $fromdate=$_POST['fromdate'];
  $todate=$_POST['todate'];
        $query = "SELECT devices_logs.*, device.name FROM `devices_logs`, device where device.device_id = devices_logs.device_id and devices_logs.device_id = '".$id."' AND devices_logs.datetime BETWEEN '".$fromdate."' AND '".$todate."' order by datetime desc";

        //echo $query;
       
            $result = $conn->query($query); 
            if($result->rowCount()>0)
            {
                  echo ' <br><div class="alert alert-success alert-dismissible">
                  <h5><i class="icon fas fa-check"></i> Success!</h5>
                  Showing data  of Device <b>'.$id.'</b> from '.$fromdate.' To '.$todate.'
                </div>';


               ?> 
              
            
      <div id="overflow" style="overflow-x:auto; border-style:">
          <table id="example1" style="width:100%;" class="table table-striped table-bordered">
            <thead class="thead-dark">
              <!-- <table class="table">
  <thead class="thead-dark"> -->
              <tr>
                <th>Device ID</th>
                <th>Name</th>
                <th>Temprature (<sup>o</sup>C)</th>
                <th>Humidity (%)</th>
                <th>Rain</th>
                <th>Flow</th>
                <th>Water Level</th>
                <th>Pressure</th>
                <th>Date & Time</th>
                
               

              </tr>
            </thead>
            <tbody>
              <?php

                 foreach ($result as $value) {
              ?>
                <tr>
                  <td><?php echo $value['device_id']; ?></td>
                  <td><?php echo $value['name']; ?></td>
                  <td><?php echo $value['temprature']; ?></td>
                  <td><?php echo $value['humidity']; ?></td>
                  <td><?php echo $value['rainfall']; ?></td>
                  <td><?php echo $value['flow']; ?></td>
                  <td><?php echo $value['water_level']; ?></td>
                  <td><?php echo $value['pressure']; ?></td>

                  <td><?php echo date( 'M d Y g:i A ', strtotime($value['dateTime'])) ?></td>
                  

                </tr>
              <?php } ?>
             
            </tbody>
          </table>

        </div>
      </div>
      <?php }
       else{
        echo ' <br><div class="alert alert-danger alert-dismissible">
                  
                  <h5><i class="icon fas fa-check"></i> Error!</h5>
                  No data found against From  '.$fromdate.' To '.$todate.'
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