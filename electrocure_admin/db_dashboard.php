<?php
  include_once('check.php');
  authenticate("can_view");
?>

<!DOCTYPE html>
<html>
<head>

  <?php $pageName = "Distribution Boxes Dashboard"?>
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
  <aside class="main-sidebar" style="margin-top: <?php echo $sidebarmargin;?>px;">
        <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="overflow-x: scroll;">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            
        <li class="header">Active DBs</li>
      
        <li class=" treeview">
                <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Active DBs</span> 
                </a>
        </li>
         <?php
 date_default_timezone_set("Asia/Karachi");
  
 require_once("opendb.php"); 
//     $con = new DBCon();
    $values = array();
    $splitval = array();
    $totalPeak = 0;
    $totalOffPk= 0;
    $trid = $_GET['id'];
    $status = $_GET['status'];
   // echo $trid;
    $chartdata=array(array('y'=>'1 Jan', 'a'=>20,'b'=>30,'c'=>40),array('y'=>'2 Jan', 'a'=>30,'b'=>30,'c'=>40));
    $id  = $trid;
    $type  = 0; //0 kvar, 1kwh, 2 kva
  //  $totalConsumtion = 0;
    $onc = 0;
    $offlc=0;
    $offc =0;
    $allc=0;

    if ($trid == "0G0") {
      $q = "SELECT db.* from db";
    }else{
      $q = "SELECT db.* from db where substring_index(dbid,'D',1)='".$trid."'";
      }
      $q1 = "select * from transformer where trid = '".$trid."'";

       $totalPeak = 0;
        $totalOffPk= 0;
        $name = 'All Distribution Boxess';

       $resultFeeder = $conn -> query($q1) or die("Query error");
        foreach($resultFeeder as $row){
        $totalPeak = $row['peak'];
        $totalOffPk= $row['offpeak'];
        $name = $row['name'];
        }
