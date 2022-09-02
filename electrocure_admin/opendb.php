<?php
	require_once("subdivid.php");

	 // $servername = "10.13.144.6";
	 // $username = "user_".$subdivid;
	 // $password = "Adm1n@".$subdivid;
	 // $dbname = $dbtype."_".$subdivid;


	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = $dbtype."_".$subdivid;

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connection Successfull";
	}
	catch(PDOException $e){
		echo  $e->getMessage();
	}

?>
