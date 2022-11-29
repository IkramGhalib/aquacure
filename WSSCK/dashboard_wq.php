<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Water Quality Dashboard"?>

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
        $offlineTime = 1440;

        $query = "select * from water_quality";
        $result = $conn -> query($query) or die("Query error");
        $values = array();
        $splitval = array();
        $onc = 0;
        $offlc = 0;
        $allc = 0 ;
        foreach ($result as $row) {
          $count =0 ;
         
          $currenttime = strtotime(date('Y-m-d H:i:s'));
          $datetime = substr($row['datetime'],2);
          $datetime = strtotime($datetime);
          $date = date('Y-m-d H:i:s',$datetime);
          $lasttime=strtotime($date); 
          $timediff = ceil(abs($currenttime-$lasttime)/60);
          
          $switchTime = "";


          if ($timediff <= $offlineTime){ 
              $onc = $onc + 1;
          }
          else{
            $offlc = $offlc + 1;
          }


          array_push($values, array($row['wqid'],$row['name'],$row['location'],$row['temprature'],$row['ph'],$row['ec'],$row['do'],$row['tss'],$row['turbidity'],$row['tds'],$row['resistivity'],$row['salinity'],$row['datetime'],$timediff));


    }

    $allc = $onc + $offlc;
             ?>



    <?php echo "<div class = 'row'>";
       echo "<div class='col-md-6'>";
            if ($status==='ON')
            {
            echo "<a href='dashboard_wq.php?status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
            </a>";
            }
            else
            {
              echo "<a href='dashboard_wq.php?status=ON'>
                <button class='btn btn-success'><i class='icofont icofont-check-circled'></i> Online $onc</button>
            </a>";  
            }
            if ($status==='OFL')
            {
            echo "<a href='dashboard_wq.php?status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
            </a>";
            }
            else
            {echo "<a href='dashboard_wq.php?status=OFL'>
                <button class='btn  btn-warning' style='background:red;border-color:red;><i class='icofont icofont-warning-alt'></i> Offline $offlc</button>
            </a>";
            }
            if ($status==='OFF')
            {
            echo "<a href='dashboard_wq.php?status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
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


                    if($values[$i][13] <= $offlineTime){
                     
                        $color = "bg-green";
                        $state = "On";
                                             
                            
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

                        <div class="filterDiv <?php echo strtoupper($values[$i][1]); echo strtoupper($values[$i][0]); ?>">
                        <div class="col col-md-3">
                          <div class="box box-widget widget-user-2" style="text-align: center;">
                         
                            <div class="widget-user-header <?php echo $color; ?>" style="min-height: 190px;">
                              
                              <h3><b><?php echo $values[$i][0]; ?></b></h3>
                              <h5 id="pumpName"><?php echo $values[$i][1];?></h5>
                              <h5 id="pumpName"><?php echo $values[$i][2]; ?></h5>
                              <h5>SCADA ID: <?php echo $values[$i][0]; ?></h5>
                            
                            </div>
            
                            <div class="box-footer no-padding" >
                              
                              <!-- Last Pulse: <?php //echo $values[$i][12]; ?><br> -->
                             
                             
                              
                              Disolved Oxygen: <?php echo $values[$i][6]; ?> mg/L<br>
                              Resistivity: <?php echo $values[$i][10]; ?> omh.cm<br>
                              
                               Temperature: <?php echo $values[$i][3]; ?> <sup>o</sup>C<br>
                              
                              Turbidity: <?php echo $values[$i][8]; ?> NTU<br>
                              Salinity: <?php echo $values[$i][11]; ?> mg/L<br>
                              TDS: <?php echo $values[$i][9]; ?> mg/L<br>
                              TSS: <?php echo $values[$i][7]; ?> mg/L<br>
                              EC: <?php echo $values[$i][5]; ?> us/cm<br>
                               pH: <?php echo $values[$i][4]; ?><br><br>
                        
                        <button class='btn btn-primary' onclick='window.location.href="device_dashboard_wq.php?id=<?php echo $values[$i][0]; ?>"'>Details</button>
                        <br><br>
                             
                            </div>
                          </div>
                        </div>
                      </div>
<?php
                      skip:
                   } 
                    
                }
                else
                {
                  echo "<b>No Tube Well Added Yet!</b>";
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
