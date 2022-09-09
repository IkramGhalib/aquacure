<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <?php  $pageName = "Flood Prediction";  ?>
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
   <script>
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
        )
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    

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
        <div class="row">
          <div class="col col-md-2">
            <label>Select Location</label>
          </div>
          <div class="col col-md-2">
            <label>Single/Multi Paramter </label>
          </div>
          <div class="col col-md-2">
            <label>Select Parameter</label>
          </div>
          <div class="col col-md-2">
            <label>From Date</label>
          </div>
         <div class="col col-md-2">
            <label>To Date</label>
          </div> 
          <div class="col col-md-2">
            <label></label>
          </div>
        </div>

        <form method="post">
          
        
        <div class="row">
          <div class="col col-md-2">
            <select name="location" class="form-control">
              <option value="HTD01">Mernda</option>
              <option value="HTD02">Brooklyn</option>
            </select>
          </div>
          <div class="col col-md-2">
            <select class="form-control">
              <option>Single Parameter</option>
              <option disabled>Multi Parameter</option>
            </select>
          </div>

          <div class="col col-md-2">
            <select class="form-control">
              <option>Water Level</option>
              <option disabled>Water Flow</option>
              <option disabled>Temprature</option>
              <option disabled>Humidity</option>
              <option disabled>Water Pressure</option>
            </select>
          </div>
          <!-- <div class="col col-md-2">
            <select class="form-control">
              <option>AI</option>
              <option>IoT</option>
              
            </select>
          </div> -->
          
          <div class="col col-md-2" >
            <input type="date" name="from" required class="form-control" min='2021-06-01' max="2021-06-30">
          </div>
          <div class="col col-md-2">
            <input type="date" name="to" class="form-control" min='2021-06-01' max="2021-06-30">
          </div>
          <div class="col col-md-2">
            <button class="btn btn-danger" name="btnSubmit" class="form-control">SUBMIT</button>
          </div>

        </div>

        </form>
      
        <?php
          if (isset($_POST['btnSubmit'])) {
            ?>
                <br><br>
        <div id="chart"></div>
            <?php
              require_once("db/opendb.php");
              $location = $_POST['location'];
              if (isset($_POST['from'])) {
                $from = $_POST['from'];
                if (isset($_POST['to'])) {
                  $to = $_POST['to'];
                }else{
                  $to = date('Y-m-d', strtotime($from. ' + 2 days'));
                }

                $query = "select * from river_level_prediction where location = '".$location."' and predicted_time between '".$from."' and '".$to."' order by datetime desc";
              }else{
                $query = "select * from river_level_prediction where location = '".$location."' order by datetime desc limit 50";
              }
              
              $data1 = array();
              $data2 = array();
              $data3 = array();
              $data4 = array();
              $data5 = array();
              $result = $conn ->query($query) or die(error);
              foreach($result as $row){
                  $pl = $row['predicted_level'];
                  $al = $row['actual_level'];
                  $error = abs($pl-$al);

                  array_push($data1,round($pl,2));
                  array_push($data2,round($al,2));
                  array_push($data3,round($error,2));
                  array_push($data4,$row['predicted_time']);  
                  array_push($data5, $row['location']) ;
                  
              }
                  $data1 = array_reverse($data1);
                  $data2 = array_reverse($data2);
                  $data3 = array_reverse($data3);
                  $data5 = array_reverse($data5);
                  $data4 = array_reverse($data4);
                  
              ?>
              <script type="text/javascript"> 
                  var js_data1 = [<?php echo '"'.implode('","', $data1).'"' ?>];
                  var js_data2 = [<?php echo '"'.implode('","', $data2).'"' ?>];
                  var js_data3 = [<?php echo '"'.implode('","', $data3).'"' ?>];
                  var js_data4 = [<?php echo '"'.implode('","', $data4).'"' ?>];
                  var titleID = "<?php echo "MANSOOR KHAN TESTING"; ?>";

              </script>
              <br>
               <script>
      
        var options = {
          series: [{
            name: "Predicted Water Level",
            data: js_data1
          },
          {
            name: "Actual Water Level",
            data: js_data2
          },
          {
            name: "Error",
            data: js_data3
          }
        ],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: [2, 2, 2],
          curve: 'straight',
          dashArray: [0, 0, 0]
        },
        title: {
          text: 'Water Level Comparison Graph',
          align: 'left'
        },
        legend: {
          tooltipHoverFormatter: function(val, opts) {
            return val + ' - <strong>' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + '</strong>'
          }
        },
        markers: {
          size: 0,
          hover: {
            sizeOffset: 6
          }
        },
        xaxis: {
          categories:js_data4,
        },
        tooltip: {
          y: [
            {
              title: {
                formatter: function (val) {
                  return val + " (mins)"
                }
              }
            },
            {
              title: {
                formatter: function (val) {
                  return val + " per session"
                }
              }
            },
            {
              title: {
                formatter: function (val) {
                  return val;
                }
              }
            }
          ]
        },
        grid: {
          borderColor: '#f1f1f1',
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      
      
        </script>
                <br>
              <table id="example" class="table table-striped table-bordered">
          <thead>
            <tr>
              <td>Location</td>
              <td>Predicted Water Level</td>
              <td>Actual Water Level</td>
              <td>Predicted Date & Time</td>
              <td>Error</td>
            </tr>
          </thead>
          <tbody>
            <?php 
             for ($i=0; $i < sizeof($data1) ; $i++) { 
              ?>

                <tr>
                  <td><?php echo $data5[$i]; ?></td>
                  <td><?php echo $data4[$i]; ?></td>
                  <td><?php echo $data1[$i]; ?></td>
                  <td><?php echo $data2[$i]; ?></td>
                  <td><?php echo $data3[$i]; ?></td>
                  
                </tr>
                <?php  
             }
                
            ?>
          </tbody>
          <tfoot>
            
          </tfoot>
        </table>
              <?php
          }else{
            ?>
            <br><br>
              <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-ban"></i> Attention Please!</h5>
                    Please select location and datetime from the above given form. Thank you!
                </div>
              
            <?php
          }
        ?>
        <br><br>
        
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

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<!-- 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script> -->