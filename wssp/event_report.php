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

               
            </section>

            <!-- Main content -->
            <section class="content">
                
                            <?php
                            $year       = date('Y');
                            $month      = date('F');
                            $day        = explode('-', date('d-m-y'));

                            require_once("opendb.php");
                            

          //include("db/opendb.php");
          if(isset($_POST['transformer'])){
            $id = $_POST['transformer'];


              $fromdate = $_POST['fromdate'];
              $todate = $_POST['todate'];

              if(!(empty($_POST['fromtime']) or empty($_POST['totime']))){
                $fromdate = $fromdate ." ". $_POST['fromtime'];
                $todate = $todate ." ". $_POST['totime'];
              }
             $query = "select tr_current_logs.trid,transformer.name, transformer.location, transformer.uc, transformer.nc, transformer.zone, tr_current_logs.datetime from tr_current_logs, transformer where tr_current_logs.datetime between '".$fromdate."' and '".$todate."' and transformer.trid = tr_current_logs.trid and tr_current_logs.trid = '".$id."' and (B1U+B1M+B1L) > 5 order by tr_current_logs.trid, tr_current_logs.id";
              ?>

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing Data for Tube well <b>'".$id."'</b> from date '".$fromdate."' to date '".$todate."'"; ?>
              </div>
            
              <?php
              
            
            ?>
            <div id="overflow" style="overflow-x:auto;">
                    <table id="example1" class="table table-responsive table-bordered table-striped">
                        <thead class="bg-blue">
                            <tr>
                                <!-- <th scope="col">Event ID</th> -->
                                <th scope="col">TW ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Location</th>
                                <th scope="col">Zone</th>
                                <th scope="col">UC</th>
                                <th scope="col">NC</th>
                                <th scope="col">On Time</th>
                                <th scope="col">Off Time</th>
                                <th>Total Running Time (Minutes)</th>                                    

                            </tr>
                        </thead>
                        <tbody>

            <?php
            $result = $conn -> query($query) or die(error);

    $trid = "";
    $df = array();
    $final = array();

    foreach ($result as $row) {
        array_push($df, $row);
    }

    $from = "";
    $to = "";
    $flag=1;
    for ($i=0; $i < sizeof($df); $i++) { 

        if ($df[$i]['trid'] == $df[$i+1]['trid']) {
            $time1 = strtotime($df[$i]['datetime']);
            $time2 = strtotime($df[$i+1]['datetime']);
            if($flag == 1){
                $from = $df[$i]['datetime'];
                $flag = 0;
            }
            $diff = ($time2-$time1)/60;
            if ($diff > 30) {

                $to = $df[$i]['datetime'];
                $flag = 1;
                $time3 = strtotime($from);
                $time4 = strtotime($to);
                $diff2 = ($time4-$time3)/60;
                array_push($final, array($df[$i-1]['trid'],$df[$i-1]['name'],$df[$i-1]['location'],$df[$i-1]['zone'],$df[$i-1]['uc'],$df[$i-1]['nc'],$from,$to,round($diff2)));
                // echo $df[$i-1]['trid']."---".$from."---".$to."...".round($diff2)."<br>";
            }
            
            //echo $df[$i]['trid']."---".$diff."---".$df[$i]['datetime']."<br>";
        }else{
            $to = $df[$i]['datetime'];
            $flag = 1;
            $time3 = strtotime($from);
            $time4 = strtotime($to);
            $diff2 = ($time4-$time3)/60;
            array_push($final, array($df[$i-1]['trid'],$df[$i-1]['name'],$df[$i-1]['location'],$df[$i-1]['zone'],$df[$i-1]['uc'],$df[$i-1]['nc'],$from,$to,round($diff2)));
            // echo $df[$i-1]['trid']."---".$from."---".$to."...".round($diff2)."<br>";
        }
        
    }

    for ($x=0; $x < sizeof($final); $x++) { 
        // code...
    
                            ?>

                                <tr>
                                    <td><?php echo $final[$x][0];  ?></td>
                                    <td><?php echo $final[$x][1];  ?></td>
                                    <td><?php echo $final[$x][2];  ?></td>
                                    <td><?php echo $final[$x][3];  ?></td>
                                    <td><?php echo $final[$x][4];  ?></td>
                                    <td><?php echo $final[$x][5];  ?></td>
                                    <td><?php echo $final[$x][6];  ?></td>

                                    <td><?php echo $final[$x][7];  ?></td>
                                    <td><?php echo $final[$x][8];  ?></td>
                                    
                                    

                                </tr>

                            <?php } ?>

                        </tbody>
                       
                    </table>
                    <?php
          }
          else{
           
            ?>
            <div class="callout callout-danger">
                <h4>Alert!</h4>

                <p>Please select tube well(s) to see the events report.</p>
              </div>
         <?php
          }

                            ?>
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
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}


</script>


</html>