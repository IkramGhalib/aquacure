<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Water Quality Logs"; ?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
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
	<?php include_once('sidebar.php') ?>

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
                  <datalist id="pumps" >
                    <?php
                    
                      require_once("opendb.php");
                      $query = "Select wqid, name, location from water_quality";
                      $result = $conn -> query($query) or die(error);

                      foreach ($result as $row) {
                        ?>
                        <option value="<?php echo $row['wqid'];?>"><?php echo $row['location']." - ".$row['location']; ?></option>
                        <?php
                      }
                    ?>

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
    
   

    <?php
    require_once("opendb.php");
          //include("db/opendb.php");
          if(isset($_POST['transformer'])){
            $id = $_POST['transformer'];

            if(empty($_POST['todate']) or empty($_POST['fromdate'])){
              $query = "SELECT wq_logs.*, water_quality.name FROM wq_logs ,water_quality WHERE wq_logs.wqid = water_quality.wqid and wq_logs.wqid = '".$id."' order by wq_logs.datetime limit 100";
              // echo "check1";
              ?>

              
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing Data for Pump <b>'".$id."'</b>"; ?>
              </div>
            
              <?php
            }
            else
            {
              $fromdate = $_POST['fromdate'];
              $todate = $_POST['todate'];
             // echo "check 2";
              if(!(empty($_POST['fromtime']) or empty($_POST['totime']))){
                $fromdate = $fromdate ." ". $_POST['fromtime'];
                $todate = $todate ." ". $_POST['totime'];
              }
              $query = "SELECT wq_logs.*, water_quality.name FROM wq_logs ,water_quality WHERE wq_logs.wqid = water_quality.wqid and wq_logs.wqid = '".$id."' and wq_logs.datetime BETWEEN '".$fromdate."' AND '".$todate."' order by wq_logs.datetime";
              ?>

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing Data from date '".$fromdate."' to date '".$todate."' desc limit 100"; ?>
              </div>
            
            <?php  
            }
            ?>
             <div id="overflow" style="overflow-x:auto;">
              <table id="example1"  class="table table-responsive table-bordered table-striped">
              <thead class="bg-blue">
              <tr>
                <th>WQID</th>
                <th>Name</th>
                <th>Temperature (<sup>o</sup>C)</th>
                <th>pH</th>
                <th>Electrical Conductivity (us/cm)</th>
                <th>Dispolved Oxygen (mg/L)</th>
                <th>TSS (mg/L)</th>
                <th>Turbidity (NTU)</th>
                <th>TDS (mg/L)</th>
                <th>Resistivity (ohm.cm)</th>
                <th>Salinity (mg/L)</th>                                               
                <th>Date Time</th>
              </tr>
              </thead>
              <tbody>
            <?php
            
            $result = $conn -> query($query) or die("Query error");
            foreach($result as $row){
            ?>

            <tr>
              <td><?php echo $row ['wqid'];  ?></td>
            <td><?php echo $row ['name'];  ?></td>
            <td><?php echo $row ['temperature'];  ?></td>
            <td><?php echo $row ['ph'];  ?></td>
            <td><?php echo $row ['ec'];  ?></td>
            <td><?php echo $row ['do'];  ?></td>
            <td><?php echo $row ['tss'];  ?></td>
            <td><?php echo $row ['turbidity'];  ?></td>
            <td><?php echo $row ['tds'];  ?></td>
            <td><?php echo $row ['resistivity'];  ?></td>
            <td><?php echo $row ['salinity'];  ?></td>
            <td><?php echo $row ['datetime'];  ?></td>
            </td>
            </tr>

            <?php }
            ?>
             </tbody>
  
            </table>
          </div>
          <br>
          <button onclick="exportTableToCSV('Current_logs.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>
            <?php 
          }
          else{

            ?>
            <div class="callout callout-danger">
                <h4>Alert!</h4>

                <p>Please select device to load water quality logs.</p>
              </div>
            <?php           
          }
        ?>
    

 

    </section>

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
</html>

   <script>
    $(function () {
    $('#example1').DataTable(
    {"order": [[ 11, "desc" ]],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]})
    $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
    })
    });

        function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}

function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}


</script>