<?php
  include_once('check.php');
  authenticate("can_view");
?>

<!DOCTYPE html>
<html>
<head>
  
  

  <?php $pageName = "Connection Consumption Logs"?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('head.php') ?> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
            
        <li class="header">Select Specific Connection</li>
        <br>
          <?php
          require_once("opendb.php");
          $query = "select cid, name from connections";
          $result = $conn -> query($query) or die("Query error");

      if (!$detect->isMobile() and !$detect->isTablet()) {

        ?>
          <form method="post">
         <input type="text" list="connect" name="connection" class="form-control" placeholder="Select Conection">
            <datalist id="connect">
            <?php
            foreach ($result as $row) {
              ?>
              <option value="<?php echo $row['cid']; ?>"><?php echo $row['name']?></option>
              <?php
            }
            ?>
            </datalist>
            
          <br>
          <div style="color: #FFFFFF"><b>From Date & Time:</b></div>
          <input type="date" id="fromdate" name="fromdate" class="form-control" placeholder="Logs From">
          <input type="time" id="fromtime" name="fromtime" class="form-control" placeholder="Logs From">

          
          <div style="color: #FFFFFF"><b>To Date & Time:</b></div>
          <input type="date" id="todate" name="todate" class="form-control" placeholder="Logs to">
          <input type="time" id="totime" name="totime" class="form-control" placeholder="Logs to">

          <br>
          <button style="float: right; margin-right:5px; " class="btn-primary btn" name="submit"> submit </button>
        </form>
      <?php } ?>
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
      if ($detect->isMobile() or $detect->isTablet()) {

        ?>
          <div class="box box-default box-solid collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Select Specific Connection</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">

            <form method="post">
          <input type="text" list="connect" name="connection" class="form-control" placeholder="Select Conection">
            <datalist id="connect">
            <?php
            foreach ($result as $row) {
              ?>
              <option value="<?php echo $row['cid']; ?>"><?php echo $row['name']?></option>
              <?php
            }
            ?>
            </datalist>
            
          <br>
          
          <div><b>From Date & Time:</b></div>
          <input type="date" id="fromdate" name="fromdate" class="form-control" placeholder="Logs From">
          <input type="time" id="fromtime" name="fromdate" class="form-control" placeholder="Logs From">

          
          <div><b>To Date & Time:</b></div>
          <input type="date" id="todate" name="todate" class="form-control" placeholder="Logs to">
          <input type="time" id="totime" name="todate" class="form-control" placeholder="Logs to">

          <br>
          <button style="float: right; margin-right:5px; " class="btn-primary btn" name="submit"> Submit </button>
        </form>



            </div>
            <!-- /.box-body -->
          </div>
          
          <?php } ?>
              
       
       <?php
        require_once("opendb.php"); 
        $filter = $_GET['filter'];
         if(isset($_GET['filter'])){
            $filter = $_GET['filter'];
          }else{
            $filter = "0G0";
          }
        if(isset($_POST['connection'])){
            $id = $_POST['connection'];

            if(empty($_POST['todate']) or empty($_POST['fromdate'])){
              $query = "SELECT cust_kwh_logs.*, connections.name FROM cust_kwh_logs ,connections WHERE cust_kwh_logs.cid = connections.cid and cust_kwh_logs.cid = '".$id."' order by cust_kwh_logs.datetime desc limit 1000";
              ?>

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing Data for Connection <b>'".$id."'</b>"; ?>
              </div>
            
              <?php
            }
            else
            {
              $fromdate = $_POST['fromdate'];
              $todate = $_POST['todate'];

              if(!(empty($_POST['fromtime']) or empty($_POST['totime']))){
                $fromdate = $fromdate ." ". $_POST['fromtime'];
                $todate = $todate ." ". $_POST['totime'];
              }
             $query = "select cust_kwh_logs.*,connections.name from cust_kwh_logs, connections WHERE  cust_kwh_logs.cid = '".$id."' AND cust_kwh_logs.cid = connections.cid and cust_kwh_logs.Datetime BETWEEN  '".$fromdate."' AND '".$todate."'";
              ?>

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing Data for Connection <b>'".$id."'</b> from date '".$fromdate."' to date '".$todate."'"; ?>
              </div>
            
              <?php
              
            }
          }elseif($filter == '0G0')
          $query= "select cust_kwh_logs.*,connections.name from cust_kwh_logs,connections WHERE cust_kwh_logs.cid = connections.cid and cust_kwh_logs.datetime >NOW()-INTERVAL 1 DAY order by cust_kwh_logs.datetime desc limit 5000";
         else
          $query= "select cust_kwh_logs.*,connections.name from cust_kwh_logs,connections WHERE cust_kwh_logs.cid = connections.cid and cust_kwh_logs.cid = '".$filter."' and cust_kwh_logs.datetime >NOW()-INTERVAL 1 DAY order by cust_kwh_logs.datetime desc limit 5000";

        //echo $query;
        $result = $conn -> query($query) or die("Query error");
      ?>
      
    <div  id="overflow" >
        <table  id="example1" class="table table-responsive table-bordered table-striped" >
        <thead class="bg-blue">
        <tr>
          <th scope="col">Connection ID</th>
          <th scope="col">Name</th>
          <th scope="col">Consumed Units</th>
          <th scope="col">Current Load</th>
          
          
          <th scope="col">Date & Time</th>
          
          
        </tr>
        </thead>
          
          
        <tbody bgcolor="#FFFFFF">
          
          <?php
          foreach($result as $row){
          ?>
          
          
        <tr>
            <td><?php echo $row ['cid']; ?></td>
            <td><?php echo $row ['name']; ?></td>
          <td><?php echo round($row ['offpeak']+$row ['peak'],2);  ?></td>
          
          <td><?php echo round($row ['offpkunits']+$row ['pkunits'],2);  ?></td>
          
          
          <td><?php echo $row ['datetime'];  ?></td>
        </tr>
          
          <?php
          }
        ?>
        
          
        </tbody>
        <tfoot class="bg-blue">
        <tr>
          <th scope="col">Connection ID</th>
          <th scope="col">Name</th>
          <th scope="col">Consumed Units</th>
          <th scope="col">Current Load</th>
         
          <th scope="col">Date & Time</th>
        </tr>
        </tfoot>

      </table>
      </div>
  <?php $conn= NULL; ?>
    
      
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

  
   <script>
    $(function () {
    $('#example1').DataTable(
    {"order": [[ 6, "desc" ]]})
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

</html>
