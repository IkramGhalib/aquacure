<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Add Manual Faults"?>



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
    <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Select Pump*</label>
                  <div class="col-sm-10">
                    <input type="text" list="pumps" class="form-control" name="pumpid" placeholder="Select Pump from List" required="required">
                    <datalist id="pumps">
                    <?php
                      require_once("opendb.php");
                      $query = "select trid, name from transformer";
                      $result = $conn -> query($query) or die(error);

                      foreach ($result as $row) {
                        ?>
                        <option value="<?php echo $row['trid']; ?>"><?php echo $row['name']; ?></option>
                        <?php
                      }
                    ?>
                    </datalist>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Fault Date Time*</label>

                  <div class="col-sm-5">
                    <input type="date" class="form-control" name="fdate" required="required">
                  </div>
                  <div class="col-sm-5">
                    <input type="time" class="form-control" name="ftime" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Pump Fault*</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="fault" placeholder="Describe Pump Fault" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Status*</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="status" placeholder="--- SELECT STATUS ---" >
                      <option>Pending</option>
                      <option>Resolved</option>
                    </select>
                  </div>
                </div>

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Resolved by</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="resolvedby" placeholder="Enter the person who resolved the problem" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Resolve Date Time</label>

                  <div class="col-sm-5">
                    <input type="date" class="form-control" name="rdate" placeholder="Enter Capacity. Unit: Horse Power" >
                  </div>
                  <div class="col-sm-5">
                    <input type="time" class="form-control" name="rtime" placeholder="Enter Capacity. Unit: Horse Power" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Remarks</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="remarks" placeholder="Enter Remarks" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Supervised by</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="supervised" placeholder="Enter Supervisor Name" >
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" name="submit" class="btn btn-primary pull-right">Add Fault</button>
              </div>
              <!-- /.box-footer -->
            </form>
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

<?php
  require_once("opendb.php");
  if (isset($_POST['submit'])) {
    $pumpid = $_POST['pumpid'];
    $fdate = $_POST['fdate']." ".$_POST['ftime'];
  
    $fault = $_POST['fault'];
    $status = $_POST['status'];
    $rdate = $_POST['rdate']." ".$_POST['rtime'];
  
    $resolvedby = $_POST['resolvedby'];
    $remarks = $_POST['remarks'];
    $supervised = $_POST['supervised'];
    
    $query = "insert into manual_faults (pump_id, f_datetime, fault,status,resolved_by, r_datetime, remarks, supervised_by) values('$pumpid','$fdate','$fault', '$status', '$rdate', '$resolvedby','$remarks','$supervised')";

    echo $query;

    $stmt = $conn->prepare($query);
    $result = $stmt->execute();
    $rcount = $stmt->rowCount();

    if ($rcount>0) {
      echo "<script type='text/javascript'> alert('Fault added successfully!'); </script>";
      echo "<script type='text/javascript'> window.location.href = 'manual_faults.php'; </script>";
    }else{
      echo "<script type='text/javascript'> alert('Sorry! There was error in adding Fault..!'); </script>"; 
    }

  }
?>