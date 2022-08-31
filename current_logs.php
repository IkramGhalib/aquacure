<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Current Logs"?>
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
    <tr role="row"><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Pump ID: activate to sort column ascending" style="width: 41.1875px;">Pump ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 70.8229px;">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Volt 1 (V): activate to sort column ascending" style="width: 33.9583px;">Volt 1 (V)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Volt 2 (V): activate to sort column ascending" style="width: 33.9583px;">Volt 2 (V)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Volt 3 (V): activate to sort column ascending" style="width: 33.9583px;">Volt 3 (V)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Current 1 (Amps): activate to sort column ascending" style="width: 64.9688px;">Current 1 (Amps)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Current 2 (Amps): activate to sort column ascending" style="width: 64.9688px;">Current 2 (Amps)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Current 3 (Amps): activate to sort column ascending" style="width: 64.9688px;">Current 3 (Amps)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="KVA 1: activate to sort column ascending" style="width: 27.0208px;">KVA 1</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="KVA 2: activate to sort column ascending" style="width: 27.0208px;">KVA 2</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="KVA 3: activate to sort column ascending" style="width: 27.0208px;">KVA 3</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="PF1: activate to sort column ascending" style="width: 23.0729px;">PF1</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="PF2: activate to sort column ascending" style="width: 23.0729px;">PF2</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="PF3: activate to sort column ascending" style="width: 23.0729px;">PF3</th><th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="descending" aria-label="Date Time: activate to sort column ascending" style="width: 50.2604px;">Date Time</th></tr>
    </thead>
    <tbody>
    
    <tr role="row" class="odd">
      <td>1G1PU13</td>
    <td>P2 Tatara Park</td>
    <td>241</td>
    <td>239</td>
    <td>240</td>
    <td>86.1</td>
    <td>99.6</td>
    <td>97.18</td>
    <td>20.75</td>
    <td>23.8</td>
    <td>23.32</td>
    <td>0.2</td>
    <td>0.2</td>
    <td>0.96</td>
    <td class="sorting_1">2022-07-18 11:07:53</td>
    
    </tr><tr role="row" class="even">
      <td>1G1PU08</td>
    <td>Sector D2 park  TW </td>
    <td>239</td>
    <td>238</td>
    <td>240</td>
    <td>40.82</td>
    <td>41.37</td>
    <td>38.81</td>
    <td>9.76</td>
    <td>9.85</td>
    <td>9.31</td>
    <td>0.67</td>
    <td>0.2</td>
    <td>0.36</td>
    <td class="sorting_1">2022-07-18 11:07:39</td>
    
    </tr><tr role="row" class="odd">
      <td>1G1PU02</td>
    <td>Sector D4 TW#08</td>
    <td>227</td>
    <td>200</td>
    <td>210</td>
    <td>59.63</td>
    <td>59.4</td>
    <td>55.21</td>
    <td>13.54</td>
    <td>11.88</td>
    <td>11.59</td>
    <td>0.2</td>
    <td>0.2</td>
    <td>0.2</td>
    <td class="sorting_1">2022-07-18 11:07:29</td>
    
    </tr><tr role="row" class="even">
      <td>1G1PU06</td>
    <td>Sector E3 nisar TW</td>
    <td>243</td>
    <td>242</td>
    <td>240</td>
    <td>67.42</td>
    <td>62.81</td>
    <td>70.34</td>
    <td>16.38</td>
    <td>15.2</td>
    <td>16.88</td>
    <td>0.69</td>
    <td>0.65</td>
    <td>0.65</td>
    <td class="sorting_1">2022-07-18 11:07:19</td>
    
    </tr><tr role="row" class="odd">
      <td>1G1PU07</td>
    <td>Sector E1 donga gali new TW</td>
    <td>217</td>
    <td>222</td>
    <td>235</td>
    <td>68.39</td>
    <td>66.8</td>
    <td>61.69</td>
    <td>14.84</td>
    <td>14.83</td>
    <td>14.5</td>
    <td>0.74</td>
    <td>0.78</td>
    <td>0.79</td>
    <td class="sorting_1">2022-07-18 11:07:18</td>
    
    </tr><tr role="row" class="even">
      <td>1G1PU12</td>
    <td>C-03 afghan market</td>
    <td>237</td>
    <td>226</td>
    <td>227</td>
    <td>106.58</td>
    <td>93.13</td>
    <td>102.25</td>
    <td>25.26</td>
    <td>21.05</td>
    <td>23.21</td>
    <td>0.8</td>
    <td>0.74</td>
    <td>0.85</td>
    <td class="sorting_1">2022-07-18 11:07:15</td>
    
    </tr><tr role="row" class="odd">
      <td>1G1PU04</td>
    <td>sector D5 site office road park</td>
    <td>239</td>
    <td>240</td>
    <td>239</td>
    <td>63.53</td>
    <td>63.91</td>
    <td>65.66</td>
    <td>15.18</td>
    <td>15.34</td>
    <td>15.69</td>
    <td>0.74</td>
    <td>0.2</td>
    <td>0.27</td>
    <td class="sorting_1">2022-07-18 11:07:12</td>
    
    </tr><tr role="row" class="even">
      <td>1G1PU03</td>
    <td>Sector D2 new TW</td>
    <td>238</td>
    <td>239</td>
    <td>239</td>
    <td>92.38</td>
    <td>101.4</td>
    <td>114.59</td>
    <td>21.99</td>
    <td>24.23</td>
    <td>27.39</td>
    <td>0.87</td>
    <td>0.7</td>
    <td>0.8</td>
    <td class="sorting_1">2022-07-18 11:07:07</td>
    
    </tr><tr role="row" class="odd">
      <td>1G1PU05</td>
    <td>Sector E2 Tw#3 </td>
    <td>209</td>
    <td>189</td>
    <td>197</td>
    <td>87.79</td>
    <td>101.3</td>
    <td>102.19</td>
    <td>18.35</td>
    <td>19.15</td>
    <td>20.13</td>
    <td>0.75</td>
    <td>0.72</td>
    <td>0.75</td>
    <td class="sorting_1">2022-07-18 11:06:58</td>
    
    </tr><tr role="row" class="even">
      <td>1G1PU13</td>
    <td>P2 Tatara Park</td>
    <td>241</td>
    <td>239</td>
    <td>240</td>
    <td>86.26</td>
    <td>100.09</td>
    <td>97.6</td>
    <td>20.79</td>
    <td>23.92</td>
    <td>23.42</td>
    <td>0.2</td>
    <td>0.2</td>
    <td>0.82</td>
    <td class="sorting_1">2022-07-18 11:06:51</td>
    
    </tr></tbody>
  
    </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 4,000 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button disabled" id="example1_ellipsis"><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">…</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">400</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="8" tabindex="0">Next</a></li></ul></div></div></div></div>
  </div>
<br>
  <button onclick="exportTableToCSV('Current_logs.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>
 

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
<script>
  $(function () {
    // $("#example1").DataTable({
      
      // "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // $('#example2').DataTable({
      // paging: true
      // "paging": true,
      // "lengthChange": false,
      // "searching": false,
      // "ordering": true,
      // "info": true,
      // "autoWidth": false,
      // "responsive": true,
    });
  });
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/datatables.min.js">
  $('#example1').DataTable( {
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // paging: false
} );
</script>
