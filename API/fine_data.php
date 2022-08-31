<?php

//Copying data from raw to main table after processing

	// $subdivid = "ENO";
  	// $dbtype = "ENO";
  	// $login = 'ncai';

	// $servername = "10.13.144.6";
	// $username = "user_".$login;
	// $password = "Adm1n@".$login;
	// $dbname = $dbtype."_".$subdivid;

	$servername = "localhost";
	$username = "root";
	$password = "";
    $dbname="supv_uet";

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// echo "Connection Successfull";
	}
	catch(PDOException $e){
	    echo  $e->getMessage();
	}

	$sql = "select `device_id`, now() as dt, avg(`temp`) as temp, avg(`humidity`) as humd, avg(`CO`) as co, avg(`air_pressure`) as ap, avg(`wind_speed`) as ws, avg(`D_10`) as d10,avg(`D2_5`) as d25,avg(`NO`) as no,avg(`CO`) as co,avg(`SO_2`) as so2,avg(`No_x`) as nox,avg(`O3`) as o3 from raw_logs where server_datetime > (now() - INTERVAL 15 minute) group by mid";

	// echo $sql;

	$result = $conn -> query($sql) or die(error);

	$insert = "INSERT INTO `fine_data`(`device_id`, `temp`, `humidity`, `air_pressure`, `wind_speed`, `D_10`, `D2_5`, `NO`, `CO`, `No_x`, `SO_2`, `O3`, `packet_datetime`, `server_datetime`) VALUES";
	$flag = 0;
	foreach ($result as $row) {
		$device_id = $row['device_id'];
		$date = $row['dt'];
		$date = substr($date, 0, -3);
		$temp = $row['temp'];
		$humidity = $row['humd'];
		$co = $row['co'];
		$air_pressure = $row['ap'];
		$wind_speed = $row['ws'];
		$d_10 = $row['d10'];
        $d2_5 = $row['d25'];
        $No = $row['no'];
        $Co = $row['co'];
        $So_2 = $row['so2'];
        $NO_x = $row['nox'];
        $O3 = $row['o3'];

		$insert .= "('".$device_id."','".$temp."','".$humidity."','".$air_pressure."','".$wind_speed."','".$d_10."','".$d2_5."',,'".$No."','".$co."','".$NO_x."','".$So_2."','".$O3."','".$date."'),";

		// $update = "UPDATE `fine_data` SET `server_datetime`= '".$date."',`temp`='".$temp."',`humidity`='".$humidity."',`air_pressure`='".$air_pressure."', `wind_speed`= '".$wind_speed."', `D_10`='".$d_10."',`D2_5`= '".$d2_5."',`NO`= '".$No."',`CO`= '".$Co."',`No_x`= '".$NO_x."',`SO_2`= '".$So_2."',`O3`= '".$O3."' WHERE `device_id`='".$device_id."'";
		$result = $conn -> query($update) or die(error);
		$flag++;
	}

	if ($flag > 0) {
		$insert = substr($insert, 0, -1);
		try{
			$result = $conn -> query($insert) or die(error);
			echo "Success!";
		}catch(PDOException $e){
			echo "Error: ".$e; 
		}
		
	}else{
		echo "No data to insert!";
	}

	$conn = NULL;

?>
