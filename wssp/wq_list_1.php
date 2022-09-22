<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Water Quality List"; ?>

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

    
      
    <div id="overflow" style="overflow-x:auto;">
    
    <table id="example1"  class="table table-responsive table-bordered table-striped">
    <thead class="bg-blue">
    
    <tr>
    
    <th scope="col">WQ ID</th>
    <th scope="col">TW ID</th>
    <th scope="col">SCADA ID</th>
    <th scope="col">WQ Name</th>
    <th scope="col">WQ Location</th>
    <th scope="col">TW Name</th>
    <th scope="col">TW Location</th>
    <th scope="col">Zone</th>
    <th scope="col">UC</th>
    <th scope="col">NC</th>
    <th scope="col">Latitude</th>
    <th scope="col">Longitude</th>

    <th scope="col">Temperature</th>
    <th scope="col">pH</th>
    <th scope="col">EC</th>
    <th scope="col">DO</th>
    <th scope="col">TSS</th>
    <th scope="col">TDS</th>
    <th scope="col">Turbidity</th>
    <th scope="col">Salinity</th>
    <th scope="col">Resistivity</th>
    <th scope="col">Date & Time</th>
     <th scope="col">Actions</th>
   
    </tr>
    </thead>
    <tbody>

    <?php
    require_once("opendb.php");
    $query = "select *,water_quality.name wqn, water_quality.location wql, water_quality.latitiude wqlat, water_quality.longitude wqlong, transformer.trid, transformer.name twn, transformer.location twl, transformer.zone, transformer.uc, transformer.nc,transformer.twid, water_quality.datetime wqdt from water_quality, transformer WHERE transformer.trid = water_quality.trid";
    $result = $conn -> query($query) or die("Query error");
    foreach($result as $row){
    ?>

    <tr>
    <td><?php echo $row ['wqid'];  ?></td>
    <td><?php echo $row ['twid'];  ?></td>
    <td><?php echo $row ['trid'];  ?></td>
    <td><?php echo $row ['wqn'];  ?></td>
    <td><?php echo $row ['wql'];  ?></td>
    <td><?php echo $row ['twn'];  ?></td>
    <td><?php echo $row ['twl'];  ?></td>
    <td><?php echo $row ['zone'];  ?></td>
    <td><?php echo $row ['uc'];  ?></td>
    <td><?php echo $row ['nc'];  ?></td>
    <td><?php echo $row ['wqlat'];  ?></td>
    <td><?php echo $row ['wqlong'];  ?></td>
    
    <td><?php echo $row ['temprature'];  ?></td>
    <td><?php echo $row ['ph'];  ?></td>
    <td><?php echo $row ['ec'];  ?></td>
    <td><?php echo $row ['do'];  ?></td>
    <td><?php echo $row ['tss'];  ?></td>
    <td><?php echo $row ['tds'];  ?></td>
    <td><?php echo $row ['turbidity'];  ?></td>
    <td><?php echo $row ['resistivity'];  ?></td>
    <td><?php echo $row ['salinity'];  ?></td>

    <td><?php echo $row ['wqdt'];  ?></td>

    <td>
    <button class="btn btn-primary" <?php echo ($row['c1']+$row['c2']+$row['c3'] < 5) ? 'disabled' : ''; ?>  onClick="window.location.href='reports/waterQuality.php?id=<?php echo $row ['wqid'];  ?>'">Test now!</button>

    </td>
    </tr>

    <?php } ?>

    </tbody>
    </table>
  </div>
  <br>
  

 

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
        function deleteVal(val)
    {
        var conf= confirm("Do you really want to delete the Tubewell?");
    if (conf== true){
       window.open('delete_pump.php?pumpid='+val , '_self');
    }else{
      return;
    }
    };
    </script>

 <script>
    $(function () {
    $('#example1').DataTable()
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
        
        for (var j = 0; j < cols.length-1; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}



</script>