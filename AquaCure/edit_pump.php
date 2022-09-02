<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Dashboard"?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('includes/head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue sidebar-mini" >
<!-- Site wrapper -->
<div class="wrapper" style="overflow: hidden;">
	
	
	<!-- Navbar -->
	<?php include_once('includes/navbar.php') ?>
	<!-- Sidebar -->
	<?php include_once('includes/sidebar.php') ?>

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
    <section class="content">
    <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Pump ID</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="pumpid" value="1G1PU01" disabled="" placeholder="Enter Pump ID" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Pump Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="Sector D4 TW#06" placeholder="Enter Pump Name" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Pumping Capacity (Gal/Hr)</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="galcapacity" value="100" placeholder="Enter Pumping Capacity. Unit: Gallon/Hour" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Capacity (HP)</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="hpcapacity" value="60" placeholder="Enter Capacity. Unit: Horse Power" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Longitude</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="longitude" value="0" placeholder="Enter Longitude" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Latitude</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="latitude" value="0" placeholder="Enter Latitude" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="description" value="Pump 1" placeholder="Enter Description" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Connection Date</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="conndate" value="2020-11-25 00:00:00" disabled="" placeholder="Enter Connection Date" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Contact No. 1 (Required)</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="contact1" value="03449657995" placeholder="Enter Contact No. 1 (Required) Ex: 923101234567" required="required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Contact No. 2 (Optional)</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="contact2" value="" placeholder="Enter Contact No. 2 (Optional) Ex: 923101234567">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Contact No. 3 (Optional)</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="contact3" value="" placeholder="Enter Contact No. 3 (Optional) Ex: 923101234567">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary pull-right">Edit Pump</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

    </section>
      
    </section>
   
  </div>
  <!-- /.content-wrapper -->
  
	<?php include_once('includes/footer.php') ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include_once('includes/script.php') ?>
</body>
</html>
