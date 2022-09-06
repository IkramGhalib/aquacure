<?php


	// $servername = "10.13.144.6";

	// $username = "user_26217";
	// $password = "Adm1n@26217";
	// $dbname = "smartenv_uetpswr";

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "sas_uetpswr";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//echo "Connection Successfull";
}
catch(PDOException $e)
    {
    echo  $e->getMessage();
    }
