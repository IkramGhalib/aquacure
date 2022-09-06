<?php
	

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "test";

$servername = "10.13.144.6";
$username = "user_26217";
$password = "Adm1n@26217"; // set this field "" (empty quotes) if you have not set any password in mysql
$dbname = "smartenv_uetpswr";

$conn="";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	echo "Connection Successfull";
}
catch(PDOException $e)
    {
    echo  $e->getMessage();
    }


	$data = $_GET['data'];
	//echo $data;

	$data_array = explode(",", $data);

	$query = "insert into devices_logs(`device_id`, `temperature`, `humidity`, `pressure`, `CO`, `LPC`, `alcohol`, `flame`, `NH3`, `Carbon_Monoxide`, `Ammonia`, `NO2_Nitrogen_dioxide`, `VOC`, `Hydrogen_Gas`, `Noice_Sensor`, `Ozone`, `Methane`, `Air_Quality`, `Dust_sensor_1`, `Dust_sensor_2p5`, `Dust_sensor_10`) values('$data_array[0]','$data_array[1]','$data_array[2]','$data_array[3]','$data_array[4]','$data_array[5]','$data_array[6]','$data_array[7]','$data_array[8]','$data_array[9]','$data_array[10]','$data_array[11]','$data_array[12]','$data_array[13]','$data_array[14]','$data_array[15]','$data_array[16]','$data_array[17]','$data_array[18]','$data_array[19]','$data_array[20]')";
	echo $query;
	echo "STEP 1";
		$stmt1 = $conn->prepare($query);
echo "STEP 2";
		$result1 = $stmt1->execute();
		echo "STEP 3";
		$count1 = $stmt1->rowCount();
echo "STEP 4";
		echo $count1;
echo "STEP 5";
	echo "SUCCESS";

	$conn = NULL; 

?>