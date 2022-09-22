<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  
<?php

date_default_timezone_set("Asia/Karachi");
$id= $_GET['id'];

//$type = 2;
$data1=array();
$data2=array();
$data3=array();
$data4=array();
$data=array();
$graphName = "";


?>
  <link href="../../assets/styles.css" rel="stylesheet" />
    <!-- Bootstrap 3.3.7 -->
      <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

  <style>
    body{
background-color: #ECF0F5;

    }
    #chart1 {
      max-width: 650zpx;
      margin: 35px auto;
    }
  </style>
</head>

<body bgcolor="#dddddd">
  <div id="chart1">

  </div>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>

  <script>
        var data1 = [];
        var data2 = [];
        var data3 = [];
        var cat = []; // categories to be shown on x-axis of the graph
        
        window.onload = function () {
            //loadGraph();
        }

        function newData(ndata1,ndata2,ndata3,ncat) {
            data1 = ndata1.slice();
            data2 = ndata2.slice();
            data3 = ndata3.slice();
            cat = ncat.slice();
            document.getElementById('chart1').innerHTML = '';
            loadGraph();
        }

          function loadGraph(){
                  
            var options = {
              chart: {
                height: 350,
                width: 500,
                type: 'bar',
                zoom: {
                  enabled: false
                },
              },
              dataLabels: {
                enabled: false
              },
              stroke: {
                width: [3, 3,3],
                curve: 'straight',
                dashArray: [0, 0,0]
              },
              series: [
                {
                  name: "Water Extraction (Cu.m)",
                  data: data3
                },
                
              ],
              title: {
                text:  titleID,
                align: 'left'
              },
              markers: {
                size: 0,

                hover: {
                  sizeOffset: 6
                }
              },
              xaxis: {
                categories: cat,
              },
              tooltip: {
                y: [{
                  title: {
                    formatter: function (val) {
                      return val
                    }
                  }
                }, {
                  title: {
                    formatter: function (val) {
                      return val
                    }
                  }
                }]
              },
              grid: {
                borderColor: '#f1f1f1',
              }
            }
            
            var chart = new ApexCharts(
              document.querySelector("#chart1"),
              options
            );

            chart.render();
          
          }
    
  </script>
</body>

</html>

<?php

$id= $_GET['id'];
require_once("opendb.php"); 
$q = "SELECT max(fm_logs.water_pumped) as wp, date(datetime) dt from fm_logs where fm_logs.pump_id = '1G1PU16' GROUP BY DATE(datetime) order by date(datetime) desc limit 15";
// echo $q;
$result= $conn -> query($q) or die("Query error");                          
foreach($result as $row)
{
        $total = round($row['wp'],2);
        $graphName = "Water Extraction Graph";

        array_push($data3,$total);
        array_push($data4,$row['dt']);                                                
}
$data5 = $data3;
for($i=0; $i<sizeof($data3)-1; $i++){
  $data5[$i] = abs(round($data3[$i] - $data3[$i+1],2));
}
 array_pop($data5);
 array_pop($data4);

?>
    <script type="text/javascript"> 
          var js_data1 = [<?php echo '"'.implode('","', $data1).'"' ?>];
          var js_data2 = [<?php echo '"'.implode('","', $data2).'"' ?>];
          var js_data3 = [<?php echo '"'.implode('","', $data5).'"' ?>];
          var js_data4 = [<?php echo '"'.implode('","', $data4).'"' ?>];
          var titleID = "<?php echo $graphName; ?>";
            newData(js_data1,js_data2,js_data3.reverse(),js_data4.reverse());
        </script>
<?php
 $conn =null;
?> 