<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
     <?php  $pageName = " Prediction Details";  ?>
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
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <!-- <h3><span>Prediction Detailed Dashboard</span></h3> -->
        </div>

        <?php 
          require_once("db/opendb.php");
          $id = "HTD01";
          $query = "select river_level_prediction.*, htdl.name from river_level_prediction, htdl where river_level_prediction.location = htdl.id and location = '".$id."' order by datetime desc limit 60";
          // echo $query;
          $result = $conn -> query($query) or die(error);

          $data1 = array();
          $data2 = array();
          $data3 = array();
          $data4 = array();
          $data5 = array();
          $result = $conn ->query($query) or die(error);
          $location = "";
          foreach($result as $row){
              $pl = $row['predicted_level'];
              $al = $row['actual_level'];
              $error = abs($pl-$al);

              array_push($data1,round($pl,2));
              array_push($data2,round($al,2));
              array_push($data3,round($error,2));
              array_push($data4,$row['predicted_time']);  
              $location = $row['location'] ;
              $name = $row['name'] ;
          }

        ?>
        <script type="text/javascript"> 
                  var js_data1 = [<?php echo '"'.implode('","', $data1).'"' ?>];
                  var js_data2 = [<?php echo '"'.implode('","', $data2).'"' ?>];
                  var js_data3 = [<?php echo '"'.implode('","', $data3).'"' ?>];
                  var js_data4 = [<?php echo '"'.implode('","', $data4).'"' ?>];
                  var titleID = "<?php echo "MANSOOR KHAN TESTING"; ?>";

              </script>
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class=" col-lg-3 col-md-6">
            <div class="info-box mb-4 bg-success">
              <!-- <i class="fas fa-map-marker"></i> -->
              <div class="inner"> 
                <h5 class=" heading"style="color: white;"><?php echo $location;?></h5>
                  <p class=" heading"style="color: white;">Location ID</p>
              </div>
            </div> 
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="info-box mb-4 bg-danger" >
              <!-- <i class="fas fa-list"></i> -->
              <div class="inner"> 
                <h5 class=" heading"style="color: white;"><?php echo $name;?></h5>
                  <p class="para"style="color: white;">Name</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="info-box mb-4 bg-warning">
              <!-- <i class="fas fa-calendar"></i> -->
              <div class="inner"> 
              <h5 class=" heading"style="color: white;"><?php echo $data1[0];?> m</h5>
                <p class="para"style="color: white;">Predicted Water Level Values</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="info-box mb-4 bg-info" >
              <!-- <i class="fas fa-clock"></i> -->
              <div class="inner"> 
                <h5 class=" heading"style="color: white;"><?php echo $data4[0];?></h5>
                  <p class="para "style="color: white;">Predicted Date & Time</p>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row" style="display: block;">
          <div class="col col-md-12 ">
            <div class="box box-warning">
              <div class="box-header with-border">
            </div> <!--- boox header-->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div id="chart"></div>
                  <br>
                </div>
              </div> <!---row--->
            </div> <!--box-body--->
      <script>
      
        var options = {
          series: [{
            name: "Predicted Water Level",
            data: js_data1.reverse()
          },
          {
            name: "Actual Water Level",
            data: js_data2.reverse()
          },
          {
            name: "Error",
            data: js_data3.reverse()
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
          categories:js_data4.reverse(),
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
          </div> <!---box box-primary--->
        </div>  <!---col-md-12-->
      </div>    <!---row-->
    </div>      <!---container--->
  </section><!-- End Contact Section -->
</main><!-- End #main -->

  <!-- ======= Footer ======= -->

     <?php  include("includes/footer.php");  ?>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php  include("includes/scripts.php");  ?>

</body>

</html>