<?php
  include_once('check.php');
  authenticate("bills");
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Transformers Current Month Bills ";?>



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
          <th scope="col">Bill</th>
          <th scope="col">Transformer ID</th>
          <th scope="col">Name - KVA Capacity</th>
          <th scope="col">Arrears (PKR)</th>
          
          <th scope="col">Units Consumed (KWH)</th>
          <th scope="col">Current Bill (PKR)</th>
          <!-- <th scope="col">Tariff</th> -->
          <th scope="col">Total Due Bill (PKR)</th>
          <th scope="col">Bill Generated</th>
          <th scope="col">Status</th>
          <th scope="col">Actions</th>
        </tr>
        </thead>
          
          
        <tbody bgcolor="#FFFFFF">
          
          <?php
          include("opendb.php"); 
          $query= "select tr_billing_postpaid.*, transformer.name,transformer.kva_capacity from tr_billing_postpaid, transformer where bill_id in (select max(bill_id) from tr_billing_postpaid group by tr_billing_postpaid.trid) and tr_billing_postpaid.trid = transformer.trid";
          // echo $query;
          $result = $conn -> query($query) or die("Query error");

          foreach ($result as $row) {
            # code...
          $bill_id = $row ['bill_id']; 
          
           // echo $row['kva_capacity'];        
          ?>
          
        <tr class=" <?php echo ($row ['status'] == 1) ? "bg-green" : "";?>">
           <td><?php echo $row ['bill_id'];  ?></td>
          <td><?php echo $row ['trid'];  ?></td>
          <td><?php echo $row ['name'];  ?> -- <?php echo $row['kva_capacity']?> kVA</td>
          <td class="<?php echo ($row ['last_arrears']>0 and $row ['status'] == 0) ? 'bg-red' : ''; ?>" > <?php echo round($row ['last_arrears']);  ?></td>
         
          <td><?php echo round($row ['units_consumed'],2);  ?></td>
          <!-- <td><?php //echo $row ['tariff'];  ?></td> -->
          <td><?php echo round($row ['total_bill']-$row ['last_arrears']);  ?></td>
          <td><?php echo round($row ['total_bill']);  ?></td>
          <td><?php echo $row ['generated_on'];  ?></td>
          <td><?php echo ($row ['status'] == 0) ? "Pending" : "Paid";  ?></td>
          <td><button class="btn btn-primary" onclick="window.location.href = 'bill_pay_tr.php?id=<?php echo $bill_id;  ?>'" <?php echo ($row ['status'] == 1) ? "disabled" : "";?>>Pay Bill</button>
            <button class="btn btn-primary" onclick="window.location.href = 'ebill_tr.php?id=<?php echo $row ['trid'];  ?>'">Print Bill</button></td>
 
        
          
        </tr>
          
          <?php
          }
        ?>
              </tbody>
              <tfoot class="bg-primary">
        <tr>     
          <th scope="col">Bill</th>
          <th scope="col">Transformer ID</th>
          <th scope="col">Name - KVA Capacity</th>
          <th scope="col">Arrears (PKR)</th>
          
          <th scope="col">Units Consumed (KWH)</th>
          <th scope="col">Current Bill (PKR)</th>
          <!-- <th scope="col">Tariff</th> -->
          <th scope="col">Total Due Bill (PKR)</th>
          <th scope="col">Bill Generated</th>
          <th scope="col">Status</th>
          <th scope="col">Actions</th>
        </tr>
        </tfoot>
          
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
