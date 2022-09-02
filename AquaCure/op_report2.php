<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Tube Well Operational Report"?>
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
    <section class="content-header">
                
               
             <form method="post">
              <div class="">
                <div class="col col-md-2"><b>Select Zone</b></div>
                <div class="col col-md-2"><b>Select Tube Well</b></div>
                <div class="col col-md-4"><b>From Date &amp; Time</b></div>
                <div class="col col-md-4"><b>To Date &amp; Time</b></div>

              </div>
              <div class="row">
               <div class="col-md-2">
                
                  <select id="zone" onchange="showZone(this.value)" class="form-control">
                    <option value="">---SELECT---</option>
                    <option>B</option>
                    <option>C</option>
                  </select>
                 
                </div>
                <div class="col-md-2">
                
                  <input type="text" list="pump" name="transformer" placeholder="Select Tube Well" required="required" class="form-control">
                  <datalist id="pump">
                  </datalist>
                </div>
                
                <div class="col-md-2">
                  <input type="date" id="fromdate" name="fromdate" required="" class="form-control" placeholder="Logs From">
                </div>
                <div class="col-md-2">
                  <input type="time" id="fromtime" name="fromtime" class="form-control" placeholder="Logs From">
                  
                </div>
                
                <div class="col-md-2">
                  <input type="date" id="todate" name="todate" required="" class="form-control" placeholder="Logs From">
                </div>
                <div class="col-md-2">
                  <input type="time" id="totime" name="totime" class="form-control" placeholder="Logs From">
                  
                </div>
              </div>
              <br>
              <div class="pull-right">
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
            <br><br>


    
                        <div id="overflow" style="overflow-x:auto;">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="-1">All</option></select> entries</label></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-responsive table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
              <thead class="bg-blue">
              <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Date: activate to sort column descending" style="width: 28.3854px;">Date</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Scada ID: activate to sort column ascending" style="width: 36.9688px;">Scada ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="TW ID: activate to sort column ascending" style="width: 19.1667px;">TW ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 35.9479px;">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="ZONE: activate to sort column ascending" style="width: 33.8542px;">ZONE</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="UC: activate to sort column ascending" style="width: 17.4583px;">UC</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="NC: activate to sort column ascending" style="width: 17.4583px;">NC</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending" style="width: 53.3542px;">Location</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Pumping Machinary (HP): activate to sort column ascending" style="width: 64.8021px;">Pumping Machinary (HP)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="SCADA Installation Date: activate to sort column ascending" style="width: 70.75px;">SCADA Installation Date</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Electromagnetic Flowmeter Installed (Y/N): activate to sort column ascending" style="width: 101.635px;">Electromagnetic Flowmeter Installed (Y/N)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Water Quality Device Installed (Y/N): activate to sort column ascending" style="width: 53.8958px;">Water Quality Device Installed (Y/N)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Total Units Consumed (KWH): activate to sort column ascending" style="width: 65.3542px;">Total Units Consumed (KWH)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Total Tube Well On Time (min): activate to sort column ascending" style="width: 33.5104px;">Total Tube Well On Time (min)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Total Tube Well Off Time (Hours): activate to sort column ascending" style="width: 46.4583px;">Total Tube Well Off Time (Hours)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="On/Off Events: activate to sort column ascending" style="width: 41.4271px;">On/Off Events</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Total Water Supplied (m3): activate to sort column ascending" style="width: 54.9271px;">Total Water Supplied (m<sup>3</sup>)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Water Sample Tests: activate to sort column ascending" style="width: 46.4479px;">Water Sample Tests</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Signal Strength: activate to sort column ascending" style="width: 54.2812px;">Signal Strength</th></tr>
              </thead>
              <tbody>                

              <tr role="row" class="odd">
                      <td class="sorting_1">2022-08-09</td>
                      <td>1G1PU02</td> 
                      <td>C-34-24</td>
                      <td>Gulberg1 service station</td>
                      <td>C</td>
                      <td>34</td>
                      <td>97</td>  
                      <td>Gulberg Main Peshawar</td>
                      <td>20</td>
                      <td>Sep-20
</td>
                      <td>No</td>
                      <td>No</td>
                      <td>0</td>
                      <td>0</td>
                      <td>0</td>
                      <td>1</td>
                      <td>0</td>
                      <td>0</td>
                      <td>26%</td>


                      
                    </tr><tr role="row" class="even">
                      <td class="sorting_1">2022-08-10</td>
                      <td>1G1PU02</td> 
                      <td>C-34-24</td>
                      <td>Gulberg1 service station</td>
                      <td>C</td>
                      <td>34</td>
                      <td>97</td>  
                      <td>Gulberg Main Peshawar</td>
                      <td>20</td>
                      <td>Sep-20
</td>
                      <td>No</td>
                      <td>No</td>
                      <td>131.11</td>
                      <td>486</td>
                      <td>8.1</td>
                      <td>5</td>
                      <td>510.46</td>
                      <td>0</td>
                      <td>100%</td>


                      
                    </tr><tr role="row" class="odd">
                      <td class="sorting_1">2022-08-11</td>
                      <td>1G1PU02</td> 
                      <td>C-34-24</td>
                      <td>Gulberg1 service station</td>
                      <td>C</td>
                      <td>34</td>
                      <td>97</td>  
                      <td>Gulberg Main Peshawar</td>
                      <td>20</td>
                      <td>Sep-20
