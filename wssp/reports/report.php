<?php 
	require_once("../opendb.php");
	$from = "2022-06-23";
	$to = "2022-06-26";
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

	$runhrs = "SELECT event_logs.pump_id, sum(TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`))/60 as run, count(event_logs.pump_id) as cnt  FROM transformer, `event_logs` WHERE event_logs.pump_id = transformer.trid and event = 'Off' and event_logs.datetime between '".$from."' and '".$to."' and event_logs.prev_datetime between '".$from."' and '".$to."' and TIMESTAMPDIFF(minute, prev_datetime, event_logs.`datetime`) <= 300 GROUP by pump_id;";
	// echo $runhrs;
	$result = $conn -> query($runhrs) or die(error);

	foreach($result as $row){
		$index = search_arr($pumps, $row['pump_id']);
		if ($index != -1) {
			$pumps[$index][8] = round($row['run'],2);
			$pumps[$index][9] = round($row['cnt'],2);
		}
	}

	$water_pumped = "select pump_id, max(water_pumped) maxv, min(water_pumped) minv from fm_logs where datetime between '".$from."' and '".$to."' group by pump_id";
	$result = $conn -> query($water_pumped) or die(error);
	foreach ($result as $row) {
		$index = search_arr($pumps, $row['pump_id']);
		if ($index != -1) {
			$pumps[$index][10] = round($row['maxv'],2);
			$pumps[$index][11] = round($row['minv'],2);
		}
	}

	// print_r($pumps);
	echo "<table border='1'>";
	for ($i=0; $i < sizeof($pumps) ; $i++) { 
		echo "<tr>";
		for ($j=0; $j < sizeof($pumps[$i]) ; $j++) { 
		
			echo "<td>".$pumps[$i][$j]."</td>";
			
		}
		echo "</tr>";
	}
	echo "</table>";
	function search_arr($data, $key){
		for ($a=0; $a < sizeof($data); $a++) { 
			if ($data[$a][0] == $key) {
				return $a;
			}
		} 
		return -1;
	}
	
?>