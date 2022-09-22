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
			<div class="col col-md-3 offset-md-9">	
				<b><?php date_default_timezone_set('Asia/Karachi');
				 echo "Print Date & Time: ".date("d-m-Y H:i:s");?></b><br>	
			</div>
		</div>
		<div class="row">
			<div class="col col-md-12">
				<u><h3 style="text-align: center;">DRINKING WATER ANALYSIS REPORT</h3></u>
			</div>
		</div>
		<br>

		<?php
			require_once("../opendb.php");
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
			}else{
				$id = "1G1WQ01";
			}
			$query = "select * from water_quality where wqid = '".$id."'";
			$result = $conn -> query($query) or die(error);

			$arrayData = array();
			foreach($result as $row){
				array_push($arrayData, $row);
			}
			// print_r($arrayData);	
	?>


		<div class="row table" >
			<table border="1" class="table table-bordered" width="100%">
				<tr>
					<td colspan="1"><b>Device Location: </b><?php echo $arrayData[0]['location']; ?></td>
				
					<td colspan="1"><b>UC: </b><?php echo $arrayData[0]['uc']; ?></td>
				
					<td colspan="1"><b>Connected Tube Well Name: </b><?php echo $arrayData[0]['twid']; ?></td>
				
				</tr>
				<tr>
					<td colspan="1"><b>Date of Sampling: </b><?php echo $arrayData[0]['datetime']; ?></td>
				
					<td colspan="1"><b>Time of Sampling: </b><?php echo $arrayData[0]['datetime']; ?></td>
				
					<td colspan="1"><b>No. of Samples: </b>10</td>
				
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
					<td>6.5 - 8</td>
			
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