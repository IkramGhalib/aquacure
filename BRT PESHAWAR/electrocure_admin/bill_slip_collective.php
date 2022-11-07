<?php
  include_once('check.php');
  authenticate("bills");
?>
<!DOCTYPE html>
<html>
<head>
  <?php $pageName = "Electrocure Collective eBill"?>

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
  <?php //include_once('sidebar.php') ?>

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
      <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <b>Bus Rapid Transit (BRT) Peshawar</b>
            
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <?php 
        $id = $_GET['id'];
        $status = $_GET['status'];
      ?>
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            
            <b style="font-size: 20px">COLLECTIVE BILL RECEIPT</b><br>
            <b>CNIC</b> <?php echo $id; ?><br>
            <b>Date</b> <?php echo date('l jS \of F Y h:i:s A'); ?><br>
            <br>

        <!-- /.col -->
      </div>
      <!-- /.row -->




      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
              
            <tr class="bg-primary">
                <td>Bill no.</td>
                <td>Reference no.</td>
                <td>Name</td>
                <td>Previous Reading</td>
                <td>Current Reading</td>
                <td>Units Consumed</td>
                <td>Current Bill</td>
                <td>Arrears</td>
                <td>Total Bill</td>
                
              </tr>
            </thead>
            <tbody>
              
              <?php
                require_once("opendb.php");

                $query = "select cnic, name, billing_postpaid.* from billing_postpaid, connections where connections.cnic = '$id' and billing_postpaid.status = '$status' and connections.cid = billing_postpaid.cid and bill_id in (select max(bill_id) from billing_postpaid group by billing_postpaid.cid)";
                $result = $conn -> query($query) or die(error);
                $total = 0;
                foreach ($result as $row) {
                  $total += $row['total_bill'];
                 ?>



              <tr>
                <td><?php echo $row['bill_id']; ?></td>
                <td><?php echo $row['cid']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['current_reading']-$row['units_consumed']; ?></td>
                <td><?php echo $row['current_reading']; ?></td>
                <td><?php echo $row['units_consumed']; ?></td>
                <td><?php echo $row['total_bill']-$row['last_arrears']; ?></td>
                <td><?php echo $row['last_arrears']; ?></td>
                <td><?php echo $row['total_bill']; ?></td>
              </tr>

               <?php
                }
              ?>

              <tr style="border-color: #00000" bgcolor="#fffff">
                
                <td colspan="8" style="text-align: right;"><h4><b>TOTAL AMOUNT:</b></h4></td>
                <td><h4><b><?php echo $total; ?></b></h4></td>
              </tr>

                

                
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>


      <!-- /.row -->
      

     <br>
     <br>
     <br>
     <br>
      <!-- /.row -->
      <?php $conn = NULL; ?>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button class="btn btn-danger pull-right" style="margin-right: 5px;" onclick="window.location.href = 'bill_pay_collective.php?id=<?php echo $id; ?>'">Pay Bill</button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" onclick="window.print()">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>



    </section>

    <!-- /.content -->


   
  </div>
  <!-- /.content-wrapper -->
  
  <?php //include_once('footer.php') ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include_once('script.php') ?>
</body>
</html>
