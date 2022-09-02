<?php
  include_once('check.php');
  authenticate("can_view");
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Recharge Account"?>



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
    <section class="content" style="max-width: 400px;">
      
       <?php
       require_once('opendb.php');
      if (isset($_POST['recharge'])) {
        $t_sql = "select prepaid_unit, gst from tariff_electrocure order by tid desc limit 1";
        $result = $conn -> query($t_sql) or die(error);

        $tariff = 0;
        $gst = 0;

        foreach($result as $row){
          $tariff = $row['prepaid_unit'];
          $gst = $row['gst'];
          $fpa = $row['fpa'];
        }

        $tariff = $tariff + ($tariff*$gst/100)+$fpa;
        $employee = $_SESSION['employee']['userid'];
        $cid = $_POST['cid'];
        $amount = $_POST['amount'];
        $units = round($amount/$tariff,2);
        $insert = "INSERT INTO `prepaid_recharge`(`cid`, `amount`, `tariff`, `units`, `amount_collectedby`) VALUES ('$cid','$amount',$tariff,$units,'$employee')";

        //echo $insert;
         $result = $conn -> query($insert) or die(error);

         $update = "update connections set unit_limit = (unit_limit+$units), bill_paid_on = now(), recharge_off = '0' where cid = '$cid'";
        // echo $update;
          $result = $conn -> query($update) or die(error);

        $last = "select * from prepaid_recharge where cid = '$cid' order by rid desc limit 1";
        $result = $conn -> query($last) or die(error);

        foreach ($result as $row) {
          $rid = $row['rid'];
          $amount = $row['amount'];
          $cid = $row['cid'];
          $units = $row['units'];
          $tariff = $row['tariff'];
          $dt = $row['datetime'];
        }

        ?>
        <div class="row">
            <div class="col-md-12">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-green">
                  
                  <!-- /.widget-user-image -->
                  <h3 class="widget-user-username">Recharge Successful!</h3>
                  <h4>Transaction ID: <?php echo $rid;?></h4>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a href="#">Connection ID <span class="pull-right badge bg-blue"><?php echo $cid;?></span></a></li>
                    <li><a href="#">Amount (PKR) <span class="pull-right badge bg-aqua">PKR <?php echo $amount;?>/-</span></a></li>
                    <li><a href="#">Units (KWh)<span class="pull-right badge bg-green"><?php echo $units;?></span></a></li>
                    <li><a href="#">Tariff (PKR/KWh)(Incl. of GST) <span class="pull-right badge bg-red"><?php echo $tariff;?></span></a></li>
                    <li><a href="#">Date & Time <span class="pull-right badge bg-yellow"><?php echo $dt;?></span></a></li>
                  </ul>
                </div>
              </div>
              <!-- /.widget-user -->
            </div>
        </div>
        
        <?php  
      }else{
        ?>
            <form method="post">
    <img src="images/recharge.png" width="60%" height="" style="margin-left: 15%">
    <br>
    <br>
    <div class="">
          <select class="form-control" name="cid">
            <option value="0">---SELECT CONNECTION</option>
        <?php
            require_once("opendb.php");
            $sql = "select cid, name from connections where billing_method = 'prepaid'";
            $result = $conn->query($sql) or die(error);

            foreach($result as $row){
                ?>
                  <option value="<?php echo $row['cid']; ?>"><?php echo $row['cid']." --- ".$row['name']?></option>
                <?php
            }
        ?>
          </select>
      </div>
        <br>
      <div class="input-group">
        <span class="input-group-addon">PKR: </span>
        <input id="amount" type="text" class="form-control"  name="amount" placeholder="Enter amount">
      </div>
      <br>
      <div align="right">
        <button class="btn btn-primary" id="recharge" name="recharge" >Recharge</button>
        <button class="btn btn-danger" type="Reset">Reset</button>
      </div>
    </form>
        <?php 
      }
    ?>


      
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
<?php $conn = NULL; ?>
</html>
