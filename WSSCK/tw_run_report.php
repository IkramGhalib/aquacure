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


    <?php $pageName = "Tube Well Running Report"; ?>



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
                <form method="post">
                <div class="row">
                    <div class="col col-md-2">
                        <label>
                            Select Tube Well(s)
                        </label>                        
                    </div>
                    <div class="col col-md-4">
                         <label>
                            From Date & Time
                        </label>  
                    </div>
                    <div class="col col-md-4">
                         <label>
                           To Date & Time
                        </label>  
                    </div>
                    <div class="col col-md-2">
                         
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" list="pumps" name="transformer" placeholder="Select Tube Well" required="required" class="form-control">
                        <datalist id="pumps">
                            <option>All</option>
                            <?php

                            require_once("opendb.php");
                            $query = "Select trid, name from transformer";
                            $result = $conn->query($query) or die(error);

                            foreach ($result as $row) {
                            ?>
                                <option value="<?php echo $row['trid']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                            }
                            ?>

                        </datalist>
                    </div>
                    
                    <div class="col-md-2">
                        <input type="date" id="fromdate" name="fromdate" class="form-control" placeholder="Logs From">
                    </div>
                    <div class="col-md-2">
                        <input type="time" id="fromtime" name="fromtime" class="form-control" placeholder="Logs From">

                    </div>
                    
                    <div class="col-md-2">
                        <input type="date" id="todate" name="todate" class="form-control" placeholder="Logs From">
                    </div>
                    <div class="col-md-2">
                        <input type="time" id="totime" name="totime" class="form-control" placeholder="Logs From">

                    </div>
                   
                    <div class="col col-md-2">
                    <button name="submit" type="submit" class="form-control btn btn-primary">Submit</button>
              
                    </div>
                </div>
                <br>
               
                
              </form>

               
            </section>


            
            <!-- Main content -->
            <section class="content">
                <?php if(isset($_POST['submit'])){

            ?>
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
          if(isset($_POST['transformer'])){
            $id = $_POST['transformer'];
            if(empty($_POST['todate']) or empty($_POST['fromdate'])){
                if ($id == 'All') {
                    $query = "SELECT event_logs.pump_id, twid, location, normal_run, sum(TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`))/60 as run, date(event_logs.datetime) as dt FROM transformer, `event_logs` WHERE event_logs.pump_id = transformer.trid and event = 'Off' and event_logs.datetime > now() - INTERVAL 24 hour and TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`) <= 300 GROUP by pump_id, date(event_logs.datetime),normal_run, twid, location";
                }else{
                    $query = "SELECT event_logs.pump_id, twid, location, normal_run, sum(TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`))/60 as run, date(event_logs.datetime) as dt FROM transformer, `event_logs` WHERE pump_id = '".$id."' and event_logs.pump_id = transformer.trid and event = 'Off' and event_logs.datetime > now() - INTERVAL 24 hour and TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`) <= 300 GROUP by pump_id, date(event_logs.datetime),normal_run, twid, location";
                }


              ?>

              
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing data for last 24 hours (From ".date('Y-m-d H:i:s')." to ".date('Y-m-d H:i:s', strtotime('-24 hour')).")."; ?>
              </div>
            
              <?php
            }
            else
            {
              $fromdate = $_POST['fromdate'];
              $todate = $_POST['todate'];

              if(!(empty($_POST['fromtime']))){
                $fromdate = $fromdate ." ". $_POST['fromtime'];
              }

              if (!(empty($_POST['totime']))) {
                $todate = $todate ." ". $_POST['totime'];
              }

              if ($id == 'All') {
                    $query = "SELECT event_logs.pump_id, twid, location, normal_run, sum(TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`))/60 as run, date(event_logs.datetime) as dt FROM transformer, `event_logs` WHERE event_logs.pump_id = transformer.trid and event = 'Off' and event_logs.datetime between '".$fromdate."' and '".$todate."' and TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`) <= 300 GROUP by pump_id,  date(event_logs.datetime),normal_run, twid, location";
                }else{
                    $query = "SELECT event_logs.pump_id, twid, location transformer.name, normal_run, sum(TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`))/60 as run,  date(event_logs.datetime) as dt FROM transformer, `event_logs` WHERE pump_id = '".$id."' and event_logs.pump_id = transformer.trid and event = 'Off' and event_logs.datetime > now() - INTERVAL 24 hour and TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`) <= 300 GROUP by pump_id,  date(event_logs.datetime),normal_run, twid, location";
                }

                $timestamp1 = strtotime($fromdate);
                $timestamp2 = strtotime($todate);
                $hour = abs($timestamp1 - $timestamp2)/(60*60);
                $days = round($hour/24);
                $hours = $hour%24;

              ?>

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing data from '".$fromdate."' to '".$todate."'"; ?><br>
                  <?php echo "Days: ".$days.", Hours: ".$hours;?>
              </div>
            
              <?php
              
            }
          }
            // echo $query;
            $result = $conn->query($query) or die("Query error");
            foreach ($result as $row) {
            ?>

                <tr class="<?php echo (round($row['run'],1)>$row['normal_run']) ? "bg-red": "" ;?>" >
                    
                    <td><?php echo $row['pump_id'];  ?></td>
                    <td><?php echo $row['twid'];  ?></td>
                    <td><?php echo $row['location'];  ?></td>
                    <td><?php echo round($row['run'],1);  ?></td>
                    <td><?php echo $row['normal_run'];  ?></td>
                    <td><?php echo $row['dt'];  ?></td>
                </tr>

            <?php } ?>

                        </tbody>
                       
                    </table>
                </div>
<br>
  <button onclick="exportTableToCSV('Pump_Reports.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>
            

        <?php }else{ 
         ?>
            <div class="callout callout-danger">
                <h4>Alert!</h4>

                <p>Please select tube well(s) to see the runnuing report.</p>
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