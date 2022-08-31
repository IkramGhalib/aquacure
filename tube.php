<?php 
// session_start();
// if( !isset($_SESSION['name']) ){
//   echo "<script language='javascript'>window.location.href='login.php';</script>";
// }
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Tube Well List"; ?>

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

      <?php 
            //   if ($_SESSION['role'] == "Admin") {
            //     ?>
            //       <button id="add-new-button" class="btn btn-primary" onClick="window.location.href='add_pump.php'"><b>+ Add New Pump</b></button>
            //       <br>
            //       <br>
                <?php 
            //   }
            ?>
    
           
      
    <div id="overflow" style="overflow-x:auto;">
    Columns to be display: &nbsp;&nbsp;&nbsp;
    <select name="toggle_column" id="toggle_column">
        <option value="0">TW ID</option>
        <option value="1">Name</option>
        <option value="2">Zone</option>
        <option value="3">UC</option>
        <option value="4">NC</option>
        <option value="5">Location</option>
        <option value="6">Latitude</option>
        <option value="7">Longitude</option>
        <option value="8">Supervisor</option>
        <option value="9">Contact</option>
        <option value="10">Capacity (HP)</option>
        <option value="11">SCADA Installation Date</option>
        <option value="12">TW Construction Date</option>
        
    </select>
    <br>
    <br>
    
    <table id="example1"  id=class="table table-responsive table-bordered table-striped">
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
    <th scope="col">TW Construction Date</th> 
    <!-- <th scope="col" width="100">Actions</th> -->
   
    </tr>
    </thead>
    <tbody>

    <?php
    require_once("includes/opendb.php");
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
        
        // $("#example1").DataTable({
      
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example1').DataTable()
    $('#example2').DataTable({
    // 'paging'      : true,
    // 'lengthChange': false,
    // 'searching'   : true,
    // 'ordering'    : true,
    // 'info'        : true,
    // 'autoWidth'   : false
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
<script>
    $(document).ready(function () {
    var table = $('#example').DataTable({
        scrollY: '200px',
        paging: false,
    });
 
    $('a.toggle-vis').on('click', function (e) {
        e.preventDefault();
 
        // Get the column API object
        var column = table.column($(this).attr('data-column'));
 
        // Toggle the visibility
        column.visible(!column.visible());
    });
});
    function hideAllColumns(){
        for(var i=0;i<13;i++){
            columns=my_table.column(i).visible(0);
        }
    }
    jQuery(document).ready(fuction(){
        my_table=jQuery('#example1').DataTable();
        // my_table.column(0).visible(0);
        jQuery('#toggle_column').multipleSelect({
            onClick:function(view){
            },
            onCheckAll:function(){

            },
            onUnCheckAll: function(){
                hideAllColumns();
            }
        })
    });
</script>