</td>
                      <td>No</td>
                      <td>No</td>
                      <td>132.66</td>
                      <td>451</td>
                      <td>7.52</td>
                      <td>5</td>
                      <td>473.7</td>
                      <td>0</td>
                      <td>97%</td>


                      
                    </tr><tr role="row" class="even">
                      <td class="sorting_1">2022-08-12</td>
                      <td>1G1PU02</td> 
                      <td>C-34-24</td>
                      <td>Gulberg1 service station</td>
                      <td>C</td>
                      <td>34</td>
                      <td>97</td>  
                      <td>Gulberg Main Peshawar</td>
                      <td>20</td>
                      <td>Sep-20
</td>
                      <td>No</td>
                      <td>No</td>
                      <td>148.76</td>
                      <td>490</td>
                      <td>8.17</td>
                      <td>4</td>
                      <td>514.66</td>
                      <td>0</td>
                      <td>98%</td>


                      
                    </tr><tr role="row" class="odd">
                      <td class="sorting_1">2022-08-13</td>
                      <td>1G1PU02</td> 
                      <td>C-34-24</td>
                      <td>Gulberg1 service station</td>
                      <td>C</td>
                      <td>34</td>
                      <td>97</td>  
                      <td>Gulberg Main Peshawar</td>
                      <td>20</td>
                      <td>Sep-20
</td>
                      <td>No</td>
                      <td>No</td>
                      <td>132.38</td>
                      <td>479</td>
                      <td>7.98</td>
                      <td>5</td>
                      <td>503.11</td>
                      <td>0</td>
                      <td>95%</td>


                      
                    </tr><tr role="row" class="even">
                      <td class="sorting_1">2022-08-14</td>
                      <td>1G1PU02</td> 
                      <td>C-34-24</td>
                      <td>Gulberg1 service station</td>
                      <td>C</td>
                      <td>34</td>
                      <td>97</td>  
                      <td>Gulberg Main Peshawar</td>
                      <td>20</td>
                      <td>Sep-20
</td>
                      <td>No</td>
                      <td>No</td>
                      <td>118.82</td>
                      <td>481</td>
                      <td>8.02</td>
                      <td>4</td>
                      <td>505.21</td>
                      <td>0</td>
                      <td>97%</td>


                      
                    </tr><tr role="row" class="odd">
                      <td class="sorting_1">2022-08-15</td>
                      <td>1G1PU02</td> 
                      <td>C-34-24</td>
                      <td>Gulberg1 service station</td>
                      <td>C</td>
                      <td>34</td>
                      <td>97</td>  
                      <td>Gulberg Main Peshawar</td>
                      <td>20</td>
                      <td>Sep-20
</td>
                      <td>No</td>
                      <td>No</td>
                      <td>112.73</td>
                      <td>452</td>
                      <td>7.53</td>
                      <td>5</td>
                      <td>474.75</td>
                      <td>0</td>
                      <td>95%</td>


                      
                    </tr><tr role="row" class="even">
                      <td class="sorting_1">2022-08-16</td>
                      <td>1G1PU02</td> 
                      <td>C-34-24</td>
                      <td>Gulberg1 service station</td>
                      <td>C</td>
                      <td>34</td>
                      <td>97</td>  
                      <td>Gulberg Main Peshawar</td>
                      <td>20</td>
                      <td>Sep-20
</td>
                      <td>No</td>
                      <td>No</td>
                      <td>117.05</td>
                      <td>480</td>
                      <td>8</td>
                      <td>3</td>
                      <td>504.16</td>
                      <td>0</td>
                      <td>38%</td>


                      
                    </tr><tr role="row" class="odd">
                      <td class="sorting_1">2022-08-17</td>
                      <td>1G1PU02</td> 
                      <td>C-34-24</td>
                      <td>Gulberg1 service station</td>
                      <td>C</td>
                      <td>34</td>
                      <td>97</td>  
                      <td>Gulberg Main Peshawar</td>
                      <td>20</td>
                      <td>Sep-20
</td>
                      <td>No</td>
                      <td>No</td>
                      <td>66.88</td>
                      <td>274</td>
                      <td>4.57</td>
                      <td>3</td>
                      <td>287.79</td>
                      <td>0</td>
                      <td>75%</td>


                      
                    </tr><tr role="row" class="even">
                      <td class="sorting_1">2022-08-18</td>
                      <td>1G1PU02</td> 
                      <td>C-34-24</td>
                      <td>Gulberg1 service station</td>
                      <td>C</td>
                      <td>34</td>
                      <td>97</td>  
                      <td>Gulberg Main Peshawar</td>
                      <td>20</td>
                      <td>Sep-20
</td>
                      <td>No</td>
                      <td>No</td>
                      <td>119.86</td>
                      <td>492</td>
                      <td>8.2</td>
                      <td>4</td>
                      <td>516.76</td>
                      <td>0</td>
                      <td>90%</td>


                      
                    </tr></tbody>

            </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 16 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">Next</a></li></ul></div></div></div></div>
          </div>

          <button onclick="exportTableToCSV('Operational_Report.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>
            




<!-- /////////////////////////////////////////////////////////////////////////////////////////// -->

    

 

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
