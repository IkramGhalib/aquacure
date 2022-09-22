<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Tube Well List"; ?>

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

      <?php 
              if ($_SESSION['role'] == "Admin") {
                ?>
                  <button id="add-new-button" class="btn btn-primary" onClick="window.location.href='add_pump.php'"><b>+ Add New Pump</b></button>
                  <br>
                  <br>
                <?php 
              }
            ?>
           
      
    <div id="overflow" style="overflow-x:auto;">
    <div class="example1_wrapper"></div>
    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
    <thead class="bg-blue">
    <tr>
    <th scope="col">SCADA ID</th>
    <th scope="col">TW ID</th>
    <th scope="col">Name</th>
    <th scope="col">Zone</th>
    <th scope="col">UC</th>
    <th scope="col">NC</th>
    <th scope="col">Location</th>
    <th scope="col">Latitude</th>
    <th scope="col">Longitude</th>
    <th scope="col">Supervisor</th>
    <th scope="col">Contact</th>
    <th scope="col">Capacity (HP)</th>
    <th scope="col">SCADA Installation Date</th>
    <th scope="col">Installation Date</th> 
    <!-- <th scope="col" width="100">Actions</th> -->
   
    </tr>
    </thead>
    <tbody>

    <?php
    require_once("opendb.php");
    $query = "select * from transformer";
    $result = $conn -> query($query) or die("Query error");
    foreach($result as $row){
    ?>

    <tr>
    <td><?php echo $row ['trid'];  ?></td>
    <td><?php echo $row ['twid'];  ?></td>
    <td><?php echo $row ['name'];  ?></td>
    <td><?php echo $row ['zone'];  ?></td>
    <td><?php echo $row ['uc'];  ?></td>
    <td><?php echo $row ['nc'];  ?></td>
    <td><?php echo $row ['location'];  ?></td>
    <td><?php echo $row ['latitude'];  ?></td>
    <td><?php echo $row ['longitude'];  ?></td>
    <td><?php echo $row ['supervisor'];  ?></td>
    <td><?php echo $row ['contact_no'];  ?></td>
    <td><?php echo $row ['kva_capacity'];  ?></td>
    <td><?php echo $row ['connectiondate'];  ?></td>
    <td><?php echo $row ['tw_const_date'];  ?></td>
   <!--  <td>
    <button class="btn btn-primary" onClick="window.location.href='edit_pump.php?id=<?php echo $row ['trid'];  ?>'">Edit</button>
    <button class='btn btn-danger' value='<?php echo $row['trid']?>' onclick = deleteVal(this.value)> Delete</button>
    </td> -->
    </tr>

    <?php } ?>

    </tbody>
    </table>
  </div>
  <br>
  <button onclick="exportTableToCSV('TWList.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>

 

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
				$("#example1").DataTable({
					"responsive": true, "lengthChange": true, "autoWidth": true,
          "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
					
					// "responsive": true, "lengthChange": true, "autoWidth": true,
					"buttons": ["copy", "csv", "excel", "colvis"]
				}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
				$('#example2').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"ordering": true,
					"info": true,
					"autoWidth": false,
					"responsive": true,
				});
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
