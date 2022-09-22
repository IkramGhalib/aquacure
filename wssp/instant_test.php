<?php
	
	$req_dt = date("Y-m-d H:i:s");
	require_once("opendb.php");


	$sql = "SELECT module_id, server_datetime, raw_wq.temprature as temp, raw_wq.ph as ph, raw_wq.electrical_conductivity as ec, raw_wq.dissolved_oxygen as do, raw_wq.tss as tss, raw_wq.tds as tds, raw_wq.turbidity as tur, raw_wq.resistivity as res, raw_wq.salinity as sal from raw_wq, water_quality where module_id = '".$id."' raw_wq.electrical_conductivity > 0 and raw_wq.resistivity > 0 and raw_wq.salinity > 0 order by server_datetime desc limit 1";

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
			echo $update;
			$up_res = $conn->query($update) or die(error);
			$flag++;	
		}

		if ($flag>0) {
			echo substr($insert, 0, -1);
			$in_res = $conn->query(substr($insert, 0, -1)) or die(error);
		}

		$conn = NULL;
?>