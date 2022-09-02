<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Faults"?>
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

<form method="post">
        <div class="row">
          <div class="col-md-2">
            <input type="text" list="pumps" name="transformer" placeholder="Select Pump" required="required" class="form-control">
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
          <div class="col-md-1">
           <b> From Date and Time</b>
          </div>
          <div class="col-md-2">
            <input type="date" id="fromdate" name="fromdate" class="form-control" placeholder="Logs From">
          </div>
          <div class="col-md-2">
            <input type="time" id="fromtime" name="fromtime" class="form-control" placeholder="Logs From">
            
          </div>
          <div class="col-md-1">
            <b>To Date and Time</b>
          </div>
          <div class="col-md-2">
            <input type="date" id="fromdate" name="fromdate" class="form-control" placeholder="Logs From">
          </div>
          <div class="col-md-2">
            <input type="time" id="fromtime" name="fromtime" class="form-control" placeholder="Logs From">
            
          </div>
        </div>
        <div class="pull-right">
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      <br><br>

<div id="overflow" style="overflow-x:auto;">
<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="-1">All</option></select> entries</label></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-responsive table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
<thead class="bg-blue">
<tr role="row"><th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="descending" aria-label="Fault #: activate to sort column ascending" style="width: 36.2917px;">Fault #</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Pump ID: activate to sort column ascending" style="width: 43.7917px;">Pump ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 89.5104px;">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Volt 1 (V): activate to sort column ascending" style="width: 38.9479px;">Volt 1 (V)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Volt 2 (V): activate to sort column ascending" style="width: 38.9479px;">Volt 2 (V)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Volt 3 (V): activate to sort column ascending" style="width: 38.9479px;">Volt 3 (V)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Curr 1 (Amps): activate to sort column ascending" style="width: 62.6562px;">Curr 1 (Amps)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Curr 2 (Amps): activate to sort column ascending" style="width: 62.6562px;">Curr 2 (Amps)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Curr 3 (Amps): activate to sort column ascending" style="width: 62.6562px;">Curr 3 (Amps)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Report Time: activate to sort column ascending" style="width: 66.6146px;">Report Time</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Type: activate to sort column ascending" style="width: 37.4896px;">Type</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 39.125px;">Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Resolve Time: activate to sort column ascending" style="width: 69.6979px;">Resolve Time</th></tr>
</thead>
<tbody>


<tr role="row" class="odd">
<td class="sorting_1">5439</td>
<td>1G1PU01</td>
<td>Sector D4 TW#06</td>

<td>233.53</td>
<td>203.37</td>
<td>240.27</td>
<td>13.44</td>
<td>12.18</td>
<td>12.46</td>
<td>2022-07-18 10:12:07</td>
<td>Under Load</td>
<td>Resolved</td>
<td>2022-07-18 10:15:02</td>

</tr><tr role="row" class="even">
<td class="sorting_1">5438</td>
<td>1G1PU03</td>
<td>Sector D2 new TW</td>

<td>239.62</td>
<td>240.03</td>
<td>240.66</td>
<td>94.32</td>
<td>102.69</td>
<td>116.41</td>
<td>2022-07-18 09:02:43</td>
<td>Over Load</td>
<td>Pending</td>
<td></td>

</tr><tr role="row" class="odd">
<td class="sorting_1">5437</td>
<td>1G1PU03</td>
<td>Sector D2 new TW</td>

<td>238.25</td>
<td>238.62</td>
<td>238.68</td>
<td>94.63</td>
<td>103.47</td>
<td>116.77</td>
<td>2022-07-18 09:01:42</td>
<td>Over Load</td>
<td>Pending</td>
<td></td>

</tr><tr role="row" class="even">
<td class="sorting_1">5436</td>
<td>1G1PU03</td>
<td>Sector D2 new TW</td>

<td>236.43</td>
<td>236.99</td>
<td>236.99</td>
<td>93.36</td>
<td>102.34</td>
<td>115.71</td>
<td>2022-07-18 09:00:41</td>
<td>Over Load</td>
<td>Pending</td>
<td></td>

</tr><tr role="row" class="odd">
<td class="sorting_1">5435</td>
<td>1G1PU03</td>
<td>Sector D2 new TW</td>

<td>236.73</td>
<td>237.44</td>
<td>238.2</td>
<td>95.2</td>
<td>103.39</td>
<td>117.81</td>
<td>2022-07-18 05:53:51</td>
<td>Over Load</td>
<td>Resolved</td>
<td>2022-07-18 09:00:02</td>

</tr><tr role="row" class="even">
<td class="sorting_1">5434</td>
<td>1G1PU09</td>
<td>Sector D5 shomali market</td>

<td>240.07</td>
<td>237.03</td>
<td>206.92</td>
<td>17.14</td>
<td>16.73</td>
<td>16.65</td>
<td>2022-07-18 05:49:59</td>
<td>Under Load</td>
<td>Resolved</td>
<td>2022-07-18 05:54:01</td>

</tr><tr role="row" class="odd">
<td class="sorting_1">5433</td>
<td>1G1PU03</td>
<td>Sector D2 new TW</td>

<td>233.66</td>
<td>234.62</td>
<td>235.66</td>
<td>95.61</td>
<td>103.76</td>
<td>118.72</td>
<td>2022-07-18 05:10:57</td>
<td>Over Load</td>
<td>Resolved</td>
<td>2022-07-18 05:51:01</td>

</tr><tr role="row" class="even">
<td class="sorting_1">5432</td>
<td>1G1PU03</td>
<td>Sector D2 new TW</td>

<td>239.05</td>
<td>239.69</td>
<td>239.94</td>
<td>93.94</td>
<td>102.33</td>
<td>115.89</td>
<td>2022-07-17 18:47:40</td>
<td>Over Load</td>
<td>Resolved</td>
<td>2022-07-17 21:21:01</td>

</tr><tr role="row" class="odd">
<td class="sorting_1">5431</td>
<td>1G1PU03</td>
<td>Sector D2 new TW</td>

<td>238.55</td>
<td>239.25</td>
<td>238.97</td>
<td>93.24</td>
<td>101.83</td>
<td>114.92</td>
<td>2022-07-17 18:46:39</td>
<td>Over Load</td>
<td>Resolved</td>
<td>2022-07-17 21:21:01</td>

</tr><tr role="row" class="even">
<td class="sorting_1">5430</td>
<td>1G1PU03</td>
<td>Sector D2 new TW</td>

<td>235.73</td>
<td>236.11</td>
<td>236.9</td>
<td>92.92</td>
<td>101.26</td>
<td>115.36</td>
<td>2022-07-17 16:56:44</td>
<td>Over Load</td>
<td>Resolved</td>
<td>2022-07-17 18:48:01</td>

</tr></tbody>
</table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 1,000 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button disabled" id="example1_ellipsis"><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">…</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">100</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="8" tabindex="0">Next</a></li></ul></div></div></div></div>

</div>
<br>
<button onclick="exportTableToCSV('Faults.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>


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
