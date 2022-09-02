<?php
  include_once('check.php');
  authenticate("bills");
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Current Month Custom Bills";?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('head.php');
 
 if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
 }else{
  $filter = "0G0";
 }
 
 ?> 
 
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
<!-- Left side column. contains the logo and sidebar -->
  <!-- =============================================== -->

<aside class="main-sidebar" style="margin-top: <?php echo $sidebarmargin;?>px;">
        <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="overflow-x: scroll;">
          <!-- sidebar menu: : style can be found in sidebar.less -->
         
      <ul class="sidebar-menu">
            <form id="sidebarform" method="post">
        <li class="header">Select Specific Transformer</li>
   

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
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



 <!-- DO NOT REMOVE THIS TABLE TAG -->
 <table width="100%" border="0"></table>
    <div  id="overflow" style="overflow-x:auto;">
        <table  id="example1" class="table table-responsive table-bordered table-striped">
        <thead class="bg-primary">
        <tr>     
          <th scope="col">Bill ID</th>
          <th scope="col">Transformer ID</th>
          <th scope="col">Transformer Name</th>
          <th scope="col">Date From</th>
          <th scope="col">Date To</th>
          <th scope="col">Units Start</th>
          <th scope="col">Units End</th>
          <th scope="col">Total Units</th>
          <th scope="col">Due Bill (Rs.)</th>
          <th scope="col">Bill Generated</th>
          <th scope="col">Status</th>
          <th scope="col">Actions</th>
        </tr>
        </thead>
          
          
        <tbody bgcolor="#FFFFFF">
          
          <?php
          include("opendb.php"); 
          $query= "select tr_billing_custom.*, transformer.name from tr_billing_custom, transformer where substring_index(tr_billing_custom.date_generated, '-', 2) = substring_index(now(), '-', 2)  and tr_billing_custom.trid = transformer.trid";
           //echo $query;
          $result = $conn -> query($query) or die("Query error");

          foreach ($result as $row) {
            # code...
          
                  
          ?>
          
        <tr>
           <td><?php echo $row ['id'];  ?></td>
          <td><?php echo $row ['trid'];  ?></td>
          <td><?php echo $row ['name'];  ?></td>
          <td><?php echo $row ['date_from'];  ?></td>
          <td><?php echo $row ['date_to'];  ?></td>
          <td><?php echo $row ['units_from'];  ?></td>
          <td><?php echo $row ['units_to'];  ?></td>
          <!-- <td><?php //echo $row ['gst'];  ?> %</td> -->
          <td><?php echo $row ['total_units'];  ?></td>
           <td><?php echo $row ['total_bill'];  ?></td>
            <td><?php echo $row ['date_generated'];  ?></td>
          <td><?php echo ($row ['status'] == 0) ? "Pending" : "Paid";  ?></td>
          <td> <?php if($row['status']==0){ ?>
            <button class="btn btn-primary" onclick="window.location.href = 'bill_pay_tr_custom.php?id=<?php echo $row ['id'];  ?>'">Pay Bill</button>
          <?php } ?>
            <button class="btn btn-primary" onclick="window.location.href = 'ebill_tr_custom.php?id=<?php echo $row ['id'];  ?>'">Print Bill</button></td>
 
        
          
        </tr>
          
          <?php
          }
        ?>
              </tbody>
          
        </table>
        </div>
      </section>
        
      
  <?php $conn= NULL; ?>
  
    
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
        {'order': [[ 0, "asc" ]]})
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
