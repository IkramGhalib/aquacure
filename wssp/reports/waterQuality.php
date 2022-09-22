<?php
	date_default_timezone_set("Asia/Karachi");
	$req_dt = date("Y-m-d H:i:s");
	require_once("../opendb.php");

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}else{
		$id = "1G1WQ01";
	}


	$sql = "SELECT module_id, server_datetime, raw_wq.temprature as temp, raw_wq.ph as ph, raw_wq.electrical_conductivity as ec, raw_wq.dissolved_oxygen as do, raw_wq.tss as tss, raw_wq.tds as tds, raw_wq.turbidity as tur, raw_wq.resistivity as res, raw_wq.salinity as sal from raw_wq, water_quality where module_id = '".$id."' and raw_wq.electrical_conductivity > 0 and raw_wq.resistivity > 0 and raw_wq.salinity > 0 order by server_datetime desc limit 1";

	$result = $conn->query($sql) or die(error);
	
	$insert = "INSERT INTO wq_logs(wqid, temperature, ph, ec, do, tss, turbidity, tds, resistivity, salinity, datetime) VALUES ";
		$flag = 0;
		foreach ($result as $row) {
			$mid = $row['module_id'];
			$temp = round($row['temp'],1);
			$ph = round($row['ph'],1);
			$ec = round($row['ec'],1);
			$do = round($row['do'],1);
			$tss = ($row['tss'] > 100) ? 0 : round($row['tss'],1);
			$tur = round($row['tur'],1);
			$tds = round($row['tds'],1);
			$res = round($row['res'],1);
			$sal = round($row['sal'],1);
			$dt = $req_dt;


			$insert .= "('".$mid."','".$temp."','".$ph."','".$ec."','".$do."','".$tss."','".$tur."','".$tds."','".$res."','".$sal."','".$dt."'),";

			$update = "UPDATE water_quality SET temprature= '$temp' ,ph='$ph',ec='$ec',do='$do',tss='$tss',turbidity= '$tur',tds= '$tds', resistivity= '$res',salinity='$sal', datetime='$dt' WHERE wqid = '$mid';";
			// echo $update;
			$up_res = $conn->query($update) or die(error);
			$flag++;	
		}

		if ($flag>0) {
			// echo substr($insert, 0, -1);
			$in_res = $conn->query(substr($insert, 0, -1)) or die(error);
		}
		// echo "----------------------------";

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>

</head>
<body>
	<div class="container">	
		<div class=""><br>
			<table border="0" width="100%">
				<tr>
					<td width="100px"><img src="wssp-logo.png" width="100%"></td>
					<td class="text-center" style="text-align: center;"><h3>WATER & SANITATION SERVICES PESHAWAR (WSSP)<br>GOVERNMENT OF KHYBER PAKHTUNKHWA<br>LCB building Plot No. 33 Street No. 13 Sector E-8, Phase 7 <br>Hayatabad, Peshawar, Khyber Pakhtunkhwa<br>Phone # 091-9219018 | Email: info@wsspeshawar.org.pk</h3>	
					<td width="100px"><img src="logo.png" width="100%"></td>
				</tr>
			</table>	
		</div>
		<div class="row">
			<div class="col col-md-12">
				<u><h3 style="text-align: center;">DRINKING WATER ANALYSIS REPORT</h3></u>
			</div>
		</div>
		<br>

		<?php
			
			$query = "select * from water_quality where wqid = '".$id."'";
			$result = $conn -> query($query) or die(error);

			$arrayData = array();
			foreach($result as $row){
				array_push($arrayData, $row);
			}
			// print_r($arrayData);	
		


		$sel = "SELECT transformer.`trid` ttrid, transformer.`location` trloc,`twid`,transformer.`name` trname,`zone`,`uc`,`nc`, water_quality.`location`, water_quality.`longitude`, water_quality.`latitiude`, water_quality.name as wqname, water_quality.location wqloc, water_quality.wqid FROM `transformer`, water_quality WHERE transformer.trid = water_quality.trid and water_quality.wqid = '".$id."'";

		$result2 = $conn -> query($sel) or die(error);
		$pump = array();
		foreach ($result2 as $key) {
			array_push($pump, $key);
		}
			?>



		<div class="row table" >
			<table border="1" class="table table-bordered" width="100%">
	<tr>
		<td><b> Water Quality ID</b></td>
		<td><?php echo $pump[0]['wqid'];?></td>

		<td><b>WQ Name</b></td>
		<td><?php echo $pump[0]['wqname'];?></td>

		<td><b>WQ Location</b></td>
		<td><?php echo $pump[0]['wqloc'];?></td>

		<td><b>Longitude</b></td>
		<td><?php echo $pump[0]['longitude'];?></td>

		<td><b>Latitude</b></td>
		<td><?php echo $pump[0]['latitiude'];?></td>
	</tr>

	<tr>
		<td><b>SCADA ID</b></td>
		<td><?php echo $pump[0]['ttrid'];?></td>

		<td><b>TW ID</b></td>
