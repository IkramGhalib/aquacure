<?php

    // $servername = "10.13.144.6";
    // $username = "user_ncai";
    // $password = "Adm1n@ncai";
    // $dbname = "flood_basic";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smartenv";

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//  echo "Connection successful";
}
catch(PDOException $e)
{
echo $e->getMessage();
}

$conn1=new mysqli("localhost","root","","smartenv");

if(!$conn1){
	echo "Connection Failed";
}

?>