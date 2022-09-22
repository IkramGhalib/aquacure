<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Online Switching"; ?>



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
	<?php include_once('sidebar.php') ?>

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


    <div id="overflow" style="overflow-x:auto;">
    <table id="example1"  class="table table-responsive table-bordered table-striped">
    <thead class="bg-blue">
    <tr>
      <th>Pump ID</th>
      <th>Name</th>
      <th>Capacity (HP)</th>
      <th>Connection Date</th> 
      <th>Last Update</th>
      <th>Switch Pump</th>
      <th>Pump Status</th>
      <th>Communication</th>
      <th>Gallons Pumped</th>
      <th>Cause</th>
    </tr>
    </thead>
    <tbody>

    <?php
    require_once("opendb.php");
    $query = "select * from transformer";
    $result = $conn -> query($query) or die("Query error");

    foreach($result as $row){
    $datetime = substr($row['connectiondate'],2);
                                        $datetime = strtotime($datetime);
                                        $date = date('d/m/y',$datetime);
                                        $time = date('h:i:s A',$datetime);
                                        
                                        $datetime2 = substr($row['switch_time'],2);
                                        $datetime2 = strtotime($datetime2);
                                        $date2 = date('d/m/y',$datetime2);
                                        $time2 = date('h:i:s A',$datetime2);
                                        $cause= $row['cause'];
                                        
                                           $currenttime = date('y-m-d H:i:s');
                   
                                            $lasttime =$row['datetime'];
        
                                if (strlen($currenttime)== 19)
                                {
                                    $currenttime = strtotime($currenttime);
                                }
                                else
                                {
                                    $currenttime = strtotime('20'.$currenttime);
                                }
        
       // $lasttime =$row['datetime'];
        
                                if (strlen($lasttime)== 19)
                                {
                                $lasttime = strtotime($lasttime);
        }
        else
        {
            $lasttime = strtotime('20'.$lasttime);
        }
            //echo $currenttime;
             $timediff = abs(ceil(($currenttime-$lasttime)/60));
                                      //  $desc = explode('SIM',$row['description']);
                                        $gallonhr = round($timediff * $row['pumping_capacity']/60,2);
                                       // $time_diff = date('Y-m-d H:i:s')." ".$row2['datetime'];
                                        echo "<tr>";
                                        
                                            // Pump name , location and capacity
                                          //  echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['trid']  . "</td>";
                                            echo "<td>" . $row['name']  . "</td>";
                                            // Voltage from 1 to 3
                                            echo "<td>" . $row['kva_capacity'] . "</td>";
                                           
                                            
                                            echo "<td>" . $date . "<br>". $time."</td>";
                                            echo "<td>" . $date2 . "<br>". $time2."</td>";
                                        
                                        if ($timediff >15)
                                        {
                                            echo "<td><button class='btn btn-disabled  disabled'>Offline</button></td>";
                                             echo "<td> offline </td>";
                                        }
                                        elseif ($row['status']=='Off')
                                        {
                                            echo "<td><a href='change_pump_status.php?pumpid=".$row['trid']."&status=On'>
                                                <button class='btn btn-primary fa fa-edit'> On</button>
                                                    </a>   
                                            </td>";
                                             echo "<td>" . $row['status'] . "</td>";
                                        }
                                        else
                                        {
                                           echo "<td><a href='change_pump_status.php?pumpid=".$row['trid']."&status=Off'>
                                                <button class='btn btn-danger fa fa-edit'> Off</button>
                                                    </a>   
                                            </td>"; 
                                             echo "<td>" . $row['status'] . "</td>";
                                        }
                                        
                                       if ($timediff <=15)
                                        echo "<td> Online </td>"; 
                                        else
                                            echo "<td> Offline </td>"; 
                                        echo  "<td>" . $gallonhr . "</td>";
                                        echo  "<td>" . $cause . "</td>";
                                        echo "</tr>"; } ?>

    </tbody>
    
    </table>
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
    $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
    })
    })
</script>