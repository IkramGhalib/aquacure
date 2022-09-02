<?php
  include_once('check.php');
  authenticate("can_view");
?>

<!DOCTYPE html>
<html>
<head>


  <?php $pageName = "Connection Current Logs"?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--title><?php echo $pageName;?></title-->
  
 <?php include_once('head.php') ?> 

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue sidebar-mini" >
<!-- Site wrapper -->
<div class="wrapper" style="overflow: hidden;">
	
	
	<!-- Navbar -->
	<?php include_once('navbar.php') ?>
	<!-- Sidebar -->
<!-- Left side column. contains the logo and sidebar -->
   <aside class="main-sidebar" style="margin-top: <?php echo $sidebarmargin;?>px;">
        <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="overflow-x: scroll;">
          <!-- sidebar menu: : style can be found in sidebar.less -->
         
      <ul class="sidebar-menu">
            
        <li class="header">Select Specific Distribution Boxes</li>
        <br>
          <?php
          require_once("opendb.php");
          $query = "select cid, name from connections";
          $result = $conn -> query($query) or die("Query error");

      if (!$detect->isMobile() and !$detect->isTablet()) {

        ?>
          <form method="post"> 
           <br>

          <select class="form-control" name="interval">
            <option value="5" <?php echo (isset($_POST['interval']) and $_POST['interval'] == 5) ? "selected" : ""; ?> >5 Minutes Interval</option>
            <option value="15" <?php echo (isset($_POST['interval']) and $_POST['interval'] == 15) ? "selected" : ""; ?> >15 Minutes Interval</option>
            <option value="30" <?php echo (isset($_POST['interval']) and $_POST['interval'] == 30) ? "selected" : ""; ?> >30 Minutes Interval</option>
          </select>
          
          <br>         
            <input type="text" list="connect" name="connection" class="form-control" placeholder="Select Conection">
            <datalist id="connect">
            <?php
            foreach ($result as $row) {
              ?>
              <option value="<?php echo $row['cid']; ?>"><?php echo $row['name']?></option>
              <?php
            }
            ?>
            </datalist>
            
          <br>
        
        
          <div style="color: #FFFFFF"><b>From Date & Time:</b></div>
          <input type="date" id="fromdate" name="fromdate" class="form-control" placeholder="Logs From">
          <input type="time" id="fromtime" name="fromtime" class="form-control" placeholder="Logs From">

          
          <div style="color: #FFFFFF"><b>To Date & Time:</b></div>
          <input type="date" id="todate" name="todate" class="form-control" placeholder="Logs to">
          <input type="time" id="totime" name="totime" class="form-control" placeholder="Logs to">

          <br>
          <button style="float: right; margin-right:5px; " class="btn-primary btn" name="submit"> submit </button>
        </form>
      <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
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

    <section class="content" id="sec">
      <?php
      if ($detect->isMobile() or $detect->isTablet()) {

        ?>
          <div class="box box-default box-solid collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Select Specific Connection</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">

            <form method="post">
          <input type="text" list="connect" name="connection" class="form-control">
            <datalist id="connect">
            <?php
            foreach ($result as $row) {
              ?>
              <option value="<?php echo $row['cid']; ?>"><?php echo $row['name']?></option>
              <?php
            }
            ?>
            </datalist>
            
          <br>

          <div><b>From Date & Time:</b></div>
          <input type="date" id="fromdate" name="fromdate" class="form-control" placeholder="Logs From">
          <input type="time" id="fromtime" name="fromdate" class="form-control" placeholder="Logs From">

          
          <div><b>To Date & Time:</b></div>
          <input type="date" id="todate" name="todate" class="form-control" placeholder="Logs to">
          <input type="time" id="totime" name="todate" class="form-control" placeholder="Logs to">

          <br>
          <button style="float: right; margin-right:5px; " class="btn-primary btn" name="submit"> Submit </button>
        </form>



            </div>
            <!-- /.box-body -->
          </div>
          
          <?php } ?>

          <?php



            if (isset($_GET['phase'])) {
              $phase = $_GET['phase'];
              
            }else{
              $phase = 3;
            }
            if (isset($_POST['connection'])) {
            	$cid = $_POST['connection'];
            	$phase_query = "select slot2 from connections where cid = '".$cid."'";
            	$phase_result = $conn->query($phase_query) or die(error);
            	foreach ($phase_result as $key) {
            		if ($key['slot2'] <= 0) {
            			$phase = 1;
            		}else{
            			$phase = 3;
            		}
            	} 
            }
           
          //echo ($phase = 3) ? 'btn-danger' : "btn-primary" ;
          ?>



          <button class="btn <?php  echo ($phase == 1) ? 'btn-danger' : 'btn-primary' ; ?>" onclick="window.location.href = 'connection-current-logs_int.php?phase=1'">Single Phase</button>
          <button class="btn <?php  echo ($phase == 3) ? 'btn-danger' : 'btn-primary' ; ?>" onclick="window.location.href = 'connection-current-logs_int.php?phase=3'">Three Phase</button><br><br>

              
 
    <div  id="overflow" style="overflow-x: scroll;" >
        
        <table  id="example1" class="table table-responsive table-bordered table-striped">
        <thead class="bg-blue">
        <tr>
                  
                  
          <th scope="col">Connection ID</th>
          <th scope="col">Connection Name</th> 
          <?php
          if ($phase == 1) {
              ?>
              <th scope="col">V1</th>
              <th scope="col">C1</th>
              <th scope="col">Pf1</th>
              
              <?php
            }else{
              ?>
              <th scope="col">V1</th>
              <th scope="col">V2</th>
              <th scope="col">V3</th>
              <th scope="col">C1</th>
              <th scope="col">C2</th>
              <th scope="col">C3</th>
              <th scope="col">Pf1</th>
              <th scope="col">Pf2</th>
              <th scope="col">Pf3</th>

              <?php
            }
          ?>         
          
         
                    <!--th scope="col">kvar1</th>
          <th scope="col">kvar2</th>
          <th scope="col">kvar3</th-->
          
          <th scope="col">Date & Time</th>
          
        </tr>
        </thead>
          
          
        <tbody bgcolor="#FFFFFF">
          
          <?php
          //include("db/opendb.php");
          $interval = 0;
          if(isset($_POST['interval'])){
              $interval = $_POST['interval'];
            }else{
              $interval = 5;
            }

          if ($phase == 1) {
            $slot2 = 'slot2 < 0';
          }else{
            $slot2 = 'slot2 > 0';
          }
        if(isset($_POST['connection'])){
            $id = $_POST['connection'];           

            if(empty($_POST['todate']) or empty($_POST['fromdate'])){
              $query = "SELECT FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(cust_current_logs.datetime) / ($interval*60)) * ($interval*60)) AS chunk_start, cust_current_logs.cid, connections.name, max(cust_current_logs.c1) as c1,max(cust_current_logs.c2) as c2,max(cust_current_logs.c3) AS c3, avg(cust_current_logs.v1) AS v1,avg(cust_current_logs.v2) as v2,avg(cust_current_logs.v3) as v3, max(cust_current_logs.pf1) as pf1, max(cust_current_logs.pf1) as pf2, max(cust_current_logs.pf3) as pf3 from cust_current_logs, connections where connections.cid = cust_current_logs.cid and cust_current_logs.cid = '".$id."' GROUP BY cid, chunk_start,cust_current_logs.datetime,name ORDER BY cust_current_logs.datetime desc desc limit 100";
              ?>

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing Data for Connection <b>'".$id."'</b>"; ?>
              </div>
            
              <?php
            }
            else
            {
              $fromdate = $_POST['fromdate'];
              $todate = $_POST['todate'];

              if(!(empty($_POST['fromtime']) or empty($_POST['totime']))){
                $fromdate = $fromdate." ".$_POST['fromtime'];
                $todate = $todate." ".$_POST['totime'];
              }
             $query = "SELECT FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(cust_current_logs.datetime) / ($interval*60)) * ($interval*60)) AS chunk_start, cust_current_logs.cid, connections.name, max(cust_current_logs.c1) as c1,max(cust_current_logs.c2) as c2,max(cust_current_logs.c3) AS c3, avg(cust_current_logs.v1) AS v1,avg(cust_current_logs.v2) as v2,avg(cust_current_logs.v3) as v3, max(cust_current_logs.pf1) as pf1, max(cust_current_logs.pf1) as pf2, max(cust_current_logs.pf3) as pf3 from cust_current_logs, connections where connections.cid = cust_current_logs.cid and cust_current_logs.cid = '".$id."' and cust_current_logs.Datetime BETWEEN  '".$fromdate."' AND '".$todate."' GROUP BY cid, chunk_start,cust_current_logs.datetime,name ORDER BY cust_current_logs.datetime desc";
              ?>

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing Data for Connection <b>'".$id."'</b> from date '".$fromdate."' to date '".$todate."'"; ?>
              </div>
            
              <?php
              
            }
          }else{
          	$query= "SELECT FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(cust_current_logs.datetime) / ($interval*60)) * ($interval*60)) AS chunk_start, cust_current_logs.cid, connections.name, max(cust_current_logs.c1) as c1,max(cust_current_logs.c2) as c2,max(cust_current_logs.c3) AS c3, avg(cust_current_logs.v1) AS v1,avg(cust_current_logs.v2) as v2,avg(cust_current_logs.v3) as v3, max(cust_current_logs.pf1) as pf1, max(cust_current_logs.pf1) as pf2, max(cust_current_logs.pf3) as pf3 from cust_current_logs, connections where connections.cid = cust_current_logs.cid and $slot2 GROUP BY cid, chunk_start,cust_current_logs.datetime,name ORDER BY cust_current_logs.datetime desc limit 100";
         }
                 
                  //echo $query;
         
          $result = $conn -> query($query) or die("Query error");
          foreach($result as $row){
          $dbname = $row['name'];

          ?>
          
         
        <tr>
          
          <td><?php echo $row['cid'];  ?></td>          
          <td><?php echo $dbname;  ?></td>
          <?php
            if ($phase == 1) {
              ?>
              <td><?php echo $row ['v1'];  ?></td>
              <td><?php echo $row ['c1'];  ?></td>
              <td><?php echo $row ['pf1'];  ?></td>
              
              <?php
            }else{
              ?>
              <td><?php echo $row ['v1'];  ?></td>
              <td><?php echo $row ['v2'];  ?></td>
              <td><?php echo $row ['v3'];  ?></td>
              <td><?php echo $row ['c1'];  ?></td>
              <td><?php echo $row ['c2'];  ?></td>
              <td><?php echo $row ['c3'];  ?></td>
              <td><?php echo $row ['pf1'];  ?></td>
              <td><?php echo $row ['pf2'];  ?></td>
              <td><?php echo $row ['pf3'];  ?></td>

              <?php
            }
          ?>
           <td><?php echo $row ['chunk_start'];  ?></td>
        
          
        </tr>
          
          <?php
          }
        ?>
            
        </tbody>
        <tfoot class="bg-blue">
        <tr>
                  
         <th scope="col">Connection ID</th>
            <th scope="col">Connection Name</th>       
<?php
          if ($phase == 1) {
              ?>
              <th scope="col">V1</th>
              <th scope="col">C1</th>
              <th scope="col">Pf1</th>
              
              <?php
            }else{
              ?>
              <th scope="col">V1</th>
              <th scope="col">V2</th>
              <th scope="col">V3</th>
              <th scope="col">C1</th>
              <th scope="col">C2</th>
              <th scope="col">C3</th>
              <th scope="col">Pf1</th>
              <th scope="col">Pf2</th>
              <th scope="col">Pf3</th>

              <?php
            }
          ?>         
          
         
                    <!--th scope="col">kvar1</th>
          <th scope="col">kvar2</th>
          <th scope="col">kvar3</th-->
          

          <th scope="col">Date & Time</th>
          
        </tr>
        </tfoot>
        

      </table>
        </div>

         </section>
        
  <?php $conn= NULL; ?>
  
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<?php include_once('footer.php') ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include_once('script.php') ?>
</body>
  <script>   
    $(function () {
      var indexLastColumn = $("#example1").find('tr')[0].cells.length-1;
    $('#example1').DataTable(
        {

            'order': [[ indexLastColumn, "desc" ]],
           'pageLength': 17
        })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    })
 
      
      
     
  </script>
</html>
