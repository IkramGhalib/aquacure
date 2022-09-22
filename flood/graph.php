<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
  <?php  $pageName = "Device Details Graph";  ?>

  <title><?php echo $pageName; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

    <?php   include("includes/head.php");  ?>
</head>

<?php   include("includes/navbar.php");  ?>

  <main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><?php  echo $pageName ?></li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <div id="chartRenderHere" class="row">
          </div>
  
        <?php 
        $device = $_GET['id'];
        require_once("db/opendb.php");
        $query = "SELECT FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(server_datetime) / (60*60)) * (60*60)) AS hourlytime, avg(temp) as Temperature, AVG(humidity) as Humidity, AVG(air_pressure) as Pressure, AVG(CO) as CO, AVG(wind_speed) as WIND, AVG(SO_2) as SO2, AVG(CO2) as CarbonDioxide, AVG(No_x) as NOX, AVG(NO2) as NitrogenDioxide, AVG(sunlight) as SunLight, AVG(noise) as Noice, AVG(O3) as Ozone, AVG(wind_dir) as DIR, AVG(rain) as Rain,AVG(D_10) as Dust1, AVG(D2_5) as Dust2 from raw_logs where mid = '" . $device . "' GROUP BY hourlytime ORDER BY hourlytime desc limit 24";
        // echo $query;
  
        $result = $conn->query($query);
        $graphName = "Smart Env";
        // echo $graphName;
  
        $data1 = array();
        $data2 = array();
        $data3 = array();
        $data4 = array();
        $data5 = array();
        $data6 = array();
        $data7 = array();
        $data8 = array();
        $data9 = array();
        $data10 = array();
        $data11 = array();
        $data12 = array();
        $data13 = array();
        $data14 = array();
        $data15 = array();
        $data16 = array();
        $data17 = array();
        
  
        array_push($data1, "Temperature (C)");
        array_push($data2,  "0000-00-00 00:00:00");
        array_push($data3, "Humidity (%)");
        array_push($data4, "Pressure (mb)");
        array_push($data5, "Carbon Monoxide (ppm)");
        array_push($data6, "Wind (m/sec)");
        array_push($data7, "Sulpher Dioxide (ppm)");
        array_push($data8, "Carbon Dioxide (ppm)");
        array_push($data9, "NOX");
        array_push($data10, "Nitrogen Dioxide (ppm)");
        array_push($data11, "Sun Light (lux)");
        array_push($data12, "Noise (db)");
        array_push($data13, "Ozone (ppm)");
        array_push($data14, "DIR");
        array_push($data15, "Rain (mm)");
        array_push($data16, "Dust (PM 10)");
        array_push($data17, "AQI");
        
  
        foreach ($result as $row) {
          $Temperture     =     (round($row['Temperature'],2));
          $hum            =     (round($row['Humidity'],2));
          $press          =     (round($row['Pressure'],2));
          $co             =     (round($row['CO'],2));
          $w_s            =     (round($row['WIND'],2));
          $so_2           =     (round($row['SO2'],2));
          $co_2           =     (round($row['CarbonDioxide'],2));
          $no_x           =     (round($row['NOX'],2));
          $No_2           =     (round($row['NitrogenDioxide'],2));
          $sun            =     (round($row['SunLight'],2));
          $noise          =     (round($row['Noice'],2));
          $o_3            =     (round($row['Ozone'],2));
          $W_d            =     (round($row['DIR'],2));
          $Rain          =     (round($row['Rain'],2));
          $DUST1          =     AQIPM25($row['Dust1']);
          $DUST2          =     (round($row['Dust2'],2));
          $date           =     ($row['hourlytime']);
          echo $co;
  

          array_push($data1, $Temperture);
          array_push($data2,  $date);
          array_push($data3, $hum);
          array_push($data4, $press);
          array_push($data5, $co);
          array_push($data6, $w_s);
          array_push($data7, $so_2);
          array_push($data8, $co_2);
          array_push($data9, $no_x);
          array_push($data10, $No_2);
          array_push($data11, $sun);
          array_push($data12, $noise);
          array_push($data13, $o_3);
          array_push($data14, $W_d);
          array_push($data15, $Rain);
          array_push($data16, $DUST1);
          array_push($data17, $DUST2);
          // echo $data1;
  
        }
  
        function Linear($AQIhigh, $AQIlow, $Conchigh, $Conclow, $Concentration)
        {
          $linear;
          $Conc=$Concentration;
          $a;
          $a=(($Conc-$Conclow)/($Conchigh-$Conclow))*($AQIhigh-$AQIlow)+$AQIlow;
          $linear=round($a);
          return $linear;
        }
  
        function AQIPM25($Concentration)
        {
        $Conc=$Concentration;
        $c;
        $AQI;
        $c=(10*$Conc)/10;
        if ($c>=0 && $c<12.1)
        {
        $AQI=Linear(50,0,12,0,$c);
        }
        else if ($c>=12.1 && $c<35.5)
        {
        $AQI=Linear(100,51,35.4,12.1,$c);
        }
        else if ($c>=35.5 && $c<55.5)
        {
        $AQI=Linear(150,101,55.4,35.5,$c);
        }
        else if ($c>=55.5 && $c<150.5)
        {
        $AQI=Linear(200,151,150.4,55.5,$c);
        }
        else if ($c>=150.5 && $c<250.5)
        {
        $AQI=Linear(300,201,250.4,150.5,$c);
        }
        else if ($c>=250.5 && $c<350.5)
        {
        $AQI=Linear(400,301,350.4,250.5,$c);
        }
        else if ($c>=350.5 && $c<500.5)
        {
        $AQI=Linear(500,401,500.4,350.5,$c);
        }
        else
        {
        $AQI="Out of Range";
        }
        return $AQI;
        }
  
  ?>
  <script type="text/javascript">
  
  
   function loadGraph(name_g, text_g, data,datentime,div,color){
    data = data.reverse();
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
    
    
    var allData = [[<?php echo '"' . implode('","', $data2) . '"' ?>],[<?php echo '"' . implode('","', $data1) . '"' ?>],[<?php echo '"' . implode('","', $data3) . '"' ?>],[<?php echo '"' . implode('","', $data4) . '"' ?>],[<?php echo '"' . implode('","', $data5) . '"' ?>],[<?php echo '"' . implode('","', $data6) . '"' ?>],[<?php echo '"' . implode('","', $data7) . '"' ?>],[<?php echo '"' . implode('","', $data8) . '"' ?>],[<?php echo '"' . implode('","', $data9) . '"' ?>],[<?php echo '"' . implode('","', $data10) . '"' ?>],[<?php echo '"' . implode('","', $data11) . '"' ?>],[<?php echo '"' . implode('","', $data12) . '"' ?>],[<?php echo '"' . implode('","', $data13) . '"' ?>],[<?php echo '"' . implode('","', $data14) . '"' ?>],[<?php echo '"' . implode('","', $data15) . '"' ?>],[<?php echo '"' . implode('","', $data16) . '"' ?>],[<?php echo '"' . implode('","', $data17) . '"' ?>]];
  
      // console.log(allData);
      var tempArray = [];
      var name = "";
      var nouse = allData[0].shift();
      
      datentime = allData[0];
      datentime = datentime.reverse();
      var colors = ["#4a9ae2"];
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
             loadGraph(name, name, tempArray, datentime,"#chart"+i,selectedColor);
          }
      }
      </script>  
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