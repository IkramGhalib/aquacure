<?php
  include_once('check.php');
  authenticate("can_view");
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Transformer Dashboard"?>



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
            
        <li class="header">Active Transformers</li>
      
        <li class=" treeview">
                <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Active Transformers</span> 
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
                  if (isset($_GET['id'])) {
                    $fdid = $_GET['id'];
                  }else{
                    $fdid = $_GET['filter'];
                  }
                  
                  $status = $_GET['status']; 
                  echo $fdid;
                  $chartdata=array(array('y'=>'1 Jan', 'a'=>20,'b'=>30,'c'=>40),array('y'=>'2 Jan', 'a'=>30,'b'=>30,'c'=>40));
                  $id  = $fdid;
                  $type  = 0; //0 kvar, 1kwh, 2 kva
                //  $totalConsumtion = 0;
                  $allc = 0;
                  $offlc  = 0;
                  $onc = 0; 
                  $offc =0;

                    $q = "SELECT transformer.* from transformer";
                    $q1 = "select * from outfeeder where fdid = '".$fdid."'";

                     $totalPeak = 0;
                      $totalOffPk= 0;

                    $resultactive = $conn -> query($q) or die("Query error");
                      foreach($resultactive as $row){
                          //$allc = $allc +1;
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
                           $sumCurrent = round(($row['c1']+ $row['c2'] + $row['c3']),2);
                            // $NC = round($row['NC'],2);
                          $kva1 = round($row['c1'] * $row['v1']/1000,2);
                          $kva2 = round($row['c2'] * $row['v2']/1000 ,2);
                          $kva3 = round($row['c3'] * $row['v2']/1000 ,2);
                          $totalKVA  = round(($kva1 + $kva2 + $kva3),2);
                          $avgPf = round(($row['pf1']+$row['pf2']+$row['pf3'])/3,2);

                          if (($row['kva_capacity']*1.5)*2/100 < $sumCurrent) {
                            $avgPf = 0.90;
                          }
                        
                          
                          
                          $kwh_dev = round($row['peak_dev']+$row['offpeak_dev'],2);
                          
                          array_push($splitval, array($row['trid'],$row['c1'],$row['c2'],$row['c3'],$row['v1'],$row['v2'],$row['v3'],$row['pf1'],$row['pf2'],$row['pf3']));

                          $totalPeak = $totalPeak + $row['peak'];
                          $totalOffPk = $totalOffPk + $row['offpeak'];
                          $maxCurrent = max($row['c1'],$row['c2'],$row['c3']);
                          array_push($values,array($row['trid'],$row['name'],$timediff,$avgVoltage,$sumCurrent,$maxCurrent,$totalKVA,$avgPf,$row['offpeak'],$row['peak'],$row['datetime'],$row['NC'],$row['NL'],$row['NUL'], $kwh_dev , $row['kva_capacity']));
                      //   $q = "select * from tr_kwh_logs where trid = '".$row['trid']."' and  Datetime >= now() - INTERVAL 1 DAY order by id desc limit 100";
                    //     $result = $con->db->query($q);
                          
                            if ($timediff <=15)
                            {
                                    $onc = $onc + 1;
                                  ?>
                                    <li class= 'treeview'>
                                      <a href="transformer_device_dashboard.php?id=<?php echo $row['trid']; ?>">
                                        <span><?php echo $row['name']; ?></span> 
                                      </a>
                                    </li>
                                    <?php
                          
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
                      $conn = null;
                $allc= $onc +  $offlc ;

                 
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
            echo "<a href='transformer_dashboard.php?id=".$fdid."&status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
            </a>";
            }
            else
            {
              echo "<a href='transformer_dashboard.php?id=".$fdid."&status=ON'>
                <button class='btn btn-success'><i class='icofont icofont-check-circled'></i> On $onc</button>
            </a>";  
            }
            if ($status==='OFL')
            {
            echo "<a href='transformer_dashboard.php?id=".$fdid."&status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
            </a>";
            }
            else
            {echo "<a href='transformer_dashboard.php?id=".$fdid."&status=OFL'>
                <button class='btn  btn-warning' style='background:blue;border-color:blue;><i class='icofont icofont-warning-alt'></i> Offline $offlc</button>
            </a>";
            }
            
        echo    "</div>";
           
       echo "</div>";?>
        <br>
      <div class="row">
    <div class="col col-md-4 col-md-offset-4">
        <div class="box box-widget widget-user-2" style="text-align: center;">
          <div class="widget-user-header bg-green" >
            <h3><b>
              <?php
                echo "All Transformers";
                
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
                                                  
                            if (($splitval[$i][4] < 100 and $splitval[$i][4]>0 )or($splitval[$i][5] < 100 and $splitval[$i][5]>0 ) or($splitval[$i][6] < 100 and $splitval[$i][6]>0 )) {
                              $color = "bg-gray"; 
                              $state = "Link Down";
                            }elseif (($splitval[$i][4] < 150 and $splitval[$i][4]>0 )or($splitval[$i][5] < 150 and $splitval[$i][5]>0 ) or($splitval[$i][6] < 150 and $splitval[$i][6]>0 )) {
                              $color = "bg-orange";
                              $state = "Under Voltage";
                            }elseif (($splitval[$i][4] > 250 ) or ($splitval[$i][5] > 250 ) or ($splitval[$i][6] > 250 )) {
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


                        <div class="col col-md-3" data-toggle="popover" title="voltages = (<?php echo $splitval[$i][4].','.$splitval[$i][5].','.$splitval[$i][6].') currents=('.$splitval[$i][1].','.$splitval[$i][2].','.$splitval[$i][3].') PFs=('.$splitval[$i][7].','.$splitval[$i][8].','.$splitval[$i][9].')';?>">
                          <div class="box box-widget widget-user-2" style="text-align: center;">
                            <a href='db_dashboard.php?id=<?php echo $values[$i][0]; ?>&status=all'>
                            <div class="widget-user-header <?php echo $color; ?>" >
                              
                              <h3><b><?php echo ($state == "Offline") ? "0": round(($values[$i][3]*$values[$i][4])/1000,2); ?> KVA</b></h3>
                              <h5><?php echo $values[$i][1]; ?></h5>
                              <h5>Capacity: <?php echo $values[$i][15]; ?> KVA</h5>
                              
                            </div>
                          </a>
                            <div class="box-footer no-padding" >
                                Device ID = <?php echo $values[$i][0];?> <br>
                                Status = <?php echo $state; ?> <br>
                                Last Pulse: <?php echo date('d-m-y H:i:s',strtotime($values[$i][10])); ?><br>
                                Average Voltage = <?php echo ($state == "Offline") ? "0": $values[$i][3]; ?> Volts<br>
                                Total Current = <?php echo ($state == "Offline") ? "0": $values[$i][4]; ?> Amps<br>
                                <?php?>

                                Average Power Factor = <?php echo ($values[$i][7] > 0.7) ? $values[$i][7] : " .72 (NC)";  ?> <br>
                                Units Consumed = <?php echo $values[$i][14];?><br>                       
                                <br>

                              <?php 

                        if($state == "On" or $state == "Link Down" or $state == "Under Voltage" or $state == "Over Voltage"){
                          ?>
                        
                        <button class='btn btn-primary' onclick='window.location.href="transformer_device_dashboard.php?id=<?php echo $values[$i][0]; ?>"'>Details</button>
                        
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
