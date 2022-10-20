<?php 
session_start();
if( !isset($_SESSION['name']) ){
  echo "<script language='javascript'>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Tube Well Summarized Report"; ?>



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
                 <b> From Date and Time</b>
                </div>
                <div class="col-md-3">
                  <input type="date" id="fromdate" name="fromdate" required class="form-control" placeholder="Logs From">
                </div>
                
                <div class="col-md-2">
                  <b>To Date and Time</b>
                </div>
                
                <div class="col-md-3">
                  <input type="date" id="todate" name="todate" required class="form-control" placeholder="Logs To">
                  
                </div>
                <div class="col-md-2">
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
              </div>
              </div>
              
              </form>
            <br>
            <br>
    
   

    <?php
      function search_arr($data, $key){
      for ($a=0; $a < sizeof($data); $a++) { 
        if ($data[$a][0] == $key) {
        return $a;
        }
      } 
      return -1;
    }
    require_once("opendb.php");
      //   $servername = "localhost";
      // $username = "root";
      // $password = "";
      //   $dbname="waterscada_wssp";
          //include("db/opendb.php");
          if(isset($_POST['submit'])){
            
              $from = $_POST['fromdate'];
              $to = $_POST['todate'];
             // echo "check 2";

              $interval = new DateInterval('P1D');

              $realEnd = new DateTime($to);
              $realEnd->add($interval);

              $realto = $realEnd->format('Y-m-d');
              //echo $to;
              $trans = "SELECT `trid`,`twid`,`name`,`zone`,`uc`,`nc`,`location`, discharge, flowmeter FROM `transformer`";

              // echo $trans;

              $trans_result = $conn -> query($trans) or die(error);

              $pumps = array();
              foreach ($trans_result as $key) {
                array_push($pumps, array($key['trid'],$key['twid'],$key['name'],$key['zone'],$key['uc'],$key['nc'],$key['location'],0,0,0,0,0,$key['discharge'],$key['flowmeter'],0));
              }
                //   code  by ikram for kwh consumation
                  $kwh = "select trid, sum(kwh) as kwh_total from tbl_kwh where date between '".$from."' and '".$to."' group by trid";
                   // echo $kwh;
                  $result = $conn -> query($kwh) or die(error);
                  foreach($result as $row){
                    $index = search_arr($pumps, $row['trid']);
                    if ($index != -1) {
                      $pumps[$index][7] = $row['kwh_total'];
                    }
                  }

                  // code by mansoor
              // $kwh = "select trid, max(peak+offpeak) maxkwh, min(peak+offpeak) minkwh from tr_kwh_logs where datetime between '".$from."' and '".$to."' group by trid";
              //  // echo $kwh;
              // $result = $conn -> query($kwh) or die(error);
              // foreach($result as $row){
              //   $index = search_arr($pumps, $row['trid']);
              //   if ($index != -1) {
              //     $pumps[$index][7] = round($row['maxkwh']-$row['minkwh'],2);
              //   }
              // }

  //  $query = "select tr_current_logs.trid,transformer.name, transformer.normal_run, transformer.location, transformer.uc, transformer.nc, transformer.zone, tr_current_logs.datetime from tr_current_logs, transformer where tr_current_logs.datetime between '".$from."' and '".$realto."' and transformer.trid = tr_current_logs.trid and (B1U+B1M+B1L) > 5 order by tr_current_logs.trid, tr_current_logs.id";


  //   $result = $conn -> query($query) or die(error);

  //     $trid = "";
  //     $df = array();
  //     $final = array();

  //     foreach ($result as $row) {
  //         array_push($df, $row);
  //     }

  //     $fromd = "";
  //     $tod = "";
  //     $flag=1;
  //     $cnt = 0;
  //     for ($i=0; $i < sizeof($df)-1; $i++) { 

  //       if ($df[$i]['trid'] == $df[$i+1]['trid']) {
  //           $time1 = strtotime($df[$i]['datetime']);
  //           $time2 = strtotime($df[$i+1]['datetime']);
  //           if($flag == 1){
  //               $fromd = $df[$i]['datetime'];
  //               $cnt = 0;
  //               $flag = 0;
  //           }
  //           $diff = ($time2-$time1)/60;
  //           if ($diff > 30) {
  //               $cnt++;
  //               $tod = $df[$i]['datetime'];
  //               $flag = 1;
  //               $time3 = strtotime($fromd);
  //               $time4 = strtotime($tod);
  //               $diff2 = ($time4-$time3)/60;
                
  //               $dtsp = explode(" ",$from);
  //               $index = search_arr($pumps, $df[$i-1]['trid']);
  //               if ( $index != -1) {
  //                   // $pumps[$index][8] += $diff2; 

  //                   $pumps[$index][9] += 1;
  //               }
                    
  //               }
  //               // echo $df[$i-1]['trid']."---".$from."---".$to."...".round($diff2)."<br>";
  //           }else{
  //           $tod = $df[$i]['datetime'];
  //           $flag = 1;
  //           $cnt++;
  //           $time3 = strtotime($fromd);
  //           $time4 = strtotime($tod);
  //           $diff2 = ($time4-$time3)/60;
  //           $index = search_arr($pumps, $df[$i-1]['trid']);
  //           if ( $index != -1) {

  //                   // $pumps[$index][8] += $diff2; 
  //                   $pumps[$index][9] += 1; 
  //           }
  //           // echo $df[$i-1]['trid']."---".$from."---".$to."...".round($diff2)."<br>";
  //       }
        
  //   }



// code by ikram
              $rh="SELECT tid, sum(TIME_TO_SEC(rh)/60) as total_min, sum(on_off_events) as ofe, avg(signal_strength) ss FROM `tbl_rh` where datetime between '".$from."' and '".$to."' group by tid ";
              // echo $rh;
              $result = $conn -> query($rh) or die(error);
              foreach($result as $row){
                $index = search_arr($pumps, $row['tid']);
                $pumps[$index][8] = round($row['total_min']);
                $pumps[$index][9] = round($row['ofe']);
                $pumps[$index][14] = round($row['ss']);



              }

              $water_pumped = "select pump_id, max(water_pumped) maxv, min(water_pumped) minv from fm_logs where datetime between '".$from."' and '".$realto."' group by pump_id";
              // echo $water_pumped;
              $result = $conn -> query($water_pumped) or die(error);
              foreach ($result as $row) {
                $index = search_arr($pumps, $row['pump_id']);
                if ($index != -1) {
                  $pumps[$index][10] = round($row['maxv'],2);
                  $pumps[$index][11] = round($row['minv'],2);
                }
              }

             
            
              ?>

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                  <?php echo "Showing Data from date '".$from."' to date '".$to."'"; ?>
              </div>
            
            <?php  
            
            ?>
             <div id="overflow" style="overflow-x:auto;">
             <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
              <table id="example1"  class="table table-responsive table-bordered table-striped">
              <thead class="bg-blue">
              <tr>
                <th>Scada ID</th>
                <th>TW ID</th>
                <th>Name</th>
                <th>ZONE</th>
                <th>UC</th>
                <th>NC</th>
                <th>Location</th>
                <th>Consumption (KWH)</th>
                <th>Total Run (min)</th>
                <th>Total Run (Hours)</th>
                <th>On/Off Events</th>
                <th>Water Pumped (m<sup>3</sup>)</th>
                <th>Flow Meter</th>
                <th>Signal Strength</th>
                <th>From</th>
                <th>To</th>
              </tr>
              </thead>
              <tbody>
            <?php
            for ($d=0; $d < sizeof($pumps); $d++) { 
              $temp = round($pumps[$d][10]-$pumps[$d][11],2);
              ?>
              <tr>
                <td><?php echo $pumps[$d][0];  ?></td>
                <td><?php echo $pumps[$d][1];  ?></td>
                <td><?php echo $pumps[$d][2];  ?></td>
                <td><?php echo $pumps[$d][3];  ?></td>
                <td><?php echo $pumps[$d][4];  ?></td>
                <td><?php echo $pumps[$d][5];  ?></td>
                <td><?php echo $pumps[$d][6];  ?></td>
                <td><?php echo round($pumps[$d][7],2);  ?></td>
                <td><?php echo round($pumps[$d][8],2);  ?></td>
                <td><?php echo round($pumps[$d][8]/60,2);  ?></td>
                <td><?php echo round($pumps[$d][9],2);  ?></td>
               
                <td><?php echo ($temp>0) ? $temp : round(($pumps[$d][8]/60)*$pumps[$d][12]) ;  ?></td>
                <td><?php echo ($pumps[$d][13]>0)  ? "Yes" : "No" ;?></td>
                <td><?php echo round($pumps[$d][14],2)?>%</td>
                <td><?php echo $from;?></td>
                <td><?php echo $to;?></td>
                
              </tr>
              <?php
            }
            
            ?>
             </tbody>
  
            </table>
          </div>
          <br>
          <button onclick="exportTableToCSV('Current_logs.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>
            <?php 
          
          }else{

            ?>
            <div class="callout callout-danger">
                <h4>Alert!</h4>

                <p>Please select device to load summarized report.</p>
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
    // $(function () {
    // $('#example1').DataTable(
    // {"order": [[ 0, "asc" ]],
    //     "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]})
    // $('#example2').DataTable({
    // 'paging'      : true,
    // 'lengthChange': false,
    // 'searching'   : false,
    // 'ordering'    : true,
    // 'info'        : true,
    // 'autoWidth'   : false
    // })
    // });

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