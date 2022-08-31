<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Online Switching"?>
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


<div id="overflow" style="overflow-x:auto;">
<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-responsive table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
<thead class="bg-blue">
<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Pump ID: activate to sort column descending" style="width: 41.4167px;">Pump ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 72.4792px;">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Capacity (HP): activate to sort column ascending" style="width: 63.5208px;">Capacity (HP)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Connection Date: activate to sort column ascending" style="width: 80.5833px;">Connection Date</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Last Update: activate to sort column ascending" style="width: 54.0521px;">Last Update</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Switch Pump: activate to sort column ascending" style="width: 55.2708px;">Switch Pump</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Pump Status: activate to sort column ascending" style="width: 51.6667px;">Pump Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Communication: activate to sort column ascending" style="width: 98.2708px;">Communication</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Gallons Pumped: activate to sort column ascending" style="width: 67.3333px;">Gallons Pumped</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Cause: activate to sort column ascending" style="width: 44.4062px;">Cause</th></tr>
</thead>
<tbody>


<tr role="row" class="odd"><td class="sorting_1">1G1PU01</td><td>Sector D4 TW#06</td><td>60</td><td>25/11/20<br>12:00:00 AM</td><td>18/07/22<br>10:13:18 AM</td><td><a href="#">
            <button class="btn btn-danger fa fa-edit"> Off</button>
                </a>   
        </td><td>On</td><td> Online </td><td>5</td><td>Manual</td></tr><tr role="row" class="even"><td class="sorting_1">1G1PU02</td><td>Sector D4 TW#08</td><td>60</td><td>26/11/20<br>12:00:00 AM</td><td>18/07/22<br>04:03:04 AM</td><td><a href="#">
            <button class="btn btn-danger fa fa-edit"> Off</button>
                </a>   
        </td><td>On</td><td> Online </td><td>1.67</td><td>Manual</td></tr><tr role="row" class="odd"><td class="sorting_1">1G1PU03</td><td>Sector D2 new TW</td><td>90</td><td>27/11/20<br>12:00:00 AM</td><td>18/07/22<br>05:53:51 AM</td><td><a href="#">
            <button class="btn btn-danger fa fa-edit"> Off</button>
                </a>   
        </td><td>On</td><td> Online </td><td>1</td><td>Manual</td></tr><tr role="row" class="even"><td class="sorting_1">1G1PU04</td><td>sector D5 site office road park</td><td>80</td><td>27/11/20<br>12:00:00 AM</td><td>18/07/22<br>10:42:07 AM</td><td><a href="#">
            <button class="btn btn-danger fa fa-edit"> Off</button>
                </a>   
        </td><td>On</td><td> Online </td><td>0</td><td>Manual</td></tr><tr role="row" class="odd"><td class="sorting_1">1G1PU05</td><td>Sector E2 Tw#3 </td><td>90</td><td>27/11/20<br>12:00:00 AM</td><td>18/07/22<br>10:03:03 AM</td><td><a href="#">
            <button class="btn btn-danger fa fa-edit"> Off</button>
                </a>   
        </td><td>On</td><td> Online </td><td>1.5</td><td>Manual</td></tr><tr role="row" class="even"><td class="sorting_1">1G1PU06</td><td>Sector E3 nisar TW</td><td>60</td><td>27/11/20<br>12:00:00 AM</td><td>18/07/22<br>10:02:55 AM</td><td><a href="#">
            <button class="btn btn-danger fa fa-edit"> Off</button>
                </a>   
        </td><td>On</td><td> Online </td><td>1</td><td>Manual</td></tr><tr role="row" class="odd"><td class="sorting_1">1G1PU07</td><td>Sector E1 donga gali new TW</td><td>60</td><td>28/11/20<br>12:00:00 AM</td><td>14/07/22<br>11:05:57 AM</td><td><a href="#">
            <button class="btn btn-danger fa fa-edit"> Off</button>
                </a>   
        </td><td>On</td><td> Online </td><td>0</td><td>Manual</td></tr><tr role="row" class="even"><td class="sorting_1">1G1PU08</td><td>Sector D2 park  TW </td><td>70</td><td>28/11/20<br>12:00:00 AM</td><td>18/07/22<br>08:59:36 AM</td><td><a href="#">
            <button class="btn btn-danger fa fa-edit"> Off</button>
                </a>   
        </td><td>On</td><td> Online </td><td>0</td><td>Manual</td></tr><tr role="row" class="odd"><td class="sorting_1">1G1PU09</td><td>Sector D5 shomali market</td><td>70</td><td>30/11/20<br>12:00:00 AM</td><td>18/07/22<br>05:51:23 AM</td><td><a href="#">
            <button class="btn btn-danger fa fa-edit"> Off</button>
                </a>   
        </td><td>On</td><td> Online </td><td>0</td><td>Manual</td></tr><tr role="row" class="even"><td class="sorting_1">1G1PU10</td><td>Sector E3 jehangir TW</td><td>60</td><td>01/12/20<br>12:00:00 AM</td><td>18/07/22<br>10:02:57 AM</td><td><a href="#">
            <button class="btn btn-danger fa fa-edit"> Off</button>
                </a>   
        </td><td>On</td><td> Online </td><td>0</td><td>Manual</td></tr></tbody>

</table>
</div>
</div>
<div class="row">
    <div class="col-sm-5">
        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 13 entries</div>
    </div><div class="col-sm-7">
        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
            <ul class="pagination">
                <li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
            </li>
            <li class="paginate_button active">
                <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a>
            </li>
                <li class="paginate_button ">
                    <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">Next</a></li></ul></div></div></div></div>
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
