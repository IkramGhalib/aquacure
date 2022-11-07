<?php
  include_once('check.php');
  authenticate("can_view");
?>
<!DOCTYPE html>
<html>
<head>
  
  <?php 
    if (isset($_GET['cid'])) {
      $cid = $_GET['cid'];
    }else{
      $cid = "";
    }
    $pageName = $cid." Shop Dashboard";

  ?>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Graph JS -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
<!-- Graph JS ENDS -->
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
      <!-- Sidebar user panel -->

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <?php
          require_once("opendb.php");
          $sql = "select cid, name, substring_index(cid,'CN',1) as chk from connections where substring_index(cid,'DB',1) = 'TR01'";
          $result = $conn -> query($sql) or die(error);
          $gulbahar = array();
          $faisal = array();

          foreach($result as $row){
            if ($row['chk'] == 'TR01DB01' or $row['chk'] == 'TR01DB02') {
              array_push($gulbahar, array($row['cid'], $row['name']));
            }else{
              array_push($faisal, array($row['cid'], $row['name']));
            }
          }

        ?>

        <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Faisal Colony</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">           
            <?php
              for ($i=0; $i < sizeof($faisal) ; $i++) { 
                ?>
                   <li><a href="dashboard_prepaid.php?cid=<?php echo $faisal[$i][0]; ?>"><i class="fa fa-circle-o"></i><?php echo $faisal[$i][1]; ?></a></li>
                <?php 
              }
            ?>
          </ul>
        </li>

        <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Gulbahar Colony</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">           
            <?php
              for ($i=0; $i < sizeof($gulbahar) ; $i++) { 
                ?>
                   <li><a href="dashboard_prepaid.php?cid=<?php echo $gulbahar[$i][0];?>"><i class="fa fa-circle-o"></i><?php echo $gulbahar[$i][1]; ?></a></li>
                <?php 
              }
            ?>
          </ul>
        </li>

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
        if ($cid != "") {
                  require_once("opendb.php");

        //$cid = $_GET['cid'];
        $query = "select * from connections where cid = '".$cid."'";
        
        $result = $conn -> query($query) or die("Query error");
        $status = "";
        $current_reading = 0;
        $remaining_units = 0;
        $bill_paid_on = "";
        foreach ($result as $row) {
          $status = $row['status'];
          $current_reading = round($row['peak'] + $row['offpeak'],2);
          $remaining_units = round($row['unit_limit'] - $current_reading,2);
          $last_recharge = $row['bill_paid_on'];
          $unit_limit = $row['unit_limit'];
        }

         if($remaining_units < 10){
        ?>
      <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          Kindly recharge your account to continue usage of electricity without any convenienance.
        </div>
     <?php

      }

      ?>

        <div class=row>

      <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $remaining_units?></h3>

              <p><b>Remaining Units (KWh)</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            
          </div>
        </div>


<!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $current_reading; ?></h3>

              <p><b>Current Reading (KWh)</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            
          </div>
        </div>

        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $unit_limit; ?></h3>

              <p><b>Unit Limit (KWh)</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>


        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $last_recharge; ?></h3>

              <p><b>Last Recharge</b></p>
            </div>
            <div class="icon">
              <i class=""></i>
            </div>
            
          </div>
        </div>
        
      </div>
      
    <div id="overflow" style="overflow:auto;">
    <table id="example1"  class="table table-responsive table-bordered table-striped">
    <thead class="bg-blue">
    <tr>
    <th scope="col">Transaction ID</th>
    <th scope="col">Connection ID</th>
    <th scope="col">Name</th>
    <th scope="col">Recharge Amount (PKR)</th>
    <th scope="col">Units (KWh)</th>
    <th scope="col">Tariff (PKR/KWh) (Incl. of GST)</th>
    <th scope="col">Date & Time</th>
   
    </tr>
    </thead>
    <tbody>

    <?php
    //  require_once("db/opendb.php");
    $query= "select prepaid_recharge.*, connections.name from prepaid_recharge, connections where connections.cid = '".$cid."' and connections.cid = prepaid_recharge.cid order by rid desc ";
    $result = $conn -> query($query) or die("Query error");
    foreach($result as $row){
    ?>

    <tr>
      <td><?php echo $row ['rid'];  ?></td>
      <td><?php echo $row ['cid'];  ?></td>
      <td><?php echo $row ['name'];  ?></td>
      <td><?php echo $row ['amount'];  ?></td>
      <td><?php echo $row ['units'];  ?></td>
      <td><?php echo $row ['tariff'];  ?></td>
      <td><?php echo $row ['datetime'];  ?></td>
      
    
    
    </tr>

    <?php } ?>

    </tbody>
  
    </table>
  </div>
       
<!-- 
        <div id="row">
          <div class="col-md-6">
          <iframe src="load_graph.php?id=<?php echo $cid;?>&type=1"  width="100%" height="450" frameborder="0"></iframe>  
          </div>
          <div class="col-md-6">
            <iframe src="load_graph.php?id=<?php echo $cid;?>&type=2"  width="100%" height="450" frameborder="0"></iframe>
          </div>
          <div class="col-md-6">
          <iframe src="http://brtpswr.cisnr.com/electrocure_user/load_graph_kwh.php?id=<?php echo $cid; ?>&type=3?>"  width="100%" height="450" frameborder="0"></iframe>  
          </div>
          <div class="col-md-6">
          <iframe src="http://brtpswr.cisnr.com/electrocure_user/load_graph_kwh.php?id=<?php echo $_SESSION['cid']?>&type=4&pay=<?php echo $_SESSION['pay']?>"  width="100%" height="450" frameborder="0"></iframe>  
          </div>

        </div> -->
      <?php

        }else{
          ?>
             <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Attention!</h4>
                Please select the shop to view the dashboard from the sidebar.
              </div>
          <?php

        }      
     
?>





    </section>
<?php $conn = NULL; ?> 
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
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Consumed Units',     53],
          ['Remaining Units', 247]
        ]);

        var options = {
          colors:['#DD4C39','#01A65A'],
          backgroundColor: '#ECEFF4',
          is3D: true,
          chartArea:{left:20,top:0,width:'80%',height:'75%'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>

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