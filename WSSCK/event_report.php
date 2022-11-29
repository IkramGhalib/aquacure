<?php session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
// the message
?>
<!DOCTYPE html>
<html>

<head>


    <?php $pageName = "Tube Well Event Report"; ?>



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
                    <div class="col-md-2">
                        <input type="text" list="pumps" name="transformer" placeholder="Select Tube Well" required="required" class="form-control">
                        <datalist id="pumps">
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
                        <input type="date" id="fromdate" name="fromdate" class="form-control" placeholder="Logs From">
                    </div>
                    <div class="col-md-2">
                        <input type="time" id="fromtime" name="fromtime" class="form-control" placeholder="Logs From">

                    </div>
                </div>
                <div class="pull-right">
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
            <br><br>

               
            </section>

            <!-- Main content -->
            <section class="content">
                <div id="overflow" style="overflow-x:auto;">
                    <table id="example1" class="table table-responsive table-bordered table-striped">
                        <thead class="bg-blue">
                            <tr>
                                <th scope="col">Event ID</th>
                                <th scope="col">TW ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">On Time</th>
                                <th scope="col">On Cause</th>
                                <th scope="col">Off Time</th>
                                <th scope="col">Off Cause</th>
                                <th>Total Running Time</th>                                    

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
              $query = "SELECT event_logs.*, transformer.name from event_logs, transformer WHERE transformer.trid = event_logs.pump_id and  event_logs.pump_id= '".$id."' order by datetime desc limit 1000";
              
              ?>

              
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing Data for Transformer <b>'".$id."'</b>"; ?>
              </div>
            
              <?php
            }
            else
            {
              $fromdate = $_POST['fromdate'];
              $todate = $_POST['todate'];

              if(!(empty($_POST['fromtime']) or empty($_POST['totime']))){
                $fromdate = $fromdate ." ". $_POST['fromtime'];
                $todate = $todate ." ". $_POST['totime'];
              }
              $query = "SELECT event_logs.*, transformer.name from event_logs, transformer WHERE transformer.trid = event_logs.pump_id and  event_logs.pump_id= '".$id."' AND datetime BETWEEN '".$fromdate."' AND '".$todate."' desc limit 1000";
              ?>

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing Data for Transformer <b>'".$id."'</b> from date '".$fromdate."' to date '".$todate."'"; ?>
              </div>
            
              <?php
              
            }
          }
          else{
            $query = "SELECT event_logs.*, transformer.name from event_logs, transformer WHERE transformer.trid = event_logs.pump_id  order by datetime desc limit 1000";

            // $query= "SELECT transformer.name , tr_current_logs.* FROM transformer , tr_current_logs WHERE transformer.trid = tr_current_logs.trid AND tr_current_logs.datetime>= now() - interval 1 day ORDER BY datetime DESC LIMIT 4000";
          }

                            $result = $conn->query($query) or die("Query error");
                            foreach ($result as $row) {
                                $start = strtotime($row['prev_datetime']);
                                $end = strtotime($row['datetime']);
                                $mins = ($end - $start) / 60;
                                $hours = $mins/60;
                                $hrs = explode(".", $hours);
                                $hours = $hrs[0];
                                $mins = $mins%60;
                            ?>

                                <tr>
                                    
                                    <td><?php echo $row['eid'];  ?></td><td><?php echo $row['pump_id'];  ?></td>
                                    <td><?php echo $row['name'];  ?></td>
                                    <td><?php echo $row['prev_datetime'];  ?></td>
                                    <td><?php echo ($row['prev_cause'] == 'Load Shedding') ? "Manual" : $row['prev_cause'];  ?></td>
                                    <td><?php echo $row['datetime'];  ?></td>
                                    <td><?php echo ($row['cause'] == 'Load Shedding') ? "Manual" : $row['cause'];  ?></td>
                                    <td> <?php echo $hours." hours ".$mins." mins";?>  </td>
                                    

                                </tr>

                            <?php } ?>

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
        $('#example1').DataTable({"order": [[ 0, "desc" ]],
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