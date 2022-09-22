<?php session_start();
// if( !isset($_SESSION['name']) ){
//   echo "<script language='javascript'>window.location.href='login.php';</script>";
// }
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
	<?php include_once('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper" style="margin-top: <?php echo $contentmargin?>px">
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
          //include("db/opendb.php");
          if(isset($_POST['submit'])){
            
              $from = $_POST['fromdate'];
              $to = $_POST['todate'];
             // echo "check 2";

              $trans = "SELECT `trid`,`twid`,`name`,`zone`,`uc`,`nc`,`location`, pumping_capacity FROM `transformer`";
              $trans_result = $conn -> query($trans) or die(error);
              $pumps = array();
              foreach ($trans_result as $key) {
                array_push($pumps, array($key['trid'],$key['twid'],$key['name'],$key['zone'],$key['uc'],$key['nc'],$key['location'],0,0,0,0,0,$key['pumping_capacity']));
              }

              $kwh = "select trid, max(peak+offpeak) maxkwh, min(peak+offpeak) minkwh from tr_kwh_logs where datetime between '".$from."' and '".$to."' group by trid";
               // echo $kwh;
              $result = $conn -> query($kwh) or die(error);
              foreach($result as $row){
                $index = search_arr($pumps, $row['trid']);
                if ($index != -1) {
                  $pumps[$index][7] = round($row['maxkwh']-$row['minkwh'],2);
                }
              }

 $query = "select tr_current_logs.trid,transformer.name, transformer.normal_run, transformer.location, transformer.uc, transformer.nc, transformer.zone, tr_current_logs.datetime from tr_current_logs, transformer where tr_current_logs.datetime between '".$from."' and '".$to."' and transformer.trid = tr_current_logs.trid and (B1U+B1M+B1L) > 5 order by tr_current_logs.trid, tr_current_logs.id";


  $result = $conn -> query($query) or die(error);

    $trid = "";
    $df = array();
    $final = array();

    foreach ($result as $row) {
        array_push($df, $row);
    }

    $fromd = "";
    $tod = "";
    $flag=1;
    $cnt = 0;
    for ($i=0; $i < sizeof($df)-1; $i++) { 

        if ($df[$i]['trid'] == $df[$i+1]['trid']) {
            $time1 = strtotime($df[$i]['datetime']);
            $time2 = strtotime($df[$i+1]['datetime']);
            if($flag == 1){
                $fromd = $df[$i]['datetime'];
                $cnt = 0;
                $flag = 0;
            }
            $diff = ($time2-$time1)/60;
            if ($diff > 30) {
                $cnt++;
                $tod = $df[$i]['datetime'];
                $flag = 1;
                $time3 = strtotime($fromd);
                $time4 = strtotime($tod);
                $diff2 = ($time4-$time3)/60;
                
                $dtsp = explode(" ",$from);
                $index = search_arr($pumps, $df[$i-1]['trid']);
                if ( $index != -1) {
                    $pumps[$index][8] += $diff2; 
                    $pumps[$index][9] += 1;
                }
                    
                }
                // echo $df[$i-1]['trid']."---".$from."---".$to."...".round($diff2)."<br>";
            }else{
            $tod = $df[$i]['datetime'];
            $flag = 1;
            $cnt++;
            $time3 = strtotime($fromd);
            $time4 = strtotime($tod);
            $diff2 = ($time4-$time3)/60;
            $index = search_arr($pumps, $df[$i-1]['trid']);
            if ( $index != -1) {
                    $pumps[$index][8] += $diff2; 
                    $pumps[$index][9] += 1; 
            }
            // echo $df[$i-1]['trid']."---".$from."---".$to."...".round($diff2)."<br>";
        }
        
    }




              // $runhrs = "SELECT event_logs.pump_id, sum(TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`))/60 as run, count(event_logs.pump_id) as cnt  FROM transformer, `event_logs` WHERE event_logs.pump_id = transformer.trid and event = 'Off' and event_logs.datetime between '".$from."' and '".$to."' and event_logs.prev_datetime between '".$from."' and '".$to."' and TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`) <= 300 GROUP by pump_id";
              // // echo $runhrs;
              // $result = $conn -> query($runhrs) or die(error);

              // foreach($result as $row){
              //   $index = search_arr($pumps, $row['pump_id']);
              //   if ($index != -1) {
              //     $pumps[$index][8] = round($row['run'],2);
              //     $pumps[$index][9] = round($row['cnt'],2);
              //   }
              // }







              $water_pumped = "select pump_id, max(water_pumped) maxv, min(water_pumped) minv from fm_logs where datetime between '".$from."' and '".$to."' group by pump_id";
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
                <td><?php echo round($pumps[$d][7]/60,2);  ?></td>
                <td><?php echo round($pumps[$d][8],2);  ?></td>
                <td><?php echo round($pumps[$d][9],2);  ?></td>
               
                <td><?php
                echo ($temp>0) ? $temp : round($pumps[$d][9]*$pumps[$d][12]) ;  ?></td>
                <td><?php echo ($temp>0)  ? "Yes" : "No" ;?></td>
                
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





<!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
      <?php

        function sak2($df, $key, $key2){
          for ($x=0; $x < sizeof($df); $x++) { 
            if ($df[$x][0] == $key1 and $df[$x][20] == $key2) {
              return $x; 
            }
          }
          return -1;
        }

        $id = '1G1PU05';

        $fromdate = "2022-06-23";
        $todate = "2022-06-26";

        $dates = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($todate);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($fromdate), $interval, $realEnd);

        foreach($period as $date) { 
            $dates[] = $date->format("Y-m-d"); 
        }

        print_r($dates);

        //$dates = array();
        $trans = "SELECT `trid`,`twid`,`name`,`zone`,`uc`,`nc`,`location`, pumping_capacity,tw_const_date, flowmeter,(select count(*) from water_quality where water_quality.trid = transformer.trid) wq FROM `transformer` where trid = '".$id."'";
        $trans_result = $conn -> query($trans) or die(error);
        $pumps = array();
        foreach ($trans_result as $key) {

        for ($a=0; $a < sizeof($dates); $a++) { 
          array_push($pumps, array($key['trid'],$key['twid'],$key['name'],$key['zone'],$key['uc'],$key['nc'],$key['location'],$key['pumping_capacity'],$key['tw_const_date'],$key['flowmeter'],$key['wq'],0,0,0,0,0,0,0,0,0,$dates[$a]));
        }          
        }


        if ($id == 'All') {
           $query = "select tr_current_logs.trid,transformer.name,transformer.twid, transformer.normal_run, transformer.location, transformer.uc, transformer.nc, transformer.zone, tr_current_logs.datetime,transformer.ss from tr_current_logs, transformer where tr_current_logs.datetime between '".$fromdate."' and '".$todate."' and transformer.trid = tr_current_logs.trid and (B1U+B1M+B1L) > 5 order by tr_current_logs.trid, tr_current_logs.id";
        }else{
           $query = "select tr_current_logs.trid,transformer.name,transformer.twid, transformer.normal_run, transformer.location, transformer.uc, transformer.nc, transformer.zone, tr_current_logs.datetime,transformer.ss from tr_current_logs, transformer where tr_current_logs.datetime between '".$fromdate."' and '".$todate."' and transformer.trid = tr_current_logs.trid and tr_current_logs.trid = '".$id."' and (B1U+B1M+B1L) > 5 order by tr_current_logs.trid, tr_current_logs.id";
        }

        

         $result = $conn -> query($query) or die(error);

        $trid = "";
        $df = array();

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
                    
                    $dtsp = explode(" ",$from);
                    $index = sak2($pumps, $df[$i]['trid'], $dtsp[0]);


                    if ( $index != -1) {
                        $pumps[$index][12] += $diff2; 
                        $pumps[$index][13] += 1;
                    }
                    // echo $df[$i-1]['trid']."---".$from."---".$to."...".round($diff2)."<br>";
                }
                
                //echo $df[$i]['trid']."---".$diff."---".$df[$i]['datetime']."<br>";
            }else{
                $to = $df[$i]['datetime'];
                $flag = 1;
                $time3 = strtotime($from);

                $time4 = strtotime($to);
                $diff2 = ($time4-$time3)/60;
                $index = sak2($pumps, $df[$i]['trid'], $dtsp[0]);
                if ( $index != -1) {
                        $pumps[$index][12] += $diff2;
                        $pumps[$index][13] += 1;
                }
                // echo $df[$i-1]['trid']."---".$from."---".$to."...".round($diff2)."<br>";
            }
            
        }


         
         if ($id == 'All') {
           $kwh = "select trid, max(peak+offpeak) maxkwh, min(peak+offpeak) minkwh, date(datetime) dt from tr_kwh_logs where datetime between '".$fromdate."' and '".$todate."' group by trid, date(datetime)";
        }else{
           $kwh = "select trid, max(peak+offpeak) maxkwh, min(peak+offpeak) minkwh, date(datetime) dt from tr_kwh_logs where datetime between '".$fromdate."' and '".$todate."' and trid = '".$id."' group by trid, date(datetime)";
        }


         
           // echo $kwh;
          $result = $conn -> query($kwh) or die(error);
          foreach($result as $row){
            $index = search_arr($pumps, $row['trid'], $row['dt']);
            if ($index != -1) {
              $pumps[$index][14] = round($row['maxkwh']-$row['minkwh'],2);
            }
          }
             

        if ($id == 'All') {
           $water_pumped = "select pump_id, max(water_pumped) maxv, min(water_pumped) minv, date(datetime) dt from fm_logs where datetime between '".$fromdate."' and '".$todate."' group by pump_id, datetime";
        }else{
           $water_pumped = "select pump_id, max(water_pumped) maxv, min(water_pumped) minv, date(datetime) dt from fm_logs where datetime between '".$fromdate."' and '".$todate."' and pump_id = '".$id."' group by pump_id, datetime";
        }

        

          
              $result = $conn -> query($water_pumped) or die(error);
              foreach ($result as $row) {
                $index = search_arr($pumps, $row['pump_id'],$row['dt']);
                if ($index != -1) {
                  $pumps[$index][15] = round($row['maxv']-$row['minv'],2);
                }
              }
              if ($id == 'All') {
                $water_test = "SELECT water_quality.wqid, trid, count(*) cnt, date(wq_logs.datetime) dt from wq_logs, water_quality where wq_logs.datetime between '2022-07-29' and '2022-08-01' and water_quality.wqid = wq_logs.wqid GROUP by wqid, date(wq_logs.datetime)";
              }else{
                $water_test = "SELECT water_quality.wqid, trid, count(*) cnt, date(wq_logs.datetime) dt from wq_logs, water_quality where wq_logs.datetime between '2022-07-29' and '2022-08-01' and water_quality.wqid = wq_logs.wqid and water_quality.trid = '".$id."' GROUP by wqid, date(wq_logs.datetime)";
              }
              
              $result = $conn -> query($water_pumped) or die(error);
              foreach ($result as $row) {
                $index = search_arr($pumps, $row['trid'],$row['dt']);
                if ($index != -1) {
                  $pumps[$index][16] = round($row['cnt'],2);
                }
              }

      ?>
          <div id="overflow" style="overflow-x:auto;">
              <table id="example1"  class="table table-responsive table-bordered table-striped">
              <thead class="bg-blue">
              <tr>
                <!-- 1 -->
                <th>Date</th>
                <!-- 2  -->
                <th>Scada ID</th>
                <!-- 3  -->
                <th>TW ID</th>
                <!-- 4  -->
                <th>Name</th>
                <!-- 5  -->
                <th>ZONE</th>
                <!-- 6  -->
                <th>UC</th>
                <!-- 7  -->
                <th>NC</th>
                <!-- 8  -->
                <th>Location</th>
                <!-- 9  -->
                <th>Pumping Machinary (HP)</th>
                <!-- 10  -->
                <th>SCADA Installation Date</th>
                <!-- 11  -->
                <th>Electromagnetic Flowmeter Installed (Y/N)</th>
                <!-- 12  -->
                <th>Water Quality Device Installed (Y/N)</th>
                <!-- 13  -->                
                <th>Total Units Consumed (KWH)</th>
                <!-- 14  -->
                <th>Total Tube Well On Time (min)</th>
                <!-- 15  -->
                <th>Total Tube Well Off Time (min)</th>
                <!-- 16  -->
                <th>On/Off Events</th>
                <!-- 17  -->
                <th>Total Water Supplied (m<sup>3</sup>)</th>
                <!-- 19  -->
                <th>Water Sample Tests</th>
                <!-- 20  -->
                <th>No. of Passed Test</th>
                <!-- 21  -->
                <th>No. of Faild Tests</th>
              </tr>
              </thead>
              <tbody>
                <?php
                  for ($i=0; $i < sizeof($pumps); $i++) { 
                    ?>
                    <tr>
                      <td><?php echo $pumps[$i][20]?></td>
                      <td><?php echo $pumps[$i][0]?></td> 
                      <td><?php echo $pumps[$i][1]?></td>
                      <td><?php echo $pumps[$i][2]?></td>
                      <td><?php echo $pumps[$i][3]?></td>
                      <td><?php echo $pumps[$i][4]?></td>
                      <td><?php echo $pumps[$i][5]?></td>  
                      <td><?php echo $pumps[$i][6]?></td>
                      <td><?php echo $pumps[$i][7]?></td>
                      <td><?php echo $pumps[$i][8]?></td>
                      <td><?php echo ($pumps[$i][9] > 0) ? "Yes": "No";?></td>
                      <td><?php echo ($pumps[$i][10] > 0) ? "Yes": "No";?></td>
                      <td><?php echo $pumps[$i][11]?></td>
                      <td><?php echo $pumps[$i][12]?></td>
                      <td><?php echo round($pumps[$i][12]/60,2);?></td>
                      <td><?php echo $pumps[$i][13]?></td>
                      <td><?php echo $pumps[$i][14]?></td>
                      <td><?php echo $pumps[$i][15]?></td>
                      <td><?php echo $pumps[$i][16]?></td>
                      <td><?php echo $pumps[$i][17]?></td>

                      
                    </tr>

                  <?php
                  }
                ?>                

              </tbody>

            </table>
          </div>

    

 

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
    {"order": [[ 0, "asc" ]],
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