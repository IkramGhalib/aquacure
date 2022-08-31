<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Consumption Logs"?>
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
                  <input type="date" id="todate" name="todate" class="form-control" placeholder="Logs From">
                </div>
                <div class="col-md-2">
                  <input type="time" id="totime" name="totime" class="form-control" placeholder="Logs From">
                  
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
        <tr role="row"><th scope="col" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Pump ID: activate to sort column ascending" style="width: 79.0104px;">Pump ID</th><th scope="col" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 205.354px;">Name</th><th scope="col" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Unit (Peak Time): activate to sort column ascending" style="width: 144.531px;">Unit (Peak Time)</th><th scope="col" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Unit (Off Peak Time): activate to sort column ascending" style="width: 172.438px;">Unit (Off Peak Time)</th><th scope="col" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Total: activate to sort column ascending" style="width: 51.0208px;">Total</th><th scope="col" class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="descending" aria-label="Date &amp;amp; Time: activate to sort column ascending" style="width: 132.646px;">Date &amp; Time</th></tr>
        </thead>
        <tbody bgcolor="#FFFFFF">
          
        <tr role="row" class="odd">
          <td>1G1PU13</td>
          <td>P2 Tatara Park</td>
          <td>1003.97</td>
          <td>3742.37</td>
          <td>4746.34</td>
          <td class="sorting_1">2022-07-18 11:11:57</td>
        </tr><tr role="row" class="even">
          <td>1G1PU07</td>
          <td>Sector E1 donga gali new TW</td>
          <td>173.87</td>
          <td>232</td>
          <td>405.87</td>
          <td class="sorting_1">2022-07-18 11:11:45</td>
        </tr><tr role="row" class="odd">
          <td>1G1PU12</td>
          <td>C-03 afghan market</td>
          <td>653.99</td>
          <td>2352</td>
          <td>3005.99</td>
          <td class="sorting_1">2022-07-18 11:11:21</td>
        </tr><tr role="row" class="even">
          <td>1G1PU04</td>
          <td>sector D5 site office road park</td>
          <td>769.48</td>
          <td>3056.57</td>
          <td>3826.05</td>
          <td class="sorting_1">2022-07-18 11:11:16</td>
        </tr><tr role="row" class="odd">
          <td>1G1PU02</td>
          <td>Sector D4 TW#08</td>
          <td>2075.5</td>
          <td>7030.61</td>
          <td>9106.11</td>
          <td class="sorting_1">2022-07-18 11:11:11</td>
        </tr><tr role="row" class="even">
          <td>1G1PU03</td>
          <td>Sector D2 new TW</td>
          <td>1366.76</td>
          <td>4590.36</td>
          <td>5957.12</td>
          <td class="sorting_1">2022-07-18 11:11:09</td>
        </tr><tr role="row" class="odd">
          <td>1G1PU13</td>
          <td>P2 Tatara Park</td>
          <td>1003.97</td>
          <td>3742.38</td>
          <td>4746.35</td>
          <td class="sorting_1">2022-07-18 11:10:56</td>
        </tr><tr role="row" class="even">
          <td>1G1PU05</td>
          <td>Sector E2 Tw#3 </td>
          <td>4204.55</td>
          <td>13792.17</td>
          <td>17996.72</td>
          <td class="sorting_1">2022-07-18 11:10:46</td>
        </tr><tr role="row" class="odd">
          <td>1G1PU09</td>
          <td>Sector D5 shomali market</td>
          <td>2717.44</td>
          <td>7410.54</td>
          <td>10127.98</td>
          <td class="sorting_1">2022-07-18 11:10:46</td>
        </tr><tr role="row" class="even">
          <td>1G1PU07</td>
          <td>Sector E1 donga gali new TW</td>
          <td>173.87</td>
          <td>232.22</td>
          <td>406.09</td>
          <td class="sorting_1">2022-07-18 11:10:45</td>
        </tr></tbody>
      </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 2,000 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button disabled" id="example1_ellipsis"><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">…</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">200</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="8" tabindex="0">Next</a></li></ul></div></div></div></div>
      </div>

      <br>
  <button onclick="exportTableToCSV('Consumption_logs.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>

      
      
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
