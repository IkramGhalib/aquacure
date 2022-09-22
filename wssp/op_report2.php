<?php session_start();
// if( !isset($_SESSION['name']) ){
//   echo "<script language='javascript'>window.location.href='login.php';</script>";
// }
?>
<!DOCTYPE html>
<html>
<head>
  

  <?php $pageName = "Tube Well Operational Report"; ?>



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
  xmlhttp.open("GET","getzone2.php?q="+str,true);
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
                
                  <select  id="zone" name="zone" onchange="showZone(this.value)" class="form-control">
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
                  <input type="time" id="fromtime" name="fromtime"  class="form-control" placeholder="Logs From">
                  
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
       function sak2($df, $key, $key2){
          for ($x=0; $x < sizeof($df)-1; $x++) { 
            if ($df[$x][0] == $key and $df[$x][20] == $key2) {
              return $x; 
            }
          }
          return -1;
        }

    
        
          if(isset($_POST['submit'])){
            require_once("opendb.php");
            
              ?>

              <?php

     

        $id = $_POST['transformer'];
        $zone = $_POST['zone'];


        $fromdate = $_POST['fromdate'];
        $todate = $_POST['todate'];

        if(!(empty($_POST['fromtime']) or empty($_POST['totime']))){
          $fromdate = $fromdate ." ". $_POST['fromtime'];
          $todate = $todate ." ". $_POST['totime'];
        }

        $dates = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($todate);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($fromdate), $interval, $realEnd);

        foreach($period as $date) { 
            $dates[] = $date->format("Y-m-d"); 
        }

        // print_r($dates);

        //$dates = array();
        

        if ($id == "All") {
          $trans = "SELECT `trid`,`twid`,`name`,`zone`,`uc`,`nc`,`location`, pumping_capacity,tw_const_date, flowmeter,(select count(*) from water_quality where water_quality.trid = transformer.trid) wq, discharge FROM `transformer` where zone = '".$zone."'";

        }else{
          $trans = "SELECT `trid`,`twid`,`name`,`zone`,`uc`,`nc`,`location`, pumping_capacity,tw_const_date, flowmeter,(select count(*) from water_quality where water_quality.trid = transformer.trid) wq, discharge FROM `transformer` where trid = '".$id."'";
        }
        // echo $trans;

        // echo $trans;
        $trans_result = $conn -> query($trans) or die(error);
        $pumps = array();
        foreach ($trans_result as $key) {

        for ($a=0; $a < sizeof($dates)-1; $a++) { 
          array_push($pumps, array($key['trid'],$key['twid'],$key['name'],$key['zone'],$key['uc'],$key['nc'],$key['location'],$key['pumping_capacity'],$key['tw_const_date'],$key['flowmeter'],$key['wq'],0,0,0,0,0,0,$key['discharge'],0,0,$dates[$a],0));
        }          
        }


        // if ($id == 'All') {
        //    $query = "select tr_current_logs.trid,transformer.name,transformer.twid, transformer.normal_run, transformer.location, transformer.uc, transformer.nc, transformer.zone, tr_current_logs.datetime,transformer.ss from tr_current_logs, transformer where tr_current_logs.datetime between '".$fromdate."' and '".$todate."' and transformer.trid = tr_current_logs.trid and (B1U+B1M+B1L) > 5 order by tr_current_logs.trid, tr_current_logs.id";
        // }else{
        //    $query = "select tr_current_logs.trid,transformer.name,transformer.twid, transformer.normal_run, transformer.location, transformer.uc, transformer.nc, transformer.zone, tr_current_logs.datetime,transformer.ss from tr_current_logs, transformer where tr_current_logs.datetime between '".$fromdate."' and '".$todate."' and transformer.trid = tr_current_logs.trid and tr_current_logs.trid = '".$id."' and (B1U+B1M+B1L) > 5 order by tr_current_logs.trid, tr_current_logs.id";
        // }

        // // echo $query;


        

        //  $result = $conn -> query($query) or die(error);

        // $trid = "";
        // $df = array();

        // foreach ($result as $row) {
        //     array_push($df, $row);
        // }

        // $from = "";
        // $to = "";
        // $flag=1;
        // for ($i=0; $i < sizeof($df); $i++) { 

        //     if ($df[$i]['trid'] == $df[$i+1]['trid']) {
        //         $time1 = strtotime($df[$i]['datetime']);
        //         $time2 = strtotime($df[$i+1]['datetime']);
        //         if($flag == 1){
        //             $from = $df[$i]['datetime'];
        //             $flag = 0;
        //         }
        //         $diff = ($time2-$time1)/60;
        //         if ($diff > 30) {

        //             $to = $df[$i]['datetime'];
        //             $flag = 1;
        //             $time3 = strtotime($from);
        //             $time4 = strtotime($to);
        //             $diff2 = ($time4-$time3)/60;
                    
        //             $dtsp = explode(" ",$from);
        //             $index = sak2($pumps, $df[$i]['trid'], $dtsp[0]);


        //             if ( $index != -1) {
        //                 $pumps[$index][12] += $diff2; 
        //                 $pumps[$index][13] += 1;
        //             }
        //             // echo $df[$i-1]['trid']."---".$from."---".$to."...".round($diff2)."<br>";
        //         }
                
        //         //echo $df[$i]['trid']."---".$diff."---".$df[$i]['datetime']."<br>";
        //     }else{
        //         $to = $df[$i]['datetime'];
        //         $flag = 1;
        //         $time3 = strtotime($from);

        //         $time4 = strtotime($to);
        //         $diff2 = ($time4-$time3)/60;
        //         $index = sak2($pumps, $df[$i]['trid'], $dtsp[0]);
        //         if ( $index != -1) {
        //                 $pumps[$index][12] += $diff2;
        //                 $pumps[$index][13] += 1;
        //         }
        //         // echo $df[$i-1]['trid']."---".$from."---".$to."...".round($diff2)."<br>";
        //     }
            
        // }

        if ($id == 'All') {
          $rh="SELECT tid, TIME_TO_SEC(rh)/60 as total_min, on_off_events,signal_strength, datetime FROM `tbl_rh` where datetime between '".$fromdate."' and '".$todate."'";
        }else{
          $rh="SELECT tid, TIME_TO_SEC(rh)/60 as total_min, on_off_events,signal_strength, datetime FROM `tbl_rh` where tid = '".$id."' and  datetime between '".$fromdate."' and '".$todate."'";
        }
        
              // echo $rh;
              $result = $conn -> query($rh) or die(error);
              foreach($result as $row){
                $index = sak2($pumps, $row['tid'], $row['datetime']);
                $pumps[$index][12] = round($row['total_min']);
                $pumps[$index][13] = round($row['on_off_events']);
                $pumps[$index][21] = round($row['signal_strength']);



              }

        // if ($id == 'All') {
        //    $rh="SELECT tid, substring_index(rh,':', 1)*60+substring_index(rh,':', 2) as total_min, datetime FROM `tbl_rh` where datetime between '".$fromdate."' and '".$todate."'";
        // }else{
        //     $rh="SELECT tid, substring_index(rh,':', 1)*60+substring_index(rh,':', 2) as total_min FROM `tbl_rh` where tid = '".$id."' and datetime between '".$fromdate."' and '".$todate."'";
        // }
        // // echo $rh;

        //       // echo $rh;
        //       $result = $conn -> query($rh) or die(error);
        //       foreach($result as $row){
        //         $index = sak2($pumps, $row['tid'], $row['datetime']);
        //         $pumps[$index][12] +=$row['total_min'];

        //       }
         
         if ($id == 'All') {
           $kwh = "SELECT trid, kwh, date FROM `tbl_kwh` where date between '".$fromdate."' and '".$todate."'";
        }else{
           $kwh = "SELECT trid, kwh, date FROM `tbl_kwh` where trid = '".$id."' and date between '".$fromdate."' and '".$todate."'";
        }

          // echo $kwh;

          $result = $conn -> query($kwh) or die(error);
          foreach($result as $row){
            $index = sak2($pumps, $row['trid'], $row['date']);
            if ($index != -1) {
              $pumps[$index][14] = round($row['kwh'],2);
            }
          }
             

        if ($id == 'All') {
           $water_pumped = "select pump_id, max(water_pumped) maxv, min(water_pumped) minv, date(datetime) dt from fm_logs where datetime between '".$fromdate."' and '".$todate."' group by pump_id, date(datetime)";
        }else{
           $water_pumped = "select pump_id, max(water_pumped) maxv, min(water_pumped) minv, date(datetime) dt from fm_logs where datetime between '".$fromdate."' and '".$todate."' and pump_id = '".$id."' group by pump_id, date(datetime)";
        }

        // echo $water_pumped;

        

          
              $result = $conn -> query($water_pumped) or die(error);
              foreach ($result as $row) {
                $index = sak2($pumps, $row['pump_id'],$row['dt']);
                if ($index != -1) {
                  $pumps[$index][15] = round($row['maxv']-$row['minv'],2);
                }
              }
              if ($id == 'All') {
                $water_test = "SELECT water_quality.wqid, trid, count(*) cnt, date(wq_logs.datetime) dt from wq_logs, water_quality where wq_logs.datetime between '".$fromdate."' and '".$todate."' and water_quality.wqid = wq_logs.wqid GROUP by wqid, date(wq_logs.datetime)";
              }else{
                $water_test = "SELECT water_quality.wqid, trid, count(*) cnt, date(wq_logs.datetime) dt from wq_logs, water_quality where wq_logs.datetime between '".$fromdate."' and '".$todate."' and water_quality.wqid = wq_logs.wqid and water_quality.trid = '".$id."' GROUP by wqid, date(wq_logs.datetime)";
              }

              
              $result = $conn -> query($water_test) or die(error);
              // echo $water_test;
              foreach ($result as $row) {
                $index = sak2($pumps, $row['trid'],$row['dt']);
                if ($index != -1) {
                  $pumps[$index][16] = round($row['cnt'],2);
                }
              }
              // echo "test";

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
                <th>Total Tube Well Off Time (Hours)</th>
                <!-- 16  -->
                <th>On/Off Events</th>
                <!-- 17  -->
                <th>Total Water Supplied (m<sup>3</sup>)</th>
                <!-- 19  -->
                <th>Water Sample Tests</th>

                <th>Signal Strength</th>

              </tr>
              </thead>
              <tbody>
                <?php
                  for ($i=0; $i < sizeof($pumps)-1; $i++) { 
                    ?>
                    <tr>
                      <td><?php echo $pumps[$i][20];?></td>
                      <td><?php echo $pumps[$i][0];?></td> 
                      <td><?php echo $pumps[$i][1];?></td>
                      <td><?php echo $pumps[$i][2];?></td>
                      <td><?php echo $pumps[$i][3];?></td>
                      <td><?php echo $pumps[$i][4];?></td>
                      <td><?php echo $pumps[$i][5];?></td>  
                      <td><?php echo $pumps[$i][6];?></td>
                      <td><?php echo $pumps[$i][7];?></td>
                      <td><?php echo $pumps[$i][8];?></td>
                      <td><?php echo ($pumps[$i][9] > 0) ? "Yes": "No";?></td>
                      <td><?php echo ($pumps[$i][10] > 0) ? "Yes": "No";?></td>
                      <td><?php echo $pumps[$i][14];?></td>
                      <td><?php echo round($pumps[$i][12]);?></td>
                      <td><?php echo round($pumps[$i][12]/60,2);?></td>
                      <td><?php echo $pumps[$i][13];?></td>
                      <td><?php echo ($pumps[$i][15] == 0 ) ? round($pumps[$i][12]*$pumps[$i][17]/60,2) :  round($pumps[$i][15],2);?></td>
                      <td><?php echo $pumps[$i][16];?></td>
                      <td><?php echo $pumps[$i][21];?>%</td>


                      
                    </tr>

                  <?php
                  }
                ?>                

              </tbody>

            </table>
          </div>

          <button onclick="exportTableToCSV('Operational_Report.csv')" class="btn btn-primary"><span class="fa fa-download"></span>&nbsp;Download</button>
            <?php 
          
          }else{

            ?>
            <div class="callout callout-danger">
                <h4>Alert!</h4>

                <p>Please select device to load operational report.</p>
              </div>
            <?php           
          }
        ?>





<!-- /////////////////////////////////////////////////////////////////////////////////////////// -->

    

 

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