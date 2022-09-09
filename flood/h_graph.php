<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <?php
    $branch_id = $_GET['b'];
    $b_name = $_GET['bn'];
    $lf = $_GET['f'];
    $lt = $_GET['t'];
   
    $from = NULL;
    $to = NULL;

    $pageName = $b_name." Branch Graphical Data";

  
      //$device = $_GET['id'];
      
      if (isset($_POST['btnSubmit'])) {
        
        // $branch_id = $_POST['branch'];
        $from = $_POST['fromDT'];
        $to = $_POST['toDT'];


        require_once("db/opendb.php");
        $query = "SELECT * from water_level where branch = '".$branch_id."' and datetime between '".$from."' and '".$to."' limit 1000";
        // echo $query;

        $result = $conn->query($query);
        $graphName = "Smart environment";

        $data1 = array();
        $data2 = array();

        array_push($data1, "Water Level");
        array_push($data2,  "0000-00-00 00:00:00");

        foreach ($result as $row) {
          $temp           =     (round($row['level'],2));
          $date           =     ($row['datetime']);

          //print_r($airquality);
          array_push($data1, $temp);
          array_push($data2,  $date);


        }
}
 
  ?>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- <link rel="stylesheet"  href="dist/apexcharts.css"/> -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
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

        <div class="row">
          <div class="col col-md-3">
            <label>Selected Branch</label>
          </div>
          <div class="col col-md-4">
            <label>From Date</label>
          </div>
          <div class="col col-md-4">
            To Date
          </div>
         
        </div>
        <form action="" method="post">
          <div class="row">
            <div class="col col-md-3">
              <input type="" name="branch" class="form-control" value="<?php echo $branch_id." - ".$b_name; ?>" disabled>
            </div>
            <div class="col col-md-4">
              <input type="date" name="fromDT" class="form-control" value="<?php echo ($from == NULL) ? "" : $from ;?>" min='<?php echo $lf;?>' max='<?php echo $lt;?>' required>
            </div>
            <div class="col col-md-4">
              <input type="date" name="toDT" class="form-control" value="<?php echo ($from == NULL) ? "" : $to ;?>" min='<?php echo $lf;?>' max='<?php echo $lt;?>'  required>
            </div>
            <div class="col col-md-1">
              <button class="btn btn-outline-primary" class="form-control" name="btnSubmit">Submit</button>
            </div>
          </div>
        </form>

        <br>
        <br>

<div id="chartRenderHere" class="row">
  <div id="abc"></div>
    

  </div>


<script type="text/javascript">
 var wi = document.getElementById("abc").offsetWidth;


 function loadGraph(name_g, text_g, data,datentime,div){
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
          type: 'line',

          width: wi,
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
        colors: ['#239ADE']
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
  
  
  var allData = [[<?php echo '"' . implode('","', $data2) . '"' ?>],[<?php echo '"' . implode('","', $data1) . '"' ?>]];

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
          DivCol.setAttribute("class", "col-md-12");
          document.getElementById("chartRenderHere").appendChild(DivCol);
          chartDiv = document.createElement('div');
          chartDiv.setAttribute("id", "chart"+i);
          document.getElementById("divcol"+i).appendChild(chartDiv);
          selectedColor = colors[Math.floor(Math.random()*colors.length)];
           //console.log(chartDiv);
          // console.log(tempArray);
          // console.log(datentime);

           loadGraph(name, name, tempArray, datentime,"#chart"+i);
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


