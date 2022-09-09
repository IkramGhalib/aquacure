<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <?php
        require_once("db/opendb.php");
    $device = $_GET['id'];
    $name = $device;
    $nameQuery = "select name from devices where device_id = '".$device."'";
    $result = $conn -> query($nameQuery) or die(error);
    foreach($result as $row){
      $name = $row['name'];
    }
    $pageName = $name." Device Dashboard";  ?>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- <link rel="stylesheet"  href="dist/apexcharts.css"/> -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>


    <style type="text/css">
     .card{
      margin: 3px;
      color: white;
      width: 24%;
     } 
    </style>

    <section class="inner-page">
      <div class="container">
        
        

  <div id="chartRenderHere" class="row">
    
  </div>
  <div class="row">
    <div id="sample" class="col col-md-6"></div>
  </div>

      <?php 


      $query = "select * from devicelogs where device_id = '".$device."' order by dateTime asc limit 20";

      echo $query;

      $result = $conn->query($query);
      $graphName = "Smart environment";

      $data1 = array();
      $data3 = array();
      $data4 = array();
      $data5 = array();
      $data6 = array();
      $data7 = array();
      $data2 = array();

      array_push($data1, "Temperature");
      array_push($data3, "Humidity");
      array_push($data4, "Pressure");
      array_push($data4, "Water Level");
      array_push($data4, "Rain");
      array_push($data4, "Flow");

      array_push($data2,  "0000-00-00 00:00:00");

      foreach ($result as $row) {
        $temp           =     (round($row['temprature'],2));
        $hum            =     (round($row['humidity'],2));
        $press          =     (round($row['pressure'],2));
        $water_level    =     (round($row['water_level'],2));
        $rain           =     (round($row['rainfall'],2));
        $flow           =     (round($row['flow'],2));
        $date           =     ($row['dateTime']);

        //print_r($airquality);
        array_push($data1, $temp);
        array_push($data3, $hum);
        array_push($data4, $press);
        array_push($data5, $water_level);
        array_push($data6, $rain);
        array_push($data7, $flow);
        array_push($data2,  $date);


      }


?>
<script type="text/javascript">
var width_div = document.getElementById('sample').offsetWidth;
// alert(width);

 function loadGraph(name_g, text_g, data,datentime,div,color){
  //alert("Called");
  //var chart = document.querySelector("#chart")\
  data = data;
   var options = {
          series: [{
          name: name_g,
          data: data
        }],
        stroke: {
            width: 3
        },
        title: {
          text: text_g,
          align: 'left'
        },
          chart: {
          type: 'bar',

          width: width_div,
          height: 500
        },
        plotOptions: {
          bar: {
            horizontal: false,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: datentime,
        },
        grid: {
          borderColor: '#525253',
        },
        colors: [color]
        };

        var chart = new ApexCharts(document.querySelector(div), options);

        chart.render();
      
}

  function allZero(keyData){
      for(var x=1; x<keyData.length; x++){
        if(keyData[x] != 0){
          return false;
        }
      }
      return true;
  }
  
  
  var allData = [[<?php echo '"' . implode('","', $data2) . '"' ?>],[<?php echo '"' . implode('","', $data1) . '"' ?>],[<?php echo '"' . implode('","', $data3) . '"' ?>],[<?php echo '"' . implode('","', $data4) . '"' ?>],[<?php echo '"' . implode('","', $data5) . '"' ?>],[<?php echo '"' . implode('","', $data6) . '"' ?>],[<?php echo '"' . implode('","', $data7) . '"' ?>]];

    //console.log(allData);
    var tempArray = [];
    var name = "";
    var nouse = allData[0].shift();
    
    datentime = allData[0];
    datentime = datentime;
    var colors = ["#CBDF1F", "#90F13B", "#38E86B", "#38E8C3", "#388BE8", "#9D38E8", "#E338E8"];
    var selectedColor="";
      for (var i = 1; i < allData.length; i++) {

        tempArray = allData[i];

        if (!allZero(tempArray)) {
          //console.log(tempArray);

          name = allData[i].shift();
          DivCol = document.createElement('div');
          DivCol.setAttribute("id", "divcol"+i);
          DivCol.setAttribute("class", "col-md-6");
          document.getElementById("chartRenderHere").appendChild(DivCol);
          chartDiv = document.createElement('div');
          chartDiv.setAttribute("id", "chart"+i);
          document.getElementById("divcol"+i).appendChild(chartDiv);
          selectedColor = colors[Math.floor(Math.random()*colors.length)];
           //console.log(chartDiv);
          // console.log(tempArray);
          // console.log(datentime);

           loadGraph(name, name, tempArray, datentime,"#chart"+i,selectedColor);
        }
    }
</script>
<?php
$conn = null;
?>
     


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