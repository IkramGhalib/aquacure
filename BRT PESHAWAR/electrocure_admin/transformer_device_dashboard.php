<?php
  include_once('check.php');
  authenticate("can_view");
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Transformer Device Dashboard"?>



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
	<?php// include_once('sidebar.php') ?>

   <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar" style="margin-top: <?php echo $sidebarmargin;?>px;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <br><br><br>
          <form id="form1" method="post">
          <select class="form-control" id="interval" name="interval">
            <option value="60" <?php echo (isset($_POST['interval']) and $_POST['interval'] == 60) ? "selected" : ""; ?> >Hourly</option>
            <option value="1440" <?php echo (isset($_POST['interval']) and $_POST['interval'] == 1440) ? "selected" : ""; ?> >Daily</option>
            <option value="43800" <?php echo (isset($_POST['interval']) and $_POST['interval'] == 43800) ? "selected" : ""; ?> >Monthly</option>
          </select><br>
          <button type="submit" class="btn btn-primary pull-right" style="margin-right: 15px;">Submit</button>
            </form>
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
      

     <?php 



    date_default_timezone_set("Asia/Karachi");
  require_once("opendb.php");
   // include("DBConnection.php");
    $transformer = $_GET['id'];
   // $con = new DBCon();
      $interval = 0;
    if (isset($_POST['interval'])) {
        $interval = $_POST['interval'];
    }else{
        $interval = 60;  
    }
    
   
      
    
         // the word in the braket is that we used in ajax i.e data: {transformerid: 1G1PU01}
        
      $q = "select * from transformer where trid = '".$transformer."'";
      $result= $conn -> query($q) or die("Query error");                          
      $tr_name = "";
      foreach($result as $row)
      {     $tr_name = $row['name'];
           $v1 = round($row['v1'],2);
           $v2 = round($row['v2'],2);
           $v3 = round($row['v3'],2);
           $c1 = round($row['c1'],2);
           $c2 = round($row['c2'],2);
           $c3 = round($row['c3'],2);
           $kva1 = round($row['c1'] * $row['v1']/1000,2);
           $kva2 = round($row['c2'] * $row['v2']/1000 ,2);
           $kva3 = round($row['c3'] * $row['v2']/1000 ,2);
           
       }


       $avgVoltage = ($v1 + $v2 + $v3)/3;
       $current =  $c1 + $c2 + $c3;
       $totalKVA = $kva1+$kva2+$kva3;

       $conn =null;

    ?>

      <div class="row">
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
             <h3><?php echo round($current,2);?> AMP</h3>

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

    <div class="row">
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="load_device_graph.php?id=<?php echo $transformer; ?>&type=3&name=<?php echo $tr_name; ?>&interval=<?php echo $interval; ?>" width="600" height="400" frameborder="0"></iframe>                                      
        </div>
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="load_device_graph.php?id=<?php echo $transformer; ?>&type=4&name=<?php echo $tr_name; ?>&interval=<?php echo $interval; ?>" width="600" height="400" frameborder="0"></iframe>                                      
        </div>
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="load_device_graph.php?id=<?php echo $transformer; ?>&type=1&name=<?php echo $tr_name; ?>&interval=<?php echo $interval; ?>" width="600" height="400" frameborder="0"></iframe>                                      
        </div>
        <div class="col-lg-5" style=" margin: 10px;">
          <iframe src="load_device_graph.php?id=<?php echo $transformer; ?>&type=2&name=<?php echo $tr_name; ?>&interval=<?php echo $interval; ?>" width="600" height="400" frameborder="0"></iframe>                                      
        </div>

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
