<?php
  include_once('check.php');
  authenticate("can_view");
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "KPUMA Custom Dashboard"?>



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
                  
                  
                  $status = $_GET['status']; 
                  
                  $chartdata=array(array('y'=>'1 Jan', 'a'=>20,'b'=>30,'c'=>40),array('y'=>'2 Jan', 'a'=>30,'b'=>30,'c'=>40));
                  
                  $type  = 0; //0 kvar, 1kwh, 2 kva
                //  $totalConsumtion = 0;
                  $allc = 0;
                  $offlc  = 0;
                  $onc = 0; 
                  $offc =0;

                    $q = "SELECT cnic, avg(`v1`) as v1, avg(`v2`) as v2, avg(`v3`) as v3, sum(`c1`) as c1, sum(`c2`) as c2, sum(`c3`) as c3, sum(`peak`) as peak, sum(`offpeak`) as offpeak, max(pf1) as pf1, max(pf2) as pf2, max(pf3) as pf3, max(datetime) as dt FROM `connections` WHERE substring_index(cid, 'DB', 1) = 'I1F1TR07' and cnic is not NULL group by cnic";
                    

                     $totalPeak = 0;
                      $totalOffPk= 0;

                    $resultactive = $conn -> query($q) or die("Query error");
                      foreach($resultactive as $row){
                          //$allc = $allc +1;
                           $currenttime = date('y-m-d H:i:s');
                           $lasttime =$row['dt'];
//  echo $currenttime.' '.$lasttime;    
                           if (strlen($currenttime)== 19)
                            {
                                $currenttime = strtotime($currenttime);
                            }
                            else
                            {
                                $currenttime = strtotime('20'.$currenttime);
                            }

                            $lasttime =$row['dt'];

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

                          
                        
                          
                          $kwh_dev = round($row['peak']+$row['offpeak'],2);
                          
                          array_push($splitval, array($row['cnic'],round($row['c1'],2),round($row['c2'],2),round($row['c3'],2),round($row['v1'],2),round($row['v2'],2),round($row['v3'],2),round($row['pf1'],2),round($row['pf2'],2),round($row['pf3'],2)));

                          $totalPeak = $totalPeak + $row['peak'];
                          $totalOffPk = $totalOffPk + $row['offpeak'];
                          $maxCurrent = max($row['c1'],$row['c2'],$row['c3']);
                          array_push($values,array($row['cnic'],$row['cnic'],$timediff,$avgVoltage,$sumCurrent,$maxCurrent,$totalKVA,$avgPf,$row['offpeak'],$row['peak'],$row['dt'], $kwh_dev));
                      //   $q = "select * from tr_kwh_logs where trid = '".$row['trid']."' and  Datetime >= now() - INTERVAL 1 DAY order by id desc limit 100";
                    //     $result = $con->db->query($q);
                          
                            
                          
                      }
                      
                   /*    $q = "SELECT fd_current_logs.* , feeder.name, feeder.mfactorcurrent,feeder.mfactorvoltage FROM `fd_current_logs`,feeder WHERE `fd_current_logs`.`trid`=feeder.trid and `fd_current_logs`.`id` in ( SELECT MAX(id) FROM fd_current_logs GROUP BY trid) order by trid";
                      $resultactive = $con->db->query($q);
                      $q = "select * from feeder";
                        $result2 = $con->db->query($q);*/
                      $chartdata = json_encode($chartdata);
                      $conn = null;


                 
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
      

        <br>
      <div class="row">
    <div class="col col-md-4 col-md-offset-4">
        <div class="box box-widget widget-user-2" style="text-align: center;">
          <div class="widget-user-header bg-green" >
            <h3><b>
              <?php
                echo "Combined Connections";
                
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

                        if($values[$i][2] <= 360){
                                                  
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
                            <a href='kpuma_connections.php?id=<?php echo $values[$i][0]; ?>&status=all'>
                            <div class="widget-user-header <?php echo $color; ?>" >
                              
                              <h3><b><?php echo ($state == "Offline") ? "0": round(($values[$i][3]*$values[$i][4])/1000,2); ?> KVA</b></h3>
                              <h5><?php echo $values[$i][1]; ?></h5>
                              
                            </div>
                          </a>
                            <div class="box-footer no-padding" >
                                Status = <?php echo $state; ?> <br>
                                Last Pulse: <?php echo date('d-m-y H:i:s',strtotime($values[$i][10])); ?><br>
                                Average Voltage = <?php echo ($state == "Offline") ? "0": $values[$i][3]; ?> Volts<br>
                                Total Current = <?php echo ($state == "Offline") ? "0": $values[$i][4]; ?> Amps<br>
                                <?php?>

                                Average Power Factor = <?php echo ($state == "Offline") ? "0": $values[$i][7];  ?> <br>
                                Units Consumed = <?php echo $values[$i][11];?><br>                       
                          
                              <br>
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
