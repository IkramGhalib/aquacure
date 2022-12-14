<?php session_start();
if( !isset($_SESSION['cid'])){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>


  <?php $pageName = "Recharge Logs"?>



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
    <?php
      if($_SESSION['employee']['can_edit'] == 1){
      ?>
      
        <button id="add-new-button" class="btn btn-primary" onClick="window.location.href='add-new-connections.php'"><b>+ Add New Connection</b></button>
        <br>
<br>
      <?php                        
      }
    ?>

    <div id="overflow" style="overflow: auto;">
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
     require_once("opendb.php");
    $cid = $_SESSION['cid'];
    $query= "select prepaid_recharge.*, connections.name from prepaid_recharge, connections where  connections.cid = '".$cid."' and connections.cid = prepaid_recharge.cid order by rid desc ";
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
</html>