//  echo $q;
//echo $q;
      $resultactive = $conn -> query($q) or die("Query error");
        foreach($resultactive as $row){
             $currenttime = date('y-m-d H:i:s');
             $lasttime =$row['datetime'];
//  echo $currenttime.' '.$lasttime;    
             if (strlen($currenttime)== 19)
              {
                  $currenttime = strtotime($currenttime);
              }
              else
              {
                  $currenttime = strtotime('20'.$currenttime);
              }

              $lasttime =$row['datetime'];

              if (strlen($lasttime)== 19)
              {
                  $lasttime = strtotime($lasttime);
              }
              else
              {
                  $lasttime = strtotime('20'.$lasttime);
              }


            $timediff = abs(ceil(($currenttime-$lasttime)/60));
            $avgVoltage  = round(($row['v1']+$row['v2']+$row['v3'])/3 ,2);
            $sumCurrent_line1 = round(($row['line1_c1']+ $row['line1_c2'] + $row['line1_c3'])/3,2);
            $sumCurrent_line2 = round(($row['line2_c1']+ $row['line2_c2'] + $row['line2_c3'])/3,2);
            $sumCurrent_line3 = round(($row['line3_c1']+ $row['line3_c2'] + $row['line3_c3'])/3,2);
            $sumCurrent_line4 = round(($row['line4_c1']+ $row['line4_c2'] + $row['line4_c3'])/3,2);
            $sumCurrent_line5 = round(($row['line5_c1']+ $row['line5_c2'] + $row['line5_c3'])/3,2);
            $sumCurrent_line6 = round(($row['line6_c1']+ $row['line6_c2'] + $row['line6_c3'])/3,2);
            $sumCurrent_line7 = round(($row['line7_c1']+ $row['line7_c2'] + $row['line7_c3'])/3,2);

            $totalcurrent = ($row['line1_c1']+ $row['line1_c2'] + $row['line1_c3']+$row['line2_c1']+ $row['line2_c2'] + $row['line2_c3']+$row['line3_c1']+ $row['line3_c2'] + $row['line3_c3']+$row['line4_c1']+ $row['line4_c2'] + $row['line4_c3']+$row['line5_c1']+ $row['line5_c2'] + $row['line5_c3']+$row['line6_c1']+ $row['line6_c2'] + $row['line6_c3']+$row['line7_c1']+ $row['line7_c2'] + $row['line7_c3']);
            $totalcurrent = round($totalcurrent,2);
// $NC = round($row['NC'],2);
            $line1_kva1 = round($row['line1_c1'] * $row['v1']/1000,2);
            $line1_kva2 = round($row['line1_c2'] * $row['v2']/1000 ,2);
            $line1_kva3 = round($row['line1_c3'] * $row['v2']/1000 ,2);
            
            $line2_kva1 = round($row['line2_c1'] * $row['v1']/1000,2);
            $line2_kva2 = round($row['line2_c2'] * $row['v2']/1000 ,2);
            $line2_kva3 = round($row['line2_c3'] * $row['v2']/1000 ,2);
            
            $line3_kva1 = round($row['line3_c1'] * $row['v1']/1000,2);
            $line3_kva2 = round($row['line3_c2'] * $row['v2']/1000 ,2);
            $line3_kva3 = round($row['line3_c3'] * $row['v2']/1000 ,2);
            
            $line4_kva1 = round($row['line4_c1'] * $row['v1']/1000,2);
            $line4_kva2 = round($row['line4_c2'] * $row['v2']/1000 ,2);
            $line4_kva3 = round($row['line4_c3'] * $row['v2']/1000 ,2);

            $line5_kva1 = round($row['line5_c1'] * $row['v1']/1000,2);
            $line5_kva2 = round($row['line5_c2'] * $row['v2']/1000 ,2);
            $line5_kva3 = round($row['line5_c3'] * $row['v2']/1000 ,2);

            $line6_kva1 = round($row['line6_c1'] * $row['v1']/1000,2);
            $line6_kva2 = round($row['line6_c2'] * $row['v2']/1000 ,2);
            $line6_kva3 = round($row['line6_c3'] * $row['v2']/1000 ,2);
            
            $totalline1_kva  = round(($line1_kva1 + $line1_kva2 + $line1_kva3),2);
            $totalline2_kva  = round(($line2_kva1 + $line2_kva2 + $line2_kva3+$line5_kva1 + $line5_kva2 + $line5_kva3),2);
            $totalline3_kva  = round(($line3_kva1 + $line3_kva2 + $line3_kva3+$line6_kva1 + $line6_kva2 + $line6_kva3),2);
             $totalline4_kva  = round(($line4_kva1 + $line4_kva2 + $line4_kva3),2);
            
            $avgPf_line1 = round(($row['line1_pf1']+$row['line1_pf2']+$row['line1_pf3'])/3,2);
            $avgPf_line2 = round(($row['line2_pf1']+$row['line2_pf2']+$row['line2_pf3'])/3,2);
            $avgPf_line3 = round(($row['line3_pf1']+$row['line3_pf2']+$row['line3_pf3'])/3,2);
            $avgPf_line4 = round(($row['line4_pf1']+$row['line4_pf2']+$row['line4_pf3'])/3,2);
                                                          
             // $id = explode('D',$row['trid']);
            $totalPeak = $totalPeak + $row['peak'];
            $totalOffPk = $totalOffPk + $row['offpeak'];
            $maxCurrent_line1 = $row['line1_c1']+$row['line1_c2']+$row['line1_c3'];
            $maxCurrent_line2 = $row['line2_c1']+$row['line2_c2']+$row['line2_c3'];
            $maxCurrent_line3 = $row['line3_c1']+$row['line3_c2']+$row['line3_c3'];
            $maxCurrent_line4 = $row['line4_c1']+$row['line4_c2']+$row['line4_c3'];
            $maxCurrent_line5 = $row['line5_c1']+$row['line5_c2']+$row['line5_c3'];
           $maxCurrent =max($maxCurrent_line1,$maxCurrent_line2,$maxCurrent_line3,$maxCurrent_line4);
               array_push($splitval, array($row['dbid'],$row['line1_c1'],$row['line1_c2'],$row['line1_c3'],$row['line2_c1'],$row['line2_c2'],$row['line2_c3'],$row['line3_c1'],$row['line3_c2'],$row['line3_c3'],$row['line4_c1'],$row['line4_c2'],$row['line4_c3'],$row['v1'],$row['v2'],$row['v3'],$row['line1_pf1'],$row['line1_pf2'],$row['line1_pf3'],$row['line2_pf1'],$row['line2_pf2'],$row['line2_pf3'],$row['line3_pf1'],$row['line3_pf2'],$row['line3_pf3'],$row['line4_pf1'],$row['line4_pf2'],$row['line4_pf3']));
            array_push($values,array($row['dbid'],$row['name'],$timediff,$avgVoltage,$sumCurrent_line1,$sumCurrent_line2,$sumCurrent_line3,$sumCurrent_line4,$maxCurrent,$totalline1_kva,$totalline2_kva,$totalline3_kva,$totalline4_kva,$avgPf_line1,$avgPf_line2,$avgPf_line3,$avgPf_line4,$row['offpeak'],$row['peak'],$row['datetime'],$totalcurrent));
        //   $q = "select * from tr_kwh_logs where trid = '".$row['trid']."' and  Datetime >= now() - INTERVAL 1 DAY order by id desc limit 100";
      //     $result = $con->db->query($q);
            
              if ($timediff <=15)
              {
                  
                    ?>
                      <li class= 'treeview'>
                        <a href="dashboard_device_db.php?id=<?php echo $row['dbid']; ?>">
                          <span><?php echo $row['name']; ?></span> 
                        </a>
                      </li>
                      <?php
                      $onc = $onc +1;
                  
                  
              }
             else
             {
                 $offlc = $offlc + 1;
             }
            
        }
        
     /*    $q = "SELECT fd_current_logs.* , feeder.name, feeder.mfactorcurrent,feeder.mfactorvoltage FROM `fd_current_logs`,feeder WHERE `fd_current_logs`.`trid`=feeder.trid and `fd_current_logs`.`id` in ( SELECT MAX(id) FROM fd_current_logs GROUP BY trid) order by trid";
        $resultactive = $con->db->query($q);
        $q = "select * from feeder";
          $result2 = $con->db->query($q);*/
        $chartdata = json_encode($chartdata);
        //$conn = null;
