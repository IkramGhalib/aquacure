<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Auto Switching"?>
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
                         <button id="add-new-button" class="btn btn-primary" onclick="window.location.href='add_auto_schedule.php'"><b>+ Add Auto Switching Job</b></button>
                  <br>
                  <br>
                
    
    <div id="overflow" style="overflow-x:auto;">
    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-responsive table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
    <thead class="bg-blue">
    <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Pump ID: activate to sort column descending" style="width: 42.1771px;">Pump ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Pump: activate to sort column ascending" style="width: 78.1667px;">Pump</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Start Time: activate to sort column ascending" style="width: 43.2812px;">Start Time</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Off Time: activate to sort column ascending" style="width: 38.8542px;">Off Time</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Repeat: activate to sort column ascending" style="width: 43.3021px;">Repeat</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Enable/Disable: activate to sort column ascending" style="width: 92.6979px;">Enable/Disable</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Auto Status: activate to sort column ascending" style="width: 50.7812px;">Auto Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Auto Time Adjustment: activate to sort column ascending" style="width: 95.875px;">Auto Time Adjustment</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Signal Strength: activate to sort column ascending" style="width: 69.5px;">Signal Strength</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label=" Job Creation Date &amp;amp; Time: activate to sort column ascending" style="width: 90.6979px;"> Job Creation Date &amp; Time</th><th width="120" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 120px;">Actions</th></tr>
    </thead>
    <tbody>

    <tr role="row" class="odd">
        <td class="sorting_1">1G1PU01</td>
        <td>Sector D4 TW#06</td>
        <td>02:00:00 am </td>
        <td>06:00:00 am </td>
        <td> Daily </td>
        <td><a href="change_auto_enable_status.php?pumpid=8&amp;en_status=1">
            <button class="btn btn-primary"><span class="fa fa-power-off"></span> On</button>
                </a>   
        </td><td>Off</td><td><a href="auto_time_adjustment.php?pumpid=8&amp;status=0">
            <button class="btn btn-success"><span class="fa fa-power-off"></span> Enable</button>
                </a>   
        </td><td style="color: Green;">Strong (22)</td><td>2021-05-12 14:31:20</td><td><a href="edit_auto_switching.php?id=8&amp;name=Sector D4 TW#06&amp;repeat=0"><button class="btn btn-primary">Edit</button></a> <button class="btn btn-danger" value="8" onclick="deleteVal(this.value)">Delete</button></td></tr><tr role="row" class="even"><td class="sorting_1">1G1PU01</td><td>Sector D4 TW#06</td><td>10:00:00 am </td><td>02:00:00 pm </td><td> Daily </td><td><a href="change_auto_enable_status.php?pumpid=9&amp;en_status=1">
            <button class="btn btn-primary"><span class="fa fa-power-off"></span> On</button>
                </a>   
        </td><td>Off</td><td><a href="auto_time_adjustment.php?pumpid=9&amp;status=0">
            <button class="btn btn-success"><span class="fa fa-power-off"></span> Enable</button>
                </a>   
        </td><td style="color: Green;">Strong (22)</td><td>2021-04-23 10:46:15</td><td><a href="edit_auto_switching.php?id=9&amp;name=Sector D4 TW#06&amp;repeat=0"><button class="btn btn-primary">Edit</button></a> <button class="btn btn-danger" value="9" onclick="deleteVal(this.value)">Delete</button></td></tr><tr role="row" class="odd"><td class="sorting_1">1G1PU01</td><td>Sector D4 TW#06</td><td>05:00:00 pm </td><td>09:00:00 pm </td><td> Daily </td><td><a href="change_auto_enable_status.php?pumpid=10&amp;en_status=1">
            <button class="btn btn-primary"><span class="fa fa-power-off"></span> On</button>
                </a>   
        </td><td>Off</td><td><a href="auto_time_adjustment.php?pumpid=10&amp;status=0">
            <button class="btn btn-success"><span class="fa fa-power-off"></span> Enable</button>
                </a>   
        </td><td style="color: Green;">Strong (22)</td><td>2021-04-23 10:46:19</td><td><a href="edit_auto_switching.php?id=10&amp;name=Sector D4 TW#06&amp;repeat=0"><button class="btn btn-primary">Edit</button></a> <button class="btn btn-danger" value="10" onclick="deleteVal(this.value)">Delete</button></td></tr><tr role="row" class="even"><td class="sorting_1">1G1PU02</td><td>Sector D4 TW#08</td><td>02:00:00 am </td><td>06:00:00 am </td><td> Daily </td><td><a href="change_auto_enable_status.php?pumpid=1&amp;en_status=1">
            <button class="btn btn-primary"><span class="fa fa-power-off"></span> On</button>
                </a>   
        </td><td>Off</td><td><a href="auto_time_adjustment.php?pumpid=1&amp;status=0">
            <button class="btn btn-success"><span class="fa fa-power-off"></span> Enable</button>
                </a>   
        </td><td style="color: Green;">Strong (23)</td><td>2021-04-14 12:18:58</td><td><a href="edit_auto_switching.php?id=1&amp;name=Sector D4 TW#08&amp;repeat=0"><button class="btn btn-primary">Edit</button></a> <button class="btn btn-danger" value="1" onclick="deleteVal(this.value)">Delete</button></td></tr><tr role="row" class="odd"><td class="sorting_1">1G1PU02</td><td>Sector D4 TW#08</td><td>10:00:00 am </td><td>02:00:00 pm </td><td> Daily </td><td><a href="change_auto_enable_status.php?pumpid=2&amp;en_status=1">
            <button class="btn btn-primary"><span class="fa fa-power-off"></span> On</button>
                </a>   
        </td><td>Off</td><td><a href="auto_time_adjustment.php?pumpid=2&amp;status=0">
            <button class="btn btn-success"><span class="fa fa-power-off"></span> Enable</button>
                </a>   
        </td><td style="color: Green;">Strong (23)</td><td>2021-04-14 12:19:08</td><td><a href="edit_auto_switching.php?id=2&amp;name=Sector D4 TW#08&amp;repeat=0"><button class="btn btn-primary">Edit</button></a> <button class="btn btn-danger" value="2" onclick="deleteVal(this.value)">Delete</button></td></tr><tr role="row" class="even"><td class="sorting_1">1G1PU02</td><td>Sector D4 TW#08</td><td>05:00:00 pm </td><td>09:00:00 pm </td><td> Daily </td><td><a href="change_auto_enable_status.php?pumpid=3&amp;en_status=1">
            <button class="btn btn-primary"><span class="fa fa-power-off"></span> On</button>
                </a>   
        </td><td>Off</td><td><a href="auto_time_adjustment.php?pumpid=3&amp;status=0">
            <button class="btn btn-success"><span class="fa fa-power-off"></span> Enable</button>
                </a>   
        </td><td style="color: Green;">Strong (23)</td><td>2021-04-14 12:19:19</td><td><a href="edit_auto_switching.php?id=3&amp;name=Sector D4 TW#08&amp;repeat=0"><button class="btn btn-primary">Edit</button></a> <button class="btn btn-danger" value="3" onclick="deleteVal(this.value)">Delete</button></td></tr><tr role="row" class="odd"><td class="sorting_1">1G1PU03</td><td>Sector D2 new TW</td><td>02:00:00 am </td><td>06:00:00 am </td><td> Daily </td><td><a href="change_auto_enable_status.php?pumpid=11&amp;en_status=1">
            <button class="btn btn-primary"><span class="fa fa-power-off"></span> On</button>
                </a>   
        </td><td>Off</td><td><a href="auto_time_adjustment.php?pumpid=11&amp;status=0">
            <button class="btn btn-success"><span class="fa fa-power-off"></span> Enable</button>
                </a>   
        </td><td style="color: Green;">Strong (58)</td><td>2021-04-14 12:19:54</td><td><a href="edit_auto_switching.php?id=11&amp;name=Sector D2 new TW&amp;repeat=0"><button class="btn btn-primary">Edit</button></a> <button class="btn btn-danger" value="11" onclick="deleteVal(this.value)">Delete</button></td></tr><tr role="row" class="even"><td class="sorting_1">1G1PU03</td><td>Sector D2 new TW</td><td>10:00:00 am </td><td>02:00:00 pm </td><td> Daily </td><td><a href="change_auto_enable_status.php?pumpid=12&amp;en_status=1">
            <button class="btn btn-primary"><span class="fa fa-power-off"></span> On</button>
                </a>   
        </td><td>Off</td><td><a href="auto_time_adjustment.php?pumpid=12&amp;status=0">
            <button class="btn btn-success"><span class="fa fa-power-off"></span> Enable</button>
                </a>   
        </td><td style="color: Green;">Strong (58)</td><td>2021-04-14 12:20:04</td><td><a href="edit_auto_switching.php?id=12&amp;name=Sector D2 new TW&amp;repeat=0"><button class="btn btn-primary">Edit</button></a> <button class="btn btn-danger" value="12" onclick="deleteVal(this.value)">Delete</button></td></tr><tr role="row" class="odd"><td class="sorting_1">1G1PU03</td><td>Sector D2 new TW</td><td>05:00:00 pm </td><td>09:00:00 pm </td><td> Daily </td><td><a href="change_auto_enable_status.php?pumpid=13&amp;en_status=1">
            <button class="btn btn-primary"><span class="fa fa-power-off"></span> On</button>
                </a>   
        </td><td>Off</td><td><a href="auto_time_adjustment.php?pumpid=13&amp;status=0">
            <button class="btn btn-success"><span class="fa fa-power-off"></span> Enable</button>
                </a>   
        </td><td style="color: Green;">Strong (58)</td><td>2021-04-14 12:20:11</td><td><a href="edit_auto_switching.php?id=13&amp;name=Sector D2 new TW&amp;repeat=0"><button class="btn btn-primary">Edit</button></a> <button class="btn btn-danger" value="13" onclick="deleteVal(this.value)">Delete</button></td></tr><tr role="row" class="even"><td class="sorting_1">1G1PU04</td><td>sector D5 site office road park</td><td>02:00:00 am </td><td>06:00:00 am </td><td> Daily </td><td><a href="change_auto_enable_status.php?pumpid=4&amp;en_status=1">
            <button class="btn btn-primary"><span class="fa fa-power-off"></span> On</button>
                </a>   
        </td><td>Off</td><td><a href="auto_time_adjustment.php?pumpid=4&amp;status=0">
            <button class="btn btn-success"><span class="fa fa-power-off"></span> Enable</button>
                </a>   
        </td><td style="color: Green;">Strong (12)</td><td>2021-04-04 12:56:05</td><td><a href="edit_auto_switching.php?id=4&amp;name=sector D5 site office road park&amp;repeat=0"><button class="btn btn-primary">Edit</button></a> <button class="btn btn-danger" value="4" onclick="deleteVal(this.value)">Delete</button>
    </td>
</tr>
</tbody>
    </table>
</div>
</div>
<div class="row">
    <div class="col-sm-5">
        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 39 entries</div>
    </div>
    <div class="col-sm-7">
        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
            <ul class="pagination">
                <li class="paginate_button previous disabled" id="example1_previous">
                    <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
                </li>
                <li class="paginate_button active">
                    <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a>
                </li>
                <li class="paginate_button ">
                    <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a>
            </li>
            <li class="paginate_button ">
                <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a>
            </li>
            <li class="paginate_button ">
                <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a>
            </li>
            <li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">Next</a></li></ul></div>
        </div>
    </div>
</div>
  </div>
  <br>
  <button onclick="exportTableToCSV('auto_switching.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>

 

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
