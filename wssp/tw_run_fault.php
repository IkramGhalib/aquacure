<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
date_default_timezone_set("Asia/Karachi");
// the message
?>
<!DOCTYPE html>
<html>

<head>


    <?php $pageName = "Excessive Running Tube Wells"; ?>



    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $pageName; ?></title>

    <?php include_once('head.php') ?>

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"></script>


<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper" style="overflow: hidden;">


        <!-- Navbar -->
        <?php include_once('navbar.php') ?>
        <!-- Sidebar -->
        <?php include_once('sidebar.php') ?>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper" style="margin-top: <?php echo $contentmargin ?>px">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <b><?php echo $pageName; ?></b>

                </h1>

                 <ol class="breadcrumb">
                    <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><?php echo $pageName; ?></li>
                </ol>
                <br>
               
            </section>


            
            <!-- Main content -->
            <section class="content">
              
                <div id="overflow" style="overflow-x:auto;">
                    <table id="example1" class="table table-responsive table-bordered table-striped">
                        <thead class="bg-blue">
                            <tr>
                                
                                <th scope="col">SCADA ID</th>
                                <th scope="col">TW ID</th>
                                <th scope="col">Location</th>
                                <th scope="col">Total Running Time (Hours)</th>
                                <th scope="col">Normal Running Time (hrs/day)</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $year       = date('Y');
                            $month      = date('F');
                            $day        = explode('-', date('d-m-y'));

                            require_once("opendb.php");
                            

          //include("db/opendb.php");
         
            $query = "SELECT event_logs.pump_id, twid, location, normal_run, sum(TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`))/60 as run, date(event_logs.datetime) as dt FROM transformer, `event_logs` WHERE event_logs.pump_id = transformer.trid and event = 'Off' and event_logs.datetime between date(now() - interval 1 day) and date(now()) and TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`) <= 300 GROUP by pump_id, date(event_logs.datetime),normal_run, twid, location";
              

            // echo $query;
            $result = $conn->query($query) or die("Query error");
            foreach ($result as $row) {
                if (round($row['run'],1) < $row['normal_run']) {
                    goto skip1;
                }
                
            ?>

                <tr >
                    
                    <td><?php echo $row['pump_id'];  ?></td>
                    <td><?php echo $row['twid'];  ?></td>
                    <td><?php echo $row['location'];  ?></td>
                    <td><?php echo round($row['run'],1);  ?></td>
                    <td><?php echo $row['normal_run'];  ?></td>
                    <td><?php echo $row['dt'];  ?></td>
                </tr>

            <?php 
                skip1:
        } ?>

                        </tbody>
                       
                    </table>
                </div>
<br>
  <button onclick="exportTableToCSV('Pump_Reports.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>
            

       
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
    $(function() {
        $('#example1').DataTable({"order": [[ 0, "asc" ]],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    })
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
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


</html>