$allc = $onc+$offlc;
   
?>

        
        
         
      </ul>
       
      </section>
        <!-- /.sidebar -->
      </aside>


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
    
<?php echo "<div class = 'row'>";
       echo "<div class='col-md-6'>";
            if ($status==='ON')
            {
            echo "<a href='db_dashboard.php?id=".$trid."&status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
            </a>";
            }
            else
            {
              echo "<a href='db_dashboard.php?id=".$trid."&status=ON'>
                <button class='btn btn-success'><i class='icofont icofont-check-circled'></i> On $onc</button>
            </a>";  
            }
            if ($status==='OFL')
            {
            echo "<a href='db_dashboard.php?id=".$trid."&status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
            </a>";
            }
            else
            {echo "<a href='db_dashboard.php?id=".$trid."&status=OFL'>
                <button class='btn  btn-warning' style='background:blue;border-color:blue;><i class='icofont icofont-warning-alt'></i> Offline $offlc</button>
            </a>";
            }
            
        echo    "</div>";
           
       echo "</div>";?>
        
        <br>

        <?php
        $trname = $trid;
        $query_name = "select name from transformer where trid = '".$trid."'";
        $result_name = $conn -> query($query_name) or die(error);
        foreach ($result_name as $name) {
          $trname = $name['name'];
        }
        ?>
      <div class="row">
    <div class="col col-md-4 col-md-offset-4">
        <div class="box box-widget widget-user-2" style="text-align: center;">
          <div class="widget-user-header bg-green" >
            <h3><b>
              <?php
                if ($trid == "0G0") {
                   echo "All Distribution Boxes";   
                }else
                {
                  echo $trname." Distribution Boxes";   
                }
               
                
                ?>
                </b></h3>
          </div>
        </div>
      </div>
      </div>
    <div class="row">

      
              <?php
                $ona = 0;
                $offa = 0;
                $offla = 0;
                $count = sizeof($values);
                //echo $count;
                if(sizeof($values) > 0)
                {
                  for ($i=0; $i < $count ; $i++) {

                        if($values[$i][2] <= 15){
                          
                          if (($splitval[$i][13] < 100 and $splitval[$i][13]>0 )or($splitval[$i][14] < 100 and $splitval[$i][14]>0 ) or($splitval[$i][15] < 100 and $splitval[$i][15]>0 )) {
                              $color = "bg-gray"; 
                              $state = "Link Down";
                            }elseif (($splitval[$i][14] < 150 and $splitval[$i][14]>0 )or($splitval[$i][15] < 150 and $splitval[$i][15]>0 ) or($splitval[$i][13] < 150 and $splitval[$i][13]>0 )) {
                              $color = "bg-orange";
                              $state = "Under Voltage";
                            }elseif (($splitval[$i][14] > 250 ) or ($splitval[$i][15] > 250 ) or ($splitval[$i][13] > 250 )) {
                              $color = "bg-yellow";
                              $state = "Over Voltage";
                            }else{
                              $color = "bg-green";
                              $state = "On";
                            } 
                        
                        
                      }
                        else{
                          $color = "bg-blue";
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


                        <div class="col col-md-3" data-toggle="popover" title="Voltages = (<?php echo $splitval[$i][13].','.$splitval[$i][14].','.$splitval[$i][15].')';?>">
                          <div class="box box-widget widget-user-2" style="text-align: center;">
                            <a href='cust_dashboard.php?id=<?php echo $values[$i][0]; ?>&status=all'>
                            <div class="widget-user-header <?php echo $color; ?>" >
                              
                              <h3><b><?php echo ($state == "Offline") ? "0" : (round(($values[$i][3]*$values[$i][20])/1000,2)); ?> KVA</b></h3>
                              <h5><?php echo $values[$i][1]; ?></h5>
                              
                            </div>
                          </a>
                            <div class="box-footer no-padding" >
                                Device ID = <?php echo $values[$i][0];?> <br>
                                Status = <?php echo $state; ?> <br>
                                Last Value received at <?php echo $values[$i][19]; ?> <br>
                                Average Voltage = <?php echo ($state == "Offline") ? "0" : $values[$i][3]; ?> Volts <br>
                                Total Current = <?php echo ($state == "Offline") ? "0" : $values[$i][20] ;?> Amps <br>                               
                                <br>


                              <?php 

                        if($state == "On" or $state == "Link Down" or $state == "Under Voltage" or $state == "Over Voltage"){
                          ?>
                      
                      <button class='btn btn-primary' onclick='window.location.href="db_device_dashboard.php?id=<?php echo $values[$i][0]; ?>"'>Details</button>

                          <?php
                        }elseif ($state == "offline") {
                        ?>                         
                        
                        <button class='btn btn-primary'disabled="disabled">Details</button>
                        
                        <?php 
                        }else
                        {
                          ?>
                        
                        <button class='btn btn-primary'disabled="disabled">Details</button>
                          <?php
                        }
                        ?>
                              <br><br>
                            </div>
                          </div>
                        </div>
<?php
                      skip:
                   } 
                    
                }
                else
                {
                  echo "<b>No Distribtion Box Added Yet!</b>";
                }
              ?>
              

    </div>

            <script type="text/javascript">

        function refreshIframe(path) {
          var ifr = document.getElementsByName('Right')[0];
          ifr.src = path;
        }
    </script>
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
