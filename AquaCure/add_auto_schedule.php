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
        <div class="container">
              <div class="box-header with-border">
                
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form class="form-horizontal" method="post">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Pump ID</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" list="pumps" name="pumpid" placeholder="Enter Pump ID">
                      <datalist id="pumps">
                                                  <option value="1G1PU01">Sector D4 TW#06</option>
                                                    <option value="1G1PU02">Sector D4 TW#08</option>
                                                    <option value="1G1PU03">Sector D2 new TW</option>
                                                    <option value="1G1PU04">sector D5 site office road park</option>
                                                    <option value="1G1PU05">Sector E2 Tw#3 </option>
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
                    <label for="inputEmail3" class="col-sm-2 control-label">Daily <input type="checkbox" name="cdaily" value="0"></label>
                    <label class="col-sm-1  control-label">Start Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="daily_start" placeholder="Enter Pump ID">
                    </div>
                    <label class="col-sm-1  control-label">End Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="daily_end" placeholder="Enter Pump ID">
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Monday <input type="checkbox" name="cmon" value="1"></label>
                    <label class="col-sm-1  control-label">Start Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="mon_start" placeholder="Enter Pump ID">
                    </div>
                    <label class="col-sm-1  control-label">End Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="mon_end" placeholder="Enter Pump ID">
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tuesday <input type="checkbox" name="ctue" value="2"></label>
                    <label class="col-sm-1  control-label">Start Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="tue_start" placeholder="Enter Pump ID">
                    </div>
                    <label class="col-sm-1  control-label">End Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="tue_end" placeholder="Enter Pump ID">
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Wednesday <input type="checkbox" name="cwed" value="3"></label>
                    <label class="col-sm-1  control-label">Start Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="wed_start" placeholder="Enter Pump ID">
                    </div>
                    <label class="col-sm-1  control-label">End Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="wed_end" placeholder="Enter Pump ID">
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Thursday <input type="checkbox" name="cthu" value="4"></label>
                    <label class="col-sm-1  control-label">Start Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="thu_start" placeholder="Enter Pump ID">
                    </div>
                    <label class="col-sm-1  control-label">End Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="thu_end" placeholder="Enter Pump ID">
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Friday <input type="checkbox" name="cfri" value="5"></label>
                    <label class="col-sm-1  control-label">Start Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="fri_start" placeholder="Enter Pump ID">
                    </div>
                    <label class="col-sm-1  control-label">End Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="fri_end" placeholder="Enter Pump ID">
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Saturday <input type="checkbox" name="csat" value="6"></label>
                    <label class="col-sm-1  control-label">Start Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="sat_start" placeholder="Enter Pump ID">
                    </div>
                    <label class="col-sm-1  control-label">End Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="sat_end" placeholder="Enter Pump ID">
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Sunday <input type="checkbox" name="csun" value="7"></label>
                    <label class="col-sm-1  control-label">Start Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="sun_start" placeholder="Enter Pump ID">
                    </div>
                    <label class="col-sm-1  control-label">End Time</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" name="sun_end" placeholder="Enter Pump ID">
                    </div>
                  </div>
  
                </form></div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="reset" class="btn btn-danger">Reset</button>
                  <button type="submit" name="submit" class="btn btn-primary pull-right">Add Pump</button>
                </div>
                <!-- /.box-footer -->
              
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
