<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Tube Well Summarized Report"?>
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
                 <b> From Date and Time</b>
                </div>
                <div class="col-md-3">
                  <input type="date" id="fromdate" name="fromdate" required="" class="form-control" placeholder="Logs From">
                </div>
                
                <div class="col-md-2">
                  <b>To Date and Time</b>
                </div>
                
                <div class="col-md-3">
                  <input type="date" id="todate" name="todate" required="" class="form-control" placeholder="Logs To">
                  
                </div>
                <div class="col-md-2">
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
              </div>
              </div>
              
              </form>
            <br><br>
  
            
              
              <table id="example1"
										class="table table-bordered table-striped dataTable
										 dtr-inline">
              <thead class="bg-blue">
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Scada ID: activate to sort column descending" style="width: 36.9688px;">Scada ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="TW ID: activate to sort column ascending" style="width: 19.1667px;">TW ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 49.7083px;">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="ZONE: activate to sort column ascending" style="width: 33.8542px;">ZONE</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="UC: activate to sort column ascending" style="width: 17.4583px;">UC</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="NC: activate to sort column ascending" style="width: 17.4583px;">NC</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending" style="width: 58.7604px;">Location</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Consumption (KWH): activate to sort column ascending" style="width: 82.75px;">Consumption (KWH)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Total Run (min): activate to sort column ascending" style="width: 33.5104px;">Total Run (min)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Total Run (Hours): activate to sort column ascending" style="width: 46.4583px;">Total Run (Hours)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="On/Off Events: activate to sort column ascending" style="width: 41.4271px;">On/Off Events</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Water Pumped (m3): activate to sort column ascending" style="width: 51.5938px;">Water Pumped (m<sup>3</sup>)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Flow Meter: activate to sort column ascending" style="width: 35.7188px;">Flow Meter</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Signal Strength: activate to sort column ascending" style="width: 54.2812px;">Signal Strength</th></tr>
              </thead>
              <tbody>
              <tr role="row" class="odd">
                <td class="sorting_1">1G1PU01</td>
                <td>C-29-74</td>
                <td>New Javedabad</td>
                <td>C</td>
                <td>29</td>
                <td>82</td>
                <td>Bahadar Kalli Peshawar</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
               
                <td>0</td>
                <td>No</td>
                <td>0%</td>
                
              </tr><tr role="row" class="even">
                <td class="sorting_1">1G1PU02</td>
                <td>C-34-24</td>
                <td>Gulberg1 service station</td>
                <td>C</td>
                <td>34</td>
                <td>97</td>
                <td>Gulberg Main Peshawar</td>
                <td>826.71</td>
                <td>3288</td>
                <td>54.8</td>
                <td>38</td>
               
                <td>3453</td>
                <td>No</td>
                <td>71%</td>
                
              </tr><tr role="row" class="odd">
                <td class="sorting_1">1G1PU03</td>
                <td>C-34-28</td>
                <td>Mani karkhana gulberg1</td>
                <td>C</td>
                <td>31</td>
                <td>97</td>
                <td>Gulabad near janazgah Peshawar</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
               
                <td>0</td>
                <td>No</td>
                <td>1%</td>
                
              </tr><tr role="row" class="even">
                <td class="sorting_1">1G1PU04</td>
                <td>C-34-30</td>
                <td>Gulabad gujarano</td>
                <td>C</td>
                <td>31</td>
                <td>97</td>
                <td>Gulabad Peshawar</td>
                <td>813.31</td>
                <td>2455</td>
                <td>40.92</td>
                <td>26</td>
               
                <td>2669</td>
                <td>No</td>
                <td>70%</td>
                
              </tr><tr role="row" class="odd">
                <td class="sorting_1">1G1PU05</td>
                <td>C-34-33</td>
                <td>Muslimabad ajmal khan afridi</td>
                <td>C</td>
                <td>34</td>
                <td>91</td>
                <td>Muslimabad No. 1 Nothia Peshawar</td>
                <td>603.35</td>
                <td>2196</td>
                <td>36.6</td>
                <td>34</td>
               
                <td>2985</td>
                <td>Yes</td>
                <td>98%</td>
                
              </tr><tr role="row" class="even">
                <td class="sorting_1">1G1PU06</td>
                <td>C-31-19</td>
                <td>Asif Baghi Park Nothia Qadeem</td>
                <td>C</td>
                <td>31</td>
                <td>87</td>
                <td>Nothia Asif baghi park Peshawar</td>
                <td>598.1</td>
                <td>2767</td>
                <td>46.12</td>
                <td>37</td>
               
                <td>3531</td>
                <td>No</td>
                <td>69%</td>
                
              </tr><tr role="row" class="odd">
                <td class="sorting_1">1G1PU07</td>
                <td>C-31-18</td>
                <td>Mushtariqa Colony near Naimat hujra</td>
                <td>C</td>
                <td>31</td>
                <td>87</td>
                <td>Nothia Asif baghi park Peshawar</td>
                <td>957.52</td>
                <td>2529</td>
                <td>42.15</td>
                <td>41</td>
               
                <td>3423</td>
                <td>No</td>
                <td>98%</td>
                
              </tr><tr role="row" class="even">
                <td class="sorting_1">1G1PU08</td>
                <td>C-31-20</td>
                <td>District Council No 1</td>
                <td>C</td>
                <td>31</td>
                <td>87</td>
                <td>near district council girls primary school  Peshawar</td>
                <td>1059.18</td>
                <td>2508</td>
                <td>41.8</td>
                <td>49</td>
               
                <td>3124.04</td>
                <td>Yes</td>
                <td>96%</td>
                
              </tr><tr role="row" class="odd">
                <td class="sorting_1">1G1PU09</td>
                <td>C-31-16</td>
                <td>District Council No 2</td>
                <td>C</td>
                <td>31</td>
                <td>87</td>
                <td>Near District council Qabaristan </td>
                <td>637.26</td>
                <td>2022</td>
                <td>33.7</td>
                <td>31</td>
               
                <td>2093</td>
                <td>No</td>
                <td>82%</td>
                
              </tr><tr role="row" class="even">
                <td class="sorting_1">1G1PU10</td>
                <td>C-31-15</td>
                <td>WSS gulistan colony No 3</td>
                <td>C</td>
                <td>31</td>
                <td>87</td>
                <td>Gulistan colony behind lewany baba Peshawar</td>
                <td>852.61</td>
                <td>2295</td>
                <td>38.25</td>
                <td>36</td>
               
                <td>2350</td>
                <td>No</td>
                <td>83%</td>
                
              </tr></tbody>
  
            </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 46 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">Next</a></li></ul></div></div></div></div>
          </div>
          <br>
          <button onclick="exportTableToCSV('Current_logs.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>
                

 

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
