<?php

		//$subdivid =$subdiv_array[$x];
       // $subdivid = $_GET['subdivid'];
    $subdivs = array('pda');
    $dbtype = "waterscada";

    for($x=0; $x<sizeof($subdivs); $x++){

    	$subdivid = $subdivs[$x];
    	echo $subdivid."<br>";

    	$servername = "10.13.144.6";
		$username = "user_".$subdivid;
		$password = "Adm1n@".$subdivid;
		$dbname = $dbtype."_".$subdivid;

		// $servername = "localhost";
		// $username = "root";
		// $password = "";
		// $dbname = $dbtype."_".$subdivid;

		$current_threshold = 10;

		try {
		    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connection Successfull";
		}
		catch(PDOException $e){
			echo  $e->getMessage();
		}
		
		$update = "UPDATE faults SET status = 'Resolved', resolvedatetime = now() where  status = 'Pending' and trid in (select distinct moduleid from raw_pump_log where fault = 0 and server_date_time > (now() - interval 3 minute))";

		$result = $conn -> query($update) or die(error);

	   	$sql = "SELECT `moduleid`,`v_red`,`v_blue`,`v_yellow`,`i_red`,`i_blue`,`i_yellow`,`fault`,`server_date_time` from raw_pump_log where fault != 0 and server_date_time > (now() - interval 3 minute) and moduleid not in (select distinct trid from faults where status = 'Pending')";

	  	$result = $conn -> query($sql) or die(error);
	  	$insert_fault = "insert into faults (trid,type,v1,v2,v3,c1,c2,c3,status,`datetime`) values";
	  	$count = 0;
	  	
	  	foreach ($result as $row) {
	  		$q_flag = 0;
	  		$i1 = $row['i_red'];
	  		$i2 = $row['i_blue'];
	  		$i3 = $row['i_yellow'];

	  		if($row['fault']== 1){
				$status = 'Over Load';
				$q_flag++;
			}
			elseif ($row['fault']== 2 and ($i1 > $current_threshold or $i2 > $current_threshold or $i3 > $current_threshold)){
				$status = 'Under Load';
				$q_flag++;
			}
			elseif ($row['fault']== 3){
				$status = 'Over Voltage';
				$q_flag++;
			}
			elseif ($row['fault']== 4){
				$status = 'Under Voltage';
				$q_flag++;
			}

			if($q_flag > 0){
				$insert_fault = $insert_fault." ('".$row['moduleid']."', '".$status."', ".$row['v_red'].", ".$row['v_blue'].", ".$row['v_yellow'].", ".$i1.", ".$i2.", ".$i3.", 'Pending','".$row['server_date_time']."'),";
				$count++;
			}
			
			
	  	}

	  	echo $insert_fault;
	  	echo "Faults detected = ".$count."<br>";;
	  	if ($count>0) {
	  	  	$insert_fault = substr($insert_fault, 0, -1);
			$result = $conn -> query($insert_fault) or die(error);
	  	}

	  	$conn = NULL;


    }

?>