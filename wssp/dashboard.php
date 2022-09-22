<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Tube Well Dashboard"?>

<style>
.filterDiv {
  display: none;
}

.show {
  display: block;
}

</style>
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
  <?php include_once('navbar.php'); ?>
  <!-- Sidebar -->
  <?php include_once('sidebar.php'); ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  
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
      <?php
      if(isset($_GET['status'])){
        $status = $_GET['status'];
      }
      else{
        $status = "all"; 
      
      }
        date_default_timezone_set("Asia/Karachi");
        include_once("opendb.php");
        $offlineTime = 120;

        $query = "select * from transformer order by CONVERT(SUBSTRING(transformer.trid,6,3),UNSIGNED INTEGER) asc";
        $result = $conn -> query($query) or die("Query error");
        $values = array();
        $splitval = array();
        $onc = 0;
        $offc = 0;
        $offlc = 0;
        $allc = 0 ;
        foreach ($result as $row) {
          $count =0 ;
          $avgVoltage  = round(($row['v1'] + $row['v2'] + $row['v3'])/3 ,2);
          $sumCurrent = round(($row['c1']+ $row['c2'] + $row['c3']),2);
          $NC = 0;
          $kva1 = round(($row['c1'] * $row['v1'])/1000,2);
          $kva2 = round(($row['c2'] * $row['v2'])/1000 ,2);
          $kva3 = round(($row['c3'] * $row['v3'])/1000 ,2);
          $totalKVA  = round(($kva1 + $kva2 + $kva3),2);

          $avgPf = round(($row['pf1']+$row['pf2']+$row['pf3'])/3,2);
          if ($avgPf < 0.78)
          {
            $avgPf =max($row['pf1'],$row['pf2'],$row['pf3']);
            if($avgPf < 0.78)
              $avgPf = 0.78;
          }
          
          $currenttime = strtotime(date('Y-m-d H:i:s'));
          $datetime = substr($row['datetime'],2);
          $datetime = strtotime($datetime);
          $date = date('Y-m-d H:i:s',$datetime);
          $lasttime=strtotime($date); 
          $timediff = ceil(abs($currenttime-$lasttime)/60);
          
          $pump_power = $row['kva_capacity']*0.7457;
          $highPhaseCurrent = ($pump_power *1000)/(3*230*0.86);
          $lowPhaseCurrent =  $highPhaseCurrent * 0.2;

          $switchTime = "";


          if ($timediff <= $offlineTime){

            if ($row['status'] == "On"){
              $onc = $onc + 1;
              $switchTime = $row['switch_ontime'];
            }
            else{
              $offc = $offc +1;
              $switchTime = $row['switch_offtime'];
            }
          }
          else{
            $offlc = $offlc + 1;
            $switchTime = $row['datetime'];
          }

          $signal = $row['ss']/60*100;

          array_push($values, array($row['trid'],$row['name'], $avgVoltage, $sumCurrent, $NC, $totalKVA, $avgPf,$row['datetime'],$timediff, $pump_power, $highPhaseCurrent, $lowPhaseCurrent, $row['cause'],$switchTime, $row['twid'], $row['zone'], $row['uc'], $row['nc'], $row['location'], $row['twid'], $switchTime,$signal));

          array_push($splitval,array($row['trid'],$row['v1'],$row['v2'],$row['v3'],$row['c1'],$row['c2'],$row['c3'],$row['pf1'],$row['pf2'],$row['pf3'],$row['status']));


    }

    $allc = $onc + $offlc + $offc;
             ?>



    <?php echo "<div class = 'row'>";
       echo "<div class='col-md-6'>";
            if ($status==='ON')
            {
            echo "<a href='dashboard.php?status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
            </a>";
            }
            else
            {
              echo "<a href='dashboard.php?status=ON'>
                <button class='btn btn-success'><i class='icofont icofont-check-circled'></i> On $onc</button>
            </a>";  
            }
            if ($status==='OFL')
            {
            echo "<a href='dashboard.php?status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
            </a>";
            }
            else
            {echo "<a href='dashboard.php?status=OFL'>
                <button class='btn  btn-warning' style='background:red;border-color:red;><i class='icofont icofont-warning-alt'></i> Offline $offlc</button>
            </a>";
            }
            if ($status==='OFF')
            {
            echo "<a href='dashboard.php?status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
            </a>";
            }
            else
            {
            echo "<a href='dashboard.php?status=OFF'>
                <button class='btn btn-primary'><i class='icofont icofont-eye-alt'></i> Off $offc</button>
            </a>";

            }
        echo    "</div>";
           ;?>
       

       <div class="col col-md-3 pull-right">
         <input type="text" name="search" id="search" onkeyup="filterSelection()" class="form-control" placeholder="Search Tube Well ID/Name ...">
       </div>
       </div>

         <br>

    <div class="row" id="pumps">

      
              <?php
                $ona = 0;
                $offa = 0;
                $offla = 0;
                $count = sizeof($values);
                //echo $count;
                if(sizeof($values) > 0)
                {
                  for ($i=0; $i < $count ; $i++) {


                    if($values[$i][8] <= $offlineTime){
                      if ($splitval[$i][10] == "On") {
                        $color = "bg-green";
                        $state = "On";
                      }else {
                        $color = "bg-blue";
                        $state = "Off";
                      }
                                         
                            
                        }
                        else{
                          $color = "bg-red";
                          $state = "Offline"; 
                        }

                       
                        
                         if ($status === "ON" and ($state ==="Offline" or $state === "Off")) {
                            goto skip;
                        }elseif($status === "OFL" and ($state ==="Off" or $state === "On" or $state === "Under Voltage" or $state === "Over Voltage" or $state === "Link Down")) {
                            goto skip;
                        }elseif ($status === "OFF" and ($state ==="Offline" or $state === "On" or $state === "Under Voltage" or $state === "Over Voltage" or $state === "Link Down")) {
                            goto skip;   
                        }
                        
                        ?>
                        <a href="device_dashboard.php?id=<?php echo $values[$i][0]; ?>">
                        <div class="filterDiv <?php echo strtoupper($values[$i][1]); echo strtoupper($values[$i][0]); ?>">
                        <div class="col col-md-3">
                          <div class="box box-widget widget-user-2" style="text-align: center;">
                         
                            <div class="widget-user-header <?php echo $color; ?>" style="min-height: 280px;">
                              
                              <h3><b><?php echo $values[$i][14]; ?></b></h3>
                              <h5 id="pumpName"><?php echo "Zone ".$values[$i][15]." | "."UC: ".$values[$i][16]." | "."NC: ".$values[$i][17]; ?></h5>
                              <h5 id="pumpName"><?php echo $values[$i][1]; ?></h5>
                              <h5 id="pumpName"><?php echo "Loc: ".$values[$i][18]; ?></h5>
                              <h5>SCADA ID: <?php echo $values[$i][0]; ?></h5>
                              <h5>Switch Time: <?php echo $values[$i][20]; ?></h5>
                              <h5>Signal Strength: <?php echo round($values[$i][21]); ?>%</h5>

                              <!-- <button class='btn btn-light' onclick='window.location.href="device_dashboard.php?id=<?php echo $values[$i][0]; ?>"'>Details</button> -->
                            </div>
            
                            
                          </div>
                        </div>
                      </div>
                      </a>
<?php
                      skip:
                   } 
                    
                }
                else
                {
                  echo "<b>No Transformers Added Yet!</b>";
                }
              ?>
              

    </div>








    </section>
    <!-- /.content -->
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

<script>
filterSelection();
function filterSelection() {
  var x, i, c;
    c = document.getElementById("search").value.toUpperCase();
    if(c == ""){
      c= "all";
    }
  
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}

</script>
