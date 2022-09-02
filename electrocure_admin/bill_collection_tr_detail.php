<?php
  include_once('check.php');
  authenticate("can_view");

$collectedBy=$_GET['collected_by'];
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "TRANSFORMER BILL COLLECTION  DETAIL" ?>



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
    <div class="row">
      
      <div class="col-md-4">
       <form method="post"> 
        <button type="submit" name="btntoday" class="btn btn-block btn-primary btn-lg">Today</button>
      </div>

      <div class="col-md-4">
        
        <button type="submit" name="btnweek" class="btn btn-block btn-primary btn-lg">Weekly</button>
      </div>

      <div class="col-md-4">
        
        <button type="submit" name="btnmonthly" class="btn btn-block btn-primary btn-lg">Monthly</button>
      </div>

    </form>
    </div>



<br>
 <div id="overflow">
        <table id="example1"  class="table table-responsive table-bordered table-striped">
              <thead class="bg-blue">
                <tr>

                 <th scope="col">Bill Id</th>
    <th scope="col">Total Bill</th>
    <th scope="col"> Amount Collected</th>
    <th scope="col">Collected on</th>
    <th scope="col">Collected By</th>
    
             
    </tr>
        </thead>
    <?php  
    include("opendb.php");
    if(isset($_POST['btntoday']))
    {
      //echo "Today";

      $query="SELECT * FROM tr_billing_postpaid WHERE YEAR(paid_on) = YEAR(NOW()) AND MONTH(paid_on) = MONTH(NOW()) AND DAY(paid_on) = DAY(NOW()) AND collected_by='".$collectedBy."'";
      $result=$conn->query($query);

  
        ?>

        
           
        <?php foreach ($result as $row) {
          # code...
        ?>
     <tr>
    <td><?php echo $row ['bill_id'];  ?></td>
    <td><?php echo round($row ['total_bill'],2);  ?></td>
    <td><?php echo round($row ['paid_amount'],2);  ?></td>
    <td><?php echo date( 'M d Y g:i A ', strtotime($row['paid_on']));  ?></td>
    <td><?php echo $row ['collected_by'];  ?></td>
         
    </tr>
<?php  } ?>

        
      
    <?php  

    }

    if(isset($_POST['btnweek']))
    {
   $query="SELECT * FROM tr_billing_postpaid WHERE WEEKOFYEAR(paid_on) = WEEKOFYEAR(NOW()) AND collected_by='".$collectedBy."'";
    $result=$conn->query($query);
    ?>



      <?php foreach ($result as $row) {
          # code...
        ?>
     <tr>
    <td><?php echo $row ['bill_id'];  ?></td>
    <td><?php echo round($row ['total_bill'],2);  ?></td>
    <td><?php echo round($row ['paid_amount'],2);  ?></td>
    <td><?php  echo date( 'M d Y g:i A ', strtotime($row['paid_on']));  ?></td>
    <td><?php echo $row ['collected_by'];  ?></td>
         
    </tr>
<?php  } ?>

   <?php
    }

    if(isset($_POST['btnmonthly']))
    {
      $query="SELECT * FROM tr_billing_postpaid WHERE YEAR(paid_on) = YEAR(NOW()) AND MONTH(paid_on)=MONTH(NOW()) AND collected_by='".$collectedBy."'";
      $result=$conn->query($query);

      ?>
    <?php foreach ($result as $row) {
          # code...
        ?>
     <tr>
    <td><?php echo $row ['bill_id'];  ?></td>
    <td><?php echo round($row ['total_bill'],2);  ?></td>
    <td><?php echo round($row ['paid_amount'],2);  ?></td>
    <td><?php echo date( 'M d Y g:i A ', strtotime($row['paid_on']));  ?></td>
    <td><?php echo $row ['collected_by'];  ?></td>
         
    </tr>
<?php  } ?>

   <?php }
      
     ?>



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
