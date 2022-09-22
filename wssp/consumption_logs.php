<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Consumption Logs"?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('head.php') ?> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>
<script>
function showZone(str) {
  if (str=="") {
    document.getElementById("pump").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("pump").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getzone.php?q="+str,true);
  xmlhttp.send();
}
</script>


<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue sidebar-mini" >
<!-- Site wrapper -->
<div class="wrapper" style="overflow: hidden;">
	
	
	<!-- Navbar -->
	<?php include_once('navbar.php') ?>
	<!-- Sidebar -->
  <?php include_once("sidebar.php");?>

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
              <div class="">
                <div class="col col-md-2"><b>Select Zone</b></div>
                <div class="col col-md-2"><b>Select Tube Well</b></div>
                <div class="col col-md-4"><b>From Date & Time</b></div>
                <div class="col col-md-4"><b>To Date & Time</b></div>

              </div>
              <div class="row">
               <div class="col-md-2">
                
                  <select  id="zone" onchange="showZone(this.value)" class="form-control">
                    <option value="">---SELECT---</option>
                    <option>B</option>
                    <option>C</option>
                  </select>
                 
                </div>
                <div class="col-md-2">
                
                  <input type="text" list="pump" name="transformer" placeholder="Select Tube Well" required="required" class="form-control">
                  <datalist id="pump" >
                  </datalist>
                </div>
                
                <div class="col-md-2">
                  <input type="date" id="fromdate" name="fromdate" required class="form-control" placeholder="Logs From">
                </div>
                <div class="col-md-2">
                  <input type="time" id="fromtime" name="fromtime" class="form-control" placeholder="Logs From">
                  
                </div>
                
                <div class="col-md-2">
                  <input type="date" id="todate" name="todate" required class="form-control" placeholder="Logs From">
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
    
       
       <?php

          require_once("opendb.php");
          //include("db/opendb.php");
          if(isset($_POST['transformer'])){
            $id = $_POST['transformer'];

            
            
              $fromdate = $_POST['fromdate'];
              $todate = $_POST['todate'];

              
              // $query = "SELECT transformer.trid, transformer.name,zone, uc, nc, twid, max(tr_kwh_logs.peak+tr_kwh_logs.offpeak ) kwh  , date(tr_kwh_logs.datetime) as dt from transformer , tr_kwh_logs where transformer.trid = tr_kwh_logs.trid and tr_kwh_logs.trid = '".$id."' and tr_kwh_logs.Datetime between '".$fromdate."' and '".$todate."' group by date(tr_kwh_logs.datetime), name,zone, uc, nc, twid";

              $query = "SELECT tbl_kwh.kwh, transformer.trid, transformer.zone, transformer.uc, transformer.nc, transformer.name, transformer.twid, tbl_kwh.date FROM `tbl_kwh`, transformer where transformer.trid = tbl_kwh.trid and tbl_kwh.trid = '".$id."' and tbl_kwh.date between '".$fromdate."' and '".$todate."';
";
              ?>

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing Data for Pump <b>'".$id."'</b> from date '".$fromdate."' to date '".$todate."'"; ?>
              </div>
            
              <?php
              
            

            ?>

    <div  id="overflow" style="overflow-x:auto;">
        <table  id="example1" class="table table-responsive table-bordered table-striped" >
        <thead class="bg-blue">
        <tr>
          <th scope="col">SCADA ID</th>
          <th scope="col">TW ID</th>
          <th scope="col">Name</th>
          <th scope="col">Zone</th>
          <th scope="col">UC</th>
          <th scope="col">NC</th>
          <th scope="col">Units (kWh)</th>
          <th scope="col">Date & Time</th>
        </tr>
        </thead>
        <tbody bgcolor="#FFFFFF">
          <?php
          $result = $conn -> query($query) or die(error);
          $temp = 0;
          $flag = 0;
          foreach($result as $row){
            if ($flag == 0) {
              $temp = round($row['kwh'],2);
              $date = $row['dt'];
              $flag++;
            }else{
               ?>
              <tr>
                <td><?php echo $row['trid'];  ?></td>
                <td><?php echo $row['twid'];  ?></td>
                <td><?php echo $row['name'];  ?></td>
                <td><?php echo $row['zone'];  ?></td>
                <td><?php echo $row['uc'];  ?></td>
                <td><?php echo $row['nc'];  ?></td>
                <td><?php echo round($row['kwh'],2);?></td>
                <td><?php echo $row['date'];  ?></td>
              </tr>
          
          <?php
          $temp = $row['kwh'];
          $date = $row['dt'];
            }
         
          }
        ?>
      
        </tbody>
      </table>
      </div>
            <?php
          }
          else{
          ?>
             <div class="callout callout-danger">
                <h4>Alert!</h4>

                <p>Please select tube well to load consumption logs.</p>
              </div>
          <?php
          }
          
          //echo $query;
        $result = $conn -> query($query) or die("Query error");
      ?>
     

      <br>
  <button onclick="exportTableToCSV('Consumption_logs.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>

  <?php $conn= NULL; ?>
    
      
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

   <script>
    $(function () {
    $('#example1').DataTable(
    {"order": [[ 7, "desc" ]],
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
</html>
