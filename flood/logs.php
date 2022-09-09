<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Smart FLood Mointering </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

    <?php   include("includes/head.php");  ?>
     <?php  $pageName = "Device Logs";  ?>
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

    <section class="inner-page">
      <div class="container">
        <div class="row">&nbsp;</div>
      <div class="row">&nbsp;</div>
    <div id="chart-container"></div>
   
        <div id="overflow" style="overflow-x:auto; border-style:">
          <table id="example1" style="width:100%;" class="table table-striped table-bordered">
            <thead class="thead-dark">
              <!-- <table class="table">
  <thead class="thead-dark"> -->
              <tr>
                <th>Device ID</th>
                <th>Rainfall</th>
                
                <th>Flow</th>
                <th>River Level</th>
                <th>Date & Time</th>
               

              </tr>
            </thead>
            <tbody>
              <?php
              require_once("db/opendb.php");
              // $id = "1710177817915";
             // echo $_SESSION['FUser']['password'];
              $query = "select * from devicelogs";
              $result = $conn->query($query) or die("Query error");

                 foreach ($result as $value) {
              ?>
                <tr>
                  <td><?php echo $value['deviceId']; ?></td>
                  <td><?php echo $value['rainfall']; ?></td>
                  <td><?php echo $value['flow']; ?></td>
                  <td><?php echo $value['river_level']; ?></td>

                  <td><?php echo date( 'M d Y g:i A ', strtotime($value['dateTime'])) ?></td>
                  

                </tr>
              <?php } ?>
             
            </tbody>
            <tfoot class="bg-blue">
              <tr>

                <th>Device ID</th>
                <th>Rainfall</th>
              
                <th>Flow</th>
                <th>River Level</th>
                <th>Date & Time</th>
               
              </tr>

            </tfoot>
          </table>

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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
       "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>