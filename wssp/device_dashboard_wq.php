<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  

  <?php
   require_once("opendb.php");

  if (isset($_GET['id'])) {
    $id = $_GET['id'];

  }else{
    $id = "1G1WQ01";
  }
  $query_sql = "SELECT wqid,water_quality.name, transformer.twid, water_quality.location,transformer.zone, transformer.uc, transformer.nc FROM water_quality, transformer WHERE water_quality.trid = transformer.trid and wqid = '".$id."'";
  $result = $conn -> query($query_sql) or die(error);
  $name = "";
  $zone ="";
  $location = "";
  $uc = 0;
  $nec = 0;
  $twid="";
  $trid="";
  foreach ($result as $row) {
      $twid = $row['twid'];
        $trid = $row['wqid'];
        $name = $row['name'];
        $zone = $row['zone'];
        $location = $row['location'];
        $uc = $row['uc'];
        $nec = $row['nc'];
  }
  $pageName = " Water Quality Detailed Satistics"?>



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
 
  $query = "select * from wq_logs where wqid = '".$id."' order by datetime desc limit 24";
  $result = $conn->query($query);
  $graphName = "";

  $data1 = array();
  $permRange = array();

  array_push($data1, array("0000-00-00 00:00:00"));
  array_push($permRange, array("Low","High","Unit"));
  array_push($data1, array("Temperature"));
  array_push($permRange, array(24,30, "(<sup>o</sup>C)"));
  array_push($data1, array("pH"));
  array_push($permRange, array(6.5,9.2,""));
  array_push($data1, array("Electrical Conductivity"));
  array_push($permRange, array(0,400, "(us/cm)"));
  array_push($data1, array("Disolved Oxygen"));
  array_push($permRange, array(6.5,8, "(mg/L)"));
  array_push($data1, array("Total Suspended Solids"));
  array_push($permRange, array(0,5, "(mg/L)"));
  array_push($data1, array("Turbidity"));
  array_push($permRange, array(0,5, "(NTU)"));
  array_push($data1, array("Total Disolved Solids"));
  array_push($permRange, array(0,1000, "(mg/L)"));
  array_push($data1, array("Resistivity"));
  array_push($permRange, array(0,18.5, "(Mohm.cm)"));
  array_push($data1, array("Salinity"));
  array_push($permRange, array(0,600, "()"));


  foreach ($result as $row) {
    array_push($data1[1], round($row['temperature'],2));
    array_push($data1[2], round($row['ph'],2));
    array_push($data1[3], round($row['ec'],2));
    array_push($data1[4], round($row['do'],2));
    array_push($data1[5], round($row['tss'],2));
    array_push($data1[6], round($row['turbidity'],2));
    array_push($data1[7], round($row['tds'],2));
    array_push($data1[8], round($row['resistivity']/1000,2));
    array_push($data1[9], round($row['salinity'],2));
    array_push($data1[0], $row['datetime']);
  }




  
?>
  
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
        <div class="col col-sm-12 col-lg-9"> 
          <div class="row">
       

            <?php 
              for($index = 1 ; $index < sizeof($data1); $index++){
                $value = $data1[$index][1];
                ?>
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box <?php echo ($value < $permRange[$index][0] or $value > $permRange[$index][1]) ? "bg-red" : "bg-green";?> ">
                    <div class="inner"> <h5><?php echo $data1[$index][0]." ".$permRange[$index][2];?></h5>
                      <h3><?php echo $value; ?></h3>
                    </div>
                  </div>
                </div>
                <?php
              }

            ?>
            


            </div>

          
          </div>

          <div class="col col-lg-3 col-sm-12">
            
          <div class="box">
         
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
                <tbody>
                  <tr class="bg-primary">
                   
                    <th colspan="2">WHO Standard Parameters Ranges</th>                    
                    
                </tr>

                <?php 
              for($index = 1 ; $index < sizeof($data1); $index++){
                
                ?>
                
                <tr>  
                  <td><?php echo $data1[$index][0];?></td>
                  <td><?php echo $permRange[$index][0]." - ".$permRange[$index][1];?></td>
                </tr>
                <?php
              }

            ?>
              
                
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
  
  
  var allData = [[<?php echo '"' . implode('","', $data1[0]) . '"' ?>],[<?php echo '"' . implode('","', $data1[1]) . '"' ?>],[<?php echo '"' . implode('","', $data1[2]) . '"' ?>],[<?php echo '"' . implode('","', $data1[3]) . '"' ?>],[<?php echo '"' . implode('","', $data1[4]) . '"' ?>],[<?php echo '"' . implode('","', $data1[5]) . '"' ?>],[<?php echo '"' . implode('","', $data1[6]) . '"' ?>],[<?php echo '"' . implode('","', $data1[7]) . '"' ?>],[<?php echo '"' . implode('","', $data1[8]) . '"' ?>],[<?php echo '"' . implode('","', $data1[9]) . '"' ?>]];

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
</script>
<?php
$conn = null;
?>
