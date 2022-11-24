<?php 
  // include_once('user_logs.php');
  // auth_user($_SESSION['userinfo']['tw_dash']);
?>

<!DOCTYPE html>
<html>
<head>
  
<?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

  }


      require_once("opendb.php");

      $query = "SELECT * FROM transformer where trid = '".$id."'";

      $result = $conn -> query($query) or die("Query error");
      $avgVoltage =0;
      $totalCurrent = 0;
        $avgpf = 0;
        $totalKVA = 0;
        //$peak = round(($row['kwh_peak1'] + $row['kwh_peak2'] + $row['kwh_peak3']),2);
        $offpeak = 0;
        $nc = 0;
        $name = "";
        $zone ="";
        $location = "";
        $uc = 0;
        $nec = 0;
        $twid="";
        $trid="";
      foreach ($result as $row) {
        $twid = $row['twid'];
        $trid = $row['trid'];
        $name = $row['name'];
        $zone = $row['zone'];
        $location = $row['location'];
        $uc = $row['uc'];
        $nec = $row['nc'];
        $avgVoltage = round(($row['v1'] + $row['v2'] + $row['v3'])/3,2);
        $totalCurrent = round(($row['c1'] + $row['c2'] + $row['c3']),2);
        $avgpf = round(($row['pf1'] + $row['pf2'] + $row['pf3'])/3,2);
        $totalKVA = round((($row['v1']*$row['c1'] + $row['v2']*$row['c2'] + $row['v3']*$row['c3'])/1000),2);
        $instant_flow = round($row['instant_flow'],2);
        $water_pumped = round($row['pump_water'],2);
        $last_pulse = $row['datetime'];
        $fm = $row['flowmeter'];
      }

        $pageName = "Detailed Satistics Dashboard";
    ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- <link rel="stylesheet"  href="dist/apexcharts.css"/> -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue sidebar-mini" >
