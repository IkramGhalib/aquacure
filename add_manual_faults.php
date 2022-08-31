<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Add Manual Faults"?>
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Select Pump*</label>
                  <div class="col-sm-10">
                    <input type="text" list="pumps" class="form-control" name="pumpid" placeholder="Select Pump from List" required="required">
                    <datalist id="pumps">
                                            <option value="1G1PU01">Sector D4 TW#06</option>
                                                <option value="1G1PU02">Sector D4 TW#08</option>
                                                <option value="1G1PU03">Sector D2 new TW</option>
                                                <option value="1G1PU05">Sector E2 Tw#3 </option>
                                                <option value="1G1PU04">sector D5 site office road park</option>
                                                <option value="1G1PU06">Sector E3 nisar TW</option>
                                                <option value="1G1PU07">Sector E1 donga gali new TW</option>
                                                <option value="1G1PU08">Sector D2 park  TW </option>
                                                <option value="1G1PU09">Sector D5 shomali market</option>
                                                <option value="1G1PU10">Sector E3 jehangir TW</option>
                                                <option value="1G1PU11">Shama market Sector D-4</option>
                                                <option value="1G1PU12">C-03 afghan market</option>
                                                <option value="1G1PU13">P2 Tatara Park</option>
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
                    <select class="form-control" name="status" placeholder="--- SELECT STATUS ---">
                      <option>Pending</option>
                      <option>Resolved</option>
                    </select>
                  </div>
                </div>

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Resolved by</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="resolvedby" placeholder="Enter the person who resolved the problem">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Resolve Date Time</label>

                  <div class="col-sm-5">
                    <input type="date" class="form-control" name="rdate" placeholder="Enter Capacity. Unit: Horse Power">
                  </div>
                  <div class="col-sm-5">
                    <input type="time" class="form-control" name="rtime" placeholder="Enter Capacity. Unit: Horse Power">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Remarks</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="remarks" placeholder="Enter Remarks">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Supervised by</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="supervised" placeholder="Enter Supervisor Name">
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