<td>		<?php echo $pump[0]['twid'];?></td>

		<td><b>TW Name</b></td>
		<td><?php echo $pump[0]['trname'];?></td>

		<td><b>TW Location</b></td>
		<td colspan="3"><?php echo $pump[0]['trloc'];?></td>

	</tr>
	<tr>
		<td><b>Test Date & Time</b></td>
		<td><?php echo $req_dt;?></td>

		<td><b>Print Date & Time</b></td>
		<td><?php echo $req_dt;?></td>

		<td><b>Zone</b></td>
		<td><?php echo $pump[0]['zone'];?></td>

		<td><b>UC</b></td>
		<td><?php echo $pump[0]['uc'];?></td>

		<td><b>NC</b></td>
		<td><?php echo $pump[0]['nc'];?></td>

		

	</tr>
</table>

				<br>

				<table border="1" width="100%" style="text-align: center;">
				<tr>
					<td>Sr. #</td>
					<td><b>Parameters</td>
					<td><b>Unit</td>
					<td><b>Values</td>
					<td><b>WHO Standard Range</td>
			
				</tr>
				<tr>
					<td>1</td>
					<td>Temperature</td>
					<td><sup>o</sup>C</td>
					<td><?php echo $arrayData[0]['temprature'];?></td>
					<td>24 - 30</td>
				

				</tr>
				<tr>
					<td>2</td>
					<td>pH</td>
					<td>No Unit</td>
					<td><?php echo $arrayData[0]['ph'];?></td>
					<td>6.5 - 9.2</td>
					
				</tr>
				<tr>
					<td>3</td>
					<td>Electrical Conductivity (EC)</b></td>
					<td>us/cm</td>
					<td><?php echo $arrayData[0]['ec'];?></td>
					<td>0 - 400</td>
			
				</tr>
				<tr>
					<td>4</td>
					<td>Disolved Oxygen (DO)</td>
					<td>mg/L</td>
					<td><?php echo $arrayData[0]['do'];?></td>
					<td>6.5 - 8</td>
					
				</tr>

				<tr>
					<td>5</td>
					<td>Total Suspended Solids (TSS)</td>
					<td>mg/L</td>
					<td><?php echo $arrayData[0]['tss'];?></td>
					<td>0-5</td>
			
				</tr>

				<tr>
					<td>6</td>
					<td>Total Disolved Solids (TDS)</td>
					<td>mg/L</td>
					<td><?php echo $arrayData[0]['tds'];?></td>
					<td>0 - 1000</td>
			
				</tr>

				<tr>
					<td>7</td>
					<td>Turbidity</td>
					<td>NTU</td>
					<td><?php echo $arrayData[0]['turbidity'];?></td>
					<td>0 - 5</td>
					
				</tr>

				<tr>
					<td>8</td>
					<td>Salinity</td>
					<td>mg/L</td>
					<td><?php echo $arrayData[0]['salinity'];?></td>
					<td>0 - 600</td>
					
				</tr>
				<tr>
					<td>9</td>
					<td>Resistivity</td>
					<td>Mohm.cm</td>
					<td><?php echo $arrayData[0]['resistivity'];?></td>
					<td>0 - 18.5</td>
					
				</tr>
			</table>
		</div>
		<br><br><br>
		
		<br>
		<br>
		<div class="row offset-md-3">
			<h6 style="text-align: center; color: red;">This is a computer-generated report and does not require a signature</h6>
		</div>
		<br>	
	</div>
</body>
</html>