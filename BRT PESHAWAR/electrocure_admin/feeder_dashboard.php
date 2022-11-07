<?php
if(empty($_SESSION)) // if the session not yet started 
	session_start();
if(!isset($_SESSION['userid'])){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Feeder Dashboard";?>



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
        <section class="sidebar">

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            
        <li class="header">Active Feeders</li>
      
        <li class=" treeview">
                <a href="#">
                  <i class="fa fa-dashboard"></i> <span>Active Feeders</span> 
                </a>
        </li>
         <?php
               date_default_timezone_set("Asia/Karachi");

                                   require_once("opendb.php"); 
                                      $values = array();
                                      $splitVal = array();
                                      $totalPeak = 0;
                                      $totalOffPk= 0;
                                      $status = "all";
                                      $status = $_GET['status'];
                                      $offlc = 0;
                                      $offc = 0;
                                      $onc = 0;
                                    //  $totalConsumtion = 0;
                                     

                                          $q = "SELECT * from feeder";
                                          $resultactive = $conn -> query($q) or die("Query error");
                                      foreach($resultactive as $row){
                                               $currenttime = date('y-m-d H:i:s');
                                               $lasttime =$row['datetime'];
                                             
                                              
                                               if($row['fdid']=='I1')
                                                {
                                                  $mfv1 = $row['mfactorvoltage']*1.732;
                                                  $mfc1 = $row['mfactorcurrent'];
                                                }
                                              $mfv = $row['mfactorvoltage']*1.732;
                                              $mfc = $row['mfactorcurrent'];

        // echo $currenttime.' '.$lasttime;
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
                                                $avgVoltage  = round(($row['v1']+$row['v2']+$row['v3'])/3 * $row['mfactorvoltage']*1.732/1000,2);
                                                $sumCurrent = round(($row['c1']+ $row['c2'] + $row['c3'])* $row['mfactorcurrent'],2);
                                                $maxCurrent = max($row['c1'],$row['c2'],$row['c3']);
                                                //$NC = round($row['NC']* $row['mfactorcurrent'],2);
                                                array_push($splitVal, array($row['fdid'],$row['c1']* $row['mfactorcurrent'],$row['c2']* $row['mfactorcurrent'],$row['c3']* $row['mfactorcurrent'],$row['v1']* $row['mfactorvoltage']*1.7432/1000,$row['v2']* $row['mfactorvoltage']*1.7432/1000,$row['v3']* $row['mfactorvoltage']*1.7432/1000,$row['pf1'],$row['pf2'],$row['pf3']));


                                                $kva1 = round($row['c1'] * $row['v1']* $row['mfactorvoltage'] *1.732/1000 * $row['mfactorcurrent'] ,2);
                                                $kva2 = round($row['c2'] * $row['v2']* $row['mfactorvoltage'] *1.732/1000* $row['mfactorcurrent'] ,2);
                                                $kva3 = round($row['c3'] * $row['v2']* $row['mfactorvoltage'] *1.732/1000* $row['mfactorcurrent'] ,2);
                                              
                                                $totalKVA  = round(($kva1 + $kva2 + $kva3),2);
                                                $avgPf = round(($row['pf1']+$row['pf2']+$row['pf3'])/3,2);
                                               // $id = explode('D',$row['fdid']);
                                                $totalPeak = $totalPeak + $row['peak'];
                                                $totalOffPk = $totalOffPk + $row['offpeak'];


                                              array_push($values,array($row['fdid'],$row['name'],$timediff,$avgVoltage,$sumCurrent,$maxCurrent,$totalKVA,$avgPf,$row['offpeak'],$row['peak'],$row['mfactorvoltage'],$row['mfactorcurrent']));

                                               if ($timediff <=360)
                                                {
                                                    if (max($row['c1'],$row['c2'],$row['c3'])>0.1)
                                                    {
                                                        $onc = $onc + 1;
                                                      ?>
                                                        <li class= 'treeview'>
                                                          <a href="feeder_device_dashboard.php?id=<?php echo $row['fdid']; ?>">
                                                            <span><?php echo $row['name']; ?></span> 
                                                          </a>
                                                        </li>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        $offc = $offc +1;
                                                    }
                                                    
                                                }
                                              else
                                              {
                                                  $offlc = $offlc + 1;
                                              }
                                              
                                          

                                          }
               $allc= $onc + $offc+ $offlc ;
                                          $conn= NULL;
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

      <p id="ifr" align="center">
            <iframe name="Right" src="loadgraph_feeder.php?id=I1&type=1&name=Feeder-1&ft=infeeder&mfv=<?php echo $mfv1; ?>&mfc=<?php echo $mfc1; ?>" width="810" height="400" frameborder="0" ></iframe>
      </p>
      
      <?php echo "<div class = 'row'>";
       echo "<div class='col-md-6'>";
        $fdid = $_GET['filter'];
            if ($status==='ON')
            {
            echo "<a href='feeder_dashboard.php?filter=".$fdid."&status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
            </a>";
            }
            else
            {
              echo "<a href='feeder_dashboard.php?filter=".$fdid."&status=ON'>
                <button class='btn btn-success'><i class='icofont icofont-check-circled'></i> On $onc</button>
            </a>";  
            }
            if ($status==='OFL')
            {
            echo "<a href='feeder_dashboard.php?filter=".$fdid."&status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
            </a>";
            }
            else
            {echo "<a href='feeder_dashboard.php?filter=".$fdid."&status=OFL'>
                <button class='btn  btn-warning' style='background:blue;border-color:blue;><i class='icofont icofont-warning-alt'></i> Offline $offlc</button>
            </a>";
            }
            if ($status==='OFF')
            {
            echo "<a href='feeder_dashboard.php?filter=".$fdid."&status=all'>
                <button class='btn btn-warning'><i class='icofont icofont-check-circled'></i> ALL $allc</button>
            </a>";
            }
            else
            {
            echo "<a href='feeder_dashboard.php?filter=".$fdid."&status=OFF'>
                <button class='btn btn-danger'><i class='icofont icofont-eye-alt'></i> Off $offc</button>
            </a>";

            }
        echo    "</div>";
           
       echo "</div>";?>
    
      
  <div class="tree" border="2px">
   
  <ul>
    <li>
         <?php

  echo "    <a href='device_dashboard_total.php' style='background-color: #53e002'>
        <h3><b>Sub-division Consumption</b></h3> <br>
               
      </a>";?>
        <br>
          
  <ul>
      <?php  
                $count = sizeof($values);
             if(sizeof($values) > 0)
            {
                 for ($i=0 ; $i<$count; $i++)
                {
                    
                    if ($values[$i][2] < 180  and $values[$i][5]>0.1 and $status!='OFF' and $status!='OFL' )
                    {
                      ?>
                      <li data-toggle="popover" title="voltages = (<?php echo $splitVal[$i][4].', '.$splitVal[$i][5].', '.$splitVal[$i][6].') currents=('.$splitVal[$i][1].', '.$splitVal[$i][2].', '.$splitVal[$i][3].') PFs=('.$splitVal[$i][7].', '.$splitVal[$i][8].', '.$splitVal[$i][9].')';?>">
                      <?php
                        //echo $values[$i][1];
                        echo "
                       <a href='outfeeder_dashboard.php?id=".$values[$i][0]."&status=all' style='background-color: #53e002'>
                        <b>".$values[$i][1]."</b>
                       <br>
                       Status = On <br>";

                       echo "
               Average Voltage = ".$values[$i][3]." KVolts <br>
               Total Current = ".$values[$i][4]." Amps <br>
               Average Power Factor = ".$values[$i][7]." <br>
               Total KVA = ".$values[$i][6]."<br>
               </a><br>";
                     if ($values[$i][2] < 180  and $values[$i][5]>0.04 )
                    {       
               ?>
                    
              <button class="btn btn-primary" onclick="refreshIframe('loadgraph_feeder.php?id=<?php echo $values[$i][0];?>&type=1&name=<?php echo $values[$i][1]; ?>&ft=infeeder&mfv=<?php echo $values[$i][10]; ?>&mfc=<?php echo $values[$i][11]; ?>')">Graphs</button>
                        <button class='btn btn-primary' onclick='window.location.href="feeder_device_dashboard.php?id=<?php echo $values[$i][0]; ?>&mfv=<?php echo $values[$i][10]; ?>&mfc=<?php echo $values[$i][11]; ?>"'>Details</button>
                     
                     <?php
                     }
                     else
                     {
                         ?>
                         
                         <button class="btn btn-primary" disabled>Graphs</button>
                        <button class='btn btn-primary' disabled>Details</button>
        
        
                         <?php
                     }
                     echo "</li>";
                     

                    }
                    elseif($values[$i][2] > 180  and $status!='ON' and $status!='OFF' )
                    {?>
                      <li data-toggle="popover" title="voltages = (<?php echo $splitVal[$i][4].', '.$splitVal[$i][5].', '.$splitVal[$i][6].') currents=('.$splitVal[$i][1].', '.$splitVal[$i][2].', '.$splitVal[$i][3].') PFs=('.$splitVal[$i][7].', '.$splitVal[$i][8].', '.$splitVal[$i][9].')';?>">
                      <?php
                      echo "
                       <a href='outfeeder_dashboard.php?id=".$values[$i][0]."&status=all' style='background-color: #2b80db'>
                        <b>".$values[$i][1]."</b> <br>
                        ";
                      echo " 
                        Status = Offline <br>";

                       echo "
               Average Voltage = ".$values[$i][3]." Volts <br>
               Total Current = ".$values[$i][4]." Amps <br>
               Average Power Factor = ".$values[$i][7]." <br>
               Total KVA = ".$values[$i][6]."<br>
               </a><br>";
                     if ($values[$i][2] < 180  and $values[$i][5]>0.04 )
                    {       
               ?>
                    
              <button class="btn btn-primary" onclick="refreshIframe('loadgraph_feeder.php?id=<?php echo $values[$i][0];?>&type=1&name=<?php echo $values[$i][1]; ?>&ft=infeeder&mfv=<?php echo $values[$i][10]; ?>&mfc=<?php echo $values[$i][11]; ?>')">Graphs</button>
                        <button class='btn btn-primary' onclick='window.location.href="feeder_device_dashboard.php?id=<?php echo $values[$i][0]; ?>&mfv=<?php echo $values[$i][10]; ?>&mfc=<?php echo $values[$i][11]; ?>"'>Details</button>
                     
                     <?php
                     }
                     else
                     {
                         ?>
                         
                         <button class="btn btn-primary" disabled>Graphs</button>
                        <button class='btn btn-primary' disabled>Details</button>
        
        
                         <?php
                     }
                     echo "</li>";
                     
                    }elseif($values[$i][5]<=0.1 and $values[$i][2] <= 360 and $status!='ON' and $status!='OFL')
                    {
                      ?>
                      <li data-toggle="popover" title="voltages = (<?php echo $splitVal[$i][4].', '.$splitVal[$i][5].', '.$splitVal[$i][6].') currents=('.$splitVal[$i][1].', '.$splitVal[$i][2].', '.$splitVal[$i][3].') PFs=('.$splitVal[$i][7].', '.$splitVal[$i][8].', '.$splitVal[$i][9].')';?>">
                      <?php
                      echo "
                       <a href='outfeeder_dashboard.php?id=".$values[$i][0]."&status=all' style='background-color: #f73d3d'>
                        <b>".$values[$i][1]."</b> <br>
                        ";
                           echo "
                       Status = Off <br>";

                       echo "
               Average Voltage = ".$values[$i][3]." Volts <br>
               Total Current = ".$values[$i][4]." Amps <br>
               Average Power Factor = ".$values[$i][7]." <br>
               Total KVA = ".$values[$i][6]."<br>
               </a><br>";
                     if ($values[$i][2] < 180  and $values[$i][5]>0.04 )
                    {       
               ?>
                    
              <button class="btn btn-primary" onclick="refreshIframe('loadgraph_feeder.php?id=<?php echo $values[$i][0];?>&type=1&name=<?php echo $values[$i][1]; ?>&ft=infeeder&mfv=<?php echo $values[$i][10]; ?>&mfc=<?php echo $values[$i][11]; ?>')">Graphs</button>
                        <button class='btn btn-primary' onclick='window.location.href="feeder_device_dashboard.php?id=<?php echo $values[$i][0]; ?>&mfv=<?php echo $values[$i][10]; ?>&mfc=<?php echo $values[$i][11]; ?>"'>Details</button>
                     
                     <?php
                     }
                     else
                     {
                         ?>
                         
                         <button class="btn btn-primary" disabled>Graphs</button>
                        <button class='btn btn-primary' disabled>Details</button>
        
        
                         <?php
                     }
                     echo "</li>";
                     
                    }//call newData(peak,offpeak,cat) function of the javascript on each onclick function of the button and pass new data to the method.
                }
            }
            else
            {
                echo "No Transformers Added ";
            }
        ?>
    
  </ul>
        </li>
        </ul>
  </div>    
      
    <!-- Right side column. Contains the navbar and content of the page -->
         <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
         <script type="text/javascript">

        function refreshIframe(path) {
          var ifr = document.getElementsByName('Right')[0];
          ifr.src = path;
        }
    </script>

    <table border="0" width="100%"></table>          

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
<style>
  
    /*Now the CSS*/
* {margin: 0; padding: 0;}

      .tree ul {
        padding-top: 20px;
        position: relative;
        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;

      }

      .tree li {
        float: left; text-align: center;
        list-style-type: none;
        position: relative;
        padding: 20px 5px 0 5px;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
      }

      /*We will use ::before and ::after to draw the connectors*/

      .tree li::before, .tree li::after{
        content: '';
        position: absolute; top: 0; right: 50%;
        border-top: 1px solid black;
        width: 50%; height: 20px;


      }
      .tree li::after{


        right: auto; left: 50%;
        border-left: 1px solid black;
      }

      /*We need to remove left-right connectors from elements without 
      any siblings*/
      .tree li:only-child::after, .tree li:only-child::before {
        display: none;

      }

      /*Remove space from the top of single children*/
      .tree li:only-child{ padding-top: 0;
          }

      /*Remove left connector from first child and 
      right connector from last child*/
      .tree li:first-child::before, .tree li:last-child::after{
        border: 0 none
          ;
      }
      /*Adding back the vertical connector to the last nodes*/
      .tree li:last-child::before{
        border-right: 1px solid black;
        border-radius: 0 5px 0 0;
        -webkit-border-radius: 0 5px 0 0;
        -moz-border-radius: 0 5px 0 0;

      }
      .tree li:first-child::after{
        border-radius: 5px 0 0 0;
        -webkit-border-radius: 5px 0 0 0;
        -moz-border-radius: 5px 0 0 0;

      }

      /*Time to add downward connectors from parents*/
      .tree ul ul::before{
        content: '';
        position: absolute; top: 0; left: 50%;
        border-left: 1px solid black;
        width: 0; height: 20px;

      }

      .tree li a{
        border: 1px solid black;
        padding: 5px 10px;
        text-decoration: none;
        color:black;
        font-family: arial, verdana, tahoma;
        font-size: 14px;
        display: inline-block;
        background-color:#FFFFFF;

        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;

        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
      }

      /*Time for some hover effects*/
      /*We will apply the hover effect the the lineage of the element also*/
      .tree li a:hover, .tree li a:hover+ul li a {
        background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
      }
      /*Connector styles on hover*/
      .tree li a:hover+ul li::after, 
      .tree li a:hover+ul li::before, 
      .tree li a:hover+ul::before, 
      .tree li a:hover+ul ul::before{
        border-color:#000000;
      }

/*Thats all. I hope you enjoyed it.
Thanks :)*/

</style>
</body>
</html>
