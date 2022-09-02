<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Pump List"?>
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

      <button id="add-new-button" class="btn btn-primary" onclick="window.location.href='add_pump.php'"><b>+ Add New Pump</b></button>
    <br>
    <br>
                           
      
    <div id="overflow" style="overflow-x:auto;">
    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
        <div class="row">
        <div class="col-sm-6">
          <div class="dataTables_length" id="example1_length">
            <label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm">
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select> entries</label>
          </div>
        </div>
        <div class="col-sm-6">
          <div id="example1_filter" class="dataTables_filter">
              <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
          </label>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <table id="example1" class="table table-responsive table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
    <thead class="bg-blue">
    <tr role="row">
        <th scope="col" class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Pump ID: activate to sort column descending" style="width: 102.094px;">Pump ID</th>
        <th scope="col" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 253.156px;">Name</th>
        <th scope="col" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending" style="width: 203.688px;">Location</th>
        <th scope="col" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Capacity (HP): activate to sort column ascending" style="width: 151.312px;">Capacity (HP)</th>
        <th scope="col" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Connection Date: activate to sort column ascending" style="width: 178.75px;">Connection Date</th>
        <th scope="col" width="100" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 100px;">Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr role="row" class="odd">
    <td class="sorting_1">1G1PU01</td>
    <td>Sector D4 TW#06</td>
    <td>Pump 1</td>
    <td>60</td>
    <td>2020-11-25 00:00:00</td>
    <td>
    <button class="btn btn-primary" onclick="window.location.href='edit_pump.php'">Edit</button>
    <button class="btn btn-danger" value="1G1PU01" onclick="deleteVal(this.value)"> Delete</button>
    </td>
    </tr><tr role="row" class="even">
    <td class="sorting_1">1G1PU02</td>
    <td>Sector D4 TW#08</td>
    <td>PDA pump 02</td>
    <td>60</td>
    <td>2020-11-26 00:00:00</td>
    <td>
    <button class="btn btn-primary" onclick="window.location.href='edit_pump.php'">Edit</button>
    <button class="btn btn-danger" value="1G1PU02" onclick="deleteVal(this.value)"> Delete</button>
    </td>
    </tr><tr role="row" class="odd">
    <td class="sorting_1">1G1PU03</td>
    <td>Sector D2 new TW</td>
    <td>PDA pump 3</td>
    <td>90</td>
    <td>2020-11-27 00:00:00</td>
    <td>
    <button class="btn btn-primary" onclick="window.location.href='edit_pump.php'">Edit</button>
    <button class="btn btn-danger" value="1G1PU03" onclick="deleteVal(this.value)"> Delete</button>
    </td>
    </tr><tr role="row" class="even">
    <td class="sorting_1">1G1PU04</td>
    <td>sector D5 site office road park</td>
    <td>PDA pump 4</td>
    <td>80</td>
    <td>2020-11-27 00:00:00</td>
    <td>
    <button class="btn btn-primary" onclick="window.location.href='edit_pump.php'">Edit</button>
    <button class="btn btn-danger" value="1G1PU04" onclick="deleteVal(this.value)"> Delete</button>
    </td>
    </tr><tr role="row" class="odd">
    <td class="sorting_1">1G1PU05</td>
    <td>Sector E2 Tw#3 </td>
    <td>PDA pump 5</td>
    <td>90</td>
    <td>2020-11-27 00:00:00</td>
    <td>
    <button class="btn btn-primary" onclick="window.location.href='edit_pump.php'">Edit</button>
    <button class="btn btn-danger" value="1G1PU05" onclick="deleteVal(this.value)"> Delete</button>
    </td>
    </tr><tr role="row" class="even">
    <td class="sorting_1">1G1PU06</td>
    <td>Sector E3 nisar TW</td>
    <td>PDA pump 6</td>
    <td>60</td>
    <td>2020-11-27 00:00:00</td>
    <td>
    <button class="btn btn-primary" onclick="window.location.href='edit_pump.php?id=1G1PU06'">Edit</button>
    <button class="btn btn-danger" value="1G1PU06" onclick="deleteVal(this.value)"> Delete</button>
    </td>
    </tr><tr role="row" class="odd">
    <td class="sorting_1">1G1PU07</td>
    <td>Sector E1 donga gali new TW</td>
    <td>pda</td>
    <td>60</td>
    <td>2020-11-28 00:00:00</td>
    <td>
    <button class="btn btn-primary" onclick="window.location.href='edit_pump.php'">Edit</button>
    <button class="btn btn-danger" value="1G1PU07" onclick="deleteVal(this.value)"> Delete</button>
    </td>
    </tr><tr role="row" class="even">
    <td class="sorting_1">1G1PU08</td>
    <td>Sector D2 park  TW </td>
    <td>pda</td>
    <td>70</td>
    <td>2020-11-28 00:00:00</td>
    <td>
    <button class="btn btn-primary" onclick="window.location.href='edit_pump.php'">Edit</button>
    <button class="btn btn-danger" value="1G1PU08" onclick="deleteVal(this.value)"> Delete</button>
    </td>
    </tr><tr role="row" class="odd">
    <td class="sorting_1">1G1PU09</td>
    <td>Sector D5 shomali market</td>
    <td>pda</td>
    <td>70</td>
    <td>2020-11-30 00:00:00</td>
    <td>
    <button class="btn btn-primary" onclick="window.location.href='edit_pump.php'">Edit</button>
    <button class="btn btn-danger" value="1G1PU09" onclick="deleteVal(this.value)"> Delete</button>
    </td>
    </tr><tr role="row" class="even">
    <td class="sorting_1">1G1PU10</td>
    <td>Sector E3 jehangir TW</td>
    <td>PDA pump  10</td>
    <td>60</td>
    <td>2020-12-01 00:00:00</td>
    <td>
    <button class="btn btn-primary" onclick="window.location.href='edit_pump.php'">Edit</button>
    <button class="btn btn-danger" value="1G1PU10" onclick="deleteVal(this.value)"> Delete</button>
    </td>
    </tr></tbody>
    </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 13 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">Next</a></li></ul></div></div></div></div>
  </div>
  <br>
  <button onclick="exportTableToCSV('PumpList.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>

 

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
