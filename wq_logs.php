<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Water Quality Logs"?>
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
                  <input type="text" list="pumps" name="transformer" placeholder="Select WQ Device" required="required" class="form-control">
                  <datalist id="pumps">
                    <option value="1G1WQ01">Arif Yousaf Hujra - Arif Yousaf Hujra</option>
                        <option value="1G1WQ02">Idressabad - Idressabad</option>
                        <option value="1G1WQ03">BHU Gulbarg  no. 2 - BHU Gulbarg  no. 2</option>
                        <option value="1G1WQ04">Bahadar School - Bahadar School</option>
                        <option value="1G1WQ05">BHU Notiya - BHU Notiya</option>
                        <option value="1G1WQ06">Gulbahar No. 2 Javid Town - Gulbahar No. 2 Javid Town</option>
                        
                  </datalist>
                </div>
                <div class="col-md-1">
                 <b> From Date and Time</b>
                </div>
                <div class="col-md-2">
                  <input type="date" id="fromdate" name="fromdate" required="" class="form-control" placeholder="Logs From">
                </div>
                <div class="col-md-2">
                  <input type="time" id="fromtime" name="fromtime" class="form-control" placeholder="Logs From">
                  
                </div>
                <div class="col-md-1">
                  <b>To Date and Time</b>
                </div>
                <div class="col-md-2">
                  <input type="date" id="todate" name="todate" required="" class="form-control" placeholder="Logs From">
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
              <tr role="row"><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="WQID: activate to sort column ascending" style="width: 34.6875px;">WQID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="WQ Name: activate to sort column ascending" style="width: 35.9479px;">WQ Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="WQ Location: activate to sort column ascending" style="width: 53.3542px;">WQ Location</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="SCADA ID: activate to sort column ascending" style="width: 40.7292px;">SCADA ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="TW Name: activate to sort column ascending" style="width: 35.9479px;">TW Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="TW Location: activate to sort column ascending" style="width: 53.3542px;">TW Location</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="TWID: activate to sort column ascending" style="width: 32.2708px;">TWID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="ZONE: activate to sort column ascending" style="width: 33.8542px;">ZONE</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="UC: activate to sort column ascending" style="width: 17.4583px;">UC</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="NC: activate to sort column ascending" style="width: 17.4583px;">NC</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Temperature (oC): activate to sort column ascending" style="width: 79.5521px;">Temperature (<sup>o</sup>C)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="pH: activate to sort column ascending" style="width: 17.4583px;">pH</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Electrical Conductivity (us/cm): activate to sort column ascending" style="width: 79.375px;">Electrical Conductivity (us/cm)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Dispolved Oxygen (mg/L): activate to sort column ascending" style="width: 61.2396px;">Dispolved Oxygen (mg/L)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="TSS (mg/L): activate to sort column ascending" style="width: 41.5px;">TSS (mg/L)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Turbidity (NTU): activate to sort column ascending" style="width: 57.1562px;">Turbidity (NTU)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="TDS (mg/L): activate to sort column ascending" style="width: 41.5px;">TDS (mg/L)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Resistivity (ohm.cm): activate to sort column ascending" style="width: 64.75px;">Resistivity (ohm.cm)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Salinity (mg/L): activate to sort column ascending" style="width: 47.5625px;">Salinity (mg/L)</th><th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="descending" aria-label="Date Time: activate to sort column ascending" style="width: 30.9062px;">Date Time</th></tr>
              </thead>
              <tbody>
                         <tr role="row" class="odd">
              <td>1G1WQ02</td>
            <td>Water Quality 02</td>
            <td>Idressabad</td>
            <td>1G1PU37</td>
            <td>Idress Abad</td>
            <td>Javed Town Umer Street Gulbahar No.3</td>

            <td>B-09-87</td>
            <td>B</td>
            <td>9</td>
            <td>22</td>
            <td>31</td>
            <td>6.7</td>
            <td>665.8</td>
            <td>4.3</td>
            <td>0</td>
            <td>0.2</td>
            <td>432.7</td>
            <td>1490.7</td>
            <td>368.9</td>
            <td class="sorting_1">2022-08-22 21:18:10</td>
            
            </tr><tr role="row" class="even">
              <td>1G1WQ02</td>
            <td>Water Quality 02</td>
            <td>Idressabad</td>
            <td>1G1PU37</td>
            <td>Idress Abad</td>
            <td>Javed Town Umer Street Gulbahar No.3</td>

            <td>B-09-87</td>
            <td>B</td>
            <td>9</td>
            <td>22</td>
            <td>31.3</td>
            <td>6.7</td>
            <td>663.9</td>
            <td>4.1</td>
            <td>0</td>
            <td>0.2</td>
            <td>431.2</td>
            <td>1495.5</td>
            <td>368.1</td>
            <td class="sorting_1">2022-08-22 21:18:10</td>
            
            </tr><tr role="row" class="odd">
              <td>1G1WQ02</td>
            <td>Water Quality 02</td>
            <td>Idressabad</td>
            <td>1G1PU37</td>
            <td>Idress Abad</td>
            <td>Javed Town Umer Street Gulbahar No.3</td>

            <td>B-09-87</td>
            <td>B</td>
            <td>9</td>
            <td>22</td>
            <td>30.7</td>
            <td>6.7</td>
            <td>667.4</td>
            <td>4.7</td>
            <td>0</td>
            <td>0.2</td>
            <td>433.8</td>
            <td>1486.9</td>
            <td>369.8</td>
            <td class="sorting_1">2022-08-22 20:59:16</td>
            
            </tr><tr role="row" class="even">
              <td>1G1WQ02</td>
            <td>Water Quality 02</td>
            <td>Idressabad</td>
            <td>1G1PU37</td>
            <td>Idress Abad</td>
            <td>Javed Town Umer Street Gulbahar No.3</td>

            <td>B-09-87</td>
            <td>B</td>
            <td>9</td>
            <td>22</td>
            <td>30.2</td>
            <td>6.6</td>
            <td>669.2</td>
            <td>5.4</td>
            <td>0</td>
            <td>0.6</td>
            <td>434.9</td>
            <td>1482.8</td>
            <td>370.8</td>
            <td class="sorting_1">2022-08-22 19:59:19</td>
            
            </tr><tr role="row" class="odd">
              <td>1G1WQ02</td>
            <td>Water Quality 02</td>
            <td>Idressabad</td>
            <td>1G1PU37</td>
            <td>Idress Abad</td>
            <td>Javed Town Umer Street Gulbahar No.3</td>

            <td>B-09-87</td>
            <td>B</td>
            <td>9</td>
            <td>22</td>
            <td>29.5</td>
            <td>6.6</td>
            <td>672.5</td>
            <td>6.2</td>
            <td>0</td>
            <td>0.8</td>
            <td>437</td>
            <td>1475.6</td>
            <td>372.7</td>
            <td class="sorting_1">2022-08-22 18:59:45</td>
            
            </tr><tr role="row" class="even">
              <td>1G1WQ02</td>
            <td>Water Quality 02</td>
            <td>Idressabad</td>
            <td>1G1PU37</td>
            <td>Idress Abad</td>
            <td>Javed Town Umer Street Gulbahar No.3</td>

            <td>B-09-87</td>
            <td>B</td>
            <td>9</td>
            <td>22</td>
            <td>30.1</td>
            <td>6.7</td>
            <td>664.2</td>
            <td>6.4</td>
            <td>0</td>
            <td>0.2</td>
            <td>431.7</td>
            <td>1494.7</td>
            <td>368.1</td>
            <td class="sorting_1">2022-08-22 17:58:51</td>
            
            </tr><tr role="row" class="odd">
              <td>1G1WQ02</td>
            <td>Water Quality 02</td>
            <td>Idressabad</td>
            <td>1G1PU37</td>
            <td>Idress Abad</td>
            <td>Javed Town Umer Street Gulbahar No.3</td>

            <td>B-09-87</td>
            <td>B</td>
            <td>9</td>
            <td>22</td>
            <td>31.1</td>
            <td>6.8</td>
            <td>652.5</td>
            <td>6.2</td>
            <td>0</td>
            <td>0.2</td>
            <td>424</td>
            <td>1520.9</td>
            <td>361.6</td>
            <td class="sorting_1">2022-08-22 16:28:54</td>
            
            </tr><tr role="row" class="even">
              <td>1G1WQ02</td>
            <td>Water Quality 02</td>
            <td>Idressabad</td>
            <td>1G1PU37</td>
            <td>Idress Abad</td>
            <td>Javed Town Umer Street Gulbahar No.3</td>

            <td>B-09-87</td>
            <td>B</td>
            <td>9</td>
            <td>22</td>
            <td>30.6</td>
            <td>6.7</td>
            <td>655.6</td>
            <td>6.6</td>
            <td>0</td>
            <td>1.1</td>
            <td>426</td>
            <td>1513.7</td>
            <td>363.3</td>
            <td class="sorting_1">2022-08-22 15:59:09</td>
            
            </tr><tr role="row" class="odd">
              <td>1G1WQ02</td>
            <td>Water Quality 02</td>
            <td>Idressabad</td>
            <td>1G1PU37</td>
            <td>Idress Abad</td>
            <td>Javed Town Umer Street Gulbahar No.3</td>

            <td>B-09-87</td>
            <td>B</td>
            <td>9</td>
            <td>22</td>
            <td>30.2</td>
            <td>6.7</td>
            <td>656.6</td>
            <td>6.9</td>
            <td>0</td>
            <td>1.4</td>
            <td>426.8</td>
            <td>1511.2</td>
            <td>364</td>
            <td class="sorting_1">2022-08-22 14:58:13</td>
            
            </tr><tr role="row" class="even">
              <td>1G1WQ02</td>
            <td>Water Quality 02</td>
            <td>Idressabad</td>
            <td>1G1PU37</td>
            <td>Idress Abad</td>
            <td>Javed Town Umer Street Gulbahar No.3</td>

            <td>B-09-87</td>
            <td>B</td>
            <td>9</td>
            <td>22</td>
            <td>29.9</td>
            <td>6.7</td>
            <td>655.1</td>
            <td>7.1</td>
            <td>0</td>
            <td>0.2</td>
            <td>425.9</td>
            <td>1514.5</td>
            <td>363.3</td>
            <td class="sorting_1">2022-08-22 13:59:30</td>
            
            </tr></tbody>
  
            </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 17 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">Next</a></li></ul></div></div></div></div>
          </div>
          <br>
          <button onclick="exportTableToCSV('wq_logs.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>
            
                

 

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
