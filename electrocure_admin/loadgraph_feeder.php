<!DOCTYPE html>
<html lang="en">

<head>
  
<?php

date_default_timezone_set("Asia/Karachi");
$id= $_GET['id'];
//$id = "I1F1TR02";
$type=$_GET['type'];
$feeder_type = $_GET['ft'];
$name=$_GET['name'];
$mfv = $_GET['mfv'];
$mfc = $_GET['mfc'];

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

<p align="center">
  <button class="btn btn-primary" onclick='window.location.href="loadgraph_feeder.php?id=<?php echo $id; ?>&type=2&name=<?php echo $name; ?>&ft=<?php echo $feeder_type; ?>&mfv=<?php echo $mfv;?>&mfc=<?php echo $mfc;?>"'>KVA</button>

  <button class="btn btn-primary" onclick='window.location.href="loadgraph_feeder.php?id=<?php echo $id; ?>&type=0&name=<?php echo $name; ?>&ft=<?php echo $feeder_type; ?>&mfv=<?php echo $mfv;?>&mfc=<?php echo $mfc;?>"'>KVAR</button>
</p>


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
                height: 250,
                width: 800,
                type: 'line',
                zoom: {
                  enabled: false
                },
              },
              dataLabels: {
                enabled: false
              },
              stroke: {
                width: [3, 3, 3],
                curve: 'straight',
                dashArray: [0, 0, 0]
              },
              series: [{
                  name: "Series 1",
                  data: data1
                },
                {
                  name: "Series 2",
                  data: data2
                },
                {
                  name: 'Series 3',
                  data: data3
                }
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
                }, {
                  title: {
                    formatter: function (val) {
                      return val;
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



  if($feeder_type =="infeeder"){
    $q = "SELECT * from fd_kwh_logs where trid = '".$id."' limit 10";
      $subdivid = 'mes05c1';
  }else{
    $q = "SELECT * from ofd_kwh_logs where trid = '".$id."' limit 10";
      $subdivid = 'mes05c1';
  }
$dbtype = 'electrocure';
require_once("opendb.php"); 
  
$result = $conn -> query($q) or die("Query error");                     
foreach($result as $row)
{
    if($type==0)
    {  //kvar data
        $kvar1 = round($row['cval1']*$row['val1']*$mfv*$mfc/1000 * sin(acos($row['pf1'])),2);
        $kvar2 = round($row['cval2']*$row['val2']*$mfv*$mfc/1000 * sin(acos($row['pf2'])),2);
        $kvar3 = round($row['cval3']*$row['val3']*$mfv*$mfc/1000 * sin(acos($row['pf3'])),2);
        $graphName = " --- KVAR Graph";

        array_push($data1,$kvar1);
        array_push($data2,$kvar2);
        array_push($data3,$kvar3);
        array_push($data4,date("H:i:a",strtotime($row['Datetime'])));                                                
    }
   else
    { // kva data
        $kva1 = round($row['cval1']*$row['val1']*$mfv*$mfc/1000,2);
        $kva2 = round($row['cval2']*$row['val2']*$mfv*$mfc/1000,2);
        $kva3 = round($row['cval3']*$row['val3']*$mfv*$mfc/1000,2);
        $graphName = " --- KVA Graph";
         array_push($data1, $kva1);
         array_push($data2, $kva2);
         array_push($data3, $kva3);
         array_push($data4, date("H:i:a",strtotime($row['Datetime'])));
    }
}

?>
    <script type="text/javascript"> 
        	var js_data1 = [<?php echo '"'.implode('","', $data1).'"' ?>];
        	var js_data2 = [<?php echo '"'.implode('","', $data2).'"' ?>];
        	var js_data3 = [<?php echo '"'.implode('","', $data3).'"' ?>];
        	var js_data4 = [<?php echo '"'.implode('","', $data4).'"' ?>];
          var titleID = "<?php echo $name; ?>" + "<?php echo $graphName; ?>";
          	newData(js_data1,js_data2,js_data3,js_data4);
        </script>
<?php
  $conn= NULL; 
?> 