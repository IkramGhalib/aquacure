<?php

	if (isset($_GET['apiflag']) and isset($_GET['subdivid'])) {
		$flag = $_GET['apiflag'];
		
		if ($flag == 'tankv10') {
			$module = $_GET['module'];
			$distance = $_GET['d'];
			$datetime = $_GET['dt'];
			$subdivid = $_GET['subdivid'];

			$query = "insert into tank_parameters(tank_id,datetime,distance) values ('".$module."', '".$datetime."','".$distance."')";
	 		
			$servername = "10.13.144.6";
			$username = "user_".$subdivid;
			$password = "Adm1n@".$subdivid;
			$dbname = "waterscada_".$subdivid;

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "wssckht";

			try {
			  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			  // set the PDO error mode to exception
			  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  //echo "Connected successfully";
			} catch(PDOException $e) {
			  echo "Connection failed: " . $e->getMessage();
			}
	    	$conn->query($query);
	    	echo "Success";
		}else{
    	echo "Invalid flag!";
    }
 	}else{
 		echo "Empty Flag or Subdivid!";
 	}

 ?>

