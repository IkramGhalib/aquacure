<!DOCTYPE html>
<html>
<head>
  <?php $pageName = "Monthly Attendance"?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageName;?></title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<body class="hold-transition skin-blue sidebar-mini" >
<!-- Site wrapper -->
<div class="wrapper" style="overflow: hidden;">
	<!-- Navbar -->
	<?php include_once('navbar.php') ?>
	<!-- Sidebar -->
	<?php include_once('sidebar.php') ?>

  <!-- =============================================== -->
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
      <?php
      echo "Today is " . date("Y/m/d") . "<br>";
      ?>
    </section>
    <?php
    require_once("opendb.php");
    $query = "select * from person";
    $result = $conn -> query($query) or die(error); 
    $persons = array();
    foreach ($result as $row) {
    	array_push($persons, array($row['pid'], $row['person_name']));
    }
   	$query1 = "select * from raw_data";
    $result1 = $conn -> query($query1) or die(error); 
    $raw_data = array();

    foreach ($result1 as $row1) {
    	array_push($raw_data, array($row1['pid'], $row1['date_time']));
    }
?>
    <!-- Main content -->
    <section class="content">
      <div id="overflow" style="overflow-x:auto;">
      <table id="example1" class="table table-responsive table-bordered table-striped">
      <thead class="bg-blue">
              <tr>
                  
              <th>Person Name</th>
            <?php             
            // $year = "2022";
            // $month = "06";
            $year = date('Y');
            $month = date('m');
            $day=date('d');
            $sundays=0;
            $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
            // $days = cal_days_in_month(CAL_GREGORIAN,$day,$month);
            // echo $days;
        
            // $days =date('t', mktime(0, 0, 0, $month, 1, $year)); 
            for ($i=1; $i < $days; $i++) {
                ?>
                <td>
                    <?php echo $i; ?>
                </td>
                <?php
            }
            ?>
              </tr>
              </thead>
              <?php
		for ($i=0; $i < sizeof($persons); $i++) { 
		?>
		<tr> 
			<b><td><?php echo $persons[$i][1];?></td></b>
			<?php
      $weekdays = 0;
			for ($j=1; $j < $days; $j++) { 
				$chkdt = $year."-".$month."-".$j;
        if($chkdt== 'Saturday' || $chkdt == 'Sunday') {
          $weekdays++;
        }
				$time = "<div style='color:red'>A</div>";
				for ($k=0; $k < sizeof($raw_data); $k++) { 
					$dt = explode(" ", $raw_data[$k][0]);
					// echo $dt[0];
					if ($dt[0] == $chkdt and $persons[$i][0] == $raw_data[$k][0]) {
						$time = $dt[1];
					}
				}      
				?>
				<td><div style='color:green'><b><?php echo $time; ?></b></div></td>      
				<?php
			}     
			?>
		</tr>
		<?php 	
		}
		function search_date($pid, $date, $data){
		}
	?>         
    </div>
    </section>
  </div>
  <div class="control-sidebar-bg">
  <?php include_once('footer.php') ?>
  </div>
</div>
<?php include_once('script.php') ?>
</body>
</html>
                 