<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  

  <?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

  }else{
    $id = "1G1WQ01";
  }
  $pageName = " Detailed Satistics"?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue sidebar-mini" >
<!-- Site wrapper -->
<div class="wrapper" style="overflow: hidden;">
  
  
  <!-- Navbar -->
  <?php include_once('navbar.php') ?>
  <!-- Sidebar -->
  <?php  include_once('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <?php
  require_once("opendb.php");
  $query = "select * from wq_logs where wqid = '".$id."' order by datetime desc limit 24";
  $result = $conn->query($query);
  $graphName = "";

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

  array_push($data1, "Temperature");
  array_push($data3, "pH");
  array_push($data4, "Electrical Conductivity");
  array_push($data5, "Disolved Oxygen");
  array_push($data6, "Total Suspended Solids (TSS)");
  array_push($data7, "Turbidity");
  array_push($data8, "Total Disolved Solids");
  array_push($data9, "Resistivity");
  array_push($data10, "Salinity");
  array_push($data2,  "0000-00-00 00:00:00");

  foreach ($result as $row) {
    array_push($data1, round($row['temperature'],2));
    array_push($data3, round($row['ph'],2));
    array_push($data4, round($row['ec'],2));
    array_push($data5, round($row['do'],2));
    array_push($data6, round($row['tss'],2));
    array_push($data7, round($row['turbidity'],2));
    array_push($data8, round($row['tds'],2));
    array_push($data9, round($row['resistivity'],2));
    array_push($data10, round($row['salinity'],2));
    array_push($data2, $row['datetime']);
  }

?>
  
  <div class="content-wrapper" style="margin-top: <?php echo $contentmargin?>px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <b><?php echo $pageName;?></b>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $pageName;?></li>
      </ol>
    </section>

   

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col col-sm-12 col-lg-9"> 
          <div class="row">
       

             <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner"> <h5><?php echo $data1[0];?></h5>
                    <h3><?php echo $data1[sizeof($data1)-1] ?></h3>
                  </div>
                  

                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner"> <h5><?php echo $data3[0];?></h5>
                    <h3><?php echo $data3[sizeof($data3)-1] ?></h3>
                  </div>
                  

                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                  <div class="inner"><h5><?php echo $data4[0];?></h5>
                    <h3><?php echo $data4[sizeof($data4)-1] ?></h3>
                  </div>
                  

                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner"> <h5><?php echo $data5[0];?></h5>
                    <h3><?php echo $data5[sizeof($data5)-1] ?></h3>
                  </div>
                  

                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-gray">
                  <div class="inner"> <h5><?php echo $data6[0];?></h5>
                    <h3><?php echo $data6[sizeof($data6)-1] ?></h3>
                  </div>
                  

                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-navy">
                  <div class="inner"> <h5><?php echo $data7[0];?></h5>
                    <h3><?php echo $data7[sizeof($data7)-1] ?></h3>
                  </div>
                  

                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner"> <h5><?php echo $data8[0];?></h5>
                    <h3><?php echo $data8[sizeof($data8)-1] ?></h3>
                  </div>
                  

                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner"> <h5><?php echo $data9[0];?></h5>
                    <h3><?php echo $data9[sizeof($data9)-1] ?></h3>
                  </div>
                  

                </div>
              </div>
              <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner"> <h5><?php echo $data10[0];?></h5>
                    <h3><?php echo $data10[sizeof($data10)-1] ?></h3>
                  </div>
                  

                </div>
              </div>

            </div>

          
          </div>

          <div class="col col-lg-3 col-sm-12">
            
          <div class="box">
         
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
                <tbody>
                  <tr class="bg-primary">
                   
                    <th>Parameter</th>                    
                    <th>Range</th>
                </tr>
                <tr>
                  
                  <td>Temperature (<sup>o</sup>C)</td>
                  <td>18-60</td>
                </tr>

                <tr>
                 
                  <td>Turbidity (NTU)</td>
                  
                  <td> </td>
                </tr>

                <tr>
                  
                  <td>TDS (mg/L)</td>

                  <td></td>
                </tr>

                <tr>
                  
                  <td>TSS (mg/L)</td>

                  <td></td>
                </tr>

                <tr>
                  
                  <td>pH</td>
   
                  <td></td>
                </tr>

                <tr>
                  
                  <td>Resistivity (ohm.cm)</td>
                  <td></td>
                </tr>

                <tr>
                  
                  <td>Disolved Oxygen (mg/L)</td>
                  <td></td>
                </tr>

                <tr>
                  
                  <td>Electrical Conductivity (us/cm)</td>
                  
                  <td></td>
                </tr>

                
                
              </tbody></table>
            </div>
          </div>
  
          </div>

        </div>  
        <div class="row" id="graph1">
          
        </div>
        <div class="row">
          <div class="col col-sm-12 col-lg-12">
          </div>  
        </div>   
     
    </section>

    <!-- /.content -->


 </div>



   
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


<script type="text/javascript">
  function clickedFunction(){
    alert("Clicked");
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>

<script type="text/javascript">


 function loadGraph(name_g, text_g, data,datentime,div,color){
  //alert("Called");
  //var chart = document.querySelector("#chart")\
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

          width: screen.width/2.5,
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
  
  
  var allData = [[<?php echo '"' . implode('","', $data2) . '"' ?>],[<?php echo '"' . implode('","', $data1) . '"' ?>],[<?php echo '"' . implode('","', $data3) . '"' ?>],[<?php echo '"' . implode('","', $data4) . '"' ?>],[<?php echo '"' . implode('","', $data5) . '"' ?>],[<?php echo '"' . implode('","', $data6) . '"' ?>],[<?php echo '"' . implode('","', $data7) . '"' ?>],[<?php echo '"' . implode('","', $data8) . '"' ?>],[<?php echo '"' . implode('","', $data9) . '"' ?>],[<?php echo '"' . implode('","', $data10) . '"' ?>]];

    //console.log(allData);
    var tempArray = [];
    var name = "";
    var nouse = allData[0].shift();
    
    datentime = allData[0];
    datentime = datentime.reverse();
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
          document.getElementById("graph1").appendChild(DivCol);
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
