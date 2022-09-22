<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Manual Fault List"; ?>

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
      <th scope="col">Fault No.</th>
      <th scope="col">Pump ID</th>
      <th scope="col">Pump Name</th>
      <th scope="col">Fault Date & Time</th>
      <th scope="col">Fault</th>
      <th scope="col">Status</th>
      <th scope="col">Resolved by</th>
      <th scope="col">Resolve Date & Time</th>
      <th scope="col">Remarks</th>
      <th scope="col">Supervised by</th>
      <th scope="col">Date & Time</th>
    </tr>
    </thead>
    <tbody>

      <?php 
        require_once("opendb.php");
        $query = "select manual_faults.*, transformer.name from manual_faults, transformer where manual_faults.pump_id = transformer.trid";
        $result = $conn -> query($query) or die(error);
        foreach ($result as $row) {
        ?>
          <tr>
            <td><?php echo $row['fault_id']; ?></td>
            <td><?php echo $row['pump_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['f_datetime']; ?></td>
            <td><?php echo $row['fault']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['resolved_by']; ?></td>
            <td><?php echo $row['r_datetime']; ?></td>
            <td><?php echo $row['remarks']; ?></td>
            <td><?php echo $row['supervised']; ?></td>
            <td><?php echo $row['datetime']; ?></td>
          </tr>
        <?php    
        }        
      ?>

 

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