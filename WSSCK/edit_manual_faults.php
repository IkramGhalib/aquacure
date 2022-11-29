<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Edit Manual Faults"?>



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
                  <label for="inputEmail3" class="col-sm-2 control-label">Pump*</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" disabled name="pumpid" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Fault Date Time*</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" disabled name="name" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Pump Fault*</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="galcapacity" disabled placeholder="Describe Pump Fault" required="required">
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
                    <input type="text" class="form-control" name="longitude" placeholder="Enter the person who resolved the problem" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Resolve Date Time</label>

                  <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" name="hpcapacity" placeholder="Enter Capacity. Unit: Horse Power" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Remarks</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="latitude" placeholder="Enter Remarks" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Supervised by</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="description" placeholder="Enter Supervisor Name" >
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

 <script>
    $(function () {
    $('#example1').DataTable(
    {"order": [[ 16, "desc" ]]})
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

<?php
  require_once("opendb.php");
  if (isset($_POST['submit'])) {
    $pumpid = $_POST['pumpid'];
    $name = $_POST['name'];
    $galcapacity = $_POST['galcapacity'];
    $hpcapacity = $_POST['hpcapacity'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $description = $_POST['description'];
    $conndate = $_POST['conndate'];
    $contact1 = $_POST['contact1'];
    $contact2 = $_POST['contact2'];
    $contact3 = $_POST['contact3'];

    $checkQuery = "select count(trid) as cnt from transformer where trid = '".$pumpid."'";
    $result = $conn -> query($checkQuery) or die(error);
    $count = 0;

    foreach ($result as $row) {
      $count = $row['cnt'];
    }

    if ($count >0) {
      echo "<script type='text/javascript'> alert('Sorry! Connection already Exists with this Pump ID..!'); </script>";    
    }
    
    $query = "insert into transformer (trid, name, pumping_capacity, kva_capacity, longitude, latitude, description,connectiondate, pump_operator1, pump_operator2, pump_operator3) values('$pumpid','$name','$galcapacity','$hpcapacity','$longitude','$latitude','$description', '$conndate', '$contact1','$contact2','$contact3')";

    $stmt = $conn->prepare($query);
    $result = $stmt->execute();
    $rcount = $stmt->rowCount();

    if ($rcount>0) {
      echo "<script type='text/javascript'> alert('Pump added successfully!'); </script>";
      echo "<script type='text/javascript'> window.location.href = 'list.php'; </script>";
    }else{
      echo "<script type='text/javascript'> alert('Sorry! There was error in adding pump..!'); </script>"; 
    }

  }
?>