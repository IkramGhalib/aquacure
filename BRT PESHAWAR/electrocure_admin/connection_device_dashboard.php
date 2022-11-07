<?php
  include_once('check.php');
  authenticate("can_view");
?>

<!doctype html>
<html><!-- InstanceBegin template="/Templates/Master.dwt" codeOutsideHTMLIsLocked="false" -->
  
<head>

	<meta charset="utf-8"> 
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>Connection Detailed Analytics</title>
	<!-- InstanceEndEditable -->
	<!-- InstanceBeginEditable name="head" -->
	<!-- InstanceEndEditable --> 
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- 		/*All STYLES*/  --> 
<style>			
		#overflow{
		width: 100%;
		height: 100%;
		}

		#add-new-button{
		position: absolute;
		right:  120px;
		}

		.skin-blue{
		background-color:#ECF0F5;
		}

		thead{
		background-color:#0073B7;
		color:white;
		}
</style>
 
			<!--ALL LINKS-->
<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<body class="skin-blue">


<div class="content-header" background-color:#000000>


     <?php //$fdid = explode('TR',$_GET['id']);?>
		<section class="content-header">
		<h1><b>
		<?php echo $_GET['id'];?> Detailed Analytics
		<button id="add-new-button" class="btn btn-primary" onClick="window.location.href='connection_dashboard.php'"><b>Return to Dashboard</b></button>

		</b></h1>

		</section>
		<hr>


     <?php 



    date_default_timezone_set("Asia/Karachi");
	   require_once("opendb.php");
   // include("DBConnection.php");
    $id = $_GET['id'];
    $type = $_GET['type'];
   // $con = new DBCon();
   
      
		
         // the word in the braket is that we used in ajax i.e data: {transformerid: 1G1PU01}
        $avgVoltage = 0;
        $totalCurrent = 0;
        $totalKVA = 0;
        $q = "select * from connections where cid = '".$id."'";
        $result= $conn -> query($q) or die("Query error");                          
        foreach($result as $row)
        {
           $avgVoltage = round(($row['v1'] + $row['v2'] + $row['v3'])/3,2);
           $totalCurrent = round($row['c1'] + $row['c2'] + $row['c3'],2);
           $kva1 = round($row['c1'] * $row['v1']/1000,2);
           $kva2 = round($row['c2'] * $row['v2']/1000 ,2);
           $kva3 = round($row['c3'] * $row['v3']/1000 ,2);
           $totalKVA = round($kva1 + $kva2 + $kva3,2);
       }

       $conn =null;

    ?>

    <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo round($avgVoltage,2);?> Volt</h3>

              <p><b>Average Voltage</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
             <h3><?php echo round($totalCurrent,2);?> AMP</h3>

              <p><b>Total Current</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
				<h3><?php echo round($totalKVA,2);?></h3>

              <p><b>Total KVA</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>




    
    </div>

    <?php if ($type == 1) {
      ?>
      <div >
        <div class="col-lg-5" style=" margin: 10px;">
          Voltage (Volts) Graph
          <iframe src="load_device_graph_connection_single.php?id=<?php echo $id; ?>&type=3&name=Transformer 1" width="650" height="500" frameborder="0"></iframe>                                      
        </div>
        <div class="col-lg-5" style=" margin: 10px;">
          Current (AMPs) Graph
          <iframe src="load_device_graph_connection_single.php?id=<?php echo $id; ?>&type=4&name=Transformer 1" width="650" height="500" frameborder="0"></iframe>                                      
        </div>
        
        <div class="col-lg-5" style=" margin: 10px;">
          KVA Graph
          <iframe src="load_device_graph_connection_single.php?id=<?php echo $id; ?>&type=2&name=Transformer 1" width="650" height="500" frameborder="0"></iframe>                                      
        </div>
         <div class="col-lg-5" style=" margin: 10px;">
          KWH Graph
          <iframe src="load_device_graph_connection_single.php?id=<?php echo $id; ?>&type=1&name=Transformer 1" width="650" height="500" frameborder="0"></iframe>                                      
        </div>
       

    </div>
      <?php
    }elseif ($type == 3) {
      ?>
      <div >
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="load_device_graph_connection.php?id=<?php echo $id; ?>&type=3&name=Transformer 1" width="600" height="400" frameborder="0"></iframe>                                      
        </div>
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="load_device_graph_connection.php?id=<?php echo $id; ?>&type=4&name=Transformer 1" width="600" height="400" frameborder="0"></iframe>                                      
        </div>
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="load_device_graph_connection.php?id=<?php echo $id; ?>&type=2&name=Transformer 1" width="600" height="400" frameborder="0"></iframe>                                      
        </div>
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="load_device_graph_connection.php?id=<?php echo $id; ?>&type=1&name=Transformer 1" width="600" height="400" frameborder="0"></iframe>                                      
        </div>

    </div>
      <?php
    }


    ?>
    
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
		
	<!-- SlimScroll -->
	<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

   
    
              
</body>
</html>