<!-- Site wrapper -->
<div class="wrapper" style="overflow: hidden;">
	
	
	<!-- Navbar -->
	<?php include_once('navbar.php') ?>
	<!-- Sidebar -->
	<?php include_once('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper" style="margin-top: <?php echo $contentmargin?>px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <b><?php echo $pageName." <br>".$name." | ".$location." | Zone: ".$zone." | UC: ".$uc." | NC: ".$nec." | ".$trid." | ".$twid;?></b>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $pageName;?></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $avgVoltage; ?> V</h3>

              <p><b>Average Voltage</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>

          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
             <h3><?php echo $totalCurrent; ?> A</h3>

              <p><b>Total Current</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo ($totalCurrent < 1) ? 0 : $avgpf; ?></h3>

              <p><b>Average PF</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <h3><?php echo $totalKVA; ?></h3>

              <p><b>Total KVA</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>

          </div>
        </div>

        <?php 
          if ($fm == 1) {
            ?>


         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $instant_flow; ?></h3>

              <p><b>Instant Flow (m<sup>3</sup>/hr)</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>

          </div>
        </div>
         <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3><?php echo $water_pumped; ?></h3>

              <p><b>Total Water Pumped (m<sup>3</sup>)</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>

          </div>
        </div>
         
         <?php 
          }
        ?>
        </div>

    <!-- Main content -->
    <section class="content">
      
<div id="chartRenderHere" class="row">
    

  </div>

      <?php 
      $id = $_GET['id'];
      require_once("opendb.php");
      $query = "SELECT v1, v2, v3, pf1, pf2, pf3, B1U, B1M, B1L, datetime from tr_current_logs where trid = '".$id."' order by id desc limit 60";

      $result = $conn->query($query);
      $graphName = "Details";
        

      $graph_names  = array();
      $kvar1_arr  = array();
      $kvar2_arr  = array();
      $kvar3_arr  = array();
      $kva1_arr  = array();
      $kva2_arr  = array();
      $kva3_arr  = array();
      $cval1_arr  = array();
      $cval2_arr  = array();
      $cval3_arr = array();
      $vval1_arr = array();
      $vval2_arr = array();
      $vval3_arr = array();
      $date = "0000-00-00 00:00:00";
      $date_arr = array();
      
      // $data16 = array();
      // $data17 = array();
    array_push($graph_names, "KVAR");
    array_push($graph_names, "KVAR");
    array_push($graph_names,  "KVA");
    array_push($graph_names, "Current");
    array_push($graph_names, "Voltage");
    //print_r($graph_names);
    //array_push($data5, "0000-00-00 00:00:00");
    // array_push($data6, "WIND");
    // array_push($data7, "SO2");
    // array_push($data8, "CarbonDioxide");
     

      foreach ($result as $row) {
        $kvar1 = round($row['v1']*$row['B1U']/1000* sin(acos($row['pf1'])),2);
        $kvar2 = round($row['v2']*$row['B1M']/1000* sin(acos($row['pf2'])),2);
        $kvar3 = round($row['v3']*$row['B1L']/1000* sin(acos($row['pf3'])),2);

        // kva
        $kva1 = round($row['v1']*$row['B1U']/1000,2);
        $kva2 = round($row['v2']*$row['B1M']/1000,2);
        $kva3 = round($row['v3']*$row['B1L']/1000,2);

        // peak and offpeak
        $cval1 = round($row['B1U'],2);
        $cval2 =round($row['B1M'],2);
        $cval3 =round($row['B1L'],2);

        // voltage

        $vval1 = round($row['v1'],2);
        $vval2 =round($row['v2'],2);
        $vval3 =round($row['v3'],2);

        //print_r($airquality);
        // array_push($data1, $kvar1,$kva2,$kvar3);
        array_push($kvar1_arr, $kvar1);
        array_push($kvar2_arr, $kvar2);
        array_push($kvar3_arr, $kvar3);

    // print_r($data1);
        // array_push($data2,  $kva1,$kva2,$kva3);
        array_push($kva1_arr, $kva1);
        array_push($kva2_arr, $kva2);
        array_push($kva3_arr, $kva3);
        // print_r($data2);
        // array_push($data3, $cval1,$cval2,$cval3);
        array_push($cval1_arr, $cval1);
        array_push($cval2_arr, $cval2);
        array_push($cval3_arr, $cval3);
        // print_r($data3);
        // array_push($data4, $val1,$val2,$val3);
        array_push($vval1_arr, $vval1);
        array_push($vval2_arr, $vval2);
        array_push($vval3_arr, $vval3);
        // print_r($data4);
        array_push($date_arr,$row['datetime']);

        // array_push($data4, $press);
        // array_push($data5, $co);
        // array_push($data6, $w_s);
        // array_push($data7, $so_2);
        // array_push($data8, $co_2);
        // array_push($data9, $no_x);
        // array_push($data10, $No_2);
        // array_push($data11, $sun);
        // array_push($data12, $noise);
        // array_push($data13, $o_3);
        // array_push($data14, $W_d);
        // array_push($data15, $Rain);
        // array_push($data16, $DUST1);
        // array_push($data17, $DUST2);
        


      }

      
?>
<script type="text/javascript">


 function loadGraph(name_g, text_g, data1, data2, data3 ,datentime,div,color1, color2, color3){
  //alert("Called");
  //var chart = document.querySelector("#chart")\
  //data = data.reverse();
   var options = {
        //   series: [{
        //   name: name_g,
        //   data: data
        // }],
        series: [{
                  name: "Phase 1",
                  data: data1
                },
                {
                  name: "Phase 2",
                  data: data2
                },
                {
                  name: 'Phase 3',
                  data: data3
                }
              ],
        stroke: {
            width: [3, 3, 3],
            curve: 'straight',
            dashArray: [0, 0, 0]
              },
        title: {
          text: text_g,
          align: 'left'
        },
        chart: {
                height: 300,
                width: 550,
                type: 'line',
                zoom: {
                  enabled: false
                },
              },
              dataLabels: {
                enabled: false
              },
        // plotOptions: {
        //   bar: {
        //     horizontal: false,
        //   }
        // },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: datentime,
        },
        grid: {
          borderColor: '#525253',
        },
        colors: [color1, color2, color3]
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
  
  
  var allData = [[<?php echo '"' . implode('","', $graph_names) . '"' ?>],[<?php echo '"' . implode('","', $kvar1_arr) . '"' ?>],[<?php echo '"' . implode('","', $kvar2_arr) . '"' ?>],[<?php echo '"' . implode('","', $kvar3_arr) . '"' ?>],
  [<?php echo '"' . implode('","', $kva1_arr) . '"' ?>],[<?php echo '"' . implode('","', $kva2_arr) . '"' ?>],[<?php echo '"' . implode('","', $kva3_arr) . '"' ?>],
  [<?php echo '"' . implode('","', $cval1_arr) . '"' ?>],[<?php echo '"' . implode('","', $cval2_arr) . '"' ?>],[<?php echo '"' . implode('","', $cval3_arr) . '"' ?>],
  [<?php echo '"' . implode('","', $vval1_arr) . '"' ?>],[<?php echo '"' . implode('","', $vval2_arr) . '"' ?>],[<?php echo '"' . implode('","', $vval3_arr) . '"' ?>],[<?php echo '"' . implode('","', $date_arr) . '"' ?>]];

    // console.log(allData);
    var tempArray = [];
    var name = "";
    //var nouse = allData[0].shift();
    var j = 0;
    datentime = allData[allData.length-1];
    datentime = datentime.reverse();
    var colors = ["#CBDF1F", "#90F13B", "#38E86B", "#38E8C3", "#388BE8", "#9D38E8", "#E338E8"];
    var selectedColor1="";
    var selectedColor2="";
    var selectedColor3="";
      for (var i = 0; i < allData[0].length; i++) {
        tempArray = allData[i];

        if (!allZero(tempArray)) {
          // console.log(tempArray);

          name = allData[i].shift();
          DivCol = document.createElement('div');
          DivCol.setAttribute("id", "divcol"+i);
          DivCol.setAttribute("class", "col-md-6");
          document.getElementById("chartRenderHere").appendChild(DivCol);
          chartDiv = document.createElement('div');
          chartDiv.setAttribute("id", "chart"+i);
          document.getElementById("divcol"+i).appendChild(chartDiv);
          selectedColor1 = colors[Math.floor(Math.random()*colors.length)];
          selectedColor2 = colors[Math.floor(Math.random()*colors.length)];
          selectedColor3 = colors[Math.floor(Math.random()*colors.length)];
        //    console.log(chartDiv);
         //   console.log(tempArray);
        //    console.log(datentime);
          if(i == 0)
          j = 0;
          else if(i == 1)
          j = 3;
          else if(i == 2)
          j = 6;
          else if(i == 3)
          j = 9;
          loadGraph(name, allData[0][i], allData[j+1], allData[j+2], allData[j+3], datentime,"#chart"+i,selectedColor1, selectedColor2, selectedColor3);


        //   loadGraph(name, name, tempArray, datentime,"#chart"+i,selectedColor);
        }
    }
</script>
<?php
$conn = null;
?>

    </section>
  </div>
  <!-- /.content-wrapper -->
  
	<?php include_once('footer.php') ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include_once('script.php') ?>
</body>
</html>
