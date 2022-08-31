<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Water Flow Logs"?>
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
        <form method="post">
              <div class="row">
                <div class="col-md-2">
                 <b> Select Tube Well</b>
                </div>
                <div class="col-md-4">
                 <b> From Date and Time</b>
                </div>
                <div class="col-md-4">
                  <b>To Date and Time</b>
                </div>
                <div class="col-md-2">
                  <b>Select Unit</b>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <input type="text" list="pumps" name="transformer" placeholder="Select WQ Device" required="required" class="form-control">
                  <datalist id="pumps">
                    <option value="1G1PU05">Muslimabad No. 1 Nothia Peshawar - Muslimabad No. 1 Nothia Peshawar</option>
                        <option value="1G1PU08">near district council girls primary school  Peshawar - near district council girls primary school  Peshawar</option>
                        <option value="1G1PU16">Gulberg main road Peshawar - Gulberg main road Peshawar</option>
                        <option value="1G1PU28">Nashtar Abad Road Gulbahar - Nashtar Abad Road Gulbahar</option>
                        <option value="1G1PU38">Amin Colony Main road Peshawar - Amin Colony Main road Peshawar</option>
                        
                  </datalist>
                </div>
                
                <div class="col-md-2">
                  <input type="date" id="fromdate" name="fromdate" class="form-control" placeholder="Logs From">
                </div>
                <div class="col-md-2">
                  <input type="time" id="fromtime" name="fromtime" class="form-control" placeholder="Logs From">
                  
                </div>
                
                <div class="col-md-2">
                  <input type="date" id="todate" name="todate" class="form-control" placeholder="Logs From">
                </div>
                <div class="col-md-2">
                  <input type="time" id="totime" name="totime" class="form-control" placeholder="Logs From">
                  
                </div>
                <div class="col-md-2">
                  <select name="unit" class="form-control">
                    <option value="1">Cu.m (m3)</option>
                    <option value="264.172">US Gallon</option>                    
                  </select>
                  
                </div>


              </div>
              <div class="pull-right">
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
            <br><br>
            
                         <div id="overflow" style="overflow-x:auto;">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row"><div class="col-sm-6">
                    <div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="-1">All</option></select> entries</label></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-responsive table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
              <thead class="bg-blue">
              <tr role="row"><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="TRID: activate to sort column ascending" style="width: 31.4271px;">TRID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 88.8438px;">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending" style="width: 122.438px;">Location</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="TWID: activate to sort column ascending" style="width: 32.2708px;">TWID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="ZONE: activate to sort column ascending" style="width: 33.8542px;">ZONE</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="UC: activate to sort column ascending" style="width: 17.4583px;">UC</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="NC: activate to sort column ascending" style="width: 17.4583px;">NC</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Instant Flow (m3/hr): activate to sort column ascending" style="width: 104.552px;">Instant Flow (m<sup>3</sup>/hr)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Water Pumped (m3): activate to sort column ascending" style="width: 102.938px;">Water Pumped (m<sup>3</sup>)</th><th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="descending" aria-label="Date Time: activate to sort column ascending" style="width: 77.7604px;">Date Time</th></tr>
              </thead>
              <tbody>

                         <tr role="row" class="odd">
              <td>1G1PU16</td>
            <td>Gulberg Railwayline 2</td>
            <td>Gulberg main road Peshawar</td>
            <td>C-34-25</td>
            <td>C</td>
            <td>34</td>
            <td>97</td>
            <td>57.79</td>
            <td>36559.29</td>
            <td class="sorting_1">2022-08-23 21:59:20</td>
            
            </tr><tr role="row" class="even">
              <td>1G1PU16</td>
            <td>Gulberg Railwayline 2</td>
            <td>Gulberg main road Peshawar</td>
            <td>C-34-25</td>
            <td>C</td>
            <td>34</td>
            <td>97</td>
            <td>88.41</td>
            <td>36554.31</td>
            <td class="sorting_1">2022-08-23 19:51:52</td>
            
            </tr><tr role="row" class="odd">
              <td>1G1PU16</td>
            <td>Gulberg Railwayline 2</td>
            <td>Gulberg main road Peshawar</td>
            <td>C-34-25</td>
            <td>C</td>
            <td>34</td>
            <td>97</td>
            <td>88.72</td>
            <td>36551.26</td>
            <td class="sorting_1">2022-08-23 19:49:48</td>
            
            </tr><tr role="row" class="even">
              <td>1G1PU16</td>
            <td>Gulberg Railwayline 2</td>
            <td>Gulberg main road Peshawar</td>
            <td>C-34-25</td>
            <td>C</td>
            <td>34</td>
            <td>97</td>
            <td>89.48</td>
            <td>36543.62</td>
            <td class="sorting_1">2022-08-23 19:44:38</td>
            
            </tr><tr role="row" class="odd">
              <td>1G1PU16</td>
            <td>Gulberg Railwayline 2</td>
            <td>Gulberg main road Peshawar</td>
            <td>C-34-25</td>
            <td>C</td>
            <td>34</td>
            <td>97</td>
            <td>89.23</td>
            <td>36535.94</td>
            <td class="sorting_1">2022-08-23 19:39:29</td>
            
            </tr><tr role="row" class="even">
              <td>1G1PU16</td>
            <td>Gulberg Railwayline 2</td>
            <td>Gulberg main road Peshawar</td>
            <td>C-34-25</td>
            <td>C</td>
            <td>34</td>
            <td>97</td>
            <td>89.37</td>
            <td>36528.26</td>
            <td class="sorting_1">2022-08-23 19:34:19</td>
            
            </tr><tr role="row" class="odd">
              <td>1G1PU16</td>
            <td>Gulberg Railwayline 2</td>
            <td>Gulberg main road Peshawar</td>
            <td>C-34-25</td>
            <td>C</td>
            <td>34</td>
            <td>97</td>
            <td>88.44</td>
            <td>36520.56</td>
            <td class="sorting_1">2022-08-23 19:29:09</td>
            
            </tr><tr role="row" class="even">
              <td>1G1PU16</td>
            <td>Gulberg Railwayline 2</td>
            <td>Gulberg main road Peshawar</td>
            <td>C-34-25</td>
            <td>C</td>
            <td>34</td>
            <td>97</td>
            <td>89.08</td>
            <td>36512.97</td>
            <td class="sorting_1">2022-08-23 19:24:00</td>
            
            </tr><tr role="row" class="odd">
              <td>1G1PU16</td>
            <td>Gulberg Railwayline 2</td>
            <td>Gulberg main road Peshawar</td>
            <td>C-34-25</td>
            <td>C</td>
            <td>34</td>
            <td>97</td>
            <td>90.02</td>
            <td>36506.78</td>
            <td class="sorting_1">2022-08-23 19:19:50</td>
            
            </tr><tr role="row" class="even">
              <td>1G1PU16</td>
            <td>Gulberg Railwayline 2</td>
            <td>Gulberg main road Peshawar</td>
            <td>C-34-25</td>
            <td>C</td>
            <td>34</td>
            <td>97</td>
            <td>89.81</td>
            <td>36499.05</td>
            <td class="sorting_1">2022-08-23 19:14:41</td>
            
            </tr></tbody>
  
            </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 60 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>
          </div>
          <br>
          <button onclick="exportTableToCSV('fm_logs.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>
                

 